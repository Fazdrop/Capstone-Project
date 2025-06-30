{{-- resources/views/partials/sidebars/staff.blade.php --}}

@if (strtolower(Auth::user()?->division?->name) === 'hr' && strtolower(Auth::user()?->role?->name) === 'staff')
    <a href="{{ route('staff.dashboard') }}"
        class="flex items-center px-3 py-2 rounded transition group
        {{ Request::routeIs('staff.dashboard') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
        <i data-feather="home" class="w-5 h-5"></i>
        <span class="ml-3 sidebar-text hidden">Dashboard</span>
    </a>
    <a href="{{ route('staff.request_employee.index') }}"
        class="flex items-center px-3 py-2 rounded transition group
        {{ Request::routeIs('staff.request_employee.*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
        <i data-feather="file-text" class="w-5 h-5"></i>
        <span class="ml-3 sidebar-text hidden">Permintaan Karyawan</span>
    </a>
    <a href="{{ route('staff.job_vacancy.index') }}"
        class="flex items-center px-3 py-2 rounded transition group
        {{ Request::routeIs('staff.job_vacancy.*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
        <i data-feather="briefcase" class="w-5 h-5"></i>
        <span class="ml-3 sidebar-text hidden">Job Vacancy</span>
    </a>

    <a href="{{ route('staff.applicants.index') }}"
        class="flex items-center px-3 py-2 rounded transition group
        {{ Request::routeIs('staff.applicants.index') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
        <i data-feather="users" class="w-5 h-5"></i>
        <span class="ml-3 sidebar-text hidden">Daftar Pelamar</span>
    </a>

    {{--

    <a href="{{ route('staff.applicants.passed') }}"
        class="flex items-center px-3 py-2 rounded transition group
        {{ Request::routeIs('staff.applicants.passed') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
        <i data-feather="user-check" class="w-5 h-5"></i>
        <span class="ml-3 sidebar-text hidden">Pelamar Lolos Adm.</span>
    </a>
    <a href="{{ route('staff.applicants.finished') }}"
        class="flex items-center px-3 py-2 rounded transition group
        {{ Request::routeIs('staff.applicants.finished') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
        <i data-feather="check-circle" class="w-5 h-5"></i>
        <span class="ml-3 sidebar-text hidden">Pelamar Selesai Interview</span>
    </a>
    <a href="{{ route('staff.talent_pool.index') }}"
        class="flex items-center px-3 py-2 rounded transition group
        {{ Request::routeIs('staff.talent_pool.*') ? 'bg-gray-800 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
        <i data-feather="database" class="w-5 h-5"></i>
        <span class="ml-3 sidebar-text hidden">Talent Pool</span>
    </a> --}}
@endif
