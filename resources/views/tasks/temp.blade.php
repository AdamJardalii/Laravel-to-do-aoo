<!DOCTYPE html>
<html lang="en">
<head>
	<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <meta charset="UTF-8">
    <title>Dashboard - Tasks</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="container mx-auto p-6" x-data="taskDashboard({{ $tasks->toJson() }})">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">My Tasks</h1>
        <a href="{{ route('tasks.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">+ Create Task</a>
    </div>

    <!-- Pending Tasks -->
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Pending Tasks</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
    	<template x-for="task in pendingTasks" :key="task.id">
            <x-task-card :task="task" />
        </template>
<!--         @foreach($tasks->where('is_done', false) as $task)
                <x-task-card :task="$task" />
        @endforeach -->
    </div>

    <!-- Completed Tasks -->
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Completed Tasks</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
<!--         @foreach($tasks->where('is_done', true) as $task)
                <x-task-card :task="$task" />
        @endforeach -->
        <template x-for="task in completedTasks" :key="task.id">
            <x-task-card :task="task" />
        </template>
    </div>

</div>


<script>
	function taskDashboard(initialTasks) {
	    return {
	        tasks: initialTasks,

	        get pendingTasks() {
	            return this.tasks.filter(t => !t.is_done);
	        },

	        get completedTasks() {
	            return this.tasks.filter(t => t.is_done);
	        },

	        updateTask(task) {
	            task.is_done = !task.is_done;

	            fetch(`/tasks/${task.id}`, {
	                method: 'PUT',
	                headers: {
	                    'Content-Type': 'application/json',
	                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
	                    'Accept': 'application/json'
	                },
	                body: JSON.stringify(task)
	            })
	            .then(res => res.json())
	            .then(data => console.log(data))
	            .catch(err => console.error(err));
	        }
	    }
	}
</script>
</body>
</html>

