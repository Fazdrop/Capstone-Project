<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    // Tampilkan form login, tapi kalau sudah login redirect ke dashboard
    public function showLoginForm()
    {
        if (Auth::check()) {
            $user = Auth::user();
            // Log::info('User already logged in', ['user_id' => $user->id, 'role' => $user->role]);
            return match ($user->role->name) {
                'admin' => redirect()->route('admin.dashboard'),
                'hod'   => redirect()->route('hod.dashboard'),
                // Aktifkan atau tambah role lain sesuai kebutuhan
                // 'hrd'   => redirect()->route('hrd.dashboard'),
                // 'ga'    => redirect()->route('ga.dashboard'),
                // 'it'    => redirect()->route('it.dashboard'),
                // default => redirect()->route('user.dashboard'),
                default => abort(403, 'Role tidak dikenali.'),
            };
        }
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Coba login, tapi cek dulu status aktif
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // 1. Cek apakah user aktif?
            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda nonaktif. Hubungi admin untuk mengaktifkan kembali.'
                ])->onlyInput('email');
            }

            // 2. Update last_login_at
            $user->last_login_at = now();
            $user->save();

            // 3. Arahkan ke dashboard sesuai role
            $request->session()->regenerate();
            return match ($user->role->name) {
                'admin' => redirect()->route('admin.dashboard'),
                'hod'   => redirect()->route('hod.dashboard'),
                // 'hrd'   => redirect()->route('hrd.dashboard'),
                // 'ga'    => redirect()->route('ga.dashboard'),
                // 'it'    => redirect()->route('it.dashboard'),
                // default => redirect()->route('user.dashboard'),
                default => abort(403, 'Role tidak dikenali.'),
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
