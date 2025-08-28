<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Maintenance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalApproveController extends Controller
{
    //

    public function index(Request $request){

        // Set default date range
        if($request->tanggal_awal||$request->tanggal_akhir){

            if($request->tanggal_awal && $request->tanggal_akhir){
                $tglawal = Carbon::parse($request->tanggal_awal);
                $tglakhir = Carbon::parse($request->tanggal_akhir);

                if($tglawal->greaterThan($tglakhir)){
                    return redirect()->back()->withErrors(['tanggal_lebih_besar' => 'Tanggal awal tidak boleh mendahului dari tanggal akhir']);
                }

            }else{
                $tglawal = now()->subDays(90);
                $tglakhir = now();
                return redirect()->back()->withErrors(['salah_input' => 'Pastikan input tanggal yang anda masukkan benar!']);

            }


        }else{
            $tglawal = now()->subDays(90);
            $tglakhir = now();
        }

        // Query dengan filter tanggal pada tanggal_realisasi
        $query = Jadwal::with(['maintenance', 'maintenance.mesin'])
            ->whereIn('status', [3, 4])
            ->whereNotNull('tanggal_realisasi') // Pastikan tanggal_realisasi tidak null
            ->whereDate('tanggal_realisasi', '>=', $tglawal->format('Y-m-d'))
            ->whereDate('tanggal_realisasi', '<=', $tglakhir->format('Y-m-d'));

        // Tambahkan filter mesin jika ada
        if($request->mesin_filter && $request->mesin_filter != ''){
            $query = $query->whereHas('maintenance.mesin', function($q) use ($request) {
                $q->where('nama_mesin', 'like', '%' . $request->mesin_filter . '%');
            });
        }

        $jadwal = $query->orderBy('tanggal_realisasi', 'desc')->get();



        return view('pages.jadwal.close_jadwal', compact('jadwal'));

    }

    // Fungsi approve dihapus karena sekarang hanya menampilkan history laporan pekerjaan yang sudah selesai

    private function buat_jadwal($id_maintenance, $start_date){


    $maintenance = Maintenance::find($id_maintenance);
    $tahun = Carbon::now()->year;

    $jadwalObj = new JadwalController();

    $waktu = Carbon::parse($start_date);
    //echo "Awalnya adalah " . $waktu->format('d-m-Y') . "<br>";

    $periode = $maintenance->periode;
    $satuan_periode = $maintenance->satuan_periode;


        switch ($satuan_periode) {
            case 'Jam':
                $waktu->addHour($periode);

                while($waktu->year === $tahun){
                    //echo $waktu->format('d-m-Y') . "<br>";

                    $jadwalObj->buat_jadwal_dan_isi_form($waktu, $id_maintenance);

                    $waktu->addHour($periode);
                }
                break;
            case 'Hari':
                $waktu->addDays($periode);

                while($waktu->year === $tahun){
                    //echo $waktu->format('d-m-Y') . "<br>";

                    //Jadwal::create(['tanggal_rencana' => $waktu, 'maintenance_id' => $id_maintenance]);
                    $jadwalObj->buat_jadwal_dan_isi_form($waktu, $id_maintenance);


                    $waktu->addDays($periode);
                }
                break;

            case 'Minggu':
                    $waktu->addWeeks($periode);

                    while($waktu->year === $tahun){
                        //echo $waktu->format('d-m-Y') . "<br>";

                        //Jadwal::create(['tanggal_rencana' => $waktu, 'maintenance_id' => $id_maintenance]);
                        $jadwalObj->buat_jadwal_dan_isi_form($waktu, $id_maintenance);


                        $waktu->addWeeks($periode);
                    }
                break;

            case 'Bulan':
                    $waktu->addMonths($periode);

                    while($waktu->year === $tahun){
                        //echo $waktu->format('d-m-Y') . "<br>";

                        //Jadwal::create(['tanggal_rencana' => $waktu, 'maintenance_id' => $id_maintenance]);
                        $jadwalObj->buat_jadwal_dan_isi_form($waktu, $id_maintenance);

                        $waktu->addMonths($periode);
                    }
                    break;

            case 'Tahun':
                $waktu->addYears($periode);

                while($waktu->year === $tahun){
                    //echo $waktu->format('d-m-Y') . "<br>";

                    //Jadwal::create(['tanggal_rencana' => $waktu, 'maintenance_id' => $id_maintenance]);
                    $jadwalObj->buat_jadwal_dan_isi_form($waktu, $id_maintenance);

                    $waktu->addYears($periode);
                }
                break;

            default:
                # code...
                break;
        }


    }


}
