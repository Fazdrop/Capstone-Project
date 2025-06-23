@extends('layouts.app')

@section('title', 'Approval Request')

@section('content')
    <div class="max-w-5xl mx-auto mt-10 bg-white rounded-xl shadow-lg p-6 border border-gray-200">
        <h1 class="text-2xl font-bold text-green-900 mb-6 text-center">
            Daftar Permintaan Pending Approval
        </h1>

        @if (session('success'))
            <div
                class="mb-4 bg-green-50 border border-green-200 text-green-800 px-5 py-3 rounded-lg flex items-center gap-3">
                <i data-feather="check-circle" class="w-6 h-6 text-green-600"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg text-sm">
                <thead class="bg-green-800 text-white">
                    <tr>
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Nama Pemohon</th>
                        <th class="px-4 py-2 border">Departemen</th>
                        <th class="px-4 py-2 border">Jumlah</th>
                        <th class="px-4 py-2 border">Jabatan</th>
                        <th class="px-4 py-2 border">Alasan</th>
                        <th class="px-4 py-2 border text-center">Catatan & Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $req)
                        <tr class="border-t hover:bg-green-50 transition">
                            <td class="px-4 py-2 text-center">{{ $req->id }}</td>
                            <td class="px-4 py-2">{{ $req->requester_name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $req->department ?? '-' }}</td>
                            <td class="px-4 py-2 text-center">{{ $req->quantity ?? ($req->jumlah ?? 1) }}</td>
                            <td class="px-4 py-2">{{ $req->position ?? ($req->jabatan ?? '-') }}</td>
                            <td class="px-4 py-2">{{ $req->reason ?? ($req->alasan ?? '-') }}</td>
                            <td class="px-4 py-2 w-80 min-w-[220px]">
                                <form action="" method="POST">
                                    @csrf
                                    {{-- Textarea remains --}}
                                    <textarea name="note" class="w-full border rounded p-2 text-sm resize-none mb-2" rows="2" required
                                        placeholder="Catatan (wajib diisi)"></textarea>
                                    {{-- Buttons are now side-by-side below the textarea --}}
                                    <div class="flex justify-end gap-2"> {{-- Added a div to contain and align buttons --}}
                                        <button formaction="{{ route('manager.approve_request.approve', $req->id) }}"
                                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition text-sm font-semibold shadow-sm"
                                            type="submit">
                                            Approve
                                        </button>
                                        <button formaction="{{ route('manager.approve_request.reject', $req->id) }}"
                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded transition text-sm font-semibold shadow-sm"
                                            type="submit">
                                            Reject
                                        </button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 py-4">Tidak ada permintaan yang menunggu
                                approval.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
