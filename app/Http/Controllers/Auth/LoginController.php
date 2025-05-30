<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Tampilkan form login, tapi kalau sudah login redirect ke dashboard
    public function showLoginForm()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return match($user->role) {
                'admin' => redirect()->route('admin.dashboard'),
                // 'hrd'   => redirect()->route('hrd.dashboard'),
                // 'ga'    => redirect()->route('ga.dashboard'),
                // 'it'    => redirect()->route('it.dashboard'),
                // default => redirect()->route('user.dashboard'),
            };
        }
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' =>['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            return match($user->role) {
                'admin' => redirect()->route('admin.dashboard'),
                // 'hrd'   => redirect()->route('hrd.dashboard'),
                // 'ga'    => redirect()->route('ga.dashboard'),
                // 'it'    => redirect()->route('it.dashboard'),
                // default => redirect()->route('user.dashboard'),
            };
        }

        // Jika gagal login, tampilkan error dan kembalikan email
        return back()->withErrors([
            'email' => 'Email atau Password yang diberikan salah.',
        ])->onlyInput('email');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'You have been logged out successfully.');
    }
}
