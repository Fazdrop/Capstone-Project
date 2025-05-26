@extends('layouts.app')

@section('title', 'Tambah Division')
@section('menu-info', 'Tambah Divisi Baru ')


@section('content')
<div class="max-w-lg mx-auto mt-14">
    <div class="bg-white rounded-xl shadow-lg p-8 border border-indigo-100">
        <div class="flex items-center gap-3 mb-6">
            <i data-feather="plus-circle" class="w-7 h-7 text-indigo-600"></i>
            <h1 class="text-2xl font-bold text-indigo-700">Tambah Divisi Baru</h1>
        </div>
        <form method="POST" action="{{ route('admin.divisions.store') }}" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Divisi</label>
                <input type="text" name="name" id="name"
                    class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-500 transition"
                    placeholder="Contoh: HRD, IT, Finance" required value="{{ old('name') }}">
                @error('name')
                    <div class="text-red-600 mt-2 text-sm font-semibold bg-red-50 px-3 py-1 rounded">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex gap-2">
                <button type="submit"
                        class="flex items-center gap-2 bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 font-semibold shadow transition">
                    <i data-feather="save" class="w-4 h-4"></i>
                    Simpan
                </button>
                <a href="{{ route('admin.divisions.index') }}"
                   class="flex items-center gap-2 bg-gray-200 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-300 font-semibold transition">
                    <i data-feather="arrow-left" class="w-4 h-4"></i>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
