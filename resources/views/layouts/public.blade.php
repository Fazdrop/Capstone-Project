{{-- filepath: resources/views/layouts/public.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'PT Graha Buana Cikarang')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
</head>

<body class="bg-gray-50 font-sans text-gray-800 antialiased">

    @if (session('success'))
        <div class="flash-message mb-4 p-3 rounded bg-green-100 text-green-800 font-semibold text-center">
            {{ session('success') }}
        </div>
    @endif
    @if (session('info'))
        <div class="flash-message mb-4 p-3 rounded bg-yellow-100 text-yellow-800 font-semibold text-center">
            {{ session('info') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="flash-message mb-4 p-3 rounded bg-red-100 text-red-800 font-semibold text-center">
            {{ $errors->first() }}
        </div>
    @endif
    <div class="flex flex-col min-h-screen max-w-7xl mx-auto">
        <header class="bg-white shadow-md sticky top-0 z-50" x-data="{ open: false }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <span class="flex items-center gap-2 font-bold text-xl text-green-700">
                            <i data-feather="home" class="w-6 h-6"></i>
                            PT Graha Buana
                        </span>
                    </div>
                    <!-- Desktop Nav -->
                    <nav class="hidden md:flex items-center space-x-4">
                        <a href="{{ route('landing') }}"
                            class="text-gray-700 hover:text-green-700 px-3 py-2 rounded-md text-sm font-medium">Beranda</a>
                        <a href="#about"
                            class="text-gray-700 hover:text-green-700 px-3 py-2 rounded-md text-sm font-medium">Tentang</a>
                        <a href="#visi-misi"
                            class="text-gray-700 hover:text-green-700 px-3 py-2 rounded-md text-sm font-medium">Visi
                            Misi</a>
                        <a href="#contact"
                            class="text-gray-700 hover:text-green-700 px-3 py-2 rounded-md text-sm font-medium">Kontak</a>
                        <a href="{{ route('career.index') }}"
                            class="bg-green-700 text-white px-4 py-2 rounded-md hover:bg-green-800 text-sm font-medium">Career</a>
                    </nav>
                    <!-- Mobile Hamburger -->
                    <div class="md:hidden flex items-center">
                        <button @click="open = !open" class="text-gray-700 focus:outline-none">
                            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- Mobile Nav -->
                <div x-show="open" x-transition
                    class="md:hidden absolute right-4 top-16 w-48 bg-white rounded-lg shadow-lg py-2 z-50 flex flex-col space-y-1"
                    @click.away="open = false">
                    <a href="{{ route('landing') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50">Beranda</a>
                    <a href="#about" class="block px-4 py-2 text-gray-700 hover:bg-green-50">Tentang</a>
                    <a href="#visi-misi" class="block px-4 py-2 text-gray-700 hover:bg-green-50">Visi Misi</a>
                    <a href="#contact" class="block px-4 py-2 text-gray-700 hover:bg-green-50">Kontak</a>
                    <a href="{{ route('career.index') }}"
                        class="block px-4 py-2 text-white bg-green-700 rounded hover:bg-green-800">Career</a>
                </div>
            </div>
        </header>
        <main class="flex-1 px-4 py-8 sm:px-6 lg:px-8">
            @yield('content')
        </main>
        <footer class="bg-white shadow-inner py-4 text-center text-gray-600 text-sm">
            © {{ date('Y') }} PT Graha Buana Cikarang
        </footer>
    </div>
    <script>
        feather.replace();
    </script>
</body>

</html>
