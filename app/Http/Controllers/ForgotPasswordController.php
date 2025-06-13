<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('pages.auth.forgot');
    }

    public function sendVerificationToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        $token = Str::random(60);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('pages.auth.email_reset', ['token' => $token, 'email' => $request->email], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('success', 'Berhasilkan Mengirimkan Link Verifikasi Reset Password Ke Email' . $request->email);
    }

    public function showResetPasswordForm(Request $request, $token)
    {
        $email = $request->email;
        return view('pages.auth.reset_form', compact('token', 'email'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $checkToken = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])
            ->first();

        if (!$checkToken) {
            return back()->with(['error' => 'Invalid Token']);
        }

        User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where('email', $request->email)->delete();
        return redirect()->route('login')->with(['success' => 'Berhasil Mengubah Password.']);
    }
}
