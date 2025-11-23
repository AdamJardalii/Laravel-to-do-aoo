<h1>{{ $task->title }}</h1>
<p>{{ $task->description }}</p>
<p>Done: {{ $task->is_done ? 'Yes' : 'No' }}</p>
<p>Important: {{ $task->is_important ? 'Yes' : 'No' }}</p>
<p>Urgent: {{ $task->is_urgent ? 'Yes' : 'No' }}</p>

<a href="{{ route('tasks.edit', $task) }}">Edit</a>
<a href="{{ route('dashboard') }}">Back to Dashboard</a>
