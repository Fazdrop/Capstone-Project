@extends('layouts.auth')

@section('title', 'Login')

@section('content')

  <div class="w-full max-w-md bg-white shadow-md rounded-xl p-8">

    <!-- Logo -->
    <div class="flex justify-center mb-6">
      <img src="{{ asset('Asset/logoPtGraha.png') }}" alt="Logo PT Graha" class="h-20">
    </div>

    <!-- Heading -->
    <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Welcome Back</h2>

    <!-- Form -->
    <form method="POST" action="">
      @csrf

      <!-- Email -->
      <div class="mb-5">
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input type="email" name="email" id="email" required
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
      </div>

      <!-- Password -->
      <div class="mb-6">
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <input type="password" name="password" id="password" required autocomplete="off"
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
      </div>

      <!-- Submit Button -->
      <button type="submit"
              class="w-full bg-indigo-600 text-white font-medium py-2 rounded-md hover:bg-indigo-700 transition cursor-pointer">
        Sign In
      </button>
    </form>

  </div>

@endsection
