<?php

namespace App\Http\Controllers;

use App\Models\Breakdown;
use App\Models\Mesin;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\PDF;

class BreakdownController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $breakdowns = Breakdown::with(['mesin']);
            return DataTables::of($breakdowns)
                ->addColumn('aksi', function($breakdown) {
                    return view('partials.tombolAksi', [
                        'editPath' => '/breakdown/edit/',
                        'id' => $breakdown->id,
                        'deletePath' => '/breakdown/destroy/'
                    ]);
                })
                ->addColumn('status_badge', function($breakdown) {
                    $badges = [
                        'belum' => 'danger',
                        'on_going' => 'warning',
                        'selesai' => 'success'
                    ];
                    return '<span class="badge bg-'.$badges[$breakdown->status].'">'.$breakdown->status.'</span>';
                })
                ->rawColumns(['aksi', 'status_badge'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('pages.breakdown.index', [
            'halaman' => 'Breakdown',
            'link_to_create' => '/breakdown/create'
        ]);
    }

    public function create()
    {
        $mesins = Mesin::all();
        $spareparts = Sparepart::all();

        return view('pages.breakdown.create', [
            'halaman' => 'Tambah Breakdown',
            'mesins' => $mesins,
            'spareparts' => $spareparts
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mesin_id' => 'required|exists:mesins,id',
            'tanggal_kejadian' => 'required|date',
            'deskripsi_masalah' => 'required|string',
            'foto_kerusakan' => 'nullable|image|max:2048',
            'sparepart_ids' => 'nullable|array',
            'sparepart_ids.*' => 'exists:spareparts,id',
            'jumlah.*' => 'required_with:sparepart_ids|integer|min:1'
        ]);

        if($request->hasFile('foto_kerusakan')) {
            $validated['foto_kerusakan'] = $request->file('foto_kerusakan')
                ->storePublicly('breakdown_images', 'public');
        }

        $breakdown = Breakdown::create($validated);

        if($request->has('sparepart_ids')) {
            $spareparts = [];
            foreach($request->sparepart_ids as $index => $sparepart_id) {
                $spareparts[$sparepart_id] = ['jumlah' => $request->jumlah[$index]];
            }
            $breakdown->spareparts()->attach($spareparts);
        }

        return redirect('/breakdown')->with('success', 'Data breakdown berhasil ditambahkan');
    }

    public function generateReport($id)
    {
        $breakdown = Breakdown::with(['mesin', 'spareparts'])->findOrFail($id);

        $pdf = PDF::loadView('reports.breakdown', [
            'breakdown' => $breakdown
        ]);

        return $pdf->download('laporan-breakdown-'.$breakdown->id.'.pdf');
    }

    public function dashboard()
    {
        $total_breakdown = Breakdown::count();
        $ongoing = Breakdown::where('status', 'on_going')->count();
        $selesai = Breakdown::where('status', 'selesai')->count();
        $belum = Breakdown::where('status', 'belum')->count();

        $breakdown_by_month = Breakdown::selectRaw('MONTH(tanggal_kejadian) as month, COUNT(*) as total')
            ->whereYear('tanggal_kejadian', date('Y'))
            ->groupBy('month')
            ->get();

        return view('pages.breakdown.dashboard', [
            'halaman' => 'Dashboard Breakdown',
            'total_breakdown' => $total_breakdown,
            'ongoing' => $ongoing,
            'selesai' => $selesai,
            'belum' => $belum,
            'breakdown_by_month' => $breakdown_by_month
        ]);
    }
}
