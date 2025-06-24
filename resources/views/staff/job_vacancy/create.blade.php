{{-- filepath: resources/views/staff/job_vacancy/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Job Vacancy')

@section('content')
    <div class="max-w-2xl mx-auto mt-10 bg-white rounded-xl shadow-lg border border-gray-200 p-8">
        <h1 class="text-2xl font-bold text-green-800 mb-6 flex items-center gap-2">
            <i data-feather="plus" class="w-6 h-6"></i>
            Tambah Job Vacancy
        </h1>
        <form action="{{ route('staff.job_vacancy.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block font-semibold mb-1">Judul</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2" required
                    value="{{ old('title') }}">
                @error('title')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Department</label>
                <input type="text" name="department" class="w-full border rounded px-3 py-2"
                    value="{{ old('department') }}">
                @error('department')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Division</label>
                <input type="text" name="division" class="w-full border rounded px-3 py-2" value="{{ old('division') }}">
                @error('division')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Lokasi</label>
                <input type="text" name="location" class="w-full border rounded px-3 py-2" value="{{ old('location') }}">
                @error('location')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Deskripsi</label>
                <textarea name="description" class="w-full border rounded px-3 py-2" rows="4">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Persyaratan</label>
                <textarea name="requirements" class="w-full border rounded px-3 py-2" rows="3">{{ old('requirements') }}</textarea>
                @error('requirements')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Jenis Pekerjaan</label>
                <input type="text" name="employment_type" class="w-full border rounded px-3 py-2"
                    value="{{ old('employment_type') }}">
                @error('employment_type')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Deadline</label>
                <input type="date" name="deadline" class="w-full border rounded px-3 py-2"
                    value="{{ old('deadline') }}">
                @error('deadline')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block font-semibold mb-1">Status</label>
                <select name="is_active" class="w-full border rounded px-3 py-2">
                    <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('is_active')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex items-center justify-between mt-8 gap-2">
                <a href="{{ route('staff.job_vacancy.index') }}"
                    class="px-5 py-2 rounded-2xl bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold shadow transition border border-gray-300">
                    Batal
                </a>
                <button type="submit"
                    class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800 transition font-semibold shadow">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
