<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Task;

class TaskCard extends Component
{
    public Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function render()
    {
        return view('components.task-card');
    }
}
