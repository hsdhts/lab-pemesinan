<?php

namespace App\Http\Controllers;

use App\Models\Pelumas;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PelumasController extends Controller
{
    //
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $parts = Pelumas::with(['sparepart']);
            return DataTables::of($parts)
                ->addColumn('nama_sparepart', function (Pelumas $pelumas) {
                    return $pelumas->sparepart->nama_sparepart;
                })
                ->addColumn('aksi', function ($p) {
                    if (Auth::user()->level === 'Superadmin') {
                        return view('partials.tombolAksi', ['editPath' => '/pelumas/edit/', 'id' => $p->id, 'deletePath' => '/pelumas/destroy/']);
                    } else {
                        return '-';
                    }
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->toJson();
        }

        $checkBtn = '';
        if (Auth::user()->level === 'Admin') {
            $checkBtn = 'd-none';
        }

        return view('pages.pelumas.index', [
            'halaman' => 'Pelumas',
            'link_to_create' => '/pelumas/create',
            'checkBtn' => $checkBtn
        ]);
    }

    public function create()
    {

        $sparepart = Sparepart::all();
        return view('pages.pelumas.create', [
            'halaman' => 'Pelumas', 'sparepart' => $sparepart
        ]);
    }

    public function tambah(Request $request)
    {

        $dataValid = $request->validate([
            'sparepart_id' => 'required',
            'metode_pelumasan' => 'required',
            'lubricant' => 'required',
            'lubricating_interval' => 'required',
            'pelumasan_terakhir' => 'required'

        ]);

        Pelumas::create($dataValid);
        return redirect('/pelumas')->with('tambah', 'p');
    }


    public function edit($id)
    {

        $pelumas = Pelumas::findOrFail($id);
        $sparepart = Sparepart::all();


        return view('pages.pelumas.update', [
            'halaman' => 'Pelumas',
            'pelumas' => $pelumas,
            'sparepart' => $sparepart
        ]);
    }


    public function update(Request $request)
    {

        $dataValid = $request->validate([
            'sparepart_id' => 'required',
            'metode_pelumasan' => 'required',
            'lubricant' => 'required',
            'lubricating_interval' => 'required',
            'pelumasan_terakhir' => 'required'
        ]);

        Pelumas::findOrFail($request->id_old)->update($dataValid);

        return redirect('/pelumas')->with('edit', 'p');
    }

    public function destroy(Request $request)
    {
        $dataValid = $request->validate([
            'id' => 'required|numeric',
        ]);

        Pelumas::destroy($dataValid);

        return redirect('/pelumas')->with('hapus', 'p');
    }
}
