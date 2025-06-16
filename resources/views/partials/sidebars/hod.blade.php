<a href="{{ route('hod.dashboard') }}"
   class="flex items-center px-3 py-2 rounded transition group
          {{ Request::routeIs('hod.dashboard') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
    <i data-feather="home" class="w-5 h-5"></i>
    <span class="ml-3 sidebar-text hidden">Dashboard</span>
</a>


<a href="{{ route('hod.request_employee.index') }}"
   class="flex items-center px-3 py-2 rounded transition group
          {{ Request::routeIs('hod.request_employee.*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
    <i data-feather="users" class="w-5 h-5"></i>
    <span class="ml-3 sidebar-text hidden">Employee Request</span>
</a>
