<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DivisionController;

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

    // ======================
    // CRUD DIVISION (khusus admin)
    // ======================
    Route::prefix('admin')->group(function () {
        Route::get('/divisions', [DivisionController::class, 'index'])->name('admin.divisions.index');
        Route::get('/divisions/create', [DivisionController::class, 'create'])->name('admin.divisions.create');
        Route::post('/divisions', [DivisionController::class, 'store'])->name('admin.divisions.store');
        Route::get('/divisions/{division}/edit', [DivisionController::class, 'edit'])->name('admin.divisions.edit');
        Route::put('/divisions/{division}', [DivisionController::class, 'update'])->name('admin.divisions.update');
        Route::delete('/divisions/{division}', [DivisionController::class, 'destroy'])->name('admin.divisions.destroy');
    });
});
