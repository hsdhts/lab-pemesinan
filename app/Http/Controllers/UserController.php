<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    // dibuat tampilan view nya dulu

    public function login()
    {

        return view('pages.user.login');
    }


    public function logout(Request $request)
    {


        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }


    public function masuk(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $user->update(['last_login' => Carbon::now()]);
                Auth::login($user);
                $request->session()->regenerate();
                return redirect()->intended('/');
            } else {
                return back()->withErrors([
                    'login' => 'Login Gagal! Pastikan username & password benar!',
                ]);
            }
        }

        return back()->withErrors([
            'login' => 'Login Gagal! Akun tidak terdaftar!',
        ]);
    }



    public function akun()
    {
        return view('pages.user.akun');
    }

    public function update_akun(Request $request)
    {
        $data_valid = $request->validate([
            'id' => 'required|numeric',
            'username' => 'required',
            'nama' => 'required',
            'avatar' => 'image|file|max:3072',
        ]);

        if ($request->hasFile('avatar')) {
            $data_valid['foto'] = $request->file('avatar')->storePublicly('foto-profil', 'public');

            // Hapus foto lama jika ada
            if (auth()->user()->foto !== null) {
                Storage::disk('public')->delete(auth()->user()->foto);
            }
        } elseif ($request->avatar_remove) {
            // Hapus foto lama
            if (auth()->user()->foto !== null) {
                Storage::disk('public')->delete(auth()->user()->foto);
            }
            $data_valid['foto'] = null;
        }

        User::find($data_valid['id'])->update($data_valid);

        return redirect('/akun');
    }




    public function ganti_password(Request $request)
    {

        $data_valid = $request->validate([
            'id' => 'required|numeric'
        ]);

        if ($request->password_baru) {
            $data_valid['password'] = $request->password_lama;
            if (Auth::attempt($data_valid)) {
                $data_valid['password'] = bcrypt($request->password_baru);
                User::find($data_valid['id'])->update($data_valid);
                return $this->logout($request)->with(['ganti password' => 'Silahkan login dengan password yang baru']);
            } else {
                return redirect()->back()->withInput()->withErrors(['password_lama' => 'Pastikan password lamanya sesuai!']);
            }
        } else {
            return redirect()->back()->withInput()->withErrors(['password_baru' => 'Password baru tidak ada isinya!']);
        }
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $user = User::query();

            return DataTables::of($user)
                ->addColumn('aksi', function ($u) {
                    return view('partials.tombolAksiUser', ['id' => $u->id]);
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->toJson();
        }


        return view('pages.user.index', ['halaman' => 'User', 'link_to_create' => '/user/create']);
    }


    public function create()
    {

        return view('pages.user.create', ['halaman' => 'User']);
    }

    public function store(Request $request)
    {

        $data_valid = $request->validate([
            'username' => 'required',
            'nama' => 'required',
            'email' => 'required|unique:users',
            'level' => 'required',
            'password' => 'required'

        ]);

        $data_valid['password'] = Hash::make($data_valid['password']);

        User::create($data_valid);

        return redirect('/user/all')->with('tambah', 'p');
    }

    public function edit($id)
    {

        $user = User::find($id);

        return view('pages.user.edit', ['halaman' => 'User', 'user' => $user]);
    }


    public function update(Request $request)
    {
        $user = User::find($request->id);

        $data_valid = $request->validate([
            'id' => 'required|numeric',
            'username' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($user->id)
            ],
            'nama' => 'required',
            'level' => 'required',
        ]);

        $user->update($data_valid);

        return redirect('/user/all')->with('edit', 'p');
    }

    public function delete(Request $request)
    {

        $data_valid = $request->validate([
            'id' => 'required|numeric',
        ]);

        User::destroy($data_valid['id']);

        return redirect('/user/all')->with('hapus', 'p');
    }
}
