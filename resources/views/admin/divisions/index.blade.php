@extends('layouts.app')

@section('title', 'Daftar Division')
@section('menu-info', 'List Divisi')

@section('content')
{{-- PENTING! x-data di div utama untuk mengelola state modal Alpine.js --}}
<div class="w-full max-w-6xl mx-auto mt-10 px-4"
     x-data="{ showDeleteModal: false, deleteUrl: '' }">

    {{-- Memanggil partial modal konfirmasi hapus --}}
    @include('partials.modal.modal-delete', [
        'title' => 'Konfirmasi Hapus Divisi',
        'description' => 'Apakah Anda yakin ingin menghapus divisi ini? Tindakan ini tidak bisa dibatalkan.',
        'buttonLabel' => 'Hapus'
    ])

    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-indigo-800 flex items-center gap-3">
            <i data-feather="grid" class="w-7 h-7 sm:w-8 sm:h-8"></i> {{-- Icon changed to grid --}}
            Daftar Divisi
            <span class="ml-2 px-2 py-1 sm:px-3 bg-indigo-100 text-indigo-700 rounded-full text-xs sm:text-sm font-semibold tracking-wide">
                {{ $divisions->count() }} divisi
            </span>
        </h1>
        <a href="{{ route('admin.divisions.create') }}"
            class="w-full sm:w-auto inline-flex items-center justify-center sm:justify-start px-5 py-2.5 bg-indigo-700 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-800 transition duration-300 ease-in-out gap-2 text-sm sm:text-base">
            <i data-feather="plus-circle" class="w-5 h-5"></i>
            Tambah Divisi Baru
        </a>
    </div>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-5 py-3 rounded-lg shadow-sm flex items-center gap-3">
            <i data-feather="check-circle" class="w-6 h-6 text-green-600"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-12">#</th>
                        <th scope="col" class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Divisi</th>
                        <th scope="col" class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider min-w-[140px]">Dibuat</th>
                        {{-- Header kolom Aksi: teks rata kanan dengan padding yang disesuaikan --}}
                        <th scope="col" class="py-3 pr-5 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($divisions as $division)
                        <tr class="hover:bg-indigo-50 transition-colors duration-200">
                            <td class="py-3 px-5 whitespace-nowrap text-sm text-gray-700">{{ $loop->iteration }}</td>
                            <td class="py-3 px-5 whitespace-nowrap text-sm font-medium text-gray-900 capitalize">{{ $division->name }}</td>
                            <td class="py-3 px-5 whitespace-nowrap text-sm text-gray-600">
                                {{ $division->created_at->format('d M Y') }}
                            </td>
                            {{-- Sel kolom Aksi: tombol rata kanan dengan padding yang presisi --}}
                            <td class="py-3 pr-5 pl-3 whitespace-nowrap text-sm flex justify-end gap-2">
                                <a href="{{ route('admin.divisions.edit', $division->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-yellow-400 hover:bg-yellow-500 text-white rounded-lg shadow-sm transition duration-300 ease-in-out text-xs">
                                    <i data-feather="edit" class="w-4 h-4 mr-1"></i> {{-- Menggunakan 'edit' untuk konsistensi --}}
                                    Edit
                                </a>
                                {{-- Tombol Hapus memicu modal Alpine.js --}}
                                <button type="button" @click="showDeleteModal = true; deleteUrl = '{{ route('admin.divisions.destroy', $division->id) }}'"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow-sm transition duration-300 ease-in-out text-xs">
                                    <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            {{-- colspan disesuaikan dengan jumlah kolom di tabel (4 kolom) --}}
                            <td colspan="4" class="text-center py-8 text-gray-500 text-lg">
                                <i data-feather="info" class="w-6 h-6 inline-block mb-2 text-gray-400"></i>
                                <p>Belum ada divisi terdaftar.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
