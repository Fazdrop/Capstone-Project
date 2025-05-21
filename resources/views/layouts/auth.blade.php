<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Login')</title>
  @vite('resources/css/app.css')
  {{-- font Inter --}}
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-200 font-sans">


  @yield('content')

</body>
</html>
