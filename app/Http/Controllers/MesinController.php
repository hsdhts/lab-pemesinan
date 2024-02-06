<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mesin;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Cache;


class MesinController extends Controller
{
    //
    public function index(Request $request){
        
    

    if($request->ajax()){
        
        $mesin = Mesin::with(['kategori',  'user']);

        return DataTables::of($mesin)
        ->editColumn('nama_mesin', function($m){
            return '<a class="text-dark" href="/mesin/detail/' . $m->id . '">' . $m->nama_mesin . '</a>';
        })
        ->editColumn('kategori', function(Mesin $mesin){
            if(isset($mesin->kategori)){
                return $mesin->kategori->nama_kategori;
            }else{
                return "Tak Terkategori";
            }
        })
        ->editColumn('user', function(Mesin $mesin){
            return $mesin->user->nama;
        })
        
        ->addColumn('aksi', function($m){
            return view('partials.tombolAksiMesin', ['editPath' => '/mesin/edit/', 'id'=> $m->id, 'deletePath' => '/mesin/destroy/' ]);
        })
        ->rawColumns(['nama_mesin','aksi'])
        ->addIndexColumn()
        ->toJson();
    }
    //return $mesin;  
    return view('pages.mesin.index', ['halaman' => 'Mesin',
      'link_to_create' => '/mesin/create'
    
    ]);
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
            'no_asset' => 'nullable|max:25',
            'user_id' => 'required|numeric',
            'tipe_mesin' => 'nullable|max:40',
            'kode_mesin' => 'nullable|max:6',
            'nomor_seri' => 'nullable|max:50',
            'spesifikasi' => 'nullable|not_regex:/\'/i'
        ]);


        $m = Mesin::create($validData);

        //return redirect()->intended('/maintenance/form/pilih/')->with('tambah', 'p');
        $mesin = Mesin::with(['maintenance',  'kategori'])->find($m->id);

        $kategori = Kategori::all(); 
        Cache::put('mesin', $mesin, now()->addMinutes(30));
        return view('pages.maintenance.select_template', ['mesin' => $mesin, 'kategori' => $kategori]);
    }


    public function detail($id){

        $mesin = Mesin::findOrFail($id);
    
        return view('pages.mesin.detail', ['halaman' => 'Mesin', 'mesin' => $mesin]);
    }

    public function edit($id){
        $mesin = Mesin::findOrFail($id);
        $kategori = Kategori::all();
        $user = User::all();
    
        return view('pages.mesin.update', [
            'halaman' => 'Mesin',
            'mesin' => $mesin,
            'kategori' => $kategori,
            'user' => $user
        ]);
    }
    


    public function update(Request $request){
        $dataValid = $request->validate([
            'id' => 'required|numeric',
            'nama_mesin' => 'required|max:255',
            'no_asset' => 'nullable|max:25',
            'user_id' => 'required|numeric',
            'tipe_mesin' => 'nullable|max:40',
            'kode_mesin' => 'nullable|max:6',
            'nomor_seri' => 'nullable|max:50',
            'spesifikasi' => 'nullable|not_regex:/\'/i'
        ]);
    
        $mesin = Mesin::findOrFail($dataValid['id']);
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
