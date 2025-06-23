{{-- resources/views/partials/sidebars/staff.blade.php --}}
<a href="{{ route('staff.dashboard') }}"
    class="flex items-center px-3 py-2 rounded transition group
          {{ Request::routeIs('staff.dashboard') ? 'bg-green-800 text-white' : 'text-gray-300 hover:bg-green-700' }}">
    <i data-feather="home" class="w-5 h-5"></i>
    <span class="ml-3 sidebar-text hidden">Dashboard</span>
</a>
