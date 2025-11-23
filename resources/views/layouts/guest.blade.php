<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    {{-- Include guest navbar --}}
    @include('components.guest-navbar')

    <div class="flex-grow flex items-center justify-center">
        <div class="w-full max-w-sm bg-white p-4 rounded-xl shadow-lg">
            @yield('content')
        </div>
    </div>

</body>
</html>
