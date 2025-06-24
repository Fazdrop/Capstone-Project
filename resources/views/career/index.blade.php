@extends('layouts.public')

@section('title', 'Karir - PT Graha Buana Cikarang')

@section('content')
    <div class="container mx-auto px-4 py-12 md:py-16">
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold text-green-800 tracking-tight leading-tight mb-4">
                Bergabunglah dengan Kami
            </h2>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto">
                Wujudkan potensi Anda bersama PT Graha Buana. Temukan peluang karir yang sesuai dengan keahlian Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse ($jobs as $job)
                <div
                    class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 transform transition-all duration-300 hover:scale-105 hover:shadow-xl flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-green-700 mb-2 leading-snug">{{ $job->title }}</h3>
                        <p class="text-gray-500 text-sm mb-4 flex items-center">
                            <i data-feather="map-pin" class="w-4 h-4 mr-1 text-gray-400"></i>
                            {{ $job->location }}
                        </p>
                        {{-- Contoh: Tambahkan deskripsi singkat jika ada di model $job --}}
                        {{-- <p class="text-gray-700 text-base mb-4 line-clamp-3">{{ $job->short_description ?? 'Lihat detail untuk informasi lebih lanjut.' }}</p> --}}
                    </div>
                    <a href="{{ route('career.show', $job->id) }}"
                        class="mt-4 w-full inline-flex items-center justify-center px-5 py-2.5 bg-green-600 text-white font-semibold rounded-full hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-75 transition duration-200 ease-in-out">
                        Lihat Detail
                        <i data-feather="arrow-right" class="ml-2 w-4 h-4"></i>
                    </a>
                </div>
            @empty
                <div class="col-span-full bg-white p-8 rounded-2xl shadow-lg text-center">
                    <p class="text-gray-600 text-lg">Saat ini belum ada lowongan pekerjaan yang tersedia. Silakan cek
                        kembali nanti!</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
