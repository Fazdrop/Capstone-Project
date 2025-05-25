<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;


// Halaman utama (redirect ke login)
Route::get('/', function () {
    return redirect()->route('login');
});

// ======================
// Login & Logout Route
// ======================

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ======================
// DASHBOARD PER ROLE (protected by auth)
// ======================
Route::middleware(['auth'])->group(function () {
    // Admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // HRD
    Route::get('/hrd/dashboard', function () {
        return view('hrd.dashboard');
    })->name('hrd.dashboard');

    // GA
    Route::get('/ga/dashboard', function () {
        return view('ga.dashboard');
    })->name('ga.dashboard');

    // IT
    Route::get('/it/dashboard', function () {
        return view('it.dashboard');
    })->name('it.dashboard');

    // User umum
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
});
