<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mesin;
use App\Models\Stasiun;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage; 



class MesinController extends Controller
{
    //
    public function index(Request $request) {
        if ($request->ajax()) {
            $mesin = Mesin::with(['user', 'stasiun']);
    
            return DataTables::of($mesin)
                ->addColumn('nama_mesin', function ($mesin) {
                    return '<a class="text-dark" href="/mesin/detail/' . $mesin->id . '">' . $mesin->nama_mesin . '</a>';
                })
                ->addColumn('user', function (Mesin $mesin) {
                    return $mesin->user ? $mesin->user->nama : ''; // Periksa apakah user tidak null
                })

                ->addColumn('stasiun', function (Mesin $mesin) {
                    return $mesin->stasiun ? $mesin->stasiun->nama_stasiun : 'Belum Ditentukan'; // Periksa apakah stasiun tidak null
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
            'stasiuns' => Stasiun::all(),
            'halaman' => 'Mesin'
        ]
    );
    }

    public function tambah(Request $request){
        $validData = $request->validate([
            'nama_mesin' => 'required|max:255',
            'kode_mesin' => 'nullable|max:6',
            'spesifikasi' => 'nullable|not_regex:/\'/i',
            'stasiun_id' => 'nullable|exists:stasiuns,id',
            'mesin_image' => 'image|file|max:3072',

        ]);

        if($request->hasFile('mesin_image')) {
            $validData['mesin_image'] = $request->file('mesin_image')->storePublicly('mesin_images', 'public');
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
        $stasiuns = Stasiun::all();
    
        return view('pages.mesin.update', [
            'halaman' => 'Mesin',
            'mesin' => $mesin,
            'user' => $user,
            'stasiuns' => $stasiuns
        ]);
    }
    
    


    public function update(Request $request){
        $dataValid = $request->validate([
            'id' => 'required|numeric',
            'nama_mesin' => 'required|max:255',
            'kode_mesin' => 'nullable|max:6',
            'spesifikasi' => 'nullable|not_regex:/\'/i',
            'stasiun_id' => 'nullable|exists:stasiuns,id',
            'mesin_image' => 'image|file|max:1024',
        ]);
    
        $mesin = Mesin::findOrFail($dataValid['id']);

    if ($request->hasFile('mesin_image')) {
        // Hapus gambar lama (jika ada) sebelum menyimpan yang baru
        Storage::disk('public')->delete($mesin->mesin_image);

        // Simpan gambar baru
        $dataValid['mesin_image'] = $request->file('mesin_image')->storePublicly('mesin_images', 'public');
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