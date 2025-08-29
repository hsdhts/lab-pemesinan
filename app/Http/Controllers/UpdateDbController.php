<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\UpdateTahunan;
use Illuminate\Support\Carbon;

class UpdateDbController extends Controller
{
    //


    public function index(){
        $tahun_terakhir = UpdateTahunan::latest()->get()->first();
       
        return view('pages.updateTahunan.index', ['tahun_terakhir' => $tahun_terakhir]);
    }

    public function update_jadwal(){
        

        if(UpdateTahunan::where('tahun', now(7))->get()->isEmpty()){
            $maintenance = Maintenance::all();

            foreach ($maintenance as $m) {

                $jadwalObj = new JadwalController();

                $tahun = Carbon::now(7)->year;
    
                $id_maintenance = $m->id;
                
                // Karena periode dan satuan_periode sudah dihapus, 
                // buat jadwal sederhana berdasarkan maintenance yang ada
                $jadwal_terakhir = $m->rencana_terakhir;
                if ($jadwal_terakhir) {
                    $waktu = Carbon::parse($jadwal_terakhir->tanggal_rencana, 7)->addMonth(); // Default tambah 1 bulan
                } else {
                    $waktu = Carbon::now(7); // Jika belum ada jadwal, mulai dari sekarang
                }
                
                // Buat jadwal baru untuk maintenance ini
                if($waktu->year <= $tahun){
                    $jadwalObj->buat_jadwal_dan_isi_form($waktu, $id_maintenance);
                }
                
            }

            // tambah data kalo sudah diupdate tahunan
            
            UpdateTahunan::create(['tahun' => now(7)->year]);
            

            return redirect('/update_tahunan')->with('berhasil_update','p');
        }else{
            return redirect('/update_tahunan')->withErrors(['pernah_update' => 'Sudah Pernah diupdate untuk tahun ini, tidak perlu update lagi']);
        }

    }


    
}
