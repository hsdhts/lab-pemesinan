<?php

namespace App\Http\Controllers;

use App\Models\Protocol;
use App\Models\Mesin;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ProtocolController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $protocols = Protocol::with(['mesin', 'sparepart']);
            return DataTables::of($protocols)
                ->addColumn('nama_mesin', function (Protocol $protocol) {
                    return $protocol->mesin->nama_mesin;
                })
                ->addColumn('nama_sparepart', function (Protocol $protocol) {
                    return $protocol->sparepart->nama_sparepart;
                })
                ->addColumn('aksi', function ($p) {
                    if (Auth::user()->level === 'Superadmin') {
                        return view('partials.tombolAksi', ['editPath' => '/protocol/edit/', 'id' => $p->id, 'deletePath' => '/protocol/destroy/']);
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

        return view('pages.protocol.index', [
            'halaman' => 'Protocol',
            'link_to_create' => '/protocol/create',
            'checkBtn' => $checkBtn
        ]);
    }

    public function create()
    {
        $mesin = Mesin::all();
        $sparepart = Sparepart::all();
        return view('pages.protocol.create', [
            'halaman' => 'Protocol',
            'mesin' => $mesin,
            'sparepart' => $sparepart
        ]);
    }

    public function tambah(Request $request)
    {
        $dataValid = $request->validate([
            'mesin_id' => 'required',
            'sparepart_id' => 'required',
            'inspection_item' => 'required',
            'tolerance' => 'required',
            'data' => 'required',
            'validation_data' => 'required|in:Good, Not Good',
            'last_protocol' => 'required|date'
        ]);

        Protocol::create($dataValid);
        return redirect('/protocol')->with('tambah', 'p');
    }

    public function edit($id)
    {
        $protocol = Protocol::findOrFail($id);
        $mesin = Mesin::all();
        $sparepart = Sparepart::all();

        return view('pages.protocol.update', [
            'halaman' => 'Protocol',
            'protocol' => $protocol,
            'mesin' => $mesin,
            'sparepart' => $sparepart
        ]);
    }

    public function update(Request $request)
    {
        $dataValid = $request->validate([
            'mesin_id' => 'required',
            'sparepart_id' => 'required',
            'inspection_item' => 'required',
            'tolerance' => 'required',
            'data' => 'required',
            'validation_data' => 'required|in:Good,Not Good',
            'last_protocol' => 'required|date'
        ]);

        Protocol::findOrFail($request->id_old)->update($dataValid);
        return redirect('/protocol')->with('edit', 'p');
    }

    public function destroy(Request $request)
    {
        $dataValid = $request->validate([
            'id' => 'required|numeric',
        ]);

        Protocol::destroy($dataValid);
        return redirect('/protocol')->with('hapus', 'p');
    }
}
