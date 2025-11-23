{{-- Guest Navbar --}}
<nav class="bg-white shadow-md">
    <div class="container mx-auto px-6 py-4 flex justify-end items-center">
        <a href="{{ route('login') }}" 
           class="text-gray-700 hover:text-blue-600 font-semibold px-4 py-2 transition">
           Login
        </a>
        <a href="{{ route('register') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition">
           Sign Up
        </a>
    </div>
</nav>
