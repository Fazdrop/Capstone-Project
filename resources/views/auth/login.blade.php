@extends('layouts.auth') {{-- Menggunakan layout auth.blade.php --}}

@section('title', 'Login') {{-- Menetapkan judul halaman login --}}

@section('content')
<!-- Container utama dengan lebar maksimal -->
<div class="w-full max-w-md p-6 bg-white rounded shadow-md">

  <!-- Logo perusahaan -->
  <div class="flex justify-center mb-6">
    <img src="{{ asset('Asset/logoPtGraha.png') }}" alt="Logo PT Graha" class="h-20">
  </div>

  <!-- Judul Form -->
  <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>

  <!-- Form Login -->
  <form method="POST" action="">
    @csrf {{-- Proteksi CSRF token untuk keamanan form --}}

    <!-- Input Email -->
    <div class="mb-4">
      <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
      <input type="email" name="email" id="email" required
             class="mt-1 w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
    </div>

    <!-- Input Password -->
    <div class="mb-6">
      <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
      <input type="password" name="password" id="password" required autocomplete="off"
             class="mt-1 w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
    </div>

    <!-- Tombol Submit -->
    <button type="submit"
            class="w-full bg-indigo-600 text-white py-2 px-4 rounded hover:bg-indigo-700 transition">
      Sign in
    </button>
  </form>
</div>
@endsection
