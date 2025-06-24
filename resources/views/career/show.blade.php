@extends('layouts.public')

@section('title', $job->title . ' - Karir PT Graha Buana')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12 md:py-16">
    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 md:p-10 transform transition-all duration-300 hover:shadow-2xl">
        <h1 class="text-3xl md:text-4xl font-extrabold text-green-800 mb-6 border-b border-gray-200 pb-4 leading-tight">
            {{ $job->title }}
        </h1>

        <div class="mb-8 flex flex-wrap items-center gap-4 text-base">
            <span class="inline-flex items-center bg-blue-50 text-blue-700 px-4 py-2 rounded-full font-semibold shadow-sm">
                <i data-feather="briefcase" class="w-4 h-4 mr-2"></i> Departemen: {{ $job->department }}
            </span>
            <span class="inline-flex items-center bg-purple-50 text-purple-700 px-4 py-2 rounded-full font-semibold shadow-sm">
                <i data-feather="grid" class="w-4 h-4 mr-2"></i> Divisi: {{ $job->division }}
            </span>
            <span class="inline-flex items-center text-gray-600">
                <i data-feather="map-pin" class="w-5 h-5 mr-2 text-green-600"></i> {{ $job->location }}
            </span>

        </div>

        <div class="space-y-8">
            <div>
                <h3 class="text-2xl font-semibold text-gray-900 mb-4 border-l-4 border-green-600 pl-4">Deskripsi Pekerjaan</h3>
                <div class="text-gray-700 leading-relaxed bg-gray-50 p-6 rounded-xl prose max-w-none">
                    {!! nl2br(e($job->description)) !!}
                </div>
            </div>

            <div>
                <h3 class="text-2xl font-semibold text-gray-900 mb-4 border-l-4 border-green-600 pl-4">Persyaratan Kualifikasi</h3>
                <div class="text-gray-700 leading-relaxed bg-gray-50 p-6 rounded-xl prose max-w-none">
                    {!! nl2br(e($job->requirements)) !!}
                </div>
            </div>

            <div>
                <h3 class="text-2xl font-semibold text-gray-900 mb-4 border-l-4 border-green-600 pl-4">Batas Akhir Pendaftaran</h3>
                <span class="text-gray-700 bg-gray-50 px-6 py-3 rounded-full inline-block text-lg font-medium shadow-sm">
                    <i data-feather="calendar" class="w-5 h-5 mr-2 inline-block align-middle text-green-600"></i>
                    {{ $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('d F Y') : 'Tidak Ada Batas Waktu' }}
                </span>
            </div>
        </div>

        <div class="mt-10 flex flex-col sm:flex-row justify-end gap-4">
            {{-- Tombol Lamar (jika diaktifkan) --}}
            <a href="{{ route('career.apply', $job->id) }}"
               class="inline-flex items-center justify-center px-8 py-3 rounded-full bg-green-600 hover:bg-green-700 text-white font-semibold shadow-lg transition duration-200 transform hover:scale-105">
                Lamar Sekarang
                <i data-feather="send" class="ml-2 w-5 h-5"></i>
            </a>
            <a href="{{ route('career.index') }}"
               class="inline-flex items-center justify-center px-8 py-3 rounded-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold shadow-md transition duration-200 transform hover:scale-105 border border-gray-300">
                <i data-feather="arrow-left" class="mr-2 w-5 h-5"></i>
                Kembali ke Daftar Lowongan
            </a>
        </div>
    </div>
</div>
@endsection
