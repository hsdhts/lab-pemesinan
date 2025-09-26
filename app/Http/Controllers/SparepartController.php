<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage; 


class SparepartController extends Controller
{
    //
    public function index(Request $request){
        
        if($request->ajax()){
            
            $parts = Sparepart::query();
            return DataTables::of($parts)

            ->addColumn('aksi', function($p){
                return view('partials.tombolAksi', ['editPath' => '/sparepart/edit/', 'id'=> $p->id, 'deletePath' => '/sparepart/destroy/' ]);
            })
            ->rawColumns(['aksi'])
            ->addIndexColumn()
            ->toJson();

        }

        $spareparts = Sparepart::all(); // Mengambil semua data sparepart


        return view('pages.spareparts.index', [
            'halaman' => 'Spareparts',
            'link_to_create' => '/sparepart/create',
            'spareparts' => $spareparts,
       
            
        ]);
        
    }

    public function create(){
        

        return view('pages.spareparts.create', [
            'halaman' => 'Spareparts'
        ]);
    }

    public function tambah(Request $request){
        $dataValid = $request->validate([
            'nama_sparepart' => 'required',
            'deskripsi' => 'required|string',
        ]);
    
        Sparepart::create($dataValid);
    
        return redirect()->route('sparepart.index')->with('tambah', 'p');
    }
    
    public function update(Request $request)
    {
        $dataValid = $request->validate([
            'nama_sparepart' => 'required',
            'deskripsi' => 'required|string',
        ]);

        $sparepart = Sparepart::find($request->id_old);

        $sparepart->update($dataValid);
    
        return redirect()->route('sparepart.index')->with('edit', 'p');
    }
    
   

    public function edit($id){
    
        $sparepart = Sparepart::findOrFail($id);


        return view('pages.spareparts.update', [
            'halaman' => 'Spareparts',
            'sparepart' => $sparepart
        ]);


    }

    public function destroy(Request $request){  
        $dataValid = $request->validate([
            'id' => 'required|numeric',
        ]);

        Sparepart::destroy($dataValid);

        return redirect()->route('sparepart.index')->with('hapus', 'p');
    }

}