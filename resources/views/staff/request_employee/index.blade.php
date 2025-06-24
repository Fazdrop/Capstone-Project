@extends('layouts.app')

@section('title', 'Permintaan Karyawan')
@section('menu-info', 'List Permintaan Karyawan')

@section('content')
    <div class="w-full max-w-6xl mx-auto mt-10 px-4">

        {{-- Flash Message --}}
        @if (session('success'))
            <div
                class="mb-6 bg-green-50 border border-green-200 text-green-800 px-5 py-3 rounded-lg shadow-sm flex items-center gap-3 flash-message">
                <i data-feather="check-circle" class="w-6 h-6 text-green-600"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Header Halaman --}}
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-green-800 flex items-center gap-2 sm:gap-3">
                <i data-feather="file-text" class="w-7 h-7 sm:w-8 sm:h-8"></i>
                Permintaan Karyawan
                <span
                    class="ml-2 px-2 py-1 sm:px-3 bg-green-100 text-green-700 rounded-full text-xs sm:text-sm font-semibold tracking-wide">
                    {{ $requests->count() }} data
                </span>
            </h1>
        </div>

        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-10">
                                #</th>
                            <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Pemohon</th>
                            <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Divisi</th>
                            <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Departemen</th>
                            <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Jabatan</th>
                            <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Jumlah</th>
                            <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Lokasi Kerja</th>
                            <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nomor FPK</th>
                            <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="py-3 px-5 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider w-40">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($requests as $req)
                            <tr class="hover:bg-green-50 transition-colors duration-200">
                                <td class="py-3 px-5 text-gray-700">{{ $loop->iteration }}</td>
                                <td class="py-3 px-5 text-gray-700">{{ $req->created_at->format('d M Y') }}</td>
                                <td class="py-3 px-5 text-gray-900 font-medium">{{ $req->requester_name ?? '-' }}</td>
                                <td class="py-3 px-5 text-gray-700 capitalize">{{ $req->division->name ?? '-' }}</td>
                                <td class="py-3 px-5 text-gray-700">{{ $req->department ?? '-' }}</td>
                                <td class="py-3 px-5 text-gray-700">{{ $req->position ?? '-' }}</td>
                                <td class="py-3 px-5 text-gray-700">{{ $req->jumlah ?? ($req->quantity ?? '-') }}</td>
                                <td class="py-3 px-5 text-gray-700">{{ $req->work_location ?? '-' }}</td>
                                <td class="py-3 px-5 text-gray-700">{{ $req->request_number ?? '-' }}</td>
                                <td class="py-3 px-5">
                                    @switch($req->workflow_status)
                                        @case('draft')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Draft</span>
                                        @break

                                        @case('submitted_by_user')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Menunggu
                                                Staff HR</span>
                                        @break

                                        @case('waiting_fpk')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Belum
                                                Diisi FPK</span>
                                        @break

                                        @case('fpk_created')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">FPK
                                                Dibuat</span>
                                        @break

                                        @case('waiting_manager_approval')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">Siap
                                                Approval</span>
                                        @break

                                        @case('approved')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-700 text-white">Approved</span>
                                        @break

                                        @case('rejected')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Rejected</span>
                                        @break

                                        @default
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-200 text-gray-700">-</span>
                                    @endswitch
                                </td>
                                <td class="py-3 px-5 whitespace-nowrap flex justify-end gap-2">
                                    {{-- Tombol Lihat --}}
                                    <a href="{{ route('staff.request_employee.show', $req->id) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-sm transition text-xs">
                                        <i data-feather="eye" class="w-4 h-4 mr-1"></i> Lihat
                                    </a>
                                    {{-- Tombol Buat/Ubah FPK --}}
                                    @if (in_array($req->workflow_status, ['draft', 'submitted_by_user', 'waiting_fpk']))
                                        <a href="{{ route('staff.request_employee.edit', $req->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg shadow-sm transition text-xs">
                                            <i data-feather="edit-3" class="w-4 h-4 mr-1"></i> FPK
                                        </a>
                                        {{-- Tombol Reject (opsional) --}}
                                        <form action="{{ route('staff.request_employee.reject', $req->id) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('Yakin ingin menolak permintaan ini?')">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-sm transition text-xs">
                                                <i data-feather="x-circle" class="w-4 h-4 mr-1"></i> Reject
                                            </button>
                                        </form>
                                    @endif
                                    {{-- Tombol Ajukan Approval --}}
                                    @if ($req->workflow_status === 'fpk_created')
                                        <form action="{{ route('staff.request_employee.submitApproval', $req->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-sm transition text-xs">
                                                <i data-feather="send" class="w-4 h-4 mr-1"></i> Ajukan
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-8 text-gray-500 text-lg">
                                        <i data-feather="info" class="w-6 h-6 inline-block mb-2 text-gray-400"></i>
                                        <p>Tidak ada permintaan karyawan.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
