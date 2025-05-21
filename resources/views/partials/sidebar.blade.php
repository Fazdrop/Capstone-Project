<!-- Sidebar -->
<aside id="sidebar" class="fixed top-0 left-0 h-screen w-16 bg-gray-900 text-white transition-all duration-300 z-40 overflow-hidden">
  <div class="mt-16 text-center px-2">
    <img src="{{ asset('Asset/logoPtGraha1.png') }}" alt="Logo" class="w-10 h-10 mx-auto mb-3">
    <h2 class="text-sm font-semibold sidebar-text hidden">Sidebar Title</h2>
  </div>

  <nav class="mt-6 space-y-2 px-2">
     {{-- Sementara pakai salah satu ini manual, sesuai role yang mau kamu lihat dulu --}}

    @include('partials.sidebars.admin')
    {{-- @include('partials.sidebars.hrd') --}}
    {{-- @include('partials.sidebars.bod') --}}
    {{-- @include('partials.sidebars.ga') --}}
    {{-- @include('partials.sidebars.departemen') --}}
  </nav>
</aside>
