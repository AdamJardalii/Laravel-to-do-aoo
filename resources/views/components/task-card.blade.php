<!-- <div :class="taskDone ? 'bg-gray-200 opacity-80' : 'bg-white'" 
     class="shadow-md rounded-lg p-4 flex flex-col justify-between">
    <div>
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-semibold {{ $task->is_done ? 'line-through text-gray-400' : 'text-gray-800' }}">
                {{ $task->title }}
            </h2> -->

            <!-- Delete X -->
<!--             <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this task?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="text-red-600 font-bold hover:text-red-800 transition px-2">&times;</button>
            </form>
        </div>

        <p class="{{ $task->is_done ? 'line-through text-gray-600' : 'text-gray-600' }} mt-1">
            {{ $task->description }}
        </p>

        <p class="mt-2 font-semibold {{ $task->is_done ? 'line-through' : '' }}">
            Priority:
            @if($task->priority == 'important') <span class="text-red-500">Important 🔥</span>
            @elseif($task->priority == 'urgent') <span class="text-yellow-500">Urgent ⚡</span>
            @else <span class="text-green-500">Normal ✅</span>
            @endif
        </p>
    </div> -->

<!--     <div class="mt-4 flex justify-between items-center" x-data="{ done: {{ $task->is_done ? 'true' : 'false' }} }">
 --><!--         <button 
            @click="done = !done; fetch('{{ route('tasks.update', $task) }}', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    is_done: done ? 1 : 0,
                    title: '{{ $task->title }}',
                    description: '{{ $task->description }}',
                    priority: '{{ $task->priority }}'
                })
            })"
            :class="done ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-500 hover:bg-green-600'"
            class="text-white px-3 py-1 rounded-lg transition">
            <span x-text="done ? 'Mark as Pending' : 'Mark as Done'"></span>
        </button>

        <a href="{{ route('tasks.edit', $task) }}"
           class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 transition">Edit</a> -->

<!--                    <button @click="$root.updateTask(task)"
                :class="task.is_done ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-500 hover:bg-green-600'"
                class="text-white px-3 py-1 rounded-lg transition">
            <span x-text="task.is_done ? 'Mark as Pending' : 'Mark as Done'"></span>
        </button>

        <a :href="`/tasks/${task.id}/edit`" 
           class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 transition">
           Edit
        </a>
    </div>
</div>
 -->

 @props(['task'])

<div class="bg-white shadow-md rounded-lg p-4 flex flex-col justify-between"
     :class="task.is_done ? 'bg-gray-200 opacity-80' : 'bg-white'">
    <div>
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-semibold text-gray-800" :class="task.is_done ? 'line-through text-gray-400' : ''">
                <span x-text="task.title"></span>
            </h2>

            <!-- Delete X -->
            <button @click="$dispatch('task-deleted', task)"
                    class="text-red-600 font-bold hover:text-red-800 transition px-2">&times;</button>
        </div>
        <p class="text-gray-600 mt-1" :class="task.is_done ? 'line-through' : ''" x-text="task.description"></p>
        <p class="mt-2 font-semibold" :class="task.is_done ? 'line-through' : ''">
            Priority: 
            <span x-show="task.priority == 'important'" class="text-red-500">Important 🔥</span>
            <span x-show="task.priority == 'urgent'" class="text-yellow-500">Urgent ⚡</span>
            <span x-show="task.priority == 'normal'" class="text-green-500">Normal ✅</span>
        </p>
    </div>

    <div class="mt-4 flex justify-between items-center">
        <button @click="task.is_done = !task.is_done; $dispatch('task-updated', task); updateTask(task)"
                :class="task.is_done ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-500 hover:bg-green-600'"
                class="text-white px-3 py-1 rounded-lg transition">
            <span x-text="task.is_done ? 'Mark as Pending' : 'Mark as Done'"></span>
        </button>

        <a :href="`/tasks/${task.id}/edit`"
           class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 transition">Edit</a>
    </div>
</div>

<script>
    function updateTask(task) {
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
</script>
