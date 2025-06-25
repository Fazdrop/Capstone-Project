@extends('layouts.app')

@section('title', 'Tambah User')
@section('menu-info', 'Tambah User Baru')

@section('content')
    {{-- Hidden div untuk menyimpan data roles dalam format JSON. Ini mencegah masalah parsing di x-data. --}}
    <div id="roles-data" class="hidden"
        data-roles="{{ $roles->map(fn($r) => ['id' => $r->id, 'name' => $r->name])->toJson() }}"></div>

    <div class="max-w-lg mx-auto mt-12 bg-white p-8 rounded-2xl shadow-lg border border-gray-100" x-data="{
        selectedDivisionId: '{{ old('division_id') }}',
        selectedRoleId: '{{ old('role_id') }}',
        isRoleLocked: false,
        filteredRoles: [],
        allRoles: [], // Diinisialisasi di sini, akan diisi di fungsi init()
    
        // Fungsi untuk menangani perubahan pada dropdown divisi
        handleDivisionChange(event) {
            const selectedOption = event.target.options[event.target.selectedIndex];
            const divisionName = selectedOption ? selectedOption.getAttribute('data-name') : '';
    
            this.$nextTick(() => {
                if (divisionName && (divisionName.toLowerCase() === 'admin' || divisionName.toLowerCase() === 'bod')) {
                    // Filter hanya role 'admin' jika divisi Admin, atau hanya 'bod' jika divisi BoD
                    let roleName = divisionName.toLowerCase();
                    this.filteredRoles = this.allRoles.filter(role => role.name.toLowerCase() === roleName);
                    if (this.filteredRoles.length > 0) {
                        this.selectedRoleId = this.filteredRoles[0].id;
                    } else {
                        this.selectedRoleId = '';
                    }
                    this.isRoleLocked = true;
                } else {
                    // Selain itu, filter semua role kecuali admin dan bod
                    this.filteredRoles = this.allRoles.filter(role => role.name.toLowerCase() !== 'admin' && role.name.toLowerCase() !== 'bod');
                    this.isRoleLocked = false;
                    if (this.selectedRoleId && !this.filteredRoles.some(r => r.id == this.selectedRoleId)) {
                        this.selectedRoleId = '';
                    }
                }
            });
        },
    
        // Fungsi yang berjalan saat komponen pertama kali dimuat
        init() {
            // Ambil data allRoles dari hidden div dan parse sebagai JSON
            const rolesDataElement = document.getElementById('roles-data');
            if (rolesDataElement) {
                this.allRoles = JSON.parse(rolesDataElement.dataset.roles);
            } else {
                // Log error jika elemen data tidak ditemukan (untuk debugging)
                console.error('Elemen data peran tersembunyi tidak ditemukan.');
                this.allRoles = []; // Fallback ke array kosong
            }
    
            // Atur status awal berdasarkan nilai old('division_id') jika ada
            if (this.selectedDivisionId) {
                // Temukan opsi divisi yang sesuai dengan selectedDivisionId
                const initialOption = this.$refs.divisionSelect.querySelector(`option[value='${this.selectedDivisionId}']`);
                const initialDivisionName = initialOption ? initialOption.getAttribute('data-name') : '';
    
                if (initialDivisionName && (initialDivisionName.toLowerCase() === 'admin' || initialDivisionName.toLowerCase() === 'bod')) {
                    let roleName = initialDivisionName.toLowerCase();
                    this.filteredRoles = this.allRoles.filter(role => role.name.toLowerCase() === roleName);
                    if (this.filteredRoles.length > 0) {
                        this.selectedRoleId = this.filteredRoles[0].id;
                    } else {
                        this.selectedRoleId = '';
                    }
                    this.isRoleLocked = true;
                } else {
                    this.filteredRoles = this.allRoles.filter(role => role.name.toLowerCase() !== 'admin' && role.name.toLowerCase() !== 'bod');
                    this.isRoleLocked = false;
                    if (this.selectedRoleId && !this.filteredRoles.some(r => r.id == this.selectedRoleId)) {
                        this.selectedRoleId = '';
                    }
                }
            } else {
                // Jika tidak ada divisi yang terpilih di awal (halaman baru), tampilkan semua peran
                this.filteredRoles = this.allRoles;
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
                <label for="role_id" class="block text-sm font-semibold mb-1">Role</label>
                <select name="role_id" id="role_id" required x-model="selectedRoleId" :disabled="isRoleLocked"
                    :class="{ 'bg-gray-100': isRoleLocked }"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
                    <option value="">-- Pilih Role --</option>
                    <template x-for="role in filteredRoles" :key="role.id">
                        <option :value="role.id" x-text="role.name.charAt(0).toUpperCase() + role.name.slice(1)"
                            :selected="selectedRoleId == role.id"></option>
                    </template>
                </select>
                <!-- Hidden input agar value tetap terkirim walau select di-disable -->
                <template x-if="isRoleLocked">
                    <input type="hidden" name="role_id" :value="selectedRoleId">
                </template>
                @error('role_id')
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
