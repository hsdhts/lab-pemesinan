<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Mesin;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\JadwalController;
use App\Models\Sparepart;

class MaintenanceController extends Controller
{
    //
    public function update()
    {
        $setup = collect(Cache::pull('setup'));
        $mesin = collect(Cache::pull('mesin'));

        $objectJadwal = new JadwalController();

        // Cek apakah objek Mesin ditemukan
        $mesinObj = Mesin::find($mesin->get('id'));
        if (!$mesinObj) {
            return redirect()->back()->with('error', 'Mesin not found.');
        }

        // Category functionality removed

        // Pengecekan apakah $mesin->get('maintenance') adalah sebuah koleksi
        if (is_array($mesin->get('maintenance')) && !empty($mesin->get('maintenance'))) {
            Maintenance::where('mesin_id', $mesin->get('id'))->delete();
        }

        foreach ($setup as $s) {
            $maintenance = Maintenance::create([
                'nama_maintenance' => $s->get('nama_setup'),
                'mesin_id' => $mesin->get('id'),
                'warna' => $s->get('warna'),
            ]);

            foreach ($s->get('setupForm') as $form) {
                Form::create([
                    'maintenance_id' => $maintenance->id,
                    'nama_form' => $form->get('nama_setup_form'),
                    'syarat' => $form->get('syarat_setup_form'),
                ]);
            }

            $objectJadwal->create_jadwal($maintenance->id);
        }

        return redirect('/jadwal/' . $mesin->get('id'));
    }




    public function maintenance_mesin($id){

        $mesin = Mesin::with(['maintenance', 'form'])->find($id);

        $maintenance = $mesin->maintenance;
        $form = $mesin->form;


        return view('pages.maintenance.maintenance', [
            'halaman' => 'Breakdown',
            'mesin' => $mesin,
            'maintenance' => $maintenance,
            'form' => $form
           ]);
    }


    public function maintenance_add(Request $request){

        $objectJadwal = new JadwalController();

        $validator = Validator::make($request->all(), [
            'mesin_id' => 'required|numeric',
            'nama_maintenance' => 'required',
            'warna' => 'required',
            'foto_kerusakan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);



        // Cek apakah ada error validasi sebelum menyimpan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Jika validasi berhasil, lanjutkan proses pembuatan maintenance
        try {
            $fotoKerusakanPath = null;

            // Handle file upload untuk foto_kerusakan
            if ($request->hasFile('foto_kerusakan')) {
                $file = $request->file('foto_kerusakan');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $fotoKerusakanPath = $file->storeAs('foto_kerusakan', $fileName, 'public');
            }

            $maintenance = Maintenance::create([
                'mesin_id' => $request->mesin_id,
                'nama_maintenance' => $request->nama_maintenance,
                'warna' => $request->warna,
                'foto_kerusakan' => $fotoKerusakanPath,
            ]);

            $objectJadwal->create_jadwal($maintenance->id);

            return redirect('/jadwal/' . $request->mesin_id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data maintenance. Silakan coba lagi.');
        }
    }







}
