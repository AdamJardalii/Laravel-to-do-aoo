<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    {{-- Include Navbar --}}
    <x-navbar />

    {{-- Page Content --}}
    <div class="container mx-auto p-6">
        @yield('content')
    </div>

</body>
</html>
