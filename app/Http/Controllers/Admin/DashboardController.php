<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Method untuk menampilkan dashboard admin
    public function index()
    {
        // Menghitung total user aktif
        $userCount = \App\Models\User::count();
        // Menghitung total division
        $divisionCount = \App\Models\Division::count();
        // menghitung total user yang aktif
        $activeUserCount = \App\Models\User::where('is_active', true)->count();
        //menghitung total role
        $roleCount = \App\Models\Role::count();



        // Kirim data ke view 'admin.dashboard'
        return view('admin.dashboard', compact('userCount','activeUserCount', 'divisionCount','roleCount'));
    }
}
