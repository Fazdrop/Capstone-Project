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


        // Bandingkan dengan lowercase agar case-insensitive
        $userRole = strtolower(Auth::user()?->role?->name ?? '');

        if ($userRole !== strtolower($role)) {
            abort(403, 'ROLE TIDAK DIKENALI.');
        }
        logger('DEBUG ROLE', [
            'expected_role' => strtolower($role),
            'user_role'     => $userRole,
            'user_id'       => Auth::user()->id,
            'user_email'    => Auth::user()->email,
            'role_id'       => Auth::user()->role_id,
        ]);

        return $next($request);
    }
}
