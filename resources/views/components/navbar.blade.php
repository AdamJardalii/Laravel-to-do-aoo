<nav class="bg-gray-800 text-white p-4 flex justify-between items-center">
    <div class="flex items-center space-x-4">
        <a href="{{ route('dashboard') }}" class="hover:text-gray-300 transition">Dashboard</a>
        <a href="{{ route('tasks.archived') }}" class="hover:text-gray-300 transition">Archived Tasks</a>
        <a href="{{ route('tasks.create') }}" class="hover:text-gray-300 transition">Create Task</a>
    </div>
    <div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 px-3 py-1 rounded hover:bg-red-700 transition">
                Logout
            </button>
        </form>
    </div>
</nav>
