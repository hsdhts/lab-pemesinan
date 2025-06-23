<?php

namespace App\Http\Controllers;

use App\Models\KernelHydroCyclone;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class KernelHydroCycloneController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $kernels = KernelHydroCyclone::query();
            return DataTables::of($kernels)
                ->addColumn('aksi', function($k){
                    return view('partials.tombolAksi', [
                        'editPath' => '/kernel-hydrocyclone/edit/',
                        'id'=> $k->id,
                        'deletePath' => '/kernel-hydrocyclone/destroy/',
                        'showPath' => '/kernel-hydrocyclone/show/'
                    ]);
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->toJson();
        }

        $kernelHydroCyclones = KernelHydroCyclone::all();

        return view('pages.kernelHydroCyclone.index', [
            'halaman' => 'Kernel Hydrocyclones',
            'link_to_create' => '/kernel-hydrocyclone/create',
            'kernelHydroCyclones' => $kernelHydroCyclones
        ]);
    }

    public function create()
    {
        return view('pages.kernelHydroCyclone.create', [
            'halaman' => 'Kernel Hydrocyclones'
        ]);
    }

    public function store(Request $request)
    {
        $dataValid = $request->validate([
            'shift' => 'required|string',
            'nama_operator' => 'required|string',
            'hydrocyclone' => 'required|string',
            'sample_weight' => 'required|string',
            'whole_nut' => 'required|string',
            'shell_from_whole_nut' => 'required|string',
            'broken_nut' => 'required|string',
            'shell_from_broken_nut' => 'required|string',
            'loose_shell' => 'required|string',
            'stone' => 'required|string',
            'broken_kernel' => 'required|string',
            'image_kernelHydroCyclone' => 'required|image|file|max:3072'
        ]);

        if($request->hasFile('image_kernelHydroCyclone')) {
            $dataValid['image_kernelHydroCyclone'] = $request->file('image_kernelHydroCyclone')->storePublicly('kernel_hydrocyclone_images', 'public');
        }

        KernelHydroCyclone::create($dataValid);

        return redirect('/kernel-hydrocyclone')->with('tambah', 'p');
    }

    public function edit($id)
    {
        $kernelHydroCyclone = KernelHydroCyclone::findOrFail($id);

        return view('pages.kernelHydroCyclone.update', [
            'halaman' => 'Kernel Hydrocyclones',
            'kernelHydroCyclone' => $kernelHydroCyclone
        ]);
    }

    public function update(Request $request)
    {
        $dataValid = $request->validate([
            'shift' => 'required|string',
            'nama_operator' => 'required|string',
            'hydrocyclone' => 'required|string',
            'sample_weight' => 'required|string',
            'whole_nut' => 'required|string',
            'shell_from_whole_nut' => 'required|string',
            'broken_nut' => 'required|string',
            'shell_from_broken_nut' => 'required|string',
            'loose_shell' => 'required|string',
            'stone' => 'required|string',
            'broken_kernel' => 'required|string',
            'image_kernelHydroCyclone' => 'image|file|max:3072'
        ]);

        $kernelHydroCyclone = KernelHydroCyclone::find($request->id_old);

        if ($request->hasFile('image_kernelHydroCyclone')) {
            // Hapus gambar lama (jika ada) sebelum menyimpan yang baru
            Storage::disk('public')->delete($kernelHydroCyclone->image_kernelHydroCyclone);

            // Simpan gambar baru
            $dataValid['image_kernelHydroCyclone'] = $request->file('image_kernelHydroCyclone')->storePublicly('kernel_hydrocyclone_images', 'public');
        }

        $kernelHydroCyclone->update($dataValid);

        return redirect('/kernel-hydrocyclone')->with('edit', 'p');
    }

    public function destroy(Request $request)
    {
        $dataValid = $request->validate([
            'id' => 'required|numeric',
        ]);

        KernelHydroCyclone::destroy($dataValid);

        return redirect('/kernel-hydrocyclone')->with('hapus', 'p');
    }

    public function show($id)
    {
        $kernelHydroCyclone = KernelHydroCyclone::findOrFail($id);

        return view('pages.kernelHydroCyclone.show', [
            'halaman' => 'Detail Kernel Hydrocyclone',
            'kernelHydroCyclone' => $kernelHydroCyclone
        ]);
    }
}
