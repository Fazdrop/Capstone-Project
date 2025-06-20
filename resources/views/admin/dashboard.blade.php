@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-5xl mx-auto mt-10">
        @if (session('success'))
            <div
                class="flash-message mb-6 flex items-center gap-2 bg-green-100 border border-green-200 text-green-700 px-4 py-2 rounded">
                <i data-feather="check-circle" class="w-5 h-5"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- Judul dan Deskripsi --}}
        <h1 class="text-3xl font-bold text-indigo-700 mb-3 flex items-center gap-2">
            <i data-feather="layout"></i>
            Dashboard Admin
        </h1>
        <p class="text-gray-600 mb-8">
            Selamat datang, <span class="font-semibold text-indigo-700">{{ auth()->user()->name ?? 'Admin' }}</span>!<br>
            Ini adalah pusat kontrol aplikasi. Kelola data user, divisi, role, dan fitur penting lain dari sini.
        </p>

        {{-- Statistik --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white shadow rounded-xl p-6 flex items-center gap-4">
                <div class="bg-indigo-100 text-indigo-700 p-3 rounded-full">
                    <i data-feather="users" class="w-6 h-6"></i>
                </div>
                <div>
                    <div class="text-xl font-bold">{{ $userCount ?? '-' }}</div>
                    <div class="text-gray-500 text-sm">Total User</div>
                </div>
            </div>
            <div class="bg-white shadow rounded-xl p-6 flex items-center gap-4">
                <div class="bg-emerald-100 text-emerald-700 p-3 rounded-full">
                    <i data-feather="grid" class="w-6 h-6"></i>
                </div>
                <div>
                    <div class="text-xl font-bold">{{ $divisionCount ?? '-' }}</div>
                    <div class="text-gray-500 text-sm">Total Divisi</div>
                </div>
            </div>
            <div class="bg-white shadow rounded-xl p-6 flex items-center gap-4">
                <div class="bg-green-100 text-green-700 p-3 rounded-full">
                    <i data-feather="user-check" class="w-6 h-6"></i>
                </div>
                <div>
                    <div class="text-xl font-bold">{{ $activeUserCount ?? '-' }}</div>
                    <div class="text-gray-500 text-sm">User Aktif</div>
                </div>
            </div>
            <div class="bg-white shadow rounded-xl p-6 flex items-center gap-4">
                <div class="bg-yellow-100 text-yellow-700 p-3 rounded-full">
                    <i data-feather="award" class="w-6 h-6"></i>
                </div>
                <div>
                    <div class="text-xl font-bold">{{ $roleCount ?? '-' }}</div>
                    <div class="text-gray-500 text-sm">Total Role</div>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('admin.users.index') }}"
                class="flex items-center gap-2 px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow transition font-semibold">
                <i data-feather="user-plus" class="w-5 h-5"></i>
                Manajemen User
            </a>
            <a href="{{ route('admin.divisions.index') }}"
                class="flex items-center gap-2 px-5 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg shadow transition font-semibold">
                <i data-feather="grid" class="w-5 h-5"></i>
                Manajemen Divisi
            </a>
            <a href="{{ route('admin.roles.index') }}"
                class="flex items-center gap-2 px-5 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow transition font-semibold">
                <i data-feather="award" class="w-5 h-5"></i>
                Manajemen Role
            </a>
        </div>
    </div>
@endsection
