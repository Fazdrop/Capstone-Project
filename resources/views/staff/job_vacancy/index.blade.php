{{-- filepath: resources/views/staff/job_vacancy/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Job Vacancy')

@section('content')
<div class="w-full max-w-6xl mx-auto mt-10 px-4"
     x-data="{ showDeleteModal: false, deleteUrl: '' }">

    {{-- Modal konfirmasi hapus --}}
    @include('partials.modal.modal-delete', [
        'title' => 'Konfirmasi Hapus Lowongan',
        'description' => 'Apakah Anda yakin ingin menghapus lowongan ini? Tindakan ini tidak bisa dibatalkan.',
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
        <h1 class="text-2xl sm:text-3xl font-extrabold text-green-800 flex items-center gap-2 sm:gap-3">
            <i data-feather="briefcase" class="w-7 h-7 sm:w-8 sm:h-8"></i>
            Daftar Job Vacancy
            <span class="ml-2 px-2 py-1 sm:px-3 bg-green-100 text-green-700 rounded-full text-xs sm:text-sm font-semibold tracking-wide">
                {{ $jobs->count() }} lowongan
            </span>
        </h1>
        <a href="{{ route('staff.job_vacancy.create') }}"
            class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-green-700 hover:bg-green-800 text-white rounded-lg shadow font-semibold text-sm transition">
            <i data-feather="plus" class="w-4 h-4 mr-2"></i> Tambah Lowongan
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-12">#</th>
                        <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul</th>
                        <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Department</th>
                        <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Division</th>
                        <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Lokasi</th>
                        <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="py-3 pr-5 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($jobs as $job)
                        <tr class="hover:bg-green-50 transition-colors duration-200">
                            <td class="py-3 px-5 text-gray-700">{{ $loop->iteration }}</td>
                            <td class="py-3 px-5 text-gray-900 font-medium">{{ $job->title }}</td>
                            <td class="py-3 px-5 text-gray-700">{{ $job->department }}</td>
                            <td class="py-3 px-5 text-gray-700">{{ $job->division }}</td>
                            <td class="py-3 px-5 text-gray-700">{{ $job->location }}</td>
                            <td class="py-3 px-5">
                                @if ($job->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-200 text-gray-700">Nonaktif</span>
                                @endif
                            </td>
                            <td class="py-3 pr-5 pl-3 whitespace-nowrap flex justify-end gap-2">
                                <a href="{{ route('staff.job_vacancy.edit', $job->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-yellow-400 hover:bg-yellow-500 text-white rounded-lg shadow-sm transition text-xs"
                                    title="Edit">
                                    <i data-feather="edit" class="w-4 h-4 mr-1"></i> Edit
                                </a>
                                <button type="button"
                                    @click="showDeleteModal = true; deleteUrl = '{{ route('staff.job_vacancy.destroy', $job->id) }}'"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow-sm transition text-xs"
                                    title="Hapus">
                                    <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-8 text-gray-500 text-lg">
                                <i data-feather="info" class="w-6 h-6 inline-block mb-2 text-gray-400"></i>
                                <p>Tidak ada job vacancy.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
