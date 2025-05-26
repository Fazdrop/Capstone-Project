<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
    public function showChangeForm()
    {
        return view('auth.passwords.change');
    }

    public function update(Request $request)
    {
        // 1) Validasi dengan pesan kustom untuk 'confirmed'
        $request->validate([
            'current_password'   => 'required',
            'new_password'       => 'required|string|min:8|confirmed',
        ], [
            // Kustom pesan untuk mismatch new_password vs new_password_confirmation
            'new_password.confirmed' => 'Password baru dan konfirmasi tidak cocok. Silakan cek kembali!',
        ]);

        $user = Auth::user();

        // 2) Cek password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password lama salah. Silakan coba lagi.',
            ]);
        }

        // 3) Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Password berhasil diubah!');
    }
}
