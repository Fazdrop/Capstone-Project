@extends('layouts.app')

@section('title', 'Daftar Division')
@section('menu-info', 'List Divisi')

@section('content')
<div class="w-full max-w-5xl mx-auto mt-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-indigo-700 flex items-center gap-3">
            <i data-feather="users" class="w-7 h-7"></i>
            Daftar Divisi
            <span class="ml-2 px-2 py-1 bg-indigo-100 text-indigo-700 rounded text-xs font-semibold">
                {{ $divisions->count() }} divisi
            </span>
        </h1>
        <a href="{{ route('admin.divisions.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 flex items-center gap-2 transition">
            <i data-feather="plus-circle" class="w-5 h-5"></i>
            Tambah Divisi
        </a>
    </div>

    @if(session('success'))
        <div class="flash-message mb-4 text-green-700 bg-green-100 rounded px-4 py-2 border border-green-200 shadow-sm flex items-center gap-2">
            <i data-feather="check-circle" class="w-5 h-5"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow overflow-hidden max-w-5xl mx-auto">
        <table class="w-full border border-gray-200 divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-4 text-left font-semibold text-gray-700 w-10">#</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-700">Nama Divisi</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-700 min-w-[130px] w-44">Dibuat</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-700 w-36">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($divisions as $division)
                    <tr class="hover:bg-indigo-50 transition">
                        <td class="py-2 px-4 border-t">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4 border-t font-medium text-gray-800">{{ $division->name }}</td>
                        <td class="py-2 px-4 border-t text-gray-600 min-w-[130px] w-44 whitespace-nowrap">
                            {{ $division->created_at->format('d M Y') }}
                        </td>
                        <td class="py-2 px-4 border-t">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.divisions.edit', $division->id) }}"
                                   class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded shadow transition flex items-center gap-1">
                                    <i data-feather="edit-3" class="w-4 h-4"></i>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.divisions.destroy', $division->id) }}"
                                      onsubmit="return confirm('Yakin ingin menghapus divisi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded shadow transition flex items-center gap-1">
                                        <i data-feather="trash-2" class="w-4 h-4"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-500">Belum ada divisi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
