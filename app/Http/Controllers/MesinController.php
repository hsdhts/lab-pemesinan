<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mesin;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage; 



class MesinController extends Controller
{
    //
    public function index(Request $request) {
        if ($request->ajax()) {
            $mesin = Mesin::with(['kategori', 'user']);
    
            return DataTables::of($mesin)
                ->addColumn('nama_mesin', function ($mesin) {
                    return '<a class="text-dark" href="/mesin/detail/' . $mesin->id . '">' . $mesin->nama_mesin . '</a>';
                })
                ->addColumn('user', function (Mesin $mesin) {
                    return $mesin->user ? $mesin->user->nama : ''; // Periksa apakah user tidak null
                })
                ->addColumn('kategori', function (Mesin $mesin) {
                    return $mesin->kategori ? $mesin->kategori->nama_kategori : 'Tak Terkategori'; // Periksa apakah kategori tidak null
                })
                ->addColumn('aksi', function ($mesin) {
                    return view('partials.tombolAksiMesin', ['editPath' => '/mesin/edit/', 'id' => $mesin->id, 'deletePath' => '/mesin/destroy/']);
                })
                ->rawColumns(['nama_mesin', 'aksi'])
                ->addIndexColumn()
                ->toJson();
        }
    
        return view('pages.mesin.index', ['halaman' => 'Mesin', 'link_to_create' => '/mesin/create']);
    }
    

    public function create(){
    
        //dd("abdwjgakwd");
        return view('pages.mesin.create',
        [
            'user' => User::all(),
            'halaman' => 'Mesin'
        ]
    );
    }

    public function tambah(Request $request){
        $validData = $request->validate([
            'nama_mesin' => 'required|max:255',
            // 'no_asset' => 'nullable|max:25',
            // 'tipe_mesin' => 'nullable|max:40',
            'kode_mesin' => 'nullable|max:6',
            // 'nomor_seri' => 'nullable|max:50',
            'spesifikasi' => 'nullable|not_regex:/\'/i',
            'tanggal_pembelian' => 'nullable|max:50',
            'mesin_image' => 'image|file|max:1024',
            'nameTag_image' => 'image|file|max:1024',

        ]);

        if($request->hasFile('mesin_image')) {
            $validData['mesin_image'] = $request->file('mesin_image')->storePublicly('mesin_images', 'public');
        }

        if($request->hasFile('nameTag_image')) {
            $validData['nameTag_image'] = $request->file('nameTag_image')->storePublicly('nameTag_images', 'public');
        }

        $m = Mesin::create($validData);

        $mesin = Mesin::with(['maintenance'])->find($m->id);

        return redirect('/mesin')->with('tambah', 'p');
    }


    public function detail($id){

        $mesin = Mesin::findOrFail($id);
    
        return view('pages.mesin.detail', ['halaman' => 'Mesin', 'mesin' => $mesin]);
    }

    public function edit($id){
        $mesin = Mesin::findOrFail($id);
        $user = User::all();
    
        return view('pages.mesin.update', [
            'halaman' => 'Mesin',
            'mesin' => $mesin,
            'user' => $user
        ]);
    }
    
    


    public function update(Request $request){
        $dataValid = $request->validate([
            'id' => 'required|numeric',
            'nama_mesin' => 'required|max:255',
            // 'no_asset' => 'nullable|max:25',
            // 'tipe_mesin' => 'nullable|max:40',
            'kode_mesin' => 'nullable|max:6',
            // 'nomor_seri' => 'nullable|max:50',
            'spesifikasi' => 'nullable|not_regex:/\'/i',
            'tanggal_pembelian' => 'nullable|max:50',
            'mesin_image' => 'image|file|max:1024',
            'nameTag_image' => 'image|file|max:1024',
        ]);
    
        $mesin = Mesin::findOrFail($dataValid['id']);

    if ($request->hasFile('mesin_image')) {
        // Hapus gambar lama (jika ada) sebelum menyimpan yang baru
        Storage::disk('public')->delete($mesin->mesin_image);

        // Simpan gambar baru
        $dataValid['mesin_image'] = $request->file('mesin_image')->storePublicly('mesin_images', 'public');
    }

    if ($request->hasFile('nameTag_image')) {
        // Hapus gambar lama (jika ada) sebelum menyimpan yang baru
        Storage::disk('public')->delete($mesin->nameTag_image);

        // Simpan gambar baru
        $dataValid['nameTag_image'] = $request->file('nameTag_image')->storePublicly('nameTag_images', 'public');
    }

    $mesin->update($dataValid);

    return redirect('/mesin')->with('edit', 'p');
    }


    public function destroy(Request $request){
        
        $id = $request->validate([
            'id' => 'required|numeric'
        ]);

        Mesin::destroy($id);

        return redirect('/mesin')->with('hapus', 'p');

    }
   
}