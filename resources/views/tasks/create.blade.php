<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task - Personal Task Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-50 to-indigo-50 min-h-screen text-slate-800 antialiased flex flex-col justify-between">

    <header class="bg-indigo-700 text-white shadow-md">
        <div class="max-w-5xl mx-auto px-6 py-4 flex items-center gap-3">
            <span class="bg-indigo-900 text-indigo-200 text-xs font-mono font-bold px-3 py-1 rounded-full border border-indigo-600">
                WST21-PM-2026-SF
            </span>
            <h1 class="text-xl font-bold tracking-tight">Personal Task Manager</h1>
        </div>
    </header>

    <main class="max-w-md w-full mx-auto px-4 py-12">
        <div class="bg-white p-8 rounded-2xl shadow-xl shadow-slate-100 border border-slate-100">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">Create New Task</h2>
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Task Name</label>
                    <input type="text" name="task_name" required placeholder="e.g., Finish Laravel project" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
                    <textarea name="description" rows="3" placeholder="Optional details..." class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"></textarea>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Due Date</label>
                    <input type="date" name="due_date" class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                </div>
                <div class="flex items-center justify-between gap-4">
                    <a href="{{ route('tasks.index') }}" class="text-sm font-medium text-slate-500 hover:text-slate-800 transition-colors">Cancel</a>
                    <button type="submit" class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-semibold text-sm shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all">Save Task</button>
                </div>
            </form>
        </div>
    </main>

    <footer class="py-6 text-center text-xs text-slate-400">
        WST21-PM-2026-SF Personal Task Manager &bull; Laravel Portfolio
    </footer>
</body>
</html>