<?php

namespace App\Http\Controllers;

use App\Models\SetupMaintenance;
use Illuminate\Http\Request;

class SetupMaintenanceController extends Controller
{
    //

    // This method is no longer needed as categories have been removed

    private function create($request){
    
        $dataValid = $request->validate([
            'nama_setup_maintenance' => 'required',
            'periode' => 'required|numeric|min:1',
            'satuan_periode' => 'required',
            'warna' => 'required'
        ]);


        SetupMaintenance::create($dataValid);

    }


    private function delete($request){
        
        $dataValid = $request->validate([
            'id' => 'required|numeric',
        ]);

        SetupMaintenance::destroy($dataValid);
    }

    private function edit($request){
        $dataValid = $request->validate([
            'id' => 'required|numeric',
            'nama_setup_maintenance' => 'required',
            'periode' => 'required|numeric|min:1',
            'satuan_periode' => 'required',
            'warna' => 'required'
        ]);

        SetupMaintenance::find($dataValid['id'])->update($dataValid);
    }

    public function createPadaSetup(Request $request){
    
        $this->create($request);
        return redirect('/')->with('tambah', 'p');
    }

    public function hapusPadaSetup(Request $request){
        $this->delete($request);

        return redirect('/')->with('hapus', 'p');
    }

    public function editPadaSetup(Request $request){
        $this->edit($request);

        return redirect('/')->with('edit', 'p');
    }






}
