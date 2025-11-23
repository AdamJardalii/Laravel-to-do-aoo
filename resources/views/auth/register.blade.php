@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Create Account</h2>

@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('register') }}" method="POST" class="space-y-4">
    @csrf

    <input type="text" name="name" placeholder="Name" required
        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">

    <input type="email" name="email" placeholder="Email" required
        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">

    <input type="password" name="password" placeholder="Password" required
        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">

    <input type="password" name="password_confirmation" placeholder="Confirm Password" required
        class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">

    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">
        Register
    </button>
</form>

<p class="text-gray-600 text-center mt-4">
    Already have an account? 
    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
</p>
@endsection
