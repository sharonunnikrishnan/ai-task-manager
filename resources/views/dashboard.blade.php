@php
    use Illuminate\Support\Str;
@endphp

<x-app-layout>

    <div class="min-h-screen bg-[#3a4152] py-6">

        <div class="max-w-7xl mx-auto px-4">

            <!-- Header -->
            <div class="flex items-center justify-between mb-8">

                <div>

                    <h1 class="text-5xl font-bold text-white">
                        Task List
                    </h1>

                </div>

                <a href="{{ route('tasks.create') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-3 rounded-xl font-semibold shadow">

                    + New Task

                </a>

            </div>

            <!-- Filters -->
            <form method="GET" action="{{ route('dashboard') }}" class="flex flex-wrap gap-3 mb-8">

                <!-- Search -->
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Filter Task"
                    class="bg-white rounded-lg px-4 py-3 w-64 border-0">

                <!-- Status -->
                <select name="status" class="bg-white rounded-lg px-4 py-3 border-0">

                    <option value="">Status</option>

                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>

                        Pending

                    </option>

                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>

                        In Progress

                    </option>

                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>

                        Completed

                    </option>

                </select>

                <!-- Priority -->
                <select name="priority" class="bg-white rounded-lg px-4 py-3 border-0">

                    <option value="">Priority</option>

                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>

                        Low

                    </option>

                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>

                        Medium

                    </option>

                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>

                        High

                    </option>

                </select>

                <button class="bg-indigo-500 hover:bg-indigo-600 text-white px-5 py-3 rounded-lg">

                    Filter

                </button>

            </form>

            <!-- Main Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

                <!-- Left Content -->
                <div class="lg:col-span-3">

                    <!-- Task Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        @forelse($tasks as $task)
                            <div class="bg-white rounded-2xl p-5 shadow-lg">

                                <!-- Top -->
                                <div class="flex items-center justify-between mb-5">

                                    <span class="bg-gray-100 text-gray-600 text-xs px-3 py-1 rounded-full">

                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}

                                    </span>

                                    <div class="text-gray-400">
                                        •••
                                    </div>

                                </div>

                                <!-- Title -->
                                <h2 class="text-xl font-bold text-gray-800 mb-4">

                                    {{ $task->title }}

                                </h2>

                                <!-- Tags -->
                                <div class="flex gap-2 mb-4">

                                    @if ($task->priority == 'high')
                                        <span class="bg-red-100 text-red-600 text-xs px-3 py-1 rounded-full">
                                            Priority High
                                        </span>
                                    @elseif($task->priority == 'medium')
                                        <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full">
                                            Priority Medium
                                        </span>
                                    @else
                                        <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                                            Priority Low
                                        </span>
                                    @endif

                                </div>

                                <!-- Description -->
                                <div class="bg-gray-50 rounded-xl p-4 mb-4">

                                    <p class="text-sm text-gray-500 leading-6">

                                        {{ Str::limit($task->description, 90) }}

                                    </p>

                                </div>

                                <!-- Details -->
                                <div class="space-y-1 text-sm text-gray-500 mb-5">

                                    <p>
                                        Due: {{ $task->due_date }}
                                    </p>

                                    <p>
                                        AI Priority:
                                        <span class="font-semibold text-gray-700">
                                            {{ ucfirst($task->ai_priority) }}
                                        </span>
                                    </p>

                                </div>

                                <!-- Buttons -->
                                <div class="flex items-center justify-end gap-2">

                                    @can('update', $task)
                                        <a href="{{ route('tasks.edit', $task->id) }}"
                                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm">

                                            Edit

                                        </a>
                                    @endcan

                                    @can('view', $task)
                                        <a href="{{ route('tasks.show', $task->id) }}"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">

                                            View

                                        </a>
                                    @endcan

                                </div>

                            </div>

                        @empty

                            <div class="text-white">

                                No tasks found

                            </div>
                        @endforelse

                    </div>

                </div>

                <!-- Sidebar -->
                <div class="space-y-6">

                    <!-- Profile Card -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg">

                        <div class="flex items-center gap-4 mb-6">

                            <div class="w-14 h-14 rounded-full bg-indigo-100 flex items-center justify-center text-2xl">

                                👨‍💻

                            </div>

                            <div>

                                <h3 class="font-bold text-lg">
                                    {{ auth()->user()->name }}
                                </h3>

                                <p class="text-sm text-gray-500">
                                    {{ ucfirst(auth()->user()->role) }}
                                </p>

                            </div>

                        </div>

                        <!-- Menu -->
                        <div class="space-y-3">

                            <div class="bg-blue-500 text-white px-4 py-3 rounded-xl">
                                Tasks
                            </div>

                            <div class="bg-gray-100 text-gray-700 px-4 py-3 rounded-xl">
                                Dashboard
                            </div>

                            <!-- Buttons -->
                            <div class="flex gap-3">

                                <!-- Create Task -->
                                <a href="{{ route('tasks.create') }}"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl shadow transition">

                                    + Create Task

                                </a>

                                <!-- Show All Tasks -->
                                <a href="{{ route('tasks.index') }}"
                                    class="bg-gray-900 hover:bg-black text-white px-5 py-3 rounded-xl shadow transition">

                                    Show All Tasks

                                </a>

                            </div>

                        </div>

                    </div>

                    <!-- Stats -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg">

                        <h3 class="font-bold text-gray-800 mb-5">
                            Monthly Task Completion
                        </h3>

                        <div class="grid grid-cols-3 gap-3 mb-6">

                            <div class="text-center">

                                <div class="text-2xl font-bold text-indigo-600">
                                    {{ $totalTasks }}
                                </div>

                                <div class="text-xs text-gray-500">
                                    Total
                                </div>

                            </div>

                            <div class="text-center">

                                <div class="text-2xl font-bold text-green-600">
                                    {{ $completedTasks }}
                                </div>

                                <div class="text-xs text-gray-500">
                                    Completed
                                </div>

                            </div>

                            <div class="text-center">

                                <div class="text-2xl font-bold text-red-600">
                                    {{ $highPriorityTasks }}
                                </div>

                                <div class="text-xs text-gray-500">
                                    High
                                </div>

                            </div>

                        </div>

                        <!-- Chart -->
                        <div class="h-64">

                            <canvas id="taskChart"></canvas>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('taskChart');

    new Chart(ctx, {

        type: 'bar',

        data: {

            labels: [
                'Total',
                'Pending',
                'Completed',
                'High'
            ],

            datasets: [{

                data: [

                    {{ $totalTasks }},

                    {{ $pendingTasks }},

                    {{ $completedTasks }},

                    {{ $highPriorityTasks }}

                ],

                backgroundColor: [

                    '#6366F1',
                    '#FACC15',
                    '#22C55E',
                    '#EF4444'
                ],

                borderRadius: 10
            }]
        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {
                    display: false
                }
            },

            scales: {

                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
