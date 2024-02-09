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


        return view('pages.spareparts.index', [
            'halaman' => 'Spareparts',
            'link_to_create' => '/sparepart/create'       
            
        ]);
        
    }

    public function create(){
        

        return view('pages.spareparts.create', [
            'halaman' => 'Spareparts'
        ]);
    }

    public function tambah(Request $request){
        $dataValid = $request->validate([
            'item_number' => 'required|numeric|unique:spareparts,item_number',
            'sparepart_image' => 'image|file|max:1024',
            'nama_sparepart' => 'required',
            'jumlah' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);
   
        if($request->hasFile('sparepart_image')) {
            $dataValid['sparepart_image'] = $request->file('sparepart_image')->storePublicly('sparepart_images', 'public');
        }
   
        Sparepart::create($dataValid);
   
        return redirect('/sparepart')->with('tambah', 'p');
    }
   
    public function update(Request $request)
    {
        $dataValid = $request->validate([
            'item_number' => 'required|numeric|unique:spareparts,item_number,' . $request->id_old,
            'sparepart_image' => 'image|file|max:1024',
            'nama_sparepart' => 'required',
            'jumlah' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);
   
        $sparepart = Sparepart::find($request->id_old);
   
        if ($request->hasFile('sparepart_image')) {
            // Hapus gambar lama (jika ada) sebelum menyimpan yang baru
            Storage::disk('public')->delete($sparepart->sparepart_image);
   
            // Simpan gambar baru
            $dataValid['sparepart_image'] = $request->file('sparepart_image')->storePublicly('sparepart_images', 'public');
        }
   
        $sparepart->update($dataValid);
   
        return redirect('/sparepart')->with('edit', 'p');
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

        return redirect('/sparepart')->with('hapus', 'p');
    }

}