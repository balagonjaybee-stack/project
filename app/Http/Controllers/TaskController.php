<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // View Tasks
    public function index()
    {
        $tasks = Task::orderBy('due_date', 'asc')->get();
        return view('tasks.index', compact('tasks'));
    }

    // Show Create Form
    public function create()
    {
        return view('tasks.create');
    }

    // Add Task
    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        Task::create([
            'task_name' => $request->task_name,
            'description' => $request->description,
            'status' => 'Pending',
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    // Show Edit Form
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // Edit Task
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,Completed',
            'due_date' => 'nullable|date',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    // Update Status Toggle Quick Action
    public function toggleStatus(Task $task)
    {
        $task->status = ($task->status === 'Pending') ? 'Completed' : 'Pending';
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task status updated!');
    }

    // Delete Task
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}