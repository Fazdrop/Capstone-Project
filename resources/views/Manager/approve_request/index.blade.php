@extends('layouts.app')

@section('title', 'Approval Request')

@section('content')
    <div class="max-w-5xl mx-auto mt-10 bg-white rounded-xl shadow-lg p-6 border border-gray-200">
        <h1 class="text-2xl font-bold text-indigo-700 mb-6 flex items-center gap-2">
            <i data-feather="clipboard"></i> Daftar Permintaan Pending Approval
        </h1>

        @if (session('success'))
            <div
                class="mb-4 bg-green-50 border border-green-200 text-green-800 px-5 py-3 rounded-lg flex items-center gap-3">
                <i data-feather="check-circle" class="w-6 h-6 text-green-600"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="overflow-x-auto shadow-md rounded-lg">
            <table class="min-w-full bg-white border-collapse">
                <thead>
                    <tr class="bg-indigo-700 text-white text-left">
                        <th class="py-3 px-4 font-medium text-sm">ID</th>
                        <th class="py-3 px-4 font-medium text-sm">Nama Pemohon</th>
                        <th class="py-3 px-4 font-medium text-sm">Departemen</th>
                        <th class="py-3 px-4 font-medium text-sm">Jumlah</th>
                        <th class="py-3 px-4 font-medium text-sm">Jabatan</th>
                        <th class="py-3 px-4 font-medium text-sm">Alasan</th>
                        <th class="py-3 px-4 font-medium text-sm text-center">Catatan & Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($requests as $req)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 text-sm">{{ $req->id }}</td>
                            <td class="py-3 px-4 text-sm">{{ $req->requester_name ?? '-' }}</td>
                            <td class="py-3 px-4 text-sm">{{ $req->department ?? '-' }}</td>
                            <td class="py-3 px-4 text-sm text-center">{{ $req->quantity ?? ($req->jumlah ?? 1) }}</td>
                            <td class="py-3 px-4 text-sm">{{ $req->position ?? ($req->jabatan ?? '-') }}</td>
                            <td class="py-3 px-4 text-sm">{{ $req->reason ?? ($req->alasan ?? '-') }}</td>
                            <td class="py-3 px-4 w-80 min-w-[220px]">
                                <form action="" method="POST">
                                    @csrf
                                    <textarea name="note" class="w-full border border-gray-300 rounded-md p-2 text-sm resize-none mb-2" rows="2"
                                        required placeholder="Catatan (wajib diisi)"></textarea>
                                    <div class="flex justify-end gap-2">
                                        <button formaction="{{ route('manager.approve_request.approve', $req->id) }}"
                                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded-md text-sm font-medium transition flex items-center gap-1"
                                            type="submit">
                                            <i data-feather="check" class="w-4 h-4"></i> Approve
                                        </button>
                                        <button formaction="{{ route('manager.approve_request.reject', $req->id) }}"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md text-sm font-medium transition flex items-center gap-1"
                                            type="submit">
                                            <i data-feather="x" class="w-4 h-4"></i> Reject
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500 text-sm">Tidak ada permintaan yang
                                menunggu approval.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
