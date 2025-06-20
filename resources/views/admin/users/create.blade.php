@extends('layouts.app')

@section('title', 'Tambah User')
@section('menu-info', 'Tambah User Baru')

@section('content')
    <div class="max-w-lg mx-auto mt-12 bg-white p-8 rounded-2xl shadow-lg border border-gray-100" x-data="{
        selectedDivisionId: '{{ old('division_id') }}',
        selectedRole: '{{ old('role') }}',
        isRoleLocked: false,
        showAdminRoleOption: true, // Default: tampilkan opsi Admin sampai divisi dipilih

        // Fungsi untuk memeriksa divisi saat dropdown berubah
        handleDivisionChange(event) {
            const selectedOption = event.target.options[event.target.selectedIndex];
            const divisionName = selectedOption.getAttribute('data-name');

            if (divisionName && divisionName.toLowerCase() === 'admin') {
                // Jika divisi adalah 'Admin'
                this.selectedRole = 'admin'; // Set role menjadi 'admin'
                this.isRoleLocked = true; // Kunci dropdown role
                this.showAdminRoleOption = true; // Pastikan opsi 'Admin' terlihat
            } else {
                // Jika divisi BUKAN 'Admin'
                this.isRoleLocked = false; // Buka kunci dropdown role
                this.showAdminRoleOption = false; // Sembunyikan opsi 'Admin'

                // Jika role sebelumnya adalah 'admin' dan divisi berubah ke non-admin,
                // reset selectedRole agar tidak ada pilihan 'admin' yang tidak valid
                if (this.selectedRole === 'admin') {
                    this.selectedRole = ''; // Atur ulang ke kosong untuk memaksa pemilihan ulang
                }
            }
        },

        // Fungsi yang berjalan saat komponen pertama kali dimuat
        init() {
            // Periksa state awal saat halaman dimuat (jika ada validation error atau old input)
            if (this.selectedDivisionId) {
                const initialOption = this.$refs.divisionSelect.querySelector(`option[value='${this.selectedDivisionId}']`);
                if (initialOption) {
                    const initialDivisionName = initialOption.getAttribute('data-name');
                    if (initialDivisionName && initialDivisionName.toLowerCase() === 'admin') {
                        this.isRoleLocked = true;
                        this.showAdminRoleOption = true;
                        // Pastikan selectedRole adalah 'admin' jika divisi admin sudah terpilih sebelumnya
                        this.selectedRole = 'admin';
                    } else {
                        this.isRoleLocked = false;
                        this.showAdminRoleOption = false; // Sembunyikan opsi admin jika divisi non-admin sudah terpilih
                        // Reset jika old role adalah admin untuk divisi non-admin
                        if (this.selectedRole === 'admin') {
                            this.selectedRole = '';
                        }
                    }
                }
            } else {
                // Jika tidak ada divisi yang terpilih di awal (halaman baru),
                // opsi admin harus terlihat agar bisa dipilih jika user memilih divisi Admin
                this.showAdminRoleOption = true;
            }
        }
    }"
        x-init="init()">

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

            {{-- Nama --}}
            <div>
                <label for="name" class="block text-sm font-semibold mb-1">Nama</label>
                <input type="text" name="name" id="name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                    required value="{{ old('name') }}">
                @error('name')
                    <div class="text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-semibold mb-1">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                    required value="{{ old('email') }}">
                @error('email')
                    <div class="text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-semibold mb-1">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                    required>
                @error('password')
                    <div class="text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Divisi --}}
            <div>
                <label for="division_id" class="block text-sm font-semibold mb-1">Divisi</label>
                <select name="division_id" id="division_id" required x-model="selectedDivisionId" x-ref="divisionSelect"
                    x-on:change="handleDivisionChange($event)"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
                    <option value="">-- Pilih Divisi --</option>
                    @foreach ($divisions as $division)
                        <option value="{{ $division->id }}" data-name="{{ $division->name }}"
                            {{ old('division_id') == $division->id ? 'selected' : '' }}>
                            {{ $division->name }}
                        </option>
                    @endforeach
                </select>
                @error('division_id')
                    <div class="text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Role --}}
            <div>
                <label for="role" class="block text-sm font-semibold mb-1">Role</label>
                <select name="role" id="role" required x-model="selectedRole" :disabled="isRoleLocked"
                    :class="{ 'bg-gray-100': isRoleLocked }"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
                    <option value="">-- Pilih Role --</option>
                    {{-- Menggunakan x-if untuk menyembunyikan/menampilkan opsi Admin --}}
                    <template x-if="showAdminRoleOption">
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </template>
                    <option value="hod" {{ old('role') == 'hod' ? 'selected' : '' }}>Head of Division (HoD)</option>
                    <option value="manager" {{ old('role') == 'manager' ? 'manager' : '' }}>Manager</option>

                </select>
                @error('role')
                    <div class="text-red-600 mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Status --}}
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
