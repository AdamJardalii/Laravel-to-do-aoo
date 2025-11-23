<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebTaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks()->latest()->get();
        // dd($tasks);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:urgent,important,normal',
        ]);

        Auth::user()->tasks()->create($validated);

        return redirect()->route('dashboard')->with('success', 'Task created!');
    }
    
    public function show(Task $task){
        $this->authorizeTask($task);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorizeTask($task);
        return view('tasks.edit', compact('task'));
    }

    // Update task
    public function update(Request $request, Task $task)
    {
        $this->authorizeTask($task);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:urgent,important,normal',
            'is_done' => 'boolean'
        ]);

        $task->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'task'    => $task,
                'message' => 'Task updated successfully!'
            ]);
        }
        return redirect()->route('dashboard')->with('success', 'Task updated!');
    }

    public function destroy(Task $task,Request $request)
    {
        $this->authorizeTask($task);
        $task->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Task deleted successfully!',
                'task_id' => $task->id,
            ]);
        }


        return redirect()->route('dashboard')->with('success', 'Task deleted!');
    }

    public function archived()
    {
        $tasks = Task::onlyTrashed()
                     ->where('user_id', auth()->id())
                     ->get();
        return view('tasks.archived', compact('tasks'));
    }

    public function restore($id)
    {
        $task = Task::onlyTrashed()->where('id', $id)->firstOrFail();
        $this->authorizeTask($task);
        $task->restore();

        return response()->json(['success' => true]);
    }


    private function authorizeTask(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
