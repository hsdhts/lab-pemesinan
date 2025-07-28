<?php

namespace App\Http\Controllers;

use App\Models\Breakdown;
use App\Models\Kategori;
use App\Models\Mesin;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DataTables;

class BreakdownController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){

            $breakdowns = Breakdown::with(['kategori']);
            return DataTables::of($breakdowns)
            ->addColumn('nama_kategori', function(Breakdown $breakdown){
                return $breakdown->kategori->nama_kategori;
            })
            ->addColumn('aksi', function($p){
                return view('partials.tombolAksi', ['editPath' => '/breakdown/edit/', 'id'=> $p->id, 'deletePath' => '/breakdown/destroy/' ]);
            })
            ->rawColumns(['aksi'])
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
        // Menampilkan form untuk membuat breakdown baru
        $kategori = Kategori::all();
        return view('pages.breakdown.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $dataValid = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'tanggal_kejadian' => 'required|date',
            'deskripsi_masalah' => 'required|string',
            'foto_kerusakan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto_kerusakan')) {
            $dataValid['foto_kerusakan'] = $request->file('foto_kerusakan')->store('public/breakdown');
        }

        Breakdown::create($dataValid);
        return redirect('/breakdown')->with('tambah', 'p');
    }

    public function edit($id)
    {
        $breakdown = Breakdown::findOrFail($id);
        $kategori = Kategori::all();

        return view('pages.breakdown.update', [
            'halaman' => 'Breakdown',
            'breakdown' => $breakdown,
            'kategori' => $kategori
        ]);
    }

    public function update(Request $request, $id)
    {
        $breakdown = Breakdown::findOrFail($id);

        $dataValid = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'tanggal_kejadian' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_kejadian',
            'deskripsi_masalah' => 'required|string',
            'tindakan_perbaikan' => 'nullable|string',
            'status' => 'required|in:belum,on_going,selesai',
            'foto_kerusakan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_perbaikan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto_perbaikan')) {
            // Hapus foto lama jika ada
            if ($breakdown->foto_perbaikan) {
                Storage::delete($breakdown->foto_perbaikan);
            }
            $dataValid['foto_perbaikan'] = $request->file('foto_perbaikan')->store('public/breakdown');
        }

        $breakdown->update($dataValid);
        return redirect('/breakdown')->with('edit', 'p');
    }

    public function destroy(Breakdown $breakdown)
    {
        if ($breakdown->foto_kerusakan) {
            Storage::delete($breakdown->foto_kerusakan);
        }
        if ($breakdown->foto_perbaikan) {
            Storage::delete($breakdown->foto_perbaikan);
        }

        $breakdown->delete();

        return redirect('/breakdown')->with('hapus', 'p');
    }
}
