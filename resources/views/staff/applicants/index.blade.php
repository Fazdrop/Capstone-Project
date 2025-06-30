@extends('layouts.app')

@section('title', 'Daftar Pelamar')

@section('content')
    <div class="w-full max-w-6xl mx-auto mt-10 px-4"
         x-data="{ showDeleteModal: false, deleteUrl: '', showDetailModal: false, detailId: null }">

        {{-- Modal Konfirmasi Hapus --}}
        @include('partials.modal.modal-delete', [
            'title' => 'Hapus Data Pelamar',
            'description' => 'Apakah Anda yakin ingin menghapus data pelamar ini? Tindakan ini tidak dapat dibatalkan.',
            'buttonLabel' => 'Hapus'
        ])

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-5 py-3 rounded-lg shadow-sm flex items-center gap-3 flash-message">
                <i data-feather="check-circle" class="w-6 h-6 text-green-600"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-indigo-800 flex items-center gap-2 sm:gap-3">
                <i data-feather="users" class="w-7 h-7 sm:w-8 sm:h-8"></i>
                Daftar Pelamar
                <span class="ml-2 px-2 py-1 sm:px-3 bg-indigo-100 text-indigo-700 rounded-full text-xs sm:text-sm font-semibold tracking-wide">
                    {{ $applicants->count() }} pelamar
                </span>
            </h1>

            <div class="flex gap-2 sm:gap-3">
                <a href="{{ route('staff.applicants.export') }}"
                    class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-sm text-sm font-medium transition">
                    <i data-feather="download" class="w-4 h-4 mr-2"></i> Export
                </a>
                <a href="{{ route('career.index') }}" target="_blank"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-sm text-sm font-medium transition">
                    <i data-feather="external-link" class="w-4 h-4 mr-2"></i> Lihat Lowongan
                </a>
            </div>
        </div>

        {{-- Filter --}}
        <div class="mb-6 bg-white p-4 rounded-lg shadow border border-gray-200">
            <form action="{{ route('staff.applicants.index') }}" method="GET" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label for="job_filter" class="block text-xs font-medium text-gray-700 mb-1">Lowongan</label>
                    <select id="job_filter" name="job" class="w-full border border-gray-300 rounded-md text-sm p-2">
                        <option value="">Semua Lowongan</option>
                        @foreach($jobs as $job)
                            <option value="{{ $job->id }}" {{ request('job') == $job->id ? 'selected' : '' }}>
                                {{ $job->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="status_filter" class="block text-xs font-medium text-gray-700 mb-1">Status</label>
                    <select id="status_filter" name="status" class="w-full border border-gray-300 rounded-md text-sm p-2">
                        <option value="">Semua Status</option>
                        <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>Baru</option>
                        <option value="review" {{ request('status') == 'review' ? 'selected' : '' }}>Dalam Review</option>
                        <option value="interview" {{ request('status') == 'interview' ? 'selected' : '' }}>Interview</option>
                        <option value="passed" {{ request('status') == 'passed' ? 'selected' : '' }}>Lolos</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="search" class="block text-xs font-medium text-gray-700 mb-1">Pencarian</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}"
                        placeholder="Nama atau email"
                        class="w-full border border-gray-300 rounded-md text-sm p-2">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                        <i data-feather="filter" class="w-4 h-4 inline-block -mt-1"></i> Filter
                    </button>
                </div>
            </form>
        </div>

        {{-- Tabel Applicants --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No.</th>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Posisi</th>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tgl Aplikasi</th>
                            <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="py-3 px-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider w-48">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($applicants as $applicant)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $applicant->full_name }}</div>
                                    @if($applicant->gender)
                                        <div class="text-xs text-gray-500">
                                            {{ $applicant->gender === 'M' ? 'Laki-laki' : 'Perempuan' }}
                                        </div>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-700">{{ $applicant->personal_email }}</td>
                                <td class="py-3 px-4">
                                    <div class="text-sm text-gray-900">{{ $applicant->applied_position }}</div>
                                    <div class="text-xs text-gray-500">{{ $applicant->jobVacancy->title ?? '-' }}</div>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-700">
                                    {{ \Carbon\Carbon::parse($applicant->application_date)->format('d M Y') }}
                                </td>
                                <td class="py-3 px-4">
                                    @php
                                        $statusClasses = [
                                            'new' => 'bg-blue-100 text-blue-800',
                                            'review' => 'bg-yellow-100 text-yellow-800',
                                            'interview' => 'bg-purple-100 text-purple-800',
                                            'passed' => 'bg-green-100 text-green-800',
                                            'rejected' => 'bg-red-100 text-red-800',
                                            '' => 'bg-gray-100 text-gray-800'
                                        ];
                                        $statusText = [
                                            'new' => 'Baru',
                                            'review' => 'Dalam Review',
                                            'interview' => 'Interview',
                                            'passed' => 'Lolos',
                                            'rejected' => 'Ditolak',
                                            '' => 'Belum Diproses'
                                        ];
                                        $currentStatus = $applicant->status ?? '';
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$currentStatus] ?? $statusClasses[''] }}">
                                        {{ $statusText[$currentStatus] ?? 'Belum Diproses' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-right text-sm font-medium">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('staff.applicants.show', $applicant) }}"
                                           class="bg-indigo-600 hover:bg-indigo-700 text-white px-2 py-1 rounded text-xs font-medium flex items-center gap-1">
                                            <i data-feather="eye" class="w-3 h-3"></i> Detail
                                        </a>
                                        <a href="{{ route('staff.applicants.edit', $applicant) }}"
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded text-xs font-medium flex items-center gap-1">
                                            <i data-feather="edit" class="w-3 h-3"></i> Proses
                                        </a>
                                        <button @click="showDeleteModal = true; deleteUrl = '{{ route('staff.applicants.destroy', $applicant) }}'"
                                                class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-xs font-medium flex items-center gap-1">
                                            <i data-feather="trash-2" class="w-3 h-3"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-8 text-gray-500 text-lg">
                                    <i data-feather="user-x" class="w-6 h-6 mx-auto mb-2 text-gray-400"></i>
                                    <p>Tidak ada data pelamar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $applicants->links() }}
        </div>
    </div>
@endsection
