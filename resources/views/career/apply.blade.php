{{-- filepath: resources/views/career/apply.blade.php --}}
@extends('layouts.public')

@section('title', 'Apply for ' . $job->title)

@section('content')
    <div class="max-w-4xl mx-auto px-4 lg:px-24 py-10">
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
            <h2 class="text-2xl font-bold text-green-800 mb-6">Apply for: {{ $job->title }}</h2>
            <form action="{{ route('career.submit', $job->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Full Name & Nickname --}}
                <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Nama Lengkap *</label>
                        <input type="text" name="full_name" class="w-full border rounded px-3 py-2" required
                            value="{{ old('full_name') }}">
                        @error('full_name')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Nama Panggilan</label>
                        <input type="text" name="nickname" class="w-full border rounded px-3 py-2"
                            value="{{ old('nickname') }}">
                    </div>
                </div>

                {{-- Tempat/Tgl Lahir, Gender, Status --}}
                <div class="mb-4 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-2">
                        <label class="block font-semibold mb-1">Tempat Lahir</label>
                        <input type="text" name="birth_place" class="w-full border rounded px-3 py-2"
                            value="{{ old('birth_place') }}">
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Tanggal Lahir</label>
                        <input type="date" name="birth_date" class="w-full border rounded px-3 py-2"
                            value="{{ old('birth_date') }}">
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Jenis Kelamin</label>
                        <select name="gender" class="w-full border rounded px-3 py-2">
                            <option value="">Pilih</option>
                            <option value="M" @selected(old('gender') === 'M')>Laki-laki</option>
                            <option value="F" @selected(old('gender') === 'F')>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Status Pernikahan</label>
                        <input type="text" name="marital_status" class="w-full border rounded px-3 py-2"
                            value="{{ old('marital_status') }}">
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">NIK (KTP) *</label>
                        <input type="text" name="national_id" class="w-full border rounded px-3 py-2" required
                            value="{{ old('national_id') }}">
                        @error('national_id')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Alamat --}}
                <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Alamat KTP</label>
                        <textarea name="ktp_address" class="w-full border rounded px-3 py-2" rows="2">{{ old('ktp_address') }}</textarea>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Alamat Sekarang</label>
                        <textarea name="current_address" class="w-full border rounded px-3 py-2" rows="2">{{ old('current_address') }}</textarea>
                    </div>
                </div>

                {{-- Kontak Darurat --}}
                <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Kontak Darurat 1</label>
                        <input type="text" name="emergency_contact_1" class="w-full border rounded px-3 py-2"
                            value="{{ old('emergency_contact_1') }}">
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Kontak Darurat 2</label>
                        <input type="text" name="emergency_contact_2" class="w-full border rounded px-3 py-2"
                            value="{{ old('emergency_contact_2') }}">
                    </div>
                </div>

                {{-- Agama, Kewarganegaraan, Golongan Darah, NPWP --}}
                <div class="mb-4 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Agama</label>
                        <input type="text" name="religion" class="w-full border rounded px-3 py-2"
                            value="{{ old('religion') }}">
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Kewarganegaraan</label>
                        <input type="text" name="nationality" class="w-full border rounded px-3 py-2"
                            value="{{ old('nationality') }}">
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Golongan Darah</label>
                        <input type="text" name="blood_type" class="w-full border rounded px-3 py-2"
                            value="{{ old('blood_type') }}">
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">NPWP</label>
                        <input type="text" name="tax_id" class="w-full border rounded px-3 py-2"
                            value="{{ old('tax_id') }}">
                    </div>
                </div>

                {{-- Email & Telepon --}}
                <div class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Email Pribadi *</label>
                        <input type="email" name="personal_email" class="w-full border rounded px-3 py-2" required
                            value="{{ old('personal_email') }}">
                        @error('personal_email')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Telepon Rumah</label>
                        <input type="text" name="home_phone" class="w-full border rounded px-3 py-2"
                            value="{{ old('home_phone') }}">
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Telepon Seluler</label>
                        <input type="text" name="mobile_phone" class="w-full border rounded px-3 py-2"
                            value="{{ old('mobile_phone') }}">
                    </div>
                </div>

                {{-- Pendidikan --}}
                <div class="mb-4 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Pendidikan Terakhir</label>
                        <input type="text" name="last_education" class="w-full border rounded px-3 py-2"
                            value="{{ old('last_education') }}">
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Nama Institusi</label>
                        <input type="text" name="institution_name" class="w-full border rounded px-3 py-2"
                            value="{{ old('institution_name') }}">
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Jurusan</label>
                        <input type="text" name="major" class="w-full border rounded px-3 py-2"
                            value="{{ old('major') }}">
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">IPK</label>
                        <input type="text" name="gpa" class="w-full border rounded px-3 py-2"
                            value="{{ old('gpa') }}">
                    </div>
                </div>
                <div class="mb-4 grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Tahun Masuk</label>
                        <input type="text" name="entry_year" maxlength="4" class="w-full border rounded px-3 py-2"
                            value="{{ old('entry_year') }}">
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Tahun Lulus</label>
                        <input type="text" name="graduation_year" maxlength="4"
                            class="w-full border rounded px-3 py-2" value="{{ old('graduation_year') }}">
                    </div>
                </div>

                {{-- Pengalaman Kerja --}}
                <div class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Nama Perusahaan Terakhir</label>
                        <input type="text" name="company_name" class="w-full border rounded px-3 py-2"
                            value="{{ old('company_name') }}">
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Posisi</label>
                        <input type="text" name="position" class="w-full border rounded px-3 py-2"
                            value="{{ old('position') }}">
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Periode Kerja</label>
                        <input type="text" name="work_period" class="w-full border rounded px-3 py-2"
                            value="{{ old('work_period') }}">
                    </div>
                </div>
                <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Deskripsi Pekerjaan</label>
                        <textarea name="job_description" class="w-full border rounded px-3 py-2" rows="2">{{ old('job_description') }}</textarea>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Alasan Berhenti</label>
                        <textarea name="reason_for_leaving" class="w-full border rounded px-3 py-2" rows="2">{{ old('reason_for_leaving') }}</textarea>
                    </div>
                </div>

                {{-- Skills --}}
                <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Keterampilan Teknis</label>
                        <textarea name="technical_skills" class="w-full border rounded px-3 py-2" rows="2">{{ old('technical_skills') }}</textarea>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Keterampilan Non Teknis</label>
                        <textarea name="non_technical_skills" class="w-full border rounded px-3 py-2" rows="2">{{ old('non_technical_skills') }}</textarea>
                    </div>
                </div>

                {{-- Gaji --}}
                <div class="mb-4" x-data="{ salary: '{{ old('expected_salary') }}' }">
                    <label class="block font-semibold mb-1">Gaji Diharapkan</label>
                    <input type="text" name="expected_salary" class="w-full border rounded px-3 py-2"
                        x-model="salary"
                        x-on:input="salary = salary.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.')"
                        autocomplete="off">
                </div>

                {{-- Referensi & Hobi --}}
                <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Referensi</label>
                        <textarea name="reference" class="w-full border rounded px-3 py-2" rows="1">{{ old('reference') }}</textarea>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Hobi</label>
                        <textarea name="hobby" class="w-full border rounded px-3 py-2" rows="1">{{ old('hobby') }}</textarea>
                    </div>
                </div>

                {{-- Posisi Dilamar --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Posisi Dilamar</label>
                    <input type="text" name="applied_position"
                        class="w-full border rounded px-3 py-2 bg-gray-100 cursor-not-allowed"
                        value="{{ old('applied_position', $job->title) }}" readonly>
                </div>

                {{-- CV (PDF) --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">CV (PDF)</label>
                    <input type="file" name="cv" accept="application/pdf"
                        class="w-full border rounded px-3 py-2">
                    @error('cv')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Photo (JPG/PNG) --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Foto (JPG/PNG)</label>
                    <input type="file" name="photo" accept="image/*" class="w-full border rounded px-3 py-2">
                    @error('photo')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-end gap-2 mt-8">
                    <a href="{{ route('career.show', $job->id) }}"
                        class="px-5 py-2 rounded-2xl bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold shadow transition border border-gray-300">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-800 transition font-semibold shadow">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
