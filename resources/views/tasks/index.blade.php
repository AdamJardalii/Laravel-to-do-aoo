@extends('layouts.app')

@section('title', 'My Tasks')

@section('content')
<div class="container mx-auto p-6" x-data="taskDashboard({{ $tasks->toJson() }})">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">My Tasks</h1>
        <a href="{{ route('tasks.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">+ Create Task</a>
    </div>

    <h2 class="text-xl font-semibold text-gray-700 mb-4">Pending Tasks</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
        <template x-for="task in pendingTasks" :key="task.id">
            <div class="bg-white shadow-md rounded-lg p-4 flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="text-lg font-semibold text-gray-800" :class="task.is_done ? 'line-through text-gray-400' : ''" x-text="task.title"></h2>
                        
                        <!-- Dynamic Delete -->
                        <button @click="deleteTask(task)"
                                class="text-red-600 font-bold hover:text-red-800 transition px-2">&times;</button>
                    </div>
                    <p class="text-gray-600 mt-1" :class="task.is_done ? 'line-through' : ''" x-text="task.description"></p>
                    <p class="mt-2 font-semibold" :class="task.is_done ? 'line-through' : ''">
                        <span x-show="task.priority === 'important'" class="text-red-500">Important 🔥</span>
                        <span x-show="task.priority === 'urgent'" class="text-yellow-500">Urgent ⚡</span>
                        <span x-show="task.priority === 'normal'" class="text-green-500">Normal ✅</span>
                    </p>
                </div>
                <div class="mt-4 flex justify-between items-center">
                    <button @click="toggleDone(task)"
                            :class="task.is_done ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-500 hover:bg-green-600'"
                            class="text-white px-3 py-1 rounded-lg transition">
                        <span x-text="task.is_done ? 'Mark as Pending' : 'Mark as Done'"></span>
                    </button>

                    <a :href="`/tasks/${task.id}/edit`"
                       class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 transition">Edit</a>
                </div>
            </div>
        </template>
    </div>

    <!-- Completed Tasks -->
    <h2 class="text-xl font-semibold text-gray-700 mb-4">Completed Tasks</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <template x-for="task in completedTasks" :key="task.id">
            <div class="bg-gray-200 shadow-md rounded-lg p-4 flex flex-col justify-between opacity-80">
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="text-lg font-semibold text-gray-800 line-through" x-text="task.title"></h2>

                        <!-- Dynamic Delete -->
                        <button @click="deleteTask(task)"
                                class="text-red-600 font-bold hover:text-red-800 transition px-2">&times;</button>
                    </div>
                    <p class="text-gray-600 mt-1 line-through" x-text="task.description"></p>
                    <p class="mt-2 font-semibold line-through">
                        <span x-show="task.priority === 'important'" class="text-red-500">Important 🔥</span>
                        <span x-show="task.priority === 'urgent'" class="text-yellow-500">Urgent ⚡</span>
                        <span x-show="task.priority === 'normal'" class="text-green-500">Normal ✅</span>
                    </p>
                </div>
                <div class="mt-4 flex justify-between items-center">
                    <button @click="toggleDone(task)"
                            :class="task.is_done ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-500 hover:bg-green-600'"
                            class="text-white px-3 py-1 rounded-lg transition">
                        <span x-text="task.is_done ? 'Mark as Pending' : 'Mark as Done'"></span>
                    </button>

                    <a :href="`/tasks/${task.id}/edit`"
                       class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 transition">Edit</a>
                </div>
            </div>
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

        toggleDone(task) {
            task.is_done = !task.is_done;
            this.updateTask(task);
        },

        updateTask(task) {
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
        },

        deleteTask(task) {
            if(!confirm('Are you sure you want to delete this task?')) return;

            fetch(`/tasks/${task.id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => {
                if(res.ok) {
                    // Remove from tasks array dynamically
                    this.tasks = this.tasks.filter(t => t.id !== task.id);
                } else {
                    alert('Failed to delete task.');
                }
            })
            .catch(err => console.error(err));
        }
    }
}
</script>

@endsection

