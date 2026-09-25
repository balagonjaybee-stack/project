@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-gray-50 border border-gray-200 rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <span class="text-xs uppercase font-bold tracking-wider text-blue-600 bg-blue-100 px-2.5 py-1 rounded-full">{{ $task->project_name }}</span>
        <a href="{{ route('tasks.index') }}" class="text-gray-500 hover:underline text-sm">← Back</a>
    </div>

    <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $task->task_name }}</h2>

    <p class="text-gray-600 text-sm mb-4">{{ $task->description ?? 'No description provided.' }}</p>

    <div class="flex justify-between text-xs text-gray-500 border-t pt-4">
        <span><strong>Due Date:</strong> {{ $task->due_date ?? 'N/A' }}</span>
        <span><strong>Status:</strong> {{ $task->status }}</span>
    </div>
</div>
@endsection