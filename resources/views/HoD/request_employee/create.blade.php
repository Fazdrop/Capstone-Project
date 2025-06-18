@extends('layouts.app')

@section('title', 'Permintaan Karyawan Baru')
@section('menu-info', 'Formulir Permintaan Karyawan')

@section('content')
    {{-- Tagify CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

    <div class="max-w-2xl mx-auto mt-10 bg-white rounded-xl shadow-lg p-8 border border-gray-200" x-data="{
        step: 1,
        employmentType: '{{ old('employment_type') }}',
        requestType: '{{ old('request_type', 'new') }}',
        softSkillsOptions: ['Komunikasi', 'Kerjasama', 'Kepemimpinan', 'Kreativitas', 'Time Management', 'Problem Solving', 'Adaptasi', 'Empati', 'Negosiasi', 'Etos Kerja', 'Berpikir Kritis'],
        hardSkillsOptions: ['Excel', 'Python', 'Public Speaking', 'Akuntansi', 'Desain Grafis', 'Negosiasi', 'SAP', 'SQL', 'Data Entry', 'Content Writing', 'SEO', 'Digital Marketing', 'Analisis Data'],
        majorOptions: ['Akuntansi', 'Manajemen', 'Teknik Informatika', 'Teknik Industri', 'Teknik Mesin', 'Teknik Elektro', 'Psikologi', 'Hukum', 'Pendidikan', 'Farmasi', 'Sistem Informasi', 'Ilmu Komunikasi', 'Desain Komunikasi Visual', 'Ekonomi Pembangunan', 'Matematika', 'Fisika', 'Kimia'],
        initTagify(elementId, whitelistData) {
            let element = document.querySelector(elementId);
            if (element) {
                new Tagify(element, {
                    whitelist: whitelistData,
                    dropdown: { enabled: 0, maxItems: 20 },
                    originalInputValueFormat: valuesArr => JSON.stringify(valuesArr.map(item => item.value))
                });
            }
        }
    }"
        x-cloak>
        <h1 class="text-2xl font-bold text-green-900 mb-6 text-center">
            Formulir Permintaan Karyawan
        </h1>
        {{-- Progress Step Indicator --}}
        <div class="flex justify-center gap-2 mb-6">
            <template x-for="n in 4" :key="n">
                <div :class="{ 'w-8 h-2 rounded-full': true, 'bg-green-600': step >= n, 'bg-gray-200': step < n }"></div>
            </template>
        </div>
        <p class="text-center text-sm text-gray-500 mb-4">Step <span x-text="step"></span> dari 4</p>
        <form x-ref="createForm" action="{{ route('hod.request_employee.store') }}" method="POST"
            enctype="multipart/form-data" autocomplete="off" novalidate>
            @csrf

            {{-- STEP 1: Data Umum --}}
            <div x-show="step === 1" x-transition>
                <h2 class="text-lg font-semibold mb-4">Bagian 1: Data Umum Permintaan</h2>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Tanggal Permintaan <span class="text-red-500">*</span></label>
                    <input type="date" name="request_date"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 transition"
                        value="{{ old('request_date', now()->format('Y-m-d')) }}" required>
                    @error('request_date')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Nama Pemohon <span class="text-red-500">*</span></label>
                    <input type="text" name="requester_name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 transition"
                        value="{{ old('requester_name', auth()->user()->name) }}" required>
                    @error('requester_name')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Unit Bisnis/Divisi <span class="text-red-500">*</span></label>
                    <input type="text" name="business_unit_division"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100"
                        value="{{ old('business_unit_division', auth()->user()->division?->name) }}" readonly required>
                    @error('business_unit_division')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Departemen <span class="text-red-500">*</span></label>
                    <input type="text" name="department"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 transition"
                        value="{{ old('department') }}" required>
                    @error('department')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Jabatan <span class="text-red-500">*</span></label>
                    <input type="text" name="position"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 transition"
                        value="{{ old('position') }}" required>
                    @error('position')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Jumlah Karyawan <span class="text-red-500">*</span></label>
                    <input type="number" name="quantity"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 transition"
                        min="1" value="{{ old('quantity', 1) }}" required>
                    @error('quantity')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block mb-1 font-medium">Lokasi Kerja <span class="text-red-500">*</span></label>
                    <input type="text" name="work_location"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 transition"
                        value="{{ old('work_location') }}" required>
                    @error('work_location')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- STEP 2: Detail Permintaan --}}
            <div x-show="step === 2" x-transition>
                <h2 class="text-lg font-semibold mb-4">Bagian 2: Detail Permintaan</h2>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Level/Golongan</label>
                    <input type="text" name="grade_level"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 transition"
                        value="{{ old('grade_level') }}">
                    @error('grade_level')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Status <span class="text-red-500">*</span></label>
                    <select name="employment_type" x-model="employmentType"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 transition"
                        required>
                        <option value="">-- Pilih Status --</option>
                        <option value="contract" {{ old('employment_type') == 'contract' ? 'selected' : '' }}>Kontrak
                        </option>
                        <option value="permanent" {{ old('employment_type') == 'permanent' ? 'selected' : '' }}>Tetap
                        </option>
                    </select>
                    @error('employment_type')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4" x-show="employmentType === 'contract'" x-transition>
                    <label class="block mb-1 font-medium">Tanggal Berakhir Kontrak</label>
                    <input type="date" name="contract_end_date"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 transition"
                        value="{{ old('contract_end_date') }}">
                    @error('contract_end_date')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Permintaan Untuk <span class="text-red-500">*</span></label>
                    <div class="flex gap-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="request_type" value="new" x-model="requestType"
                                {{ old('request_type', 'new') == 'new' ? 'checked' : '' }}>
                            <span class="ml-2">Formasi Baru</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="request_type" value="replace" x-model="requestType"
                                {{ old('request_type') == 'replace' ? 'checked' : '' }}>
                            <span class="ml-2">Menggantikan</span>
                        </label>
                    </div>
                    @error('request_type')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4" x-show="requestType === 'replace'" x-transition>
                    <label class="block mb-1 font-medium">Alasan Penggantian</label>
                    <select name="replacement_reason"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 transition">
                        <option value="">-- Pilih Alasan --</option>
                        <option value="resign" {{ old('replacement_reason') == 'resign' ? 'selected' : '' }}>Resign
                        </option>
                        <option value="mutation" {{ old('replacement_reason') == 'mutation' ? 'selected' : '' }}>Mutasi
                        </option>
                        <option value="promotion" {{ old('replacement_reason') == 'promotion' ? 'selected' : '' }}>Promosi
                        </option>
                    </select>
                    @error('replacement_reason')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Alasan Permintaan</label>
                    <textarea name="reason" rows="2"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 transition">{{ old('reason') }}</textarea>
                    @error('reason')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- STEP 3: Kualifikasi --}}
            <div x-show="step === 3" x-transition>
                <h2 class="text-lg font-semibold mb-4">Bagian 3: Kualifikasi</h2>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Jenis Kelamin / Usia <span class="text-red-500">*</span></label>
                    <div class="flex items-center gap-6">
                        <div class="flex gap-3">
                            <label class="inline-flex items-center">
                                <input type="radio" name="gender_requirement" value="male"
                                    {{ old('gender_requirement') == 'male' ? 'checked' : '' }} required>
                                <span class="ml-1">Pria</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="gender_requirement" value="female"
                                    {{ old('gender_requirement') == 'female' ? 'checked' : '' }} required>
                                <span class="ml-1">Wanita</span>
                            </label>
                        </div>
                        <div class="flex gap-2 items-center">
                            <input type="number" name="min_age_requirement" min="17" placeholder="min"
                                class="w-20 px-2 py-1 border border-gray-300 rounded"
                                value="{{ old('min_age_requirement', 18) }}">
                            <span>-</span>
                            <input type="number" name="max_age_requirement" min="17" placeholder="max"
                                class="w-20 px-2 py-1 border border-gray-300 rounded"
                                value="{{ old('max_age_requirement', 35) }}">
                        </div>
                    </div>
                    @error('gender_requirement')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Pengalaman <span class="text-red-500">*</span></label>
                    <div class="flex gap-4">
                        @foreach (['0' => '0', '1-2' => '1-2 TH', '3-5' => '3-5 TH', '>5' => '> 5 TH'] as $val => $label)
                            <label class="inline-flex items-center">
                                <input type="radio" name="experience_requirement" value="{{ $val }}"
                                    {{ old('experience_requirement') == $val ? 'checked' : '' }} required>
                                <span class="ml-1">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('experience_requirement')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Pendidikan <span class="text-red-500">*</span></label>
                    <div class="flex gap-4 flex-wrap">
                        @foreach (['SMA', 'D3', 'S1', 'S2'] as $ed)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="education_level[]" value="{{ $ed }}"
                                    {{ is_array(old('education_level')) && in_array($ed, old('education_level')) ? 'checked' : '' }}>
                                <span class="ml-1">{{ $ed }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('education_level')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block mb-1 font-medium">Jurusan</label>
                    <input id="major_requirement" name="major_requirement" placeholder="Ketik jurusan lalu enter"
                        value='{{ old('major_requirement', '[]') }}' class="w-full" x-init="initTagify('#major_requirement', majorOptions)">
                    <small class="text-gray-500">Bisa memilih dari daftar atau mengetik jurusan baru.</small>
                    @error('major_requirement')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- STEP 4: Uraian Pekerjaan & Persyaratan --}}
            <div x-show="step === 4" x-transition x-data="{
                jobDescriptions: {{ old('job_description') ? json_encode(old('job_description')) : "['']" }},
                addJobDesc() { if (this.jobDescriptions.length < 5) this.jobDescriptions.push('') },
                removeJobDesc(i) { if (this.jobDescriptions.length > 1) this.jobDescriptions.splice(i, 1) }
            }">
                <h2 class="text-lg font-semibold mb-4">Bagian 4: Uraian Pekerjaan & Persyaratan</h2>
                <label class="block mb-1 font-medium">Uraian Pekerjaan <span class="text-red-500">*</span></label>
                <template x-for="(desc, i) in jobDescriptions" :key="i">
                    <div class="flex items-start gap-2 mb-2">
                        <textarea :name="`job_description[${i}]`" x-model="jobDescriptions[i]" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 transition"
                            rows="2" placeholder="Tuliskan uraian pekerjaan"></textarea>
                        <button type="button" x-show="jobDescriptions.length > 1" @click="removeJobDesc(i)"
                            class="mt-2 text-red-600 hover:text-red-800 font-bold" title="Hapus">×</button>
                    </div>
                </template>
                <button type="button" @click="addJobDesc" x-show="jobDescriptions.length < 5"
                    class="mb-4 px-3 py-1 rounded bg-green-50 text-green-700 border border-green-400 hover:bg-green-100 transition">
                    + Tambah Uraian</button>
                @error('job_description.*')
                    <span class="text-sm text-red-600 d-block">{{ $message }}</span>
                @enderror

                <div class="mb-4">
                    <label class="block mb-1 font-medium">Soft Skill</label>
                    <input id="soft_skills_requirement" name="soft_skills_requirement"
                        placeholder="Ketik soft skill lalu enter" value='{{ old('soft_skills_requirement', '[]') }}'
                        class="w-full" x-init="initTagify('#soft_skills_requirement', softSkillsOptions)">
                    <small class="text-gray-500">Anda bisa mengetik atau memilih lebih dari satu skill.</small>
                    @error('soft_skills_requirement')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-medium">Hard Skill</label>
                    <input id="hard_skills_requirement" name="hard_skills_requirement"
                        placeholder="Ketik hard skill lalu enter" value='{{ old('hard_skills_requirement', '[]') }}'
                        class="w-full" x-init="initTagify('#hard_skills_requirement', hardSkillsOptions)">
                    <small class="text-gray-500">Anda bisa mengetik atau memilih lebih dari satu skill.</small>
                    @error('hard_skills_requirement')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block mb-1 font-medium">Upload File Pendukung</label>
                    <input type="file" name="supporting_documents[]" multiple
                        class="w-full px-2 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600 transition file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                    <small class="text-gray-500">Bisa upload lebih dari satu file (opsional).</small>
                    @error('supporting_documents.*')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- BUTTONS --}}
            <div class="flex justify-between items-center gap-4 mt-8">
                <a href="{{ route('hod.request_employee.index') }}" x-show="step === 1"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg font-semibold shadow-md transition-transform transform hover:scale-105">Batal</a>
                <button type="button" @click="step--" x-show="step > 1"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg font-semibold shadow-md transition-transform transform hover:scale-105">Kembali</button>
                <div class="flex-grow"></div>
                <button type="button" @click="step++" x-show="step < 4"
                    class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-lg font-semibold shadow-md transition-transform transform hover:scale-105">Lanjut</button>
                <button type="button" @click="$refs.createForm.submit()" x-show="step === 4"
                    class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-lg font-semibold shadow-md transition-transform transform hover:scale-105">Kirim
                    Permintaan</button>
            </div>
        </form>
    </div>
@endsection
