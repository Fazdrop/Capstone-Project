<a href="{{ route('manager.dashboard') }}"
    class="flex items-center px-3 py-2 rounded transition group
         {{ Request::routeIs('manager.dashboard') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
    <i data-feather="home" class="w-5 h-5"></i>
    <span class="ml-3 sidebar-text hidden">Dashboard</span>
</a>

@if (strtolower(Auth::user()?->division?->name) === 'hr' && strtolower(Auth::user()?->role?->name) === 'manager')
    <a href="{{ route('manager.approve_request.index') }}"
        class="flex items-center px-3 py-2 rounded transition group
         {{ Request::routeIs('manager.approve_request.index') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
        <i data-feather="check-square" class="w-5 h-5"></i>
        <span class="ml-3 sidebar-text hidden">Approval Request</span>
    </a>
@endif
