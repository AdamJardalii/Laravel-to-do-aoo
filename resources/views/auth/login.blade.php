@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login</h2>

{{-- Show server-side validation errors --}}
@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('login') }}" method="POST" class="space-y-4">
    @csrf

    <input type="email" name="email" placeholder="Email" required
        value="{{ old('email') }}"
        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">

    <input type="password" name="password" placeholder="Password" required
        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">

    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">
        Login
    </button>
</form>

<p class="text-gray-600 text-center mt-4">
    Don't have an account? 
    <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Sign Up</a>
</p>
@endsection
