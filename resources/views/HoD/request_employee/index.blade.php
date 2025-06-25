@extends('layouts.app')

@section('title', 'Status Permintaan Karyawan')
@section('menu-info', 'Status Permintaan Karyawan')

@section('content')
    <div class="w-full max-w-6xl mx-auto mt-10 px-4">
        {{-- Header Halaman --}}
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-green-800 flex items-center gap-3">
                <i data-feather="users" class="w-7 h-7 sm:w-8 sm:h-8"></i>
                Status Permintaan Karyawan
            </h1>
            <a href="{{ route('hod.request_employee.create') }}"
                class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 sm:px-5 bg-green-700 text-white font-semibold rounded-lg shadow-md hover:bg-green-800 transition gap-2 text-sm sm:text-base">
                <i data-feather="plus-circle" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                Tambah Permintaan Baru
            </a>
        </div>

        {{-- Flash Message --}}
        @if (session('success'))
            <div
                class="flash-message mb-6 bg-green-50 border border-green-200 text-green-800 px-5 py-3 rounded-lg shadow-sm flex items-center gap-3">
                <i data-feather="check-circle" class="w-6 h-6 text-green-600"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Tabel --}}
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                #
                            </th>
                            <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nama Pemohon
                            </th>
                            <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Divisi
                            </th>
                            <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Jabatan
                            </th>
                            <th class="py-3 px-5 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Jumlah
                            </th>
                            <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Lokasi Kerja
                            </th>
                            <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Notes
                            </th>
                            <th
                                class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-40">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($requests as $req)
                            <tr class="hover:bg-green-50 transition-colors duration-200">
                                {{-- Kolom nomor urut --}}
                                <td class="py-3 px-5 text-sm text-gray-700">{{ $loop->iteration }}</td>
                                <td class="py-3 px-5 text-sm text-gray-700 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($req->request_date)->format('d-m-Y') }}
                                </td>
                                <td class="py-3 px-5 text-sm font-medium text-gray-900">
                                    {{ $req->requester_name }}
                                </td>
                                <td class="py-3 px-5 text-sm text-gray-700">
                                    {{ $req->division->name ?? '-' }}
                                </td>
                                <td class="py-3 px-5 text-sm text-gray-700">
                                    {{ $req->position }}
                                </td>
                                <td class="py-3 px-5 text-center text-sm text-gray-700">
                                    {{ $req->quantity }}
                                </td>
                                <td class="py-3 px-5 text-sm text-gray-700">
                                    {{ $req->work_location }}
                                </td>
                                <td class="py-3 px-5 text-sm font-semibold">
                                    {{-- Badge Status Workflow --}}
                                    @php
                                        $status = strtolower($req->workflow_status);
                                        $statusMap = [
                                            'submitted_by_user' => ['Menunggu Staff HR', 'text-gray-700'],
                                            'waiting_fpk' => ['Menunggu FPK Staff HR', 'text-blue-700'],
                                            'fpk_created' => ['FPK Dibuat', 'text-green-700'],
                                            'waiting_manager_approval' => [
                                                'Menunggu Approval Manager HR',
                                                'text-indigo-700',
                                            ],
                                            'approved' => ['Disetujui', 'text-green-700'],
                                            'rejected' => ['Ditolak', 'text-red-600'],
                                            'draft' => ['Draft', 'text-yellow-700'],
                                            'revisi' => ['Revisi', 'text-yellow-700'],
                                        ];
                                    @endphp
                                    @if (isset($statusMap[$status]))
                                        <span class="{{ $statusMap[$status][1] }}">{{ $statusMap[$status][0] }}</span>
                                    @else
                                        <span class="text-gray-700">{{ ucfirst($req->workflow_status) }}</span>
                                    @endif
                                </td>
                                <td class="py-3 px-5 text-sm text-gray-700">
                                    @if ($req->notes)
                                        {{ $req->notes }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="py-3 px-5 text-sm font-medium">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('hod.request_employee.show', $req->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white rounded-md shadow-sm transition text-xs">
                                            <i data-feather="eye" class="w-4 h-4 mr-1"></i>Lihat
                                        </a>
                                        @php
                                            // Boleh edit jika status: draft, submitted_by_user, rejected, revisi
                                            $canEdit = in_array($status, [
                                                'draft',
                                                'submitted_by_user',
                                                'rejected',
                                                'revisi',
                                            ]);
                                        @endphp
                                        @if ($canEdit)
                                            <a href="{{ route('hod.request_employee.edit', $req->id) }}"
                                                class="inline-flex items-center px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md shadow-sm transition text-xs">
                                                <i data-feather="edit-3" class="w-4 h-4 mr-1"></i>Edit
                                            </a>
                                            <form action="{{ route('hod.request_employee.destroy', $req->id) }}"
                                                method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-md shadow-sm transition text-xs">
                                                    <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-8 text-gray-500 text-lg">
                                    <i data-feather="info" class="w-6 h-6 inline-block mb-2 text-gray-400"></i>
                                    <p>Belum ada permintaan karyawan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
