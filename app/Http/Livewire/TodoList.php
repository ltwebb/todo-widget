<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Todo;
use Livewire\Component;

class TodoList extends Component
{

    public string $task = '';
    public string $hours = '';
    public $tasksTotal;
    public $hoursTotal;

    public $editing;

    protected $rules = [
        'task' => 'required' | 'string',
        'hours' => 'required' | 'numeric',
        'editing.task' => 'required' | 'string',
        'editing.hours' => 'required' | 'numeric',
    ];

    public function mount(Todo $todo)
    {
        $this->tasksTotal = Todo::where('completed_at', '=', null)
            ->count('task');

        $this->hoursTotal = Todo::where('completed_at', '=', null)
            ->sum('hours');
    }

    public function render()
    {
        return view(
            'livewire.todo-list',
            ['tasks' => Todo::orderBy('completed_at', 'asc')
                ->orderBy('created_at', 'desc')
                ->get()]
        );
    }

    public function addTask()
    {
        $validatedData = $this->validate([
            'task' => 'required|string',
            'hours' => 'required|numeric',
        ]);

        Todo::create($validatedData);

        $this->reset('task', 'hours');
    }

    public function markCompleted(Todo $task)
    {
        $task->completed_at = isset($task->completed_at) ? null : Carbon::now();
        $task->save();
    }

    public function deleteTask(Todo $task)
    {
        $task->delete();
    }

    public function selectTaskForEdit(Todo $task)
    {
        $this->editing = $task;
    }

    public function cancelEdit()
    {
        $this->editing = null;
    }


    public function updateTask(Todo $task)
    {
        $validatedData = $this->validate([
            'editing.task' => 'required|string',
            'editing.hours' => 'required|numeric',
        ]);

        $this->editing->save($validatedData);

        $this->editing = null;
    }
}
