@extends('layouts.app')

@section('title', 'Edit User')
@section('menu-info', 'Edit User')

@section('content')
    <div class="flex justify-center items-center min-h-[80vh]">
        <div class="w-full max-w-lg bg-white rounded-xl shadow-lg p-8">
            <h1 class="text-2xl font-bold mb-2 text-indigo-700 flex items-center gap-2">
                <i data-feather="edit"></i> Edit User
            </h1>

            <p class="text-gray-500 mb-6">Ubah detail pengguna di bawah ini.</p>
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-5">
                @csrf
                @method('PUT')
                <div>
                    <label for="name" class="block text-sm font-medium mb-1">Nama</label>
                    <input type="text" name="name" id="name"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
                        required value="{{ old('name', $user->name) }}">
                    @error('name')
                        <div class="text-red-600 mt-1 text-xs">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" id="email"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
                        required value="{{ old('email', $user->email) }}">
                    @error('email')
                        <div class="text-red-600 mt-1 text-xs">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <div>
                    <label for="password" class="block text-sm font-medium mb-1 flex items-center gap-1">
                        Password
                        <span class="text-xs text-gray-400">(Biarkan kosong jika tidak ingin diubah)</span>
                        <i data-feather="info" class="w-4 h-4 text-gray-400"></i>
                    </label>
                    <input type="password" name="password" id="password"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 transition"
                        autocomplete="new-password" placeholder="******">
                    @error('password')
                        <div class="text-red-600 mt-1 text-xs">{{ $message }}</div>
                    @enderror
                </div> --}}
                <div>
                    <label for="division_id" class="block text-sm font-medium mb-1">Divisi</label>
                    <select name="division_id" id="division_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                        <option value="">-- Pilih Divisi --</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}"
                                {{ old('division_id', $user->division_id) == $division->id ? 'selected' : '' }}>
                                {{ $division->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('division_id')
                        <div class="text-red-600 mt-1 text-xs">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="role" class="block text-sm font-medium mb-1">Role</label>
                    <select name="role" id="role" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                        <option value="">-- Pilih Role --</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="hod" {{ old('role', $user->role) == 'hod' ? 'selected' : '' }}>Head of Division
                            (HoD)</option>
                        {{-- <option value="staff_hr" {{ old('role', $user->role) == 'staff_hr' ? 'selected' : '' }}>Staff HR
                        </option>
                        <option value="manager_hr" {{ old('role', $user->role) == 'manager_hr' ? 'selected' : '' }}>Manager
                            HR</option> --}}
                    </select>
                    @error('role')
                        <div class="text-red-600 mt-1 text-xs">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tambahkan Status --}}
                <div>
                    <label for="is_active" class="block text-sm font-medium mb-1">Status</label>
                    <select name="is_active" id="is_active" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                        <option value="1" {{ old('is_active', $user->is_active) == 1 ? 'selected' : '' }}>Aktif
                        </option>
                        <option value="0" {{ old('is_active', $user->is_active) == 0 ? 'selected' : '' }}>Nonaktif
                        </option>
                    </select>
                    @error('is_active')
                        <div class="text-red-600 mt-1 text-xs">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-between mt-6 gap-2">
                    <button type="submit"
                        class="bg-indigo-600 text-white font-semibold px-6 py-2 rounded-lg shadow hover:bg-indigo-700 transition">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.users.index') }}"
                        class="bg-gray-200 text-gray-800 font-semibold px-6 py-2 rounded-lg hover:bg-gray-300 transition text-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
