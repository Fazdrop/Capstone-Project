@extends('layouts.app')

@section('title', 'Dashboard HoD')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-indigo-700 mb-4 flex items-center gap-2">
        <i data-feather="layout"></i>
        Dashboard HoD
    </h1>
    <p class="text-gray-600 mb-8">
        Selamat datang, <span class="font-semibold text-indigo-700">{{ auth()->user()->name }}</span>!<br>
        Ini adalah halaman utama untuk HoD. Anda dapat melakukan request recruitment dan melihat status permintaan Anda di sini.
    </p>
    {{-- Tambahkan statistik, quick actions, atau info sesuai kebutuhan --}}
</div>
@endsection
