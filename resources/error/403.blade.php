@extends('layouts.app')

@section('title', 'Akses Ditolak')

@section('content')
    <div class="min-h-[60vh] flex flex-col items-center justify-center">
        <div class="bg-red-50 rounded-xl shadow-lg p-10 flex flex-col items-center">
            <i data-feather="slash" class="w-16 h-16 text-red-400 mb-4"></i>
            <h1 class="text-3xl font-bold text-red-600 mb-2">403 | Akses Ditolak</h1>
            <p class="text-gray-700 mb-6 text-center">
                Anda tidak memiliki izin untuk mengakses halaman ini.<br>
                @if (auth()->check())
                    Mungkin role Anda belum diatur, atau halaman ini belum tersedia untuk role Anda.
                @else
                    Silakan login kembali.
                @endif
            </p>
            <div class="flex gap-3">
                @if (auth()->check())
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="px-6 py-2 rounded-lg bg-gray-800 text-white font-semibold hover:bg-gray-900 transition">
                        Logout & Login Ulang
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                @else
                    <a href="{{ route('login') }}"
                        class="px-6 py-2 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition shadow">
                        Kembali ke Login
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
