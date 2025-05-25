<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        //data yang dikirim dari form login
        $credentials = $request->validate([
            'email' =>['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        //melakukan autentikasi
        if(Auth::attempt($credentials)){
            //membuat session baru untuk user yang berhasil login
            $request->session()->regenerate();

            //redirect ke halaman dashboard atau halaman sesuai role masing masing
            $user = Auth::user();
            return match($user->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'hrd' => redirect()->route('hrd.dashboard'),
                'ga'=> redirect()->route('ga.dashboard'),
                'it' => redirect()->route('it.dashboard'),
                default => redirect()->route('user.dashboard'),
            };
        }

        //jika gagal login, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    //logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        //redirect ke halaman login
        return redirect()->route('login')->with('status', 'You have been logged out successfully.');
    }
}
