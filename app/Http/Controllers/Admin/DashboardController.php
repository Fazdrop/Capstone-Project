<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Method untuk menampilkan dashboard admin
    public function index()
    {
        // Menghitung total user
        $userCount = \App\Models\User::count();
        // Menghitung total division
        $divisionCount = \App\Models\Division::count();

        // Kirim data ke view 'admin.dashboard'
        return view('admin.dashboard', compact('userCount', 'divisionCount'));
    }
}
