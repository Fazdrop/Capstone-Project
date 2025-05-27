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

   document.addEventListener("DOMContentLoaded", function () {
  feather.replace();

  const userBtn = document.getElementById("user-menu-button");
  const dropdown = document.getElementById("user-dropdown");

  userBtn.addEventListener("click", function (e) {
    e.stopPropagation();
    const isHidden = dropdown.classList.contains("hidden");
    if (isHidden) {
      dropdown.classList.remove("hidden");
      // Next tick, biar style dibaca browser dulu
      setTimeout(() => {
        dropdown.classList.remove("scale-95", "opacity-0", "pointer-events-none");
        dropdown.classList.add("scale-100", "opacity-100");
      }, 10);
    } else {
      dropdown.classList.remove("scale-100", "opacity-100");
      dropdown.classList.add("scale-95", "opacity-0", "pointer-events-none");
      // Setelah transisi, baru di-hide (waktu harus sama/lebih dari duration)
      setTimeout(() => {
        dropdown.classList.add("hidden");
      }, 200);
    }
  });

  document.addEventListener("click", function (e) {
    if (dropdown && !dropdown.classList.contains("hidden")) {
      dropdown.classList.remove("scale-100", "opacity-100");
      dropdown.classList.add("scale-95", "opacity-0", "pointer-events-none");
      setTimeout(() => {
        dropdown.classList.add("hidden");
      }, 200);
    }
  });
});



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

  // Auto-hide any flash messages after 3s
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.flash-message').forEach(el => {
        setTimeout(() => {
          el.classList.add('opacity-0', 'transition', 'duration-500');
          setTimeout(() => el.remove(), 500);
        }, 3000);
      });
    });
</script>



</body>
</html>
