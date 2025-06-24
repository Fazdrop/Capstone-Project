@extends('layouts.app')

@section('title', 'Edit FPK')
@section('menu-info', 'Edit Form Permintaan Karyawan')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white rounded-xl shadow-lg p-8 border border-gray-200">
    <h2 class="text-2xl font-bold text-green-900 text-center mb-6">Edit Nomor FPK</h2>
    <form action="{{ route('staff.request_employee.update', $req->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium text-gray-700 mb-1">Nomor FPK</label>
            <input type="number" name="request_number" value="{{ old('request_number', $req->request_number) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="flex justify-between mt-8">
            <a href="{{ route('staff.request_employee.index') }}" class="px-5 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-900 font-semibold">Kembali</a>
            <button type="submit" class="px-5 py-2 rounded bg-green-700 hover:bg-green-800 text-white font-semibold">Simpan</button>
        </div>
    </form>
</div>
@endsection
