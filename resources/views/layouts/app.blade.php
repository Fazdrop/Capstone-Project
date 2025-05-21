<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>@yield('title', 'Dashboard')</title>
  @vite('resources/css/app.css')
  <link href="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.css" rel="stylesheet">
  {{-- font Inter --}}
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
</head>

<body class="bg-gray-100 overflow-x-hidden">

    <!-- navbar -->
    @include('partials.navbar')

    <!-- Sidebar + Main content -->
    <div class="flex">
      @include('partials.sidebar') {{-- nanti diganti sesuai role --}}
      <main id="main-content" class="pt-20 px-4 transition-all duration-300 min-h-screen flex-1 ml-16">
        @yield('content')
      </main>
    </div>

  <!-- Feather Icons -->
  <script src="https://cdn.jsdelivr.net/npm/feather-icons"></script>
  <script>
  feather.replace();

  const sidebar = document.getElementById('sidebar');
  const toggleBtn = document.getElementById('sidebar-toggle');
  const sidebarText = document.querySelectorAll('.sidebar-text');
  const mainContent = document.getElementById('main-content');

  let isExpanded = false;

  toggleBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    isExpanded = !isExpanded;

    if (isExpanded) {
      sidebar.classList.remove('w-16');
      sidebar.classList.add('w-64');
      mainContent.classList.remove('ml-16');
      mainContent.classList.add('ml-64');
      sidebarText.forEach(el => el.classList.remove('hidden'));
    } else {
      sidebar.classList.remove('w-64');
      sidebar.classList.add('w-16');
      mainContent.classList.remove('ml-64');
      mainContent.classList.add('ml-16');
      sidebarText.forEach(el => el.classList.add('hidden'));
    }

    feather.replace(); // refresh icons
  });
</script>



</body>
</html>
