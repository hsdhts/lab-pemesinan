<?php

namespace App\Http\Controllers;

use App\Models\Mesin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;



class SetupMesinController extends Controller
{
    //


    public function pilih_template(Request $request){

        $data_valid = $request->validate([
            'id' => 'required|numeric',
        ]);

        $mesin = Mesin::with(['maintenance', 'form'])->find($data_valid['id']);

        return redirect('/mesin/maintenance/' . $mesin->id);
    }

    public function ubah_template(){
        return $this->aksi_pilih_template();
    }


    private function aksi_pilih_template(){
        $mesin = collect(Cache::get('mesin'));
        Cache::forget('attach');
        Cache::put('mesin', $mesin, now()->addMinutes(30));
        return view('pages.maintenance.select_template', ['mesin' => $mesin]);
    }


    public function ambil_template(Request $request){
        $data_valid = $request->validate([
            'id' => 'required|numeric',
        ]);

        $setup = collect([]);

        $mesin = collect(Cache::get('mesin'));

        Cache::forget('attach');
        Cache::put('setup', $setup, now()->addMinutes(30));
        Cache::put('mesin', $mesin, now()->addMinutes(30));

        $mesin = collect(Cache::get('mesin'));
        return redirect('/mesin/maintenance/' . $mesin->get('id'));
    }

    public function tampil_template() {

        $setup = collect(Cache::get('setup'));
        $mesin = collect(Cache::get('mesin'));
        $attach = collect(Cache::get('attach'));

        return view('pages.maintenance.form', ['setup' => $setup, 'mesin' => $mesin, 'attach' => $attach]);
    }

    public function create_maintenance(Request $request){
        $setup = collect(Cache::get('setup'));

        $data_valid = $request->validate([
            'nama_maintenance' => 'required',
            'warna' => 'required',
            'foto_kerusakan' => 'nullable|array',
            'foto_kerusakan.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $fotoKerusakanPaths = [];

        if ($request->hasFile('foto_kerusakan')) {
            foreach ($request->file('foto_kerusakan') as $file) {
                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $fotoPath = $file->storeAs('foto_kerusakan', $fileName, 'public');
                if ($fotoPath) {
                    $fotoKerusakanPaths[] = $fotoPath;
                }
            }
        }

        $data_valid['foto_kerusakan'] = !empty($fotoKerusakanPaths) ? json_encode($fotoKerusakanPaths) : null;
        $data_valid['setupForm'] = collect([]);

        $setup->push(collect($data_valid));

        $mesin = collect(Cache::get('mesin'));
        $attach = collect(Cache::get('attach'));

        Cache::put('attach', $attach, now()->addMinutes(30));
        Cache::put('setup', $setup, now()->addMinutes(30));
        Cache::put('mesin', $mesin, now()->addMinutes(30));

        $mesin = collect(Cache::get('mesin'));
        return redirect('/mesin/maintenance/' . $mesin->get('id'))->with('reminder', 'p');

    }


    public function edit_maintenance(Request $request){

        $setup = collect(Cache::get('setup'));

        $data_valid = collect($request->validate([
            'index' => 'required|numeric',
            'nama_maintenance' => 'required',
            'warna' => 'required',
            'foto_kerusakan' => 'nullable|array',
            'foto_kerusakan.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]));

        $index_maintenance = $data_valid['index'];

        $maintenance = $setup[$index_maintenance];

        $data_valid->forget('index');

        if ($request->hasFile('foto_kerusakan')) {
            $fotoKerusakanPaths = [];
            foreach ($request->file('foto_kerusakan') as $file) {
                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $fotoPath = $file->storeAs('foto_kerusakan', $fileName, 'public');
                if ($fotoPath) {
                    $fotoKerusakanPaths[] = $fotoPath;
                }
            }
            $data_valid['foto_kerusakan'] = !empty($fotoKerusakanPaths) ? json_encode($fotoKerusakanPaths) : null;
        } else {
            $data_valid['foto_kerusakan'] = $maintenance->get('foto_kerusakan');
        }

        $maintenance = $maintenance->replace($data_valid);

        $setup[$index_maintenance] = $maintenance;

        $mesin = collect(Cache::get('mesin'));
        $attach = collect(Cache::get('attach'));

        Cache::put('attach', $attach, now()->addMinutes(30));
        Cache::put('setup', $setup, now()->addMinutes(30));
        Cache::put('mesin', $mesin, now()->addMinutes(30));

        $mesin = collect(Cache::get('mesin'));
        return redirect('/mesin/maintenance/' . $mesin->get('id'))->with('reminder', 'p');
    }

    public function delete_maintenance(Request $request){

        $setup = collect(Cache::get('setup'));

        $data_valid = $request->validate([
            'index' => 'required|numeric',
        ]);

        $setup = $setup->forget($data_valid['index'])->values();

        $mesin = collect(Cache::get('mesin'));
        $attach = collect(Cache::get('attach'));

        Cache::put('attach', $attach, now()->addMinutes(30));
        Cache::put('setup', $setup, now()->addMinutes(30));
        Cache::put('mesin', $mesin, now()->addMinutes(30));



        $mesin = collect(Cache::get('mesin'));
        return redirect('/mesin/maintenance/' . $mesin->get('id'))->with('reminder', 'p');
    }


    public function create_maintenance_form(Request $request){

        $setup = collect(Cache::get('setup'));

        $data_valid = $request->validate([
            'maintenance_index' => 'required|numeric',
            'nama_setup_form' => 'required',
            'syarat_setup_form' => 'required',
        ]);
        $setup[$data_valid['maintenance_index']]->get('setupForm')
        ->push(collect([
            'nama_setup_form' => $data_valid['nama_setup_form'],
            'syarat_setup_form' => $data_valid['syarat_setup_form']
        ]));

        $mesin = collect(Cache::get('mesin'));

        Cache::put('setup', $setup, now()->addMinutes(30));
        Cache::put('mesin', $mesin, now()->addMinutes(30));

        $mesin = collect(Cache::get('mesin'));
        return redirect('/mesin/maintenance/' . $mesin->get('id'))->with('reminder', 'p');

    }

    public function update_maintenance_form(Request $request){

        $setup = collect(Cache::get('setup'));

        $data_valid = $request->validate([
            'maintenance_index' => 'required|numeric',
            'form_index' => 'required|numeric',
            'nama_setup_form' => 'required',
            'syarat_setup_form' => 'required',
        ]);

        $form = $setup[$data_valid['maintenance_index']]->get('setupForm')[$data_valid['form_index']];

        $form = $form->replace(collect([
            'nama_setup_form' => $data_valid['nama_setup_form'],
            'syarat_setup_form' => $data_valid['syarat_setup_form']
        ]));

        $setup[$data_valid['maintenance_index']]->get('setupForm')[$data_valid['form_index']] = $form;

       $mesin = collect(Cache::get('mesin'));
       $attach = collect(Cache::get('attach'));

        Cache::put('attach', $attach, now()->addMinutes(30));
        Cache::put('setup', $setup, now()->addMinutes(30));
        Cache::put('mesin', $mesin, now()->addMinutes(30));
        $mesin = collect(Cache::get('mesin'));
        return redirect('/mesin/maintenance/' . $mesin->get('id'))->with('reminder', 'p');

    }

    public function delete_maintenance_form(Request $request){
        $setup = collect(Cache::get('setup'));

        $data_valid = $request->validate([
            'maintenance_index' => 'required|numeric',
            'form_index' => 'required|numeric',
        ]);

        $temp = $setup[$data_valid['maintenance_index']]->get('setupForm')->forget($data_valid['form_index']);
        $setup[$data_valid['maintenance_index']]['setupForm'] = $temp->values();



        $mesin = collect(Cache::get('mesin'));
        $attach = collect(Cache::get('attach'));

        Cache::put('attach', $attach, now()->addMinutes(30));
        Cache::put('setup', $setup, now()->addMinutes(30));
        Cache::put('mesin', $mesin, now()->addMinutes(30));

        $mesin = collect(Cache::get('mesin'));
        return redirect('/mesin/maintenance/' . $mesin->get('id'))->with('reminder', 'p');
    }
}
