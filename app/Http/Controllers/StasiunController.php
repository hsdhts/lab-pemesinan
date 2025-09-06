<?php

namespace App\Http\Controllers;

use App\Models\Stasiun;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Cache;

class StasiunController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $stasiuns = Stasiun::query();
            
            return DataTables::of($stasiuns)
                ->addColumn('aksi', function ($stasiun) {
                    return view('partials.tombolAksi', [
                        'editPath' => '/stasiun/edit/', 
                        'id' => $stasiun->id, 
                        'deletePath' => '/stasiun/destroy/'
                    ]);
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->toJson();
        }

        $stasiuns = Stasiun::all();

        return view('pages.stasiun.index', [
            'halaman' => 'Stasiun',
            'link_to_create' => '/stasiun/create',
            'stasiuns' => $stasiuns,
        ]);
    }

    public function create()
    {
        return view('pages.stasiun.create', [
            'halaman' => 'Stasiun'
        ]);
    }

    public function tambah(Request $request)
    {
        $dataValid = $request->validate([
            'nama_stasiun' => 'required|string|max:255',
            'kode_stasiun' => 'required|string|max:10|unique:stasiuns,kode_stasiun',
            'deskripsi' => 'nullable|string',
        ]);

        Stasiun::create($dataValid);

        return redirect('/stasiun')->with('tambah', 'p');
    }

    public function edit($id)
    {
        $stasiun = Stasiun::findOrFail($id);

        return view('pages.stasiun.update', [
            'halaman' => 'Stasiun',
            'stasiun' => $stasiun
        ]);
    }

    public function update(Request $request)
    {
        $dataValid = $request->validate([
            'nama_stasiun' => 'required|string|max:255',
            'kode_stasiun' => 'required|string|max:10|unique:stasiuns,kode_stasiun,' . $request->id_old,
            'deskripsi' => 'nullable|string',
        ]);

        $stasiun = Stasiun::find($request->id_old);
        $stasiun->update($dataValid);

        return redirect('/stasiun')->with('edit', 'p');
    }

    public function destroy(Request $request)
    {
        $dataValid = $request->validate([
            'id' => 'required|numeric',
        ]);

        Stasiun::destroy($dataValid);

        return redirect('/stasiun')->with('hapus', 'p');
    }

    public function detail($id)
    {
        $stasiun = Stasiun::with('mesins')->findOrFail($id);

        return view('pages.stasiun.detail', [
            'halaman' => 'Stasiun',
            'stasiun' => $stasiun
        ]);
    }
}