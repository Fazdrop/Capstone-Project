<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

//admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

