 <!-- Navbar -->
  <header class="fixed top-0 left-0 w-full z-50 bg-gray-800 text-white flex items-center justify-between px-4 py-3 shadow">
    <div class="flex items-center space-x-4">
      <button id="sidebar-toggle" class="p-2 rounded bg-gray-900 hover:bg-gray-700 cursor-pointer">
        <i data-feather="menu" class="w-5 h-5"></i>
      </button>
      <h1 class="text-xl font-bold">User Panel</h1>
    </div>
    <div class="text-sm md:text-base">
      @yield('menu-info', 'Dashboard')
    </div>
    <div class="flex items-center space-x-2">
      <i data-feather="user"></i>
      <span>Fairuz</span>
    </div>
  </header>
