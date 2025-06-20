<!-- resources/views/partials/sidebar.blade.php -->
<aside id="sidebar" class="fixed top-0 left-0 h-screen w-16 bg-gray-900 text-white transition-all duration-300 z-40 overflow-hidden">
  <div class="mt-16 text-center px-2">
    <img src="{{ asset('Asset/logoPtGraha1.png') }}" alt="Logo" class="w-10 h-10 mx-auto mb-3">
    <h2 class="text-sm font-semibold sidebar-text hidden">Menu</h2>
  </div>

  <nav class="mt-6 space-y-2 px-2">
    {{-- Logic: pilih sidebar sesuai role --}}
    @php
      $role = Auth::user()?->role?->name ?? null;
    @endphp

    @if($role === 'admin')
      @include('partials.sidebars.admin')
    @elseif($role === 'hod')
      @include('partials.sidebars.hod')
    @elseif($role === 'manager')
      @include('partials.sidebars.manager')
    @elseif($role === 'ga')
      @include('partials.sidebars.ga')
    @elseif($role === 'departemen')
      @include('partials.sidebars.departemen')
    @else
      {{-- Optional: sidebar default/user biasa --}}
      {{-- @include('partials.sidebars.user') --}}
    @endif
  </nav>
</aside>
