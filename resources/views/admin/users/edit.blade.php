@extends('layouts.app')

@section('title', 'Edit User')
@section('menu-info', 'Edit User')

@section('content')
    <div class="flex justify-center items-center min-h-[80vh]">
        <div class="w-full max-w-lg bg-white rounded-xl shadow-lg p-8" x-data="{
            // Inisialisasi state Alpine.js dengan nilai dari PHP (old input atau data user)
            selectedDivisionId: '{{ old('division_id', $user->division_id) }}',
            selectedRole: '{{ old('role', $user->role) }}',
            isRoleLocked: false,
            showAdminRoleOption: true, // Default: tampilkan opsi Admin sampai divisi dipilih

            // Fungsi untuk menangani perubahan pada dropdown divisi
            handleDivisionChange(event) {
                const selectedOption = event.target.options[event.target.selectedIndex];
                const divisionName = selectedOption.getAttribute('data-name');

                if (divisionName && divisionName.toLowerCase() === 'admin') {
                    // Jika divisi adalah 'Admin'
                    this.showAdminRoleOption = true; // Pastikan opsi 'Admin' terlihat terlebih dahulu
                    this.$nextTick(() => { // Tunggu sampai DOM diperbarui
                        this.selectedRole = 'admin'; // Kemudian atur role menjadi 'admin'
                        this.isRoleLocked = true; // Kunci dropdown role
                    });
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
                // Periksa state awal saat halaman dimuat (jika ada validation error atau old input atau data user)
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
                    // Jika tidak ada divisi yang terpilih di awal (halaman baru atau user belum memiliki divisi),
                    // opsi admin harus terlihat agar bisa dipilih jika user memilih divisi Admin
                    this.showAdminRoleOption = true;
                }
            }
        }"
            x-init="init()">

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
                {{-- Password field is intentionally commented out as per your original code.
                     Uncomment if you want to allow password changes from this form. --}}
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
                        x-model="selectedDivisionId" x-ref="divisionSelect" x-on:change="handleDivisionChange($event)"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                        <option value="">-- Pilih Divisi --</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}" data-name="{{ $division->name }}"
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
                        x-model="selectedRole" :disabled="isRoleLocked" :class="{ 'bg-gray-100': isRoleLocked }"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                        <option value="">-- Pilih Role --</option>
                        {{-- Menggunakan x-if untuk menyembunyikan/menampilkan opsi Admin --}}
                        <template x-if="showAdminRoleOption">
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        </template>
                        <option value="hod" {{ old('role', $user->role) == 'hod' ? 'selected' : '' }}>Head of Division (HoD)</option>
                        <option value="manager" {{ old('role', $user->role) == 'manager' ? 'selected' : '' }}>Manager</option>
                        {{-- Uncomment these if you need them:
                        <option value="staff_hr" {{ old('role', $user->role) == 'staff_hr' ? 'selected' : '' }}>Staff HR</option>
                        <option value="manager_hr" {{ old('role', $user->role) == 'manager_hr' ? 'selected' : '' }}>Manager HR</option>
                        --}}
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
