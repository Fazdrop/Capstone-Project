@extends('layouts.app')

@section('title', 'Dashboard Staff HR')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-2xl sm:text-3xl font-extrabold text-green-800 mb-2 flex items-center gap-2">
        <i data-feather="layout" class="w-6 h-6"></i>
        Dashboard Staff HR
    </h1>

    @if (auth()->user()->division?->name)
        <div class="inline-block mb-3 px-4 py-1 rounded-lg bg-green-50 border border-green-200 text-green-900 text-base font-bold shadow-sm tracking-wide">
            Divisi: {{ auth()->user()->division->name }}
        </div>
    @endif

    <p class="text-gray-600 mb-6">
        Selamat datang, <span class="font-semibold text-green-700">{{ auth()->user()->name }}</span>!<br>
        Ini adalah halaman utama untuk Staff HR. Anda dapat mengelola permintaan karyawan dan pelamar di sini.
    </p>
</div>
@endsection
