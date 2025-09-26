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

        // Tampilkan semua data untuk Admin dan Superadmin
        $query = Jadwal::with(['maintenance', 'maintenance.mesin', 'maintenance.mesin.stasiun'])
                    ->where('status', '<', 3);

        $hari_ini = $query->get();

        $mesinQuery = Mesin::with(['user', 'stasiun']);
        $seminggu = $mesinQuery->get();

        $sebulan = User::where('users.level', '!=', 'Superadmin')->get();

        $totalJadwalQuery = Jadwal::query();
        $totalJadwal = $totalJadwalQuery->get();

        $maintenanceQuery = Maintenance::query();
        $totalMaintenance = $maintenanceQuery->count();

        // Chart data untuk Admin dan Superadmin - Optimasi dengan raw query dan caching
        $jadwal_chart_rencana = Cache::remember('chart_rencana_' . $user->id . '_' . now()->year, 600, function() {
            $chartQuery = Jadwal::selectRaw('MONTH(tanggal_rencana) as month, COUNT(*) as count')
                ->whereYear('tanggal_rencana', now()->year)
                ->where('status', '<', 3) // Only show planned breakdown/maintenance (not yet verified by superadmin)
                ->groupBy('month')
                ->orderBy('month');

            return $chartQuery->pluck('count', 'month');
        });

        //ddd($jadwal_chart_rencana);
        $jadwal_chart_realisasi = Cache::remember('chart_realisasi_' . $user->id . '_' . now()->year, 600, function() {
            $chartRealisasiQuery = Jadwal::selectRaw('MONTH(tanggal_realisasi) as month, COUNT(*) as count')
                ->whereYear('tanggal_realisasi', now()->year)
                ->where('status', '>=', 3) // Only show completed and verified maintenance
                ->whereNotNull('tanggal_realisasi') // Ensure it has completion date
                ->groupBy('month')
                ->orderBy('month');

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

        $setup = collect();
        Cache::put('setup', $setup, 60);
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

        $pdf = PDF::loadView('reports.inspeksi', $data);

        return $pdf->download('invoice.pdf');
    }
}
