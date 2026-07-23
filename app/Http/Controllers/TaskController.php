<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display Task Board
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $tasks = Task::when($search, function ($query) use ($search) {

            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('employee', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");

        })
        ->latest()
        ->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show Create Form
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store Task
     */
    public function store(Request $request)
    {
        $request->validate([

            'title'       => 'required|max:255',

            'employee'    => 'required|max:255',

            'priority'    => 'required',

            'status'      => 'required',

            'due_date'    => 'required|date',

            'description' => 'nullable',

        ]);

        Task::create([

            'title'       => $request->title,

            'employee'    => $request->employee,

            'priority'    => $request->priority,

            'status'      => $request->status,

            'due_date'    => $request->due_date,

            'description' => $request->description,

        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task created successfully!');
    }

    /**
     * Show Single Task
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show Edit Form
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update Task
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([

            'title'       => 'required|max:255',

            'employee'    => 'required|max:255',

            'priority'    => 'required',

            'status'      => 'required',

            'due_date'    => 'required|date',

            'description' => 'nullable',

        ]);

        $task->update([

            'title'       => $request->title,

            'employee'    => $request->employee,

            'priority'    => $request->priority,

            'status'      => $request->status,

            'due_date'    => $request->due_date,

            'description' => $request->description,

        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task updated successfully!');
    }

    /**
     * Delete Task
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    }
}