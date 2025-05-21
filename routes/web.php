<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard',['title' => 'Fairuz']);
});
Route::get('/login', function () {
    return view('auth.login');
});

//admin
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

