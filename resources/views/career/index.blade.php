@extends('layouts.public')

@section('title', 'Karir - PT Graha Buana Cikarang')

@section('content')
    <div class="container mx-auto px-4 py-12 md:py-16">
        <!-- Header Section -->
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold text-green-800 tracking-tight leading-tight mb-4">
                Bergabunglah dengan Kami
            </h2>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto">
                Wujudkan potensi Anda bersama PT Graha Buana. Temukan peluang karir yang sesuai dengan keahlian Anda.
            </p>
        </div>

        <!-- Filter dan Pencarian -->
        <div class="max-w-4xl mx-auto mb-10 bg-white rounded-xl shadow-md p-6 border border-gray-100">
            <div class="mb-4 flex items-center text-gray-700">
                <i data-feather="filter" class="mr-2 h-5 w-5 text-green-600"></i>
                <h3 class="font-semibold">Filter Lowongan</h3>
            </div>

            <form action="{{ route('career.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-1">
                    <label for="department" class="block text-sm font-medium text-gray-700 mb-1">Departemen</label>
                    <div class="relative">
                        <select id="department" name="department"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 pl-10">
                            <option value="">Semua Departemen</option>
                            @foreach ($departments ?? [] as $dept)
                                <option value="{{ $dept->id }}"
                                    {{ request('department') == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-feather="briefcase" class="h-4 w-4 text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-1">
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                    <div class="relative">
                        <select id="location" name="location"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 pl-10">
                            <option value="">Semua Lokasi</option>
                            @foreach ($locations ?? [] as $location)
                                <option value="{{ $location }}"
                                    {{ request('location') == $location ? 'selected' : '' }}>
                                    {{ $location }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-feather="map-pin" class="h-4 w-4 text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-1">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Kata Kunci</label>
                    <div class="relative">
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            placeholder="Cari posisi..."
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 pl-10">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-feather="search" class="h-4 w-4 text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-3 flex justify-end space-x-3 mt-3 pt-3 border-t border-gray-100">
                    @if (request()->anyFilled(['department', 'location', 'search']))
                        <a href="{{ route('career.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition">
                            <i data-feather="x" class="h-4 w-4 mr-1"></i>
                            Reset
                        </a>
                    @endif
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-sm transition">
                        <i data-feather="filter" class="h-4 w-4 mr-2"></i>
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Hasil jumlah pencarian -->
        @if (request()->anyFilled(['department', 'location', 'search']))
            <div class="text-center mb-8 bg-green-50 rounded-lg p-3 max-w-xl mx-auto">
                <p class="text-gray-700 flex items-center justify-center">
                    <i data-feather="info" class="h-4 w-4 text-green-600 mr-2"></i>
                    Menampilkan {{ $jobs->count() }} lowongan
                    @if (request('search'))
                        untuk "<span class="font-semibold">{{ request('search') }}</span>"
                    @endif
                </p>
            </div>
        @endif

        <!-- Daftar Lowongan -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse ($jobs as $job)
                <div
                    class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 transform transition-all duration-300 hover:scale-105 hover:shadow-xl flex flex-col justify-between h-full">
                    <div>
                        <div class="flex justify-between items-start mb-3 pb-3 border-b border-gray-100">
                            <h3 class="text-xl font-bold text-green-700 leading-snug">{{ $job->title }}</h3>

                            @if ($job->employment_type)
                                <span
                                    class="ml-2 px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full font-medium whitespace-nowrap">
                                    {{ $job->employment_type }}
                                </span>
                            @endif
                        </div>

                        <div class="space-y-2 mb-4">
                            <p class="text-gray-500 text-sm flex items-center">
                                <i data-feather="map-pin" class="w-4 h-4 mr-1 text-gray-400"></i>
                                {{ $job->location }}
                            </p>
                            <p class="text-gray-500 text-sm flex items-center">
                                <i data-feather="briefcase" class="w-4 h-4 mr-1 text-gray-400"></i>
                                {{ $job->department ?? 'Umum' }}
                            </p>
                            <p class="text-gray-500 text-sm flex items-center">
                                <i data-feather="clock" class="w-4 h-4 mr-1 text-gray-400"></i>
                                Dibuka: {{ \Carbon\Carbon::parse($job->created_at)->format('d M Y') }}
                            </p>
                            @if ($job->deadline)
                                <p class="text-gray-500 text-sm flex items-center">
                                    <i data-feather="calendar" class="w-4 h-4 mr-1 text-gray-400"></i>
                                    Deadline: {{ \Carbon\Carbon::parse($job->deadline)->format('d M Y') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('career.show', $job->id) }}"
                        class="mt-4 w-full inline-flex items-center justify-center px-5 py-2.5 bg-green-600 text-white font-semibold rounded-full hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-75 transition duration-200 ease-in-out">
                        Lihat Detail
                        <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                    </a>
                </div>
            @empty
                <div class="col-span-full bg-white p-8 rounded-2xl shadow-lg text-center">
                    <i data-feather="briefcase" class="w-12 h-12 mx-auto mb-4 text-gray-300"></i>
                    <p class="text-gray-600 text-lg">Saat ini belum ada lowongan pekerjaan yang tersedia.</p>
                    @if (request()->anyFilled(['department', 'location', 'search']))
                        <p class="text-gray-500 mt-2">Coba ubah filter pencarian Anda.</p>
                        <a href="{{ route('career.index') }}"
                            class="mt-4 inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                            <i data-feather="refresh-cw" class="w-4 h-4 mr-1"></i>
                            Tampilkan semua lowongan
                        </a>
                    @else
                        <p class="text-gray-500 mt-2">Silakan cek kembali nanti!</p>
                    @endif
                </div>
            @endforelse
        </div>
    </div>
@endsection
