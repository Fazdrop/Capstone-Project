@extends('layouts.app')

@section('title', 'Ganti Password')
@section('menu-info', 'Ganti Password')

@section('content')
<div class="w-full max-w-md mx-auto mt-10">
  <div class="relative">
    <!-- Icon overlap -->
    <div class="absolute -top-10 left-1/2 transform -translate-x-1/2">
      <div class="bg-indigo-100 p-3 rounded-full shadow-md">
        <i data-feather="lock" class="w-6 h-6 text-indigo-600"></i>
      </div>
    </div>

    <div class="mt-8 bg-white rounded-2xl shadow-lg p-8 space-y-6">
      <div class="text-center">
        <h2 class="text-2xl font-semibold text-indigo-700">Ganti Password</h2>
        <p class="text-gray-500 text-sm mt-1">Demi keamanan, gunakan password baru yang unik dan kuat.</p>
      </div>

      {{-- Flash message --}}
      @if(session('success'))
        <div class="flash-message flex items-center gap-2 bg-green-100 border border-green-200 text-green-700 px-4 py-2 rounded">
          <i data-feather="check-circle" class="w-5 h-5"></i>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf

        <div>
          <label for="current_password" class="flex items-center gap-2 text-gray-700 font-medium mb-1">
            <i data-feather="key" class="w-4 h-4 text-gray-500"></i> Password Lama
          </label>
          <input type="password" name="current_password" id="current_password"
                 class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition"
                 placeholder="Masukkan password lama" required>
          @error('current_password')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="new_password" class="flex items-center gap-2 text-gray-700 font-medium mb-1">
            <i data-feather="lock" class="w-4 h-4 text-gray-500"></i> Password Baru
          </label>
          <input type="password" name="new_password" id="new_password"
                 class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition"
                 placeholder="Minimal 8 karakter" required>
          @error('new_password')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="new_password_confirmation" class="flex items-center gap-2 text-gray-700 font-medium mb-1">
            <i data-feather="check" class="w-4 h-4 text-gray-500"></i> Konfirmasi Password Baru
          </label>
          <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                 class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition"
                 placeholder="Ulangi password baru" required>
        </div>

        <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2.5 rounded-xl font-semibold flex items-center justify-center gap-2 shadow-md transition">
          <i data-feather="refresh-ccw" class="w-5 h-5"></i> Simpan Password Baru
        </button>
      </form>
    </div>
  </div>
</div>
@endsection
