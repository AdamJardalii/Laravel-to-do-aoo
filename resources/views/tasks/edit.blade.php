@extends('layouts.app')

@section('title', 'My Tasks')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-100">

<div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Edit Task</h1>
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Task Title -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title', $task->title) }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>

        <!-- Task Description -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Description</label>
            <textarea name="description"
                      class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('description', $task->description) }}</textarea>
        </div>

        <!-- Task Done -->
        <div class="flex items-center space-x-2">
            <input type="checkbox" name="is_done" id="is_done" value="1" 
                   class="h-5 w-5 text-green-600"
                   {{ old('is_done', $task->is_done) ? 'checked' : '' }}>
            <label for="is_done" class="text-gray-700 font-medium">Mark as Done</label>
        </div>

        <!-- Task Priority -->
        <div>
            <p class="text-gray-700 font-semibold mb-2">Priority</p>
            <div class="flex space-x-4">
                <label class="flex items-center space-x-1">
                    <input type="radio" name="priority" value="important"
                        class="text-red-500"
                        {{ old('priority', $task->priority) == 'important' ? 'checked' : '' }}>
                    <span class="text-gray-700">Important 🔥</span>
                </label>

                <label class="flex items-center space-x-1">
                    <input type="radio" name="priority" value="urgent"
                        class="text-yellow-500"
                        {{ old('priority', $task->priority) == 'urgent' ? 'checked' : '' }}>
                    <span class="text-gray-700">Urgent ⚡</span>
                </label>

                <label class="flex items-center space-x-1">
                    <input type="radio" name="priority" value="normal"
                        class="text-green-500"
                        {{ old('priority', $task->priority) == 'normal' ? 'checked' : '' }}>
                    <span class="text-gray-700">Normal ✅</span>
                </label>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition">
            Update Task
        </button>
    </form>

    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="mt-4"
          onsubmit="return confirm('Are you sure you want to delete this task?');">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="w-full bg-red-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-red-700 transition">
            Delete Task
        </button>
    </form>
</div>
</div>

@endsection

