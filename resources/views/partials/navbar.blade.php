<!-- Navbar -->
<header class="fixed top-0 left-0 w-full z-50 bg-gray-800 text-white flex items-center justify-between px-4 py-3 shadow">
  <div class="flex items-center space-x-4">
    <button id="sidebar-toggle" class="p-2 rounded bg-gray-900 hover:bg-gray-700 cursor-pointer transition">
      <i data-feather="menu" class="w-5 h-5"></i>
    </button>
    <h1 class="text-xl font-bold">User Panel</h1>
  </div>

  <div class="text-sm md:text-base">
    @yield('menu-info', 'Dashboard')
  </div>

  <!-- User Dropdown -->
  <div class="relative">
    <button id="user-menu-button" class="flex items-center space-x-2 focus:outline-none cursor-pointer hover:opacity-80 transition">
      <i data-feather="user"></i>
      <span>Fairuz</span>
    </button>

    <!-- Dropdown Menu -->
    <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-32 bg-white text-black rounded shadow-md z-50 transition duration-200 ease-out">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
                class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 transition duration-200 cursor-pointer">
          Logout
        </button>
      </form>
    </div>
  </div>
</header>
