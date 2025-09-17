<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Jadwal;
use App\Models\Mesin;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Services\ImageOptimizationService;

class UpdateMaintenanceController extends Controller
{
    public function create(Request $request){
        $data_valid = $request->validate([
            'mesin_id' => 'required|numeric',
            'nama_maintenance' => 'required|string|max:255',
            'warna' => 'required|string',
            'foto_kerusakan' => 'nullable|array',
            'foto_kerusakan.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Verify that the mesin exists with detailed debugging
        $mesin = Mesin::find($data_valid['mesin_id']);
        if (!$mesin) {
            // Add debugging information for hosting environment
            \Log::error('Mesin not found', [
                'mesin_id' => $data_valid['mesin_id'],
                'request_data' => $request->all(),
                'database_connection' => config('database.default'),
                'environment' => app()->environment()
            ]);
            
            // Check if any mesin exists at all
            $totalMesin = Mesin::count();
            $allMesinIds = Mesin::pluck('id')->toArray();
            
            return redirect()->back()->with('error', 
                'Mesin tidak ditemukan. ID: ' . $data_valid['mesin_id'] . 
                '. Total mesin di database: ' . $totalMesin . 
                '. ID mesin yang tersedia: ' . implode(', ', $allMesinIds)
            );
        }

        // Handle multiple file uploads with optimization
        $foto_kerusakan_paths = [];
        if ($request->hasFile('foto_kerusakan')) {
            $imageService = new ImageOptimizationService();

            foreach ($request->file('foto_kerusakan') as $file) {
                $foto_path = $imageService->optimizeAndStore(
                    $file,
                    'maintenance_photos',
                    1200, // max width
                    800,  // max height
                    85    // quality
                );

                if ($foto_path) {
                    $foto_kerusakan_paths[] = $foto_path;
                    // Create thumbnail for faster loading
                    $imageService->createThumbnail($foto_path);
                }
            }
        }

        // Convert array to JSON string for database storage
        $foto_kerusakan = !empty($foto_kerusakan_paths) ? json_encode($foto_kerusakan_paths) : null;

        // Create maintenance record
        $maintenance = Maintenance::create([
            'nama_maintenance' => $data_valid['nama_maintenance'],
            'mesin_id' => $data_valid['mesin_id'],
            'warna' => $data_valid['warna'],
            'foto_kerusakan' => $foto_kerusakan
        ]);

        $objectJadwal = new JadwalController();
        $objectJadwal->create_jadwal($maintenance->id);

        return redirect('/mesin/maintenance/' . $request->mesin_id)->with('success', 'Breakdown berhasil ditambahkan!');
    }

    public function edit(Request $request){

        $data_valid = $request->validate([
            'mesin_id' => 'required|numeric',
            'maintenance_id' => 'required|numeric'
        ]);

        $mesin = Mesin::with(['maintenance', 'form'])->find($data_valid['mesin_id']);

        $maintenance = Maintenance::find($data_valid['maintenance_id']);
        $setup = collect([$maintenance])->map(function($item){

            return collect([
               'nama_maintenance' => $item->nama_maintenance,
               'warna' => $item->warna,
               'foto_kerusakan' => $item->foto_kerusakan,

               'setupForm' => $item->form->map(function($i) {
                   return collect([
                       'nama_setup_form' => $i->nama_form,
                       'syarat_setup_form' => $i->syarat,
                       'value' => $i->value,
                   ]);
                   })
           ]);
           });
           $attach = collect(['aksi' => 'edit', 'maintenance_id' => $data_valid['maintenance_id']]);

           Cache::put('attach', $attach, now()->addMinutes(30));
           Cache::put('setup', $setup, now()->addMinutes(30));
           Cache::put('mesin', $mesin, now()->addMinutes(30));
           return redirect('/mesin/maintenance/' . $data_valid['mesin_id']);

    }

    public function submit_create(){
        $setup = collect(Cache::pull('setup'));
        $mesin = collect(Cache::pull('mesin'));
        Cache::forget('attach');

        $objectJadwal = new JadwalController();



            foreach($setup as $s){
                $maintenance = Maintenance::create([
                    'nama_maintenance' => $s->get('nama_maintenance'),
                    'mesin_id' => $mesin->get('id'),
                    'warna' => $s->get('warna'),
                    'foto_kerusakan' => $s->get('foto_kerusakan')
                ]);
                foreach($s->get('setupForm') as $form){
                    Form::create([
                        'maintenance_id' => $maintenance['id'],
                        'nama_form' => $form->get('nama_setup_form'),
                        'syarat' => $form->get('syarat_setup_form'),
                    ]);
                }
                $objectJadwal->create_jadwal($maintenance->id);


            }

        return redirect('/jadwal/'.$mesin['id']);

    }


    public function submit_edit(){
        $setup = collect(Cache::pull('setup'));
        $mesin = collect(Cache::pull('mesin'));
        $attach = collect(Cache::pull('attach'));

        $objectJadwal = new JadwalController();


            foreach($setup as $s){
                $maintenance = Maintenance::create([
                    'nama_maintenance' => $s->get('nama_maintenance'),
                    'mesin_id' => $mesin->get('id'),
                    'warna' => $s->get('warna'),
                    'foto_kerusakan' => $s->get('foto_kerusakan')
                ]);
                foreach($s->get('setupForm') as $form){
                    Form::create([
                        'maintenance_id' => $maintenance['id'],
                        'nama_form' => $form->get('nama_setup_form'),
                        'syarat' => $form->get('syarat_setup_form'),
                    ]);
                }
                $objectJadwal->create_jadwal($maintenance->id);


            }


            Jadwal::where('maintenance_id', $attach['maintenance_id'])->where('tanggal_rencana', '>=', now())->forceDelete();

            // Update past scheduled maintenance status
            $jadwal = Jadwal::where('maintenance_id', $attach['maintenance_id'])->where('tanggal_rencana', '<', now());
            $jadwal->increment('status', 20);

            Maintenance::destroy($attach['maintenance_id']);
            return redirect('/jadwal/'.$mesin['id']);


    }


    public function delete(Request $request){
        $data_valid = $request->validate([
            'maintenance_id' => 'required|numeric',
            'mesin_id' => 'required|numeric'
        ]);

        try {
            $maintenance = Maintenance::find($data_valid['maintenance_id']);

            if (!$maintenance) {
                return redirect()->back()->with('error', 'Data maintenance tidak ditemukan.');
            }

            if ($maintenance->foto_kerusakan && Storage::disk('public')->exists($maintenance->foto_kerusakan)) {
                Storage::disk('public')->delete($maintenance->foto_kerusakan);
            }

            Maintenance::destroy($data_valid['maintenance_id']);

            return redirect('/jadwal/'.$data_valid['mesin_id'])->with('success', 'Data maintenance berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data maintenance.');
        }
    }

    public function edit_direct(Request $request){
        $validator = Validator::make($request->all(), [
            'maintenance_id' => 'required|numeric',
            'mesin_id' => 'required|numeric',
            'nama_maintenance' => 'required|string|max:255',
            'warna' => 'required|string',
            'foto_kerusakan' => 'nullable|array',
            'foto_kerusakan.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $maintenance = Maintenance::find($request->maintenance_id);

            if (!$maintenance) {
                return redirect()->back()->with('error', 'Data maintenance tidak ditemukan.');
            }

            $fotoKerusakanPath = $maintenance->foto_kerusakan;

            if ($request->hasFile('foto_kerusakan')) {
                if ($maintenance->foto_kerusakan) {
                    $oldPhotos = json_decode($maintenance->foto_kerusakan, true);
                    if (is_array($oldPhotos)) {
                        foreach ($oldPhotos as $oldPhoto) {
                            if (Storage::disk('public')->exists($oldPhoto)) {
                                Storage::disk('public')->delete($oldPhoto);
                            }
                        }
                    } elseif (Storage::disk('public')->exists($maintenance->foto_kerusakan)) {
                        Storage::disk('public')->delete($maintenance->foto_kerusakan);
                    }
                }

                $imageService = new ImageOptimizationService();
                $foto_kerusakan_paths = [];

                foreach ($request->file('foto_kerusakan') as $file) {
                    $foto_path = $imageService->optimizeAndStore(
                        $file,
                        'maintenance_photos',
                        1200, // max width
                        800,  // max height
                        85    // quality
                    );

                    if ($foto_path) {
                        $foto_kerusakan_paths[] = $foto_path;
                        $imageService->createThumbnail($foto_path);
                    }
                }

                $fotoKerusakanPath = !empty($foto_kerusakan_paths) ? json_encode($foto_kerusakan_paths) : null;
            }

            $maintenance->update([
                'nama_maintenance' => $request->nama_maintenance,
                'warna' => $request->warna,
                'foto_kerusakan' => $fotoKerusakanPath,
            ]);

            return redirect('/mesin/maintenance/' . $request->mesin_id)->with('success', 'Data berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate data maintenance.');
        }
    }

}
