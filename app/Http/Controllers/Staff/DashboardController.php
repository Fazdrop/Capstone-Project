<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // (Opsional) Cek apakah benar-benar staff HR
        $user = Auth::user();
        if (
            strtolower($user->role?->name) !== 'staff' ||
            strtolower($user->division?->name) !== 'hr'
        ) {
            abort(403, 'Akses khusus Staff HR.');
        }

        return view('staff.dashboard');
    }
}
