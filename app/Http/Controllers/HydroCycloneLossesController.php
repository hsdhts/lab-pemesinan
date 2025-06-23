<?php

namespace App\Http\Controllers;

use App\Models\HydroCycloneLosses;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class HydroCycloneLossesController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $hydroCycloneLosses = HydroCycloneLosses::query();
            return DataTables::of($hydroCycloneLosses)
                ->addColumn('aksi', function($k){
                    return view('partials.tombolAksi', [
                        'editPath' => '/hydrocyclone-losses/edit/',
                        'id'=> $k->id,
                        'deletePath' => '/hydrocyclone-losses/destroy/',
                        'showPath' => '/hydrocyclone-losses/show/'
                    ]);
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('pages.hydroCycloneLosses.index', [
            'halaman' => 'Hydrocyclone Losses',
            'link_to_create' => '/hydrocyclone-losses/create'
        ]);
    }

    public function create()
    {
        return view('pages.hydroCycloneLosses.create', [
            'halaman' => 'Tambah Data Hydrocyclone Losses'
        ]);
    }

    public function store(Request $request)
    {
        $dataValid = $request->validate([
            'shift' => 'required|string',
            'nama_operator' => 'required|string',
            'sample_weight' => 'required|string',
            'whole_kernel' => 'required|string',
            'broken_kernel' => 'required|string',
            'whole_nut' => 'required|string',
            'broken_nut' => 'required|string',
            'image_HydroCycloneLosses' => 'required|image|file|max:3072'
        ]);

        if($request->hasFile('image_HydroCycloneLosses')) {
            $dataValid['image_HydroCycloneLosses'] = $request->file('image_HydroCycloneLosses')
                ->storePublicly('hydrocyclone_losses_images', 'public');
        }

        HydroCycloneLosses::create($dataValid);

        return redirect('/hydrocyclone-losses')->with('tambah', 'p');
    }

    public function show($id)
    {
        $hydroCycloneLosses = HydroCycloneLosses::findOrFail($id);

        return view('pages.hydroCycloneLosses.show', [
            'halaman' => 'Detail Hydrocyclone Losses',
            'hydroCycloneLosses' => $hydroCycloneLosses
        ]);
    }

    public function edit($id)
    {
        $hydroCycloneLosses = HydroCycloneLosses::findOrFail($id);

        return view('pages.hydroCycloneLosses.update', [
            'halaman' => 'Edit Hydrocyclone Losses',
            'hydroCycloneLosses' => $hydroCycloneLosses
        ]);
    }

    public function update(Request $request)
    {
        $dataValid = $request->validate([
            'shift' => 'required|string',
            'nama_operator' => 'required|string',
            'sample_weight' => 'required|string',
            'whole_kernel' => 'required|string',
            'broken_kernel' => 'required|string',
            'whole_nut' => 'required|string',
            'broken_nut' => 'required|string',
            'image_HydroCycloneLosses' => 'image|file|max:3072'
        ]);

        $hydroCycloneLosses = HydroCycloneLosses::find($request->id_old);

        if ($request->hasFile('image_HydroCycloneLosses')) {
            Storage::disk('public')->delete($hydroCycloneLosses->image_HydroCycloneLosses);
            $dataValid['image_HydroCycloneLosses'] = $request->file('image_HydroCycloneLosses')
                ->storePublicly('hydrocyclone_losses_images', 'public');
        }

        $hydroCycloneLosses->update($dataValid);

        return redirect('/hydrocyclone-losses')->with('edit', 'p');
    }

    public function destroy(Request $request)
    {
        $dataValid = $request->validate([
            'id' => 'required|numeric',
        ]);

        $hydroCycloneLosses = HydroCycloneLosses::find($dataValid['id']);
        if ($hydroCycloneLosses->image_HydroCycloneLosses) {
            Storage::disk('public')->delete($hydroCycloneLosses->image_HydroCycloneLosses);
        }

        HydroCycloneLosses::destroy($dataValid);

        return redirect('/hydrocyclone-losses')->with('hapus', 'p');
    }
}
