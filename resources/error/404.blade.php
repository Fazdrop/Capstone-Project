@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
    <div class="min-h-[60vh] flex flex-col items-center justify-center">
        <div class="bg-yellow-50 rounded-xl shadow-lg p-10 flex flex-col items-center">
            <i data-feather="alert-triangle" class="w-16 h-16 text-yellow-400 mb-4"></i>
            <h1 class="text-3xl font-bold text-yellow-700 mb-2">404 | Halaman Tidak Ditemukan</h1>
            <p class="text-gray-700 mb-6 text-center">
                Maaf, halaman yang Anda cari tidak tersedia atau sudah dipindahkan.<br>
                @if (auth()->check())
                    Anda akan diarahkan ke dashboard utama.
                @else
                    Silakan login untuk melanjutkan.
                @endif
            </p>
            <div class="flex gap-3">
                @if (auth()->check())
                    <a href="{{ route('dashboard.by.role') }}"
                        class="px-6 py-2 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow">
                        Kembali ke Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-6 py-2 rounded-lg bg-gray-800 text-white font-semibold hover:bg-gray-900 transition">
                        Login
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
