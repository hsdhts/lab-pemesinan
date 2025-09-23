<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Maintenance;
use App\Models\Mesin;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    public function index(Request $request){

        if($request->ajax()){

            $jadwal = Jadwal::with(['maintenance', 'maintenance.mesin'])
                ->whereNotNull('tanggal_realisasi')
                ->orderBy('tanggal_realisasi', 'desc');

            return DataTables::of($jadwal)
            ->addColumn('nama_maintenance', function($j){
                return $j->maintenance->nama_maintenance ?? '-';
            })
            ->addColumn('nama_mesin', function($j){
                return $j->maintenance->mesin->nama_mesin ?? '-';
            })
            ->addColumn('tanggal_selesai', function($j){
                return $j->tanggal_realisasi ? \Carbon\Carbon::parse($j->tanggal_realisasi)->format('d-m-Y') : '-';
            })
            ->addColumn('aksi', function($j){
                return view('partials.tombolDownloadLaporanMaintenance', ['jadwal_id' => $j->id, 'maintenance_id' => $j->maintenance_id]);
            })
            ->rawColumns(['aksi'])
            ->addIndexColumn()
            ->toJson();
        }

        return view('pages.laporan.index', ['halaman' => 'Laporan']);
        }

    public function laporan_general_inspection(Request $request){

        $data_valid = $request->validate([
            'maintenance_id' => 'required|numeric',
            'tanggal_awal' => 'required|date_format:d-m-Y',
            'tanggal_akhir' => 'required|date_format:d-m-Y',
        ]);

        $tgl_awal = Carbon::parse($data_valid['tanggal_awal'], 7);
        $tgl_akhir = Carbon::parse($data_valid['tanggal_akhir'], 7);

        if($tgl_awal->greaterThan($tgl_akhir)){
            return back()->withErrors(['tanggal_error'=>'Tanggal awal tidak boleh mendahului tanggal akhir']);
        }

        $maintenance = Maintenance::with(['jadwal' => function($query) use ($tgl_awal, $tgl_akhir){
                        $query->where('tanggal_realisasi', '>=', $tgl_awal)->where('tanggal_realisasi', '<=', $tgl_akhir);
        }, 'jadwal.isi_form', 'form', 'jadwal.sparepart'])->find($data_valid['maintenance_id']);

        $mesin = Mesin::find($maintenance->mesin_id);

        $pdf = PDF::loadView('pages.laporan.inspeksi', ['maintenance' => $maintenance, 'mesin' => $mesin, 'tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir])->setPaper('a4', 'potrait')->setWarnings(false);

        return $pdf->download('Inspeksi_' . $mesin->nama_mesin .'_' . $data_valid['tanggal_awal'] .'_' . $data_valid['tanggal_akhir'] .'.pdf');
    }

    public function laporan_rencana_realisasi(){


        $awal = now(7)->isoWeek(1)->startOfWeek();
        $akhir = $awal->copy()->endOfWeek();

        $mesin = Mesin::with(['maintenance', 'maintenance.jadwal'=>function($query){
                $query->whereYear('tanggal_rencana', now(7)->year)->orWhereYear('tanggal_realisasi', now(7)->year);
        }])->get();

        $data = [
            'awal' => $awal,
            'akhir' => $akhir,
            'mesin' => $mesin
        ];

        $pdf = PDF::loadView('pages.laporan.rencana_dan_realisasi', $data)->setPaper('a3', 'landscape')->setWarnings(false);

        return $pdf->download('Laporan Rencana dan Realisasi Tahun '. now(7)->year .'.pdf');
    }


    public function laporan_maintenance(Request $request){

        $data_valid = $request->validate([
            'jadwal_id' => 'required|numeric'
        ]);

        $jadwal = Jadwal::with(['sparepart', 'maintenance' =>function($query){
            $query->withTrashed();
        }, 'maintenance.mesin' => function($query){
            $query->withTrashed();
        }, 'isi_form.form' => function($query){
            $query->withTrashed();
        }])->withTrashed()->find($data_valid['jadwal_id']);

        // Check if jadwal exists
        if (!$jadwal) {
            return redirect()->back()->with('error', 'Jadwal tidak ditemukan. ID: ' . $data_valid['jadwal_id']);
        }

        // Check if maintenance exists
        if (!$jadwal->maintenance) {
            return redirect()->back()->with('error', 'Data breakdown tidak ditemukan untuk jadwal ID: ' . $data_valid['jadwal_id']);
        }

        // Check if mesin exists
        if (!$jadwal->maintenance->mesin) {
            return redirect()->back()->with('error', 'Data mesin tidak ditemukan. Silakan coba lagi.');
        }

        // Check if jadwal is completed (has tanggal_realisasi)
        if (!$jadwal->tanggal_realisasi) {
            return redirect()->back()->with('error', 'Laporan hanya dapat dibuat untuk pekerjaan yang sudah selesai. Jadwal ID: ' . $data_valid['jadwal_id']);
        }

        $data = [
            'jadwal' => $jadwal,
        ];

        $pdf = PDF::loadView('pages.laporan.maintenance', $data)->setPaper('a4', 'potrait')->setWarnings(false);

        return $pdf->download('laporan_maintenance_' . $jadwal->maintenance->mesin->nama_mesin . '_'. $jadwal->maintenance->nama_maintenance .'.pdf');
    }

    public function laporan_harian(Request $request){

        $data_valid = $request->validate([
            'tanggal' => 'required|date'
        ]);

        $tanggal = Carbon::parse($data_valid['tanggal']);

        $jadwal_list = Jadwal::with(['sparepart', 'maintenance' => function($query){
            $query->withTrashed();
        }, 'maintenance.mesin' => function($query){
            $query->withTrashed();
        }])->whereNotNull('tanggal_realisasi')
        ->whereDate('tanggal_realisasi', $tanggal)
        ->withTrashed()
        ->get();

        if($jadwal_list->isEmpty()){
            return back()->with('error', 'Tidak ada laporan pekerjaan pada tanggal ' . $tanggal->format('d-m-Y'));
        }

        $data = [
            'jadwal_list' => $jadwal_list,
            'tanggal' => $tanggal
        ];

        $pdf = PDF::loadView('pages.laporan.harian', $data)->setPaper('a4', 'potrait')->setWarnings(false);

        return $pdf->download('laporan_harian_' . $tanggal->format('Y-m-d') . '.pdf');
    }

}
