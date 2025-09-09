<?php

namespace App\Http\Controllers;

use App\Models\Mesin;
use App\Models\Form;
use App\Models\Jadwal;
use App\Models\IsiForm;
use App\Models\Maintenance;
use App\Models\Sparepart;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Services\ImageOptimizationService;

class JadwalController extends Controller
{
    //
    function index($id) {
        //return view('jadwal', ['halaman' => 'Jadwal', 'link_to_create' => '/jadwal/create/']);

        //id mesin
        $mesin = Mesin::find($id);
        ///ddd($mesin);
        /*
        $maintenance = Maintenance::with(['jadwal' => function($query) {
            $query->withTrashed();
        }])->where('mesin_id', $id)->withTrashed()->get();
        */

        $maintenance = Maintenance::with(['jadwal'])->where('mesin_id', $id)->withTrashed()->get();

        $maintenance2 = Maintenance::with(['jadwal' => function($query) {
            $query->withTrashed()->where('status', '>', 20);
        }])->where('mesin_id', $id)->withTrashed()->get();

        $maintenance = $maintenance->concat($maintenance2);


        //ddd($maintenance);
        //return view('pages.jadwal.index');
        return view('pages.jadwal.index', ['halaman' => 'Jadwal', 'maintenance' => $maintenance, 'mesin' => $mesin]);
    }

    public function create_jadwal($id_maintenance){
    $maintenance = Maintenance::find($id_maintenance);

    // Start from current date
    $waktu = Carbon::now();

    // Langsung buat jadwal tanpa bergantung pada periode dan satuan_periode
    $this->buat_jadwal_dan_isi_form($waktu, $id_maintenance);
}


    public function buat_jadwal_dan_isi_form($waktu, $id_maintenance){
        // Check if schedule already exists for this date and maintenance
        $existingJadwal = Jadwal::where('tanggal_rencana', $waktu->format('Y-m-d H:i:s'))
                                ->where('maintenance_id', $id_maintenance)
                                ->first();

        if ($existingJadwal) {
            return; // Skip if schedule already exists
        }

        $jadwal = Jadwal::create(['tanggal_rencana' => $waktu, 'maintenance_id' => $id_maintenance]);

        $form = Form::where('maintenance_id', $id_maintenance)->get();
        foreach ($form as $f) {
            IsiForm::create([
                'jadwal_id' => $jadwal->id,
                'form_id' => $f->id,
            ]);
        }
    }

    public function detail($id){
        $jadwal = Jadwal::withTrashed()->find($id);
        $maintenance = Maintenance::withTrashed()->find($jadwal->maintenance_id);
        $mesin = Mesin::find($maintenance->mesin_id);
        $sparepart = Sparepart::all();

        // ddd($jadwal);
        $isi_form = IsiForm::withTrashed()->with(['form' => function($query) {
            $query->withTrashed();
        }])->where('jadwal_id', $id)->get();

        return view('pages.jadwal.detail', ['halaman' => 'Jadwal', 'jadwal' => $jadwal, 'isi_form' => $isi_form, 'mesin' => $mesin, 'maintenance' => $maintenance, 'sparepart' => $sparepart]);
    }


    public function update(Request $request){

        $data_valid = $request->validate([
            'id' => 'required|numeric',
            'tanggal_rencana' => 'required|date_format:d-m-Y',
            'tanggal_realisasi' => 'nullable|date_format:d-m-Y',
            'lama_pekerjaan' => 'nullable',
            'personel' => 'nullable',
            'keterangan' => 'nullable|not_regex:/\'/i',
            'foto_perbaikan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data_valid['tanggal_rencana'] = Carbon::parse($data_valid['tanggal_rencana']);
        if(isset($data_valid['tanggal_realisasi']) && $data_valid['tanggal_realisasi']){
            $data_valid['tanggal_realisasi'] = Carbon::parse($data_valid['tanggal_realisasi']);
        }
        $jadwal = Jadwal::find($data_valid['id']);

        if($request->has('alasan')){
            $data_valid['alasan'] = $request->alasan;
        }
        return $this->submit($request, $data_valid);

    }

    public function update_with_alasan(Request $request){

        $data_valid = $request->validate([
            'id' => 'required|numeric',
            'tanggal_rencana' => 'required|date_format:d-m-Y',
            'tanggal_realisasi' => 'nullable|date_format:d-m-Y',
            'lama_pekerjaan' => 'nullable',
            'personel' => 'nullable',
            'keterangan' => 'nullable|not_regex:/\'/i',
        ]);

        $validator = Validator::make($request->all(), [
            'alasan' => 'required'
        ]);


        if($validator->fails()){
            return redirect()->back()->withInput()->with('form_alasan', 'p')->withErrors(['alasan' => 'Alasan tidak boleh kosong!']);
        }

        $data_valid['alasan'] = $validator->validated()['alasan'];
        $data_valid['tanggal_rencana'] = Carbon::parse($data_valid['tanggal_rencana']);
        if(isset($data_valid['tanggal_realisasi']) && $data_valid['tanggal_realisasi']){
            $data_valid['tanggal_realisasi'] = Carbon::parse($data_valid['tanggal_realisasi']);
        }

        return $this->submit($request, $data_valid);

    }

    public function submit($request, $data_valid) {


        $jadwal = Jadwal::find($data_valid['id']);

        // Remove tanggal_realisasi and foto_perbaikan from data_valid if they exist
        unset($data_valid['tanggal_realisasi']);
        if (isset($data_valid['foto_perbaikan'])) {
            unset($data_valid['foto_perbaikan']);
        }

        // Handle foto_perbaikan upload with optimization
        if ($request->hasFile('foto_perbaikan')) {
            $imageService = new ImageOptimizationService();
            
            // Delete old photo if exists
            if ($jadwal->foto_perbaikan) {
                $imageService->deleteImage($jadwal->foto_perbaikan);
            }
            
            // Optimize and store new image
            $foto_path = $imageService->optimizeAndStore(
                $request->file('foto_perbaikan'),
                'foto_perbaikan',
                1200, // max width
                800,  // max height
                85    // quality
            );
            
            if ($foto_path) {
                $jadwal->foto_perbaikan = $foto_path;
                // Create thumbnail for faster loading
                $imageService->createThumbnail($foto_path);
            }
        }

        $jadwal->update($data_valid);

        if($jadwal->status == 1){
            $jadwal->increment('status');
        }

        if(isset($request->validasi)){
            $jadwal->increment('status');
            // Auto-set tanggal_realisasi when task is validated/completed
            $jadwal->tanggal_realisasi = Carbon::now();
            $jadwal->save();
        }


        if($request->has('isi_form')){
        foreach($request->isi_form as $key => $value){
            IsiForm::find($key)->update(['nilai' => $value]);
            }
        }

        return redirect('/jadwal/detail/' . $jadwal->id);
    }

    public function indexAll() {
        // Logic untuk menampilkan semua jadwal
        $maintenance = Maintenance::with(['jadwal'])->withTrashed()->get();

        return view('pages.jadwal.index_all', [
            'halaman' => 'Semua Jadwal',
            'maintenance' => $maintenance
        ]);
    }

    public function updateStatus(Request $request, $id) {
        try {
            $validator = Validator::make($request->all(), [
                'status' => 'required|integer|in:1,2'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Status tidak valid. Hanya status 1 (Belum Dikerjakan) dan 2 (Dalam Pekerjaan) yang diizinkan.'
                ], 400);
            }

            $jadwal = Jadwal::find($id);
            
            if (!$jadwal) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jadwal tidak ditemukan.'
                ], 404);
            }

            $jadwal->status = $request->status;
            $jadwal->save();

            $statusText = $request->status == 1 ? 'Belum Dikerjakan' : 'Dalam Pekerjaan';

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui menjadi ' . $statusText,
                'data' => [
                    'id' => $jadwal->id,
                    'status' => $jadwal->status,
                    'status_text' => $statusText
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui status: ' . $e->getMessage()
            ], 500);
        }
    }
}
