@extends('layouts.app')

@section('title', 'Archived Tasks')

@section('content')

<h1 class="text-3xl font-bold mb-6">Archived Tasks</h1>

@if($tasks->count() == 0)
    <p class="text-gray-600">No archived tasks.</p>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

        @foreach($tasks as $task)
        <div class="bg-white shadow-md rounded-lg p-4 flex flex-col justify-between">

            <div>
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-lg font-semibold text-gray-800">
                        {{ $task->title }}
                    </h2>

                    <!-- Trash icon (non-clickable since already archived) -->
                    <span class="text-gray-400 cursor-not-allowed text-xl">&times;</span>
                </div>

                <p class="text-gray-600 mt-1">{{ $task->description }}</p>

                <p class="mt-2 font-semibold">
                    @if($task->priority === 'important')
                        <span class="text-red-500">Important 🔥</span>
                    @elseif($task->priority === 'urgent')
                        <span class="text-yellow-500">Urgent ⚡</span>
                    @else
                        <span class="text-green-500">Normal ✅</span>
                    @endif
                </p>
            </div>

            <div class="mt-4 flex justify-end">
                <button 
                    onclick="restoreTask({{ $task->id }}, this)" 
                    class="bg-green-600 text-white px-3 py-1 rounded-lg hover:bg-green-700 transition">
                    Restore
                </button>
            </div>

        </div>
        @endforeach

    </div>
@endif

@endsection

<script>
function restoreTask(taskId, buttonElement) {
    fetch(`/tasks/${taskId}/restore`, {
        method: 'POST',
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json"
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            buttonElement.closest('.bg-white').classList.add('opacity-50');
            setTimeout(() => {
                buttonElement.closest('.bg-white').remove();
            }, 300);
        }
    })
    .catch(err => console.error(err));
}
</script>
