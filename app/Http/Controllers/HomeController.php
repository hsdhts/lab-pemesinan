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
        $user = Auth::user();
        
        // Cache key berdasarkan user dan level untuk optimasi
        $cacheKey = 'dashboard_data_' . $user->id . '_' . $user->level;
        
        // Dapatkan stasiun user berdasarkan mesin yang dimiliki dengan caching
        $userStasiuns = collect();
        if($user->level == 'Mahasiswa' || $user->level == 'Teknisi') {
            $userStasiuns = Cache::remember('user_stasiuns_' . $user->id, 300, function() use ($user) {
                return $user->mesin()->with('stasiun')->get()->pluck('stasiun.id')->filter()->unique();
            });
        }

        if($user->level != 'Mahasiswa'){
            // Untuk non-mahasiswa, tampilkan semua data atau filter berdasarkan stasiun jika teknisi
            $query = Jadwal::with(['maintenance', 'maintenance.mesin', 'maintenance.mesin.stasiun'])
                        ->where('status', '<', 3);
            
            if($user->level == 'Teknisi' && $userStasiuns->isNotEmpty()) {
                $query->whereHas('maintenance.mesin', function($q) use ($userStasiuns) {
                    $q->whereIn('stasiun_id', $userStasiuns);
                });
            }
            
            $hari_ini = $query->get();

            $mesinQuery = Mesin::with(['user', 'stasiun']);
            if($user->level == 'Teknisi' && $userStasiuns->isNotEmpty()) {
                $mesinQuery->whereIn('stasiun_id', $userStasiuns);
            }
            $seminggu = $mesinQuery->get();
            
            $sebulan = User::where('users.level', '!=', 'Superadmin')->get();
            
            $totalJadwalQuery = Jadwal::query();
            if($user->level == 'Teknisi' && $userStasiuns->isNotEmpty()) {
                $totalJadwalQuery->whereHas('maintenance.mesin', function($q) use ($userStasiuns) {
                    $q->whereIn('stasiun_id', $userStasiuns);
                });
            }
            $totalJadwal = $totalJadwalQuery->get();
            
            $maintenanceQuery = Maintenance::query();
            if($user->level == 'Teknisi' && $userStasiuns->isNotEmpty()) {
                $maintenanceQuery->whereHas('mesin', function($q) use ($userStasiuns) {
                    $q->whereIn('stasiun_id', $userStasiuns);
                });
            }
            $totalMaintenance = $maintenanceQuery->count();
        }else{
            $user_id = $user->id;
            $hari_ini = Jadwal::with(['maintenance', 'maintenance.mesin', 'maintenance.mesin.stasiun'])
                                ->whereRelation('maintenance.mesin','user_id', $user_id)
                                ->where('status', '<', 3)
                                ->get()->sortBy('tanggal_rencana');
            $seminggu = Mesin::with(['user', 'stasiun'])->where('user_id', $user_id)->get();
            $sebulan = User::where('users.level', '!=', 'Superadmin')->get();
            $totalJadwal = Jadwal::whereRelation('maintenance.mesin', 'user_id', $user_id);
            $totalMaintenance = Maintenance::whereRelation('mesin', 'user_id', $user_id)->count();
        }

        // Chart data dengan filtering stasiun - Optimasi dengan raw query dan caching
        $jadwal_chart_rencana = Cache::remember('chart_rencana_' . $user->id . '_' . now()->year, 600, function() use ($user, $userStasiuns) {
            $chartQuery = Jadwal::selectRaw('MONTH(tanggal_rencana) as month, COUNT(*) as count')
                ->whereYear('tanggal_rencana', now()->year)
                ->groupBy('month')
                ->orderBy('month');
                
            if(($user->level == 'Teknisi' || $user->level == 'Mahasiswa') && $userStasiuns->isNotEmpty()) {
                $chartQuery->whereHas('maintenance.mesin', function($q) use ($userStasiuns) {
                    $q->whereIn('stasiun_id', $userStasiuns);
                });
            } elseif($user->level == 'Mahasiswa') {
                $chartQuery->whereRelation('maintenance.mesin','user_id', $user->id);
            }
            
            return $chartQuery->pluck('count', 'month');
        });

        //ddd($jadwal_chart_rencana);
        $jadwal_chart_realisasi = Cache::remember('chart_realisasi_' . $user->id . '_' . now()->year, 600, function() use ($user, $userStasiuns) {
            $chartRealisasiQuery = Jadwal::selectRaw('MONTH(tanggal_realisasi) as month, COUNT(*) as count')
                ->whereYear('tanggal_realisasi', now()->year)
                ->where('status', '=', 4)
                ->groupBy('month')
                ->orderBy('month');
                
            if(($user->level == 'Teknisi' || $user->level == 'Mahasiswa') && $userStasiuns->isNotEmpty()) {
                $chartRealisasiQuery->whereHas('maintenance.mesin', function($q) use ($userStasiuns) {
                    $q->whereIn('stasiun_id', $userStasiuns);
                });
            } elseif($user->level == 'Mahasiswa') {
                $chartRealisasiQuery->whereRelation('maintenance.mesin','user_id', $user->id);
            }
            
            return $chartRealisasiQuery->pluck('count', 'month');
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
