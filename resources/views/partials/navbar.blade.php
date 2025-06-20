{{-- Navbar --}}
<header class="fixed top-0 left-0 w-full z-50 bg-gray-800 text-white flex items-center justify-between px-4 py-3 shadow">
    {{-- Sidebar toggle & panel title --}}
    <div class="flex items-center space-x-4">
        <button id="sidebar-toggle" class="p-2 rounded bg-gray-900 hover:bg-gray-700 cursor-pointer transition">
            <i data-feather="menu" class="w-5 h-5"></i>
        </button>
        @php
            $role = Auth::user()?->role?->name ?? 'user';
            $panelTitle = strtoupper($role) . ' PANEL';
        @endphp
        <h1 class="text-xl font-bold">{{ $panelTitle }}</h1>
    </div>

    {{-- Info menu dinamis --}}
    <div class="text-sm md:text-base">
        @yield('menu-info', 'Dashboard')
    </div>

    {{-- User dropdown (pakai Alpine.js biar mudah) --}}
    <div class="relative" x-data="{ open: false }" @click.away="open = false">
        <button @click="open = !open"
            class="flex items-center space-x-2 focus:outline-none cursor-pointer hover:opacity-80 transition">
            <i data-feather="user"></i>
            <span>{{ Auth::user()->name ?? 'User' }}</span>
        </button>
        <div x-show="open" x-transition
            class="absolute right-0 mt-2 w-44 bg-white text-black rounded shadow-md z-50 origin-top-right"
            style="min-width: 180px;">
            <a href="{{ route('password.change') }}"
                class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-gray-100 transition border-b border-gray-200">
                <i data-feather="key" class="w-4 h-4"></i>
                Ganti Password
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm hover:bg-gray-100 transition">
                    <i data-feather="log-out" class="w-4 h-4"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>
{{-- End Navbar --}}
