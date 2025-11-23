@extends('layouts.app')

@section('title', 'Archived Tasks')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100">

<div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Create New Task</h1>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Task Title -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Title</label>
            <input type="text" name="title" placeholder="Task title"
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                   required>
        </div>

        <!-- Task Description -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Description</label>
            <textarea name="description" placeholder="Task description"
                      class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
        </div>


        <!-- Task Priority -->
        <div>
            <p class="text-gray-700 font-semibold mb-2">Priority</p>
            <div class="flex space-x-4">
                <label class="flex items-center space-x-1">
                    <input type="radio" name="priority" value="important" 
                        {{ old('priority') == 'important' ? 'checked' : '' }}
                        class="text-red-500">
                    <span class="text-gray-700">Important 🔥</span>
                </label>

                <label class="flex items-center space-x-1">
                    <input type="radio" name="priority" value="urgent"
                        {{ old('priority') == 'urgent' ? 'checked' : '' }}
                        class="text-yellow-500">
                    <span class="text-gray-700">Urgent ⚡</span>
                </label>

                <label class="flex items-center space-x-1">
                    <input type="radio" name="priority" value="normal"
                        {{ old('priority', 'normal') == 'normal' ? 'checked' : '' }}
                        class="text-green-500">
                    <span class="text-gray-700">Normal ✅</span>
                </label>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition">
            Create Task
        </button>
    </form>
</div>
</div>

@endsection

