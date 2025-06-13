<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Mesin;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
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
    
        $mesinObj->update(['kategori_id' => $mesin->get('kategori_id')]);
    
        // Pengecekan apakah $mesin->get('maintenance') adalah sebuah koleksi
        if (is_array($mesin->get('maintenance')) && !empty($mesin->get('maintenance'))) {
            Maintenance::where('mesin_id', $mesin->get('id'))->delete();
        }
    
        // foreach ($setup as $s) {
        //     $start_time = null;
        //     $end_time = null;

        //     if ($s->get('satuan_periode') === 'Jam') {
        //         $start_time = $s->get('start_time');
        //         $end_time = $s->get('end_time');
        //     }

        //     $maintenance = Maintenance::create([
        //         'nama_maintenance' => $s->get('nama_setup'),
        //         'mesin_id' => $mesin->get('id'),
        //         'periode' => $s->get('periode'),
        //         'satuan_periode' => $s->get('satuan_periode'),
        //         'start_date' => Carbon::parse($s->get('start_date')),
        //         'end_date' => Carbon::parse($s->get('end_date')),
        //         'warna' => $s->get('warna'),
        //         'start_time' => $start_time,
        //         'end_time' => $end_time,
        //     ]);
            
        //     foreach ($s->get('setupForm') as $form) {
        //         Form::create([
        //             'maintenance_id' => $maintenance->id,
        //             'nama_form' => $form->get('nama_setup_form'),
        //             'syarat' => $form->get('syarat_setup_form'),
        //         ]);
        //     }
    
        //     $objectJadwal->create_jadwal($maintenance->id);
        // }
    
        foreach ($setup as $s) {
            // Atur ulang $start_time dan $end_time menjadi null di setiap iterasi
            $start_time = null;
            $end_time = null;

            if ($s->get('satuan_periode') === 'Jam') {
                $start_time = $s->get('start_time');
                $end_time = $s->get('end_time');
            }

            $maintenance = Maintenance::create([
                'nama_maintenance' => $s->get('nama_setup'),
                'mesin_id' => $mesin->get('id'),
                'periode' => $s->get('periode'),
                'satuan_periode' => $s->get('satuan_periode'),
                'start_date' => Carbon::parse($s->get('start_date')),
                'end_date' => Carbon::parse($s->get('end_date')),
                'warna' => $s->get('warna'),
                'start_time' => $start_time,
                'end_time' => $end_time,
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

        $mesin = Mesin::with(['maintenance',  'kategori', 'form'])->find($id);

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
        dd($request);
        //maintenance ditambahkan bersama form nya
        
        $objectJadwal = new JadwalController();
    
        $validator = Validator::make($request->all(), [
            'mesin_id' => 'required|numeric',
            'nama_maintenance' => 'required',
            'periode' => 'required|numeric',
            'satuan_periode' => 'required',
            'start_date' => 'required|date_format:d-m-Y',
            'end_date' => 'required|date_format:d-m-Y',
            'warna' => 'required'
        ]);
    
        // Validasi jika satuan periode adalah jam
        if ($validator->passes() && $request->satuan_periode === 'Jam') {
            // Parsing input date
            $start_date = Carbon::parse($request->start_date);
            $end_date = Carbon::parse($request->end_date);
            
            // Periksa apakah perbedaan antara start_date dan end_date kurang dari atau sama dengan 1 hari
            if ($start_date->diffInDays($end_date) > 0) {
                return redirect()->back()->with('error', 'Untuk satuan jam, perbedaan antara start date dan end date harus kurang dari atau sama dengan 1 hari.');
            }
        }
    
        // Cek apakah ada error validasi sebelum menyimpan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Jika validasi berhasil, lanjutkan proses pembuatan maintenance
        try {
            $start_time = null;
            $end_time = null;

            if ($request->satuan_periode === 'Jam') {
                $start_time = $request->start_time;
                $end_time = $request->end_time;
            }

            $maintenance = Maintenance::create([
                'mesin_id' => $request->mesin_id,
                'nama_maintenance' => $request->nama_maintenance,
                'periode' => $request->periode,
                'satuan_periode' => $request->satuan_periode,
                'start_date' => Carbon::parse($request->start_date),
                'end_date' => Carbon::parse($request->end_date),
                'warna' => $request->warna,
                'start_time' => $start_time,
                'end_time' => $end_time,
            ]);
    
            $objectJadwal->create_jadwal($maintenance->id);
            
            return redirect('/jadwal/' . $request->mesin_id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data maintenance. Silakan coba lagi.');
        }
    }
    
    
    
    



}
