@extends('layouts.app')

@section('title', 'Detail Pelamar')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 px-4">
        <div class="mb-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-indigo-800 flex items-center gap-2">
                <i data-feather="user" class="w-6 h-6"></i>
                Detail Pelamar
            </h1>
            <a href="{{ route('staff.applicants.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-medium text-sm transition flex items-center gap-2">
                <i data-feather="arrow-left" class="w-4 h-4"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="md:col-span-2">
                    <h2 class="text-xl font-bold text-gray-800 mb-1">{{ $applicant->full_name }}</h2>
                    <p class="text-gray-600 text-sm">{{ $applicant->applied_position }} -
                        {{ $applicant->jobVacancy->title ?? 'N/A' }}</p>
                    <div class="flex items-center text-sm text-gray-500 mt-2">
                        <i data-feather="mail" class="w-4 h-4 mr-1"></i> {{ $applicant->personal_email }}
                    </div>
                    <div class="flex items-center text-sm text-gray-500 mt-1">
                        <i data-feather="phone" class="w-4 h-4 mr-1"></i> {{ $applicant->mobile_phone ?? '-' }}
                    </div>
                    <div class="flex items-center text-sm text-gray-500 mt-1">
                        <i data-feather="map-pin" class="w-4 h-4 mr-1"></i>
                        {{ $applicant->current_address ?? ($applicant->ktp_address ?? '-') }}
                    </div>
                </div>
                <div class="text-right">
                    @if ($applicant->photo)
                        <img src="{{ asset('storage/' . $applicant->photo) }}" alt="{{ $applicant->full_name }}"
                            class="w-32 h-32 object-cover rounded-lg inline-block">
                    @else
                        <div class="w-32 h-32 bg-gray-200 rounded-lg inline-flex items-center justify-center text-gray-500">
                            <i data-feather="user" class="w-12 h-12"></i>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2">Informasi Pribadi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <div>
                        <p class="text-gray-600 text-sm">Tempat, Tanggal Lahir</p>
                        <p class="font-medium">
                            {{ $applicant->birth_place ?? '-' }},
                            {{ $applicant->birth_date ? \Carbon\Carbon::parse($applicant->birth_date)->format('d M Y') : '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Jenis Kelamin</p>
                        <p class="font-medium">
                            {{ $applicant->gender === 'M' ? 'Laki-laki' : ($applicant->gender === 'F' ? 'Perempuan' : '-') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Status Pernikahan</p>
                        <p class="font-medium">{{ $applicant->marital_status ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Agama</p>
                        <p class="font-medium">{{ $applicant->religion ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Kebangsaan</p>
                        <p class="font-medium">{{ $applicant->nationality ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">NIK</p>
                        <p class="font-medium">{{ $applicant->national_id ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2">Pendidikan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <div>
                        <p class="text-gray-600 text-sm">Pendidikan Terakhir</p>
                        <p class="font-medium">{{ $applicant->last_education ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Institusi</p>
                        <p class="font-medium">{{ $applicant->institution_name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Jurusan</p>
                        <p class="font-medium">{{ $applicant->major ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Tahun</p>
                        <p class="font-medium">
                            {{ $applicant->entry_year ?? '-' }} - {{ $applicant->graduation_year ?? 'Sekarang' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">IPK</p>
                        <p class="font-medium">{{ $applicant->gpa ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2">Pengalaman Kerja</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <div>
                        <p class="text-gray-600 text-sm">Perusahaan</p>
                        <p class="font-medium">{{ $applicant->company_name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Posisi</p>
                        <p class="font-medium">{{ $applicant->position ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Periode</p>
                        <p class="font-medium">{{ $applicant->work_period ?? '-' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-gray-600 text-sm">Deskripsi Pekerjaan</p>
                        <p class="font-medium">{{ $applicant->job_description ?? '-' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-gray-600 text-sm">Alasan Resign</p>
                        <p class="font-medium">{{ $applicant->reason_for_leaving ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2">Skills</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <div>
                        <p class="text-gray-600 text-sm">Technical Skills</p>
                        <p class="font-medium">{{ $applicant->technical_skills ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Non-Technical Skills</p>
                        <p class="font-medium">{{ $applicant->non_technical_skills ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2">Dokumen</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <div>
                        <p class="text-gray-600 text-sm">CV</p>
                        @if ($applicant->cv)
                            <a href="{{ asset('storage/' . $applicant->cv) }}" target="_blank"
                                class="inline-flex items-center text-indigo-600 hover:text-indigo-800">
                                <i data-feather="file-text" class="w-4 h-4 mr-1"></i>
                                Lihat CV
                            </a>
                        @else
                            <p class="text-gray-500">Tidak ada file</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2">Status Aplikasi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                    <div>
                        <p class="text-gray-600 text-sm">Status</p>
                        @php
                            $statusClasses = [
                                'new' => 'bg-blue-100 text-blue-800',
                                'review' => 'bg-yellow-100 text-yellow-800',
                                'interview' => 'bg-purple-100 text-purple-800',
                                'passed' => 'bg-green-100 text-green-800',
                                'rejected' => 'bg-red-100 text-red-800',
                                '' => 'bg-gray-100 text-gray-800',
                            ];
                            $statusText = [
                                'new' => 'Baru',
                                'review' => 'Dalam Review',
                                'interview' => 'Interview',
                                'passed' => 'Lolos',
                                'rejected' => 'Ditolak',
                                '' => 'Belum Diproses',
                            ];
                            $currentStatus = $applicant->status ?? '';
                        @endphp
                        <span
                            class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $statusClasses[$currentStatus] ?? $statusClasses[''] }}">
                            {{ $statusText[$currentStatus] ?? 'Belum Diproses' }}
                        </span>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Tanggal Aplikasi</p>
                        <p class="font-medium">
                            {{ \Carbon\Carbon::parse($applicant->application_date)->format('d M Y') }}
                        </p>
                    </div>
                    @if ($applicant->status === 'interview')
                        <div>
                            <p class="text-gray-600 text-sm">Jadwal Interview</p>
                            <p class="font-medium">
                                {{ $applicant->interview_date ? \Carbon\Carbon::parse($applicant->interview_date)->format('d M Y') : '-' }}
                                {{ $applicant->interview_time ?? '' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Lokasi/Link</p>
                            @if ($applicant->interview_link)
                                <a href="{{ $applicant->interview_link }}" target="_blank"
                                    class="inline-flex items-center text-indigo-600 hover:text-indigo-800">
                                    <i data-feather="video" class="w-4 h-4 mr-1"></i>
                                    Link Meeting
                                </a>
                            @else
                                <p class="font-medium">{{ $applicant->interview_location ?? '-' }}</p>
                            @endif
                        </div>
                    @endif
                    <div class="md:col-span-2">
                        <p class="text-gray-600 text-sm">Catatan</p>
                        <p class="font-medium">{{ $applicant->additional_notes ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-10 border-t pt-6 flex justify-between">
                <a href="{{ route('staff.applicants.edit', $applicant) }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium transition">
                    <i data-feather="edit-2" class="w-4 h-4 inline-block mr-1"></i>
                    Edit & Proses Pelamar
                </a>
            </div>
        </div>
    </div>
@endsection
