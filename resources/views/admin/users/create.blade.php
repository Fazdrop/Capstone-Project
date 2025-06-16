@extends('layouts.app')

@section('title', 'Tambah User')
@section('menu-info', 'Tambah User Baru')

@section('content')
    <div class="max-w-lg mx-auto mt-12 bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
        <div class="flex items-center gap-3 mb-8">
            <div class="bg-indigo-100 text-indigo-700 rounded-full w-12 h-12 flex items-center justify-center shadow">
                <i data-feather="user-plus" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-indigo-700">Tambah User Baru</h1>
                <p class="text-gray-500 text-sm">Isi form di bawah untuk menambah user internal.</p>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-semibold mb-1">Nama</label>
                <input type="text" name="name" id="name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                    required value="{{ old('name') }}">
                @error('name')
                    <div class="text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold mb-1">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                    required value="{{ old('email') }}">
                @error('email')
                    <div class="text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold mb-1">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                    required>
                @error('password')
                    <div class="text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="division_id" class="block text-sm font-semibold mb-1">Divisi</label>
                <select name="division_id" id="division_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
                    <option value="">-- Pilih Divisi --</option>
                    @foreach ($divisions as $division)
                        <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}>
                            {{ $division->name }}
                        </option>
                    @endforeach
                </select>
                @error('division_id')
                    <div class="text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="role" class="block text-sm font-semibold mb-1">Role</label>
                <select name="role" id="role" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="hod" {{ old('role') == 'hod' ? 'selected' : '' }}>Head of Division (HoD)</option>
                    {{-- <option value="staff_hr" {{ old('role') == 'staff_hr' ? 'selected' : '' }}>Staff HR</option>
                    <option value="manager_hr" {{ old('role') == 'manager_hr' ? 'selected' : '' }}>Manager HR</option> --}}
                </select>
                @error('role')
                    <div class="text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tambahkan Status --}}
            <div>
                <label for="is_active" class="block text-sm font-semibold mb-1">Status</label>
                <select name="is_active" id="is_active" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
                    <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('is_active')
                    <div class="text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 transition font-semibold">
                    <i data-feather="save" class="inline w-5 h-5 mr-1 -mt-1"></i> Simpan
                </button>
                <a href="{{ route('admin.users.index') }}"
                    class="flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition text-center font-semibold">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
