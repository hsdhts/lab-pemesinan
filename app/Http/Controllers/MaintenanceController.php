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
                'periode' => $s->get('periode'),
                'satuan_periode' => $s->get('satuan_periode'),
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
            'halaman' => 'Maintenace',
            'mesin' => $mesin,
            'maintenance' => $maintenance,
            'form' => $form
           ]);
    }


    public function maintenance_add(Request $request){
        //maintenance ditambahkan bersama form nya

        $objectJadwal = new JadwalController();

        $validator = Validator::make($request->all(), [
            'mesin_id' => 'required|numeric',
            'nama_maintenance' => 'required',
            'periode' => 'required|numeric',
            'satuan_periode' => 'required',
            'warna' => 'required'
        ]);



        // Cek apakah ada error validasi sebelum menyimpan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Jika validasi berhasil, lanjutkan proses pembuatan maintenance
        try {
            $maintenance = Maintenance::create([
                'mesin_id' => $request->mesin_id,
                'nama_maintenance' => $request->nama_maintenance,
                'periode' => $request->periode,
                'satuan_periode' => $request->satuan_periode,
                'warna' => $request->warna,
            ]);

            $objectJadwal->create_jadwal($maintenance->id);

            return redirect('/jadwal/' . $request->mesin_id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data maintenance. Silakan coba lagi.');
        }
    }







}
