<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Cache;
use App\Models\Kategori;
use App\Models\Mesin;
use App\Models\User;
use App\Models\KernelHydroCyclone;
use App\Models\HydroCycloneLosses;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $kernel_hydrocyclones = KernelHydroCyclone::all();
        $hydrocyclone_losses = HydroCycloneLosses::all();

        if(Auth::user()->level != 'Mahasiswa'){
            $seminggu = Mesin::with(['kategori', 'user'])->get();
            $sebulan = User::where('users.level', '!=', 'Superadmin')->get();
        }else{
            $user_id = Auth::user()->id;
            $seminggu = Mesin::with(['kategori', 'user'])->get();
            $sebulan = User::where('users.level', '!=', 'Superadmin')->get();
        }

        $jadwal_chart_rencana = Jadwal::whereYear('tanggal_rencana', now(7)->year)->get()->groupBy(function($val) {
            return Carbon::parse($val->tanggal_rencana)->month;
        })->sort()->map(function($item){
            return $item->count();
        });

        $jadwal_chart_realisasi = Jadwal::whereYear('tanggal_realisasi', now(7)->year)
            ->where('status', '=', 4)
            ->get()
            ->groupBy(function($val) {
                return Carbon::parse($val->tanggal_rencana)->month;
            })->sort()->map(function($item){
                return $item->count();
            });

        return view('home', [
            'halaman' => 'Home',
            'chart_rencana' => $jadwal_chart_rencana,
            'chart_realisasi' => $jadwal_chart_realisasi,
            'kernel_hydrocyclones' => $kernel_hydrocyclones,
            'hydrocyclone_losses' => $hydrocyclone_losses,
            'seminggu' => $seminggu,
            'sebulan' => $sebulan
        ]);
    }

    public function test()
    {
        return view('pages.jadwal.close_jadwal');
    }

    public function test2(Request $request)
    {
        return $request;
    }

    public function load_test()
    {
        $setup = Kategori::with(['SetupMaintenance'])->find(1)->setupMaintenance;
        $setup = $setup->map(function($item){
            return collect([
                'nama_setup' => $item->nama_setup_maintenance,
                'periode' => $item->periode,
                'satuan_periode' => $item->satuan_periode,
                'setupForm' => $item->setupForm->map(function($i) {
                    return collect([
                        'nama_setup_form' => $i->nama_setup_form,
                        'setup_maintenance_id' => $i->setup_maintenance_id,
                        'value' => $i->value,
                    ]);
                })
            ]);
        });

        Cache::put('setup', $setup, 60);
        return view('test_page.load_setup');
    }

    public function tes_kalender()
    {
        return view('test_page.test_calendar');
    }

    public function test_pdf()
    {
        $data = [
            'title' => 'Ya ndak tau kok tanya saia',
            'date' => 56575675,
        ];

        $pdf = PDF::loadView('test_page.test_for_pdf', $data);
        return $pdf->download('invoice.pdf');
    }

    public function test_laporan()
    {
        $jadwal = Jadwal::find(4);
        $mesin = $jadwal->maintenance->mesin;
        $data = ['mesin' => $mesin, 'jadwal' => $jadwal];
        $pdf = PDF::loadView('reports.inspeksi', $data);
        return $pdf->download('invoice.pdf');
    }
}
