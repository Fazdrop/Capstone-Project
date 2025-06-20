@extends('layouts.app')

@section('title', 'Edit User')
@section('menu-info', 'Edit User')

@section('content')
    {{-- Hidden div untuk menyimpan data roles dalam format JSON. Ini mencegah masalah parsing di x-data. --}}
    <div id="roles-data-edit" class="hidden" data-roles="{{ $roles->map(fn($r) => ['id' => $r->id, 'name' => $r->name])->toJson() }}"></div>

    <div class="flex justify-center items-center min-h-[80vh]">
        <div class="w-full max-w-lg bg-white rounded-xl shadow-lg p-8" x-data="{
            selectedDivisionId: '{{ old('division_id', $user->division_id) }}',
            selectedRoleId: '{{ old('role_id', $user->role_id) }}',
            isRoleLocked: false,
            filteredRoles: [],
            allRoles: [], // Akan diisi di fungsi init()

            // Fungsi untuk menangani perubahan pada dropdown divisi
            handleDivisionChange(event) {
                const selectedOption = event.target.options[event.target.selectedIndex];
                const divisionName = selectedOption ? selectedOption.getAttribute('data-name') : '';

                // Menggunakan $nextTick untuk memastikan DOM diperbarui setelah Alpine.js membuat/menyembunyikan opsi
                this.$nextTick(() => {
                    if (divisionName && divisionName.toLowerCase() === 'admin') {
                        // Filter hanya peran 'admin' jika divisi yang dipilih adalah 'Admin'
                        this.filteredRoles = this.allRoles.filter(role => role.name.toLowerCase() === 'admin');
                        // Pilih peran 'admin' jika ada
                        if (this.filteredRoles.length > 0) {
                            this.selectedRoleId = this.filteredRoles[0].id;
                        } else {
                            this.selectedRoleId = ''; // Tidak ada peran 'admin' yang ditemukan
                        }
                        this.isRoleLocked = true; // Kunci dropdown peran
                    } else {
                        // Filter semua peran kecuali 'admin' jika divisi bukan 'Admin'
                        this.filteredRoles = this.allRoles.filter(role => role.name.toLowerCase() !== 'admin');
                        this.isRoleLocked = false; // Buka kunci dropdown peran

                        // Jika peran yang sedang dipilih (selectedRoleId) tidak ada di filteredRoles yang baru, reset
                        if (this.selectedRoleId && !this.filteredRoles.some(r => r.id == this.selectedRoleId)) {
                            this.selectedRoleId = '';
                        }
                    }
                });
            },

            // Fungsi yang berjalan saat komponen pertama kali dimuat
            init() {
                // Ambil data allRoles dari hidden div dan parse sebagai JSON
                const rolesDataElement = document.getElementById('roles-data-edit'); // Menggunakan ID unik
                if (rolesDataElement) {
                    this.allRoles = JSON.parse(rolesDataElement.dataset.roles);
                } else {
                    console.error('Elemen data peran tersembunyi tidak ditemukan.');
                    this.allRoles = []; // Fallback ke array kosong
                }

                // Atur status awal berdasarkan nilai old('division_id') atau user->division_id
                if (this.selectedDivisionId) {
                    // Temukan opsi divisi yang sesuai dengan selectedDivisionId
                    const initialOption = this.$refs.divisionSelect.querySelector(`option[value='${this.selectedDivisionId}']`);
                    const initialDivisionName = initialOption ? initialOption.getAttribute('data-name') : '';

                    if (initialDivisionName && initialDivisionName.toLowerCase() === 'admin') {
                        this.filteredRoles = this.allRoles.filter(role => role.name.toLowerCase() === 'admin');
                        if (this.filteredRoles.length > 0) {
                            this.selectedRoleId = this.filteredRoles[0].id;
                        } else {
                            this.selectedRoleId = '';
                        }
                        this.isRoleLocked = true;
                    } else {
                        this.filteredRoles = this.allRoles.filter(role => role.name.toLowerCase() !== 'admin');
                        this.isRoleLocked = false;
                        // Pastikan selectedRoleId awal masih valid setelah filtering
                        if (this.selectedRoleId && !this.filteredRoles.some(r => r.id == this.selectedRoleId)) {
                            this.selectedRoleId = '';
                        }
                    }
                } else {
                    // Jika tidak ada divisi yang terpilih di awal, tampilkan semua peran
                    this.filteredRoles = this.allRoles;
                }
            }
        }" x-init="init()">

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
                {{-- Password field masih sama (optional di edit, bisa dikasih jika mau ganti) --}}
                {{-- Jika Anda ingin mengaktifkan field password:
                <div>
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
                </div>
                --}}
                <div>
                    <label for="division_id" class="block text-sm font-medium mb-1">Divisi</label>
                    <select name="division_id" id="division_id" required x-model="selectedDivisionId" x-ref="divisionSelect"
                        x-on:change="handleDivisionChange($event)"
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
                    <label for="role_id" class="block text-sm font-medium mb-1">Role</label>
                    <select name="role_id" id="role_id" required x-model="selectedRoleId" :disabled="isRoleLocked"
                        :class="{ 'bg-gray-100': isRoleLocked }"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                        <option value="">-- Pilih Role --</option>
                        <template x-for="role in filteredRoles" :key="role.id">
                            <option :value="role.id" x-text="role.name.charAt(0).toUpperCase() + role.name.slice(1)"
                                :selected="selectedRoleId == role.id"></option>
                        </template>
                    </select>
                    @error('role_id')
                        <div class="text-red-600 mt-1 text-xs">{{ $message }}</div>
                    @enderror
                </div>
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
