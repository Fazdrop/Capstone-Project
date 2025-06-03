<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\HoD\DashboardController as HoDDashboardController;

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
// ROUTE GANTI PASSWORD (semua user login bisa akses)
// ======================
Route::middleware(['auth'])->group(function () {
    Route::get('/password/change', [PasswordController::class, 'showChangeForm'])->name('password.change');
    Route::post('/password/change', [PasswordController::class, 'update'])->name('password.update');
});

// ======================
// DASHBOARD & PANEL PER ROLE (PROTECTED & ROLE)
// ======================

// ADMIN PANEL (hanya admin)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    // Dashboard Admin PAKAI CONTROLLER
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // CRUD Division (hanya admin)
    Route::get('/divisions', [DivisionController::class, 'index'])->name('admin.divisions.index');
    Route::get('/divisions/create', [DivisionController::class, 'create'])->name('admin.divisions.create');
    Route::post('/divisions', [DivisionController::class, 'store'])->name('admin.divisions.store');
    Route::get('/divisions/{division}/edit', [DivisionController::class, 'edit'])->name('admin.divisions.edit');
    Route::put('/divisions/{division}', [DivisionController::class, 'update'])->name('admin.divisions.update');
    Route::delete('/divisions/{division}', [DivisionController::class, 'destroy'])->name('admin.divisions.destroy');

    // CRUD USER (hanya admin)
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

// ======================
// HoD PANEL (hanya HoD)

Route::middleware(['auth', 'role:hod'])->prefix('hod')->group(function () {
    // Dashboard HoD PAKAI CONTROLLER
    Route::get('/dashboard', [HoDDashboardController::class, 'index'])->name('hod.dashboard');
});



