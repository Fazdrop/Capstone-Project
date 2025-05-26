@extends('layouts.app')

@section('title', 'Edit Division')
@section('menu-info', 'Edit Divisi')

@section('content')
<div class="max-w-lg mx-auto mt-14">
    <div class="bg-white rounded-xl shadow-lg p-8 border border-indigo-100">
        <div class="flex items-center gap-3 mb-6">
            <i data-feather="edit-3" class="w-7 h-7 text-yellow-500"></i>
            <h1 class="text-2xl font-bold text-yellow-600">Edit Divisi</h1>
        </div>
        <form method="POST" action="{{ route('admin.divisions.update', $division->id) }}" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Divisi</label>
                <input type="text" name="name" id="name"
                       class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-yellow-500 transition"
                       required value="{{ old('name', $division->name) }}">
                @error('name')
                    <div class="text-red-600 mt-2 text-sm font-semibold bg-red-50 px-3 py-1 rounded">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex gap-2">
                <button type="submit"
                        class="flex items-center gap-2 bg-yellow-500 text-white px-5 py-2 rounded-lg hover:bg-yellow-600 font-semibold shadow transition">
                    <i data-feather="save" class="w-4 h-4"></i>
                    Update
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
