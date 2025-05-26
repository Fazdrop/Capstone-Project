{{-- <a href="{{ route('admin.users.create') }}"
   class="flex items-center px-3 py-2 rounded transition group
          {{ Request::routeIs('admin.users.create') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
  <i data-feather="user-plus" class="w-5 h-5 transition-all duration-200"></i>
  <span class="ml-3 sidebar-text hidden group-hover:inline transition-all duration-300">Add User</span>
</a> --}}

<a href="{{ route('admin.divisions.index') }}"
   class="flex items-center px-3 py-2 rounded transition group
          {{ Request::routeIs('admin.divisions.*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
  <i data-feather="user" class="w-5 h-5 transition-all duration-200"></i>
  <span class="ml-3 sidebar-text hidden ">Division</span>
</a>


{{-- <a href="#" class="flex items-center px-3 py-2 rounded transition group text-gray-300 hover:bg-gray-700">
  <i data-feather="settings" class="w-5 h-5 transition-all duration-200"></i>
  <span class="ml-3 sidebar-text hidden group-hover:inline transition-all duration-300">Settings</span>
</a> --}}
