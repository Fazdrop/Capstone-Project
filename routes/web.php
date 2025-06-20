<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\HoD\EmployeeRequestController;
use App\Http\Controllers\HoD\DashboardController as HoDDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

// ======================
// Halaman utama (redirect ke login)
// ======================
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
// ADMIN PANEL (hanya admin)
// ======================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Resource route untuk user & division
    Route::resource('users', UserController::class);
    Route::resource('divisions', DivisionController::class);
    Route::resource('roles',RoleController::class);
});

// ======================
// HoD PANEL (hanya HoD)
// ======================
Route::middleware(['auth', 'role:hod'])->prefix('hod')->name('hod.')->group(function () {
    // Dashboard HoD
    Route::get('/dashboard', [HoDDashboardController::class, 'index'])->name('dashboard');

    // Resource route untuk employee request
    Route::resource('request_employee', EmployeeRequestController::class);
});

// ======================
// (TAMBAHAN: HRD, BOD, dll, jika perlu, tinggal copy pola di atas)
// ======================

// Contoh jika nanti ada modul untuk HRD:
// use App\Http\Controllers\HRD\SomeController;
// Route::middleware(['auth', 'role:hrd'])->prefix('hrd')->name('hrd.')->group(function () {
//     Route::get('/dashboard', [SomeController::class, 'index'])->name('dashboard');
//     Route::resource('asset', AssetController::class);
// });
