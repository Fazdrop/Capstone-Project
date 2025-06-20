@extends('layouts.app')

@section('title', 'Tambah Role')
@section('menu-info', 'Tambah Role Baru')

@section('content')
<div class="max-w-xl mx-auto mt-12 bg-white p-8 rounded-2xl shadow border border-gray-100">
    <h1 class="text-2xl font-bold text-indigo-700 mb-6 flex items-center gap-2">
        <i data-feather="plus-circle"></i> Tambah Role Baru
    </h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 rounded px-4 py-2 mb-4">
            <ul class="pl-5 list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.roles.store') }}" class="space-y-6">
        @csrf
        <div>
            <label for="name" class="block text-sm font-semibold mb-1">Nama Role</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                   required autofocus>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-700 transition font-semibold">
                <i data-feather="save" class="inline w-5 h-5 mr-1 -mt-1"></i> Simpan
            </button>
            <a href="{{ route('admin.roles.index') }}"
               class="flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition text-center font-semibold">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
