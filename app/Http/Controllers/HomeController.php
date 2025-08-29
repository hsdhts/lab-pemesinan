<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Barryvdh\DomPDF\Facade\PDF;

use Illuminate\Support\Facades\Cache;

use App\Models\Mesin;
use App\Models\User;
use App\Models\Maintenance;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
   /* public function _construct(){
        parent::__construct();
    }*/

    public function index(){

        if(Auth::user()->level != 'Mahasiswa'){
            $hari_ini = Jadwal::with(['maintenance', 'maintenance.mesin', 'maintenance.mesin'])
                        ->where('status', '<', 3)
                        ->get();

            $seminggu = Mesin::with(['user'])->get();
            $sebulan = User::where('users.level', '!=', 'Superadmin')->get();
            $totalJadwal = Jadwal::all();
            $totalMaintenance = Maintenance::count();
        }else{
            $user_id = Auth::user()->id;
            $hari_ini = Jadwal::with(['maintenance', 'maintenance.mesin', 'maintenance.mesin'])
                                ->whereRelation('maintenance.mesin','user_id', $user_id)
                                ->where('status', '<', 3)
                                ->get()->sortBy('tanggal_rencana');
            $seminggu = Mesin::with(['user'])->get();
            $sebulan = User::where('users.level', '!=', 'Superadmin')->get();
            $totalJadwal = Jadwal::whereRelation('maintenance.mesin', 'user_id', $user_id);
            $totalMaintenance = Maintenance::whereRelation('mesin', 'user_id', $user_id)->count();
        }

        $jadwal_chart_rencana = Jadwal::whereYear('tanggal_rencana', now(7)->year)->get()->groupBy(function($val) {
            return Carbon::parse($val->tanggal_rencana)->month;
            })->sort()->map(function($item){
                return $item->count();
            });

        //ddd($jadwal_chart_rencana);
        $jadwal_chart_realisasi = Jadwal::whereYear('tanggal_realisasi', now(7)->year)->where('status', '=', 4)->get()->groupBy(function($val) {
                return Carbon::parse($val->tanggal_rencana)->month;
            })->sort()->map(function($item){
                return $item->count();
            });


        return view('home', ['halaman' => 'Home',
         'chart_rencana' => $jadwal_chart_rencana,
         'chart_realisasi' => $jadwal_chart_realisasi,
         'hari_ini' => $hari_ini,
         'seminggu' => $seminggu,
         'sebulan' => $sebulan,
         'total_jadwal' => $totalJadwal,
         'total_maintenance' => $totalMaintenance,
        ]);



    }


    public function test(){

        return view('pages.jadwal.close_jadwal');

    }

    public function test2(Request $request){

        return $request;

    }

    public function load_test(){


//dd($collection);

        // Category functionality removed - setup data no longer available
        $setup = collect();
        Cache::put('setup', $setup, 60);


        //$maintenance = new Maintenance($setup->toArray());
        //dd($maintenance);
       // dd($kategori);
        return view('test_page.load_setup');
    }

    public function tes_kalender(){
        return view('test_page.test_calendar');
    }

    public function test_pdf(){


        $data = [
            'title' => 'Ya ndak tau kok tanya saia',
            'date' => 56575675,
        ];

        $pdf = PDF::loadView('test_page.test_for_pdf', $data);

        return $pdf->download('invoice.pdf');
    }


    public function test_laporan(){
        $jadwal = Jadwal::find(4);
        $mesin = $jadwal->maintenance->mesin;


        $data = ['mesin' => $mesin, 'jadwal' => $jadwal];

        //return view('reports.inspeksi', $data);

        $pdf = PDF::loadView('reports.inspeksi', $data);

        return $pdf->download('invoice.pdf');
    }



}
