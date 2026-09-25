<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Task Manager - WST21-PM-2026-SF</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen antialiased selection:bg-indigo-500 selection:text-white">
    
    <!-- Top Header -->
    <header class="bg-slate-800/80 backdrop-blur-md border-b border-slate-700 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-6 py-4 flex flex-col sm:flex-row justify-between items-center gap-3">
            <div class="flex items-center gap-3">
                <span class="bg-indigo-500/10 text-indigo-400 border border-indigo-500/30 text-xs font-mono font-bold px-3 py-1 rounded-full shadow-inner">
                    WST21-PM-2026-SF
                </span>
                <h1 class="text-lg font-bold tracking-tight text-white flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    TaskFlow Pro
                </h1>
            </div>
            <div class="text-xs font-medium text-slate-400 bg-slate-900/50 px-3 py-1.5 rounded-lg border border-slate-700/50">
                Personal Workspace &bull; Laravel 11
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-6 py-10">
        
        <!-- Dashboard Greeting & Actions -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-black tracking-tight text-white">Your Workspace</h2>
                <p class="text-sm text-slate-400 mt-1">Track, prioritize, and accomplish your daily objectives seamlessly.</p>
            </div>
            <a href="{{ route('tasks.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-3 rounded-xl font-semibold text-sm shadow-lg shadow-indigo-600/30 transition-all transform hover:-translate-y-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create New Task
            </a>
        </div>

        @if(session('success'))
            <div class="mb-8 bg-emerald-950/50 border border-emerald-500/30 text-emerald-300 px-5 py-4 rounded-2xl shadow-xl flex items-center gap-3 backdrop-blur-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Task Cards Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($tasks as $task)
                <div class="bg-slate-800/60 border border-slate-700/70 rounded-2xl p-6 shadow-xl hover:border-indigo-500/50 transition-all flex flex-col justify-between group">
                    <div>
                        <div class="flex justify-between items-start gap-3 mb-3">
                            <h3 class="font-bold text-lg text-white group-hover:text-indigo-300 transition-colors line-clamp-1">{{ $task->task_name }}</h3>
                            <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-3 py-1 text-xs font-bold rounded-full transition-all shadow-sm {{ $task->status === 'Completed' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 hover:bg-emerald-500/20' : 'bg-amber-500/10 text-amber-400 border border-amber-500/30 hover:bg-amber-500/20' }}">
                                    {{ $task->status }}
                                </button>
                            </form>
                        </div>
                        <p class="text-sm text-slate-400 mb-4 line-clamp-3 leading-relaxed">{{ $task->description ?? 'No description provided for this task.' }}</p>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 text-xs text-slate-400 mb-4 bg-slate-900/40 p-2.5 rounded-xl border border-slate-700/40">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Due: <strong class="text-slate-200">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No deadline' }}</strong></span>
                        </div>

                        <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-700/50">
                            <a href="{{ route('tasks.edit', $task) }}" class="inline-flex items-center gap-1.5 text-xs font-semibold px-3.5 py-2 rounded-xl bg-indigo-500/10 text-indigo-300 border border-indigo-500/20 hover:bg-indigo-500/20 transition-all">
                                Edit
                            </a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete this task permanently?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1.5 text-xs font-semibold px-3.5 py-2 rounded-xl bg-rose-500/10 text-rose-400 border border-rose-500/20 hover:bg-rose-500/20 transition-all">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center bg-slate-800/30 border border-dashed border-slate-700 rounded-3xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-slate-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="text-lg font-semibold text-slate-300">No tasks found</h3>
                    <p class="text-sm text-slate-500 mt-1">Get started by creating your first task above.</p>
                </div>
            @endforelse
        </div>
    </main>

    <footer class="text-center py-8 text-xs text-slate-500 border-t border-slate-800 mt-16">
        Project Code: WST21-PM-2026-SF &bull; Built with Laravel & Tailwind CSS
    </footer>
</body>
</html>