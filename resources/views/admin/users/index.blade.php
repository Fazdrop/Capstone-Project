@extends('layouts.app')

@section('title', 'Daftar User')
@section('menu-info', 'List User')

@section('content')
    <div class="w-full max-w-6xl mx-auto mt-10 px-4"> {{-- Increased max-width and added horizontal padding --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold text-indigo-800 flex items-center gap-3">
                <i data-feather="users" class="w-8 h-8"></i>
                Daftar User
                <span class="ml-2 px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm font-semibold tracking-wide">
                    {{ $users->count() }} user
                </span>
            </h1>
            <a href="{{ route('admin.users.create') }}"
                class="inline-flex items-center px-5 py-2 bg-indigo-700 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-800 transition duration-300 ease-in-out gap-2">
                <i data-feather="plus-circle" class="w-5 h-5"></i>
                Tambah User Baru
            </a>
        </div>

        {{-- Flash Message --}}
        @if (session('success'))
            <div
                class="mb-6 bg-green-50 border border-green-200 text-green-800 px-5 py-3 rounded-lg shadow-sm flex items-center gap-3">
                <i data-feather="check-circle" class="w-6 h-6 text-green-600"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200"> {{-- Added a subtle border --}}
            <div class="overflow-x-auto"> {{-- Added for horizontal scrolling on small screens if needed --}}
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-12">
                                #</th>
                            <th scope="col"
                                class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nama</th>
                            <th scope="col"
                                class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Email</th>
                            <th scope="col"
                                class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Divisi</th>
                            <th scope="col"
                                class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Role</th>
                            <th scope="col"
                                class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider min-w-[140px]">
                                Dibuat</th>
                            <th scope="col"
                                class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider min-w-[160px]">
                                Terakhir Login</th>
                            <th scope="col"
                                class="py-3 px-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider w-40">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($users as $user)
                            <tr class="hover:bg-indigo-50 transition-colors duration-200">
                                <td class="py-3 px-5 whitespace-nowrap text-sm text-gray-700">{{ $loop->iteration }}</td>
                                <td class="py-3 px-5 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $user->name }}</td>
                                <td class="py-3 px-5 whitespace-nowrap text-sm text-gray-700">{{ $user->email }}</td>
                                <td class="py-3 px-5 whitespace-nowrap text-sm text-gray-700">
                                    {{ $user->division?->name ?? '-' }}</td>
                                <td class="py-3 px-5 whitespace-nowrap text-sm text-gray-700 capitalize">{{ $user->role }}
                                </td>
                                <td class="py-3 px-5 whitespace-nowrap text-sm">
                                    @if ($user->is_active)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="py-3 px-5 whitespace-nowrap text-sm text-gray-600">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td class="py-3 px-5 whitespace-nowrap text-sm text-gray-500">
                                     {{ $user->last_login_at ? \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() : '-' }}
                                </td>
                                <td class="py-3 px-5 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md shadow-sm transition duration-300 ease-in-out text-xs">
                                            <i data-feather="edit-3" class="w-4 h-4 mr-1"></i>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini? Tindakan ini tidak bisa dibatalkan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-md shadow-sm transition duration-300 ease-in-out text-xs">
                                                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-8 text-gray-500 text-lg">
                                    <i data-feather="info" class="w-6 h-6 inline-block mb-2 text-gray-400"></i>
                                    <p>Belum ada user terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
