<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Jika user tidak punya role, atau role-nya tidak sama dengan yang dibutuhkan
        if (!Auth::user()->role || Auth::user()->role->name !== $role) {
            // Logout user dan redirect ke login dengan pesan error
            Auth::logout();
            return redirect()->route('login')->withErrors(['auth' => 'Akses ditolak, role tidak dikenali!']);
        }

        return $next($request);
    }
}
