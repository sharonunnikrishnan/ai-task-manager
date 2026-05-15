@php
    use Illuminate\Support\Str;
@endphp

<x-app-layout>

    <div class="py-8">

        <div class="max-w-7xl mx-auto px-4">

            <!-- Header -->
            <div class="mb-8">

                <h1 class="text-3xl font-bold text-gray-800">
                    Dashboard
                </h1>

                <p class="text-gray-500 mt-1">
                    AI Assisted Task Management Overview
                </p>

            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                <!-- Total Tasks -->
                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-gray-500 text-sm">
                                Total Tasks
                            </p>

                            <h2 class="text-4xl font-bold text-gray-800 mt-2">
                                {{ $totalTasks }}
                            </h2>

                        </div>

                        <div class="w-14 h-14 bg-indigo-100 rounded-xl flex items-center justify-center text-2xl">
                            📋
                        </div>

                    </div>

                </div>

                <!-- Pending Tasks -->
                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-gray-500 text-sm">
                                Pending Tasks
                            </p>

                            <h2 class="text-4xl font-bold text-yellow-600 mt-2">
                                {{ $pendingTasks }}
                            </h2>

                        </div>

                        <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center text-2xl">
                            ⏳
                        </div>

                    </div>

                </div>

                <!-- Completed -->
                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-gray-500 text-sm">
                                Completed Tasks
                            </p>

                            <h2 class="text-4xl font-bold text-green-600 mt-2">
                                {{ $completedTasks }}
                            </h2>

                        </div>

                        <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center text-2xl">
                            ✅
                        </div>

                    </div>

                </div>

                <!-- High Priority -->
                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-gray-500 text-sm">
                                High Priority
                            </p>

                            <h2 class="text-4xl font-bold text-red-600 mt-2">
                                {{ $highPriorityTasks }}
                            </h2>

                        </div>

                        <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center text-2xl">
                            🔥
                        </div>

                    </div>

                </div>

            </div>

            <!-- Analytics Chart -->
            <div class="mt-10">

                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="mb-6">

                        <h2 class="text-2xl font-bold text-gray-800">
                            Task Analytics
                        </h2>

                        <p class="text-gray-500 mt-1">
                            Overview of task statistics
                        </p>

                    </div>

                    <!-- Chart -->
                    <div class="h-96">

                        <canvas id="taskChart"></canvas>

                    </div>

                </div>

            </div>

            <!-- Recent Tasks -->
            <div class="mt-10">

                <div class="flex items-center justify-between mb-5">

                    <div>

                        <h2 class="text-2xl font-bold text-gray-800">
                            Recent Tasks
                        </h2>

                        <p class="text-gray-500">
                            Latest created tasks
                        </p>

                    </div>

                    <a href="{{ route('tasks.index') }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-lg shadow">

                        View All Tasks

                    </a>

                </div>

                <div class="bg-white rounded-2xl shadow overflow-hidden">

                    <table class="w-full">

                        <thead class="bg-gray-100">

                            <tr>

                                <th class="text-left px-6 py-4">
                                    Title
                                </th>

                                <th class="text-left px-6 py-4">
                                    Priority
                                </th>

                                <th class="text-left px-6 py-4">
                                    Status
                                </th>

                                <th class="text-left px-6 py-4">
                                    Due Date
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($recentTasks as $task)
                                <tr class="border-b hover:bg-gray-50">

                                    <td class="px-6 py-4">

                                        <div class="font-semibold text-gray-800">
                                            {{ $task->title }}
                                        </div>

                                        <div class="text-sm text-gray-500">
                                            {{ Str::limit($task->description, 50) }}
                                        </div>

                                    </td>

                                    <!-- Priority -->
                                    <td class="px-6 py-4">

                                        @if ($task->priority == 'high')
                                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                                High
                                            </span>
                                        @elseif($task->priority == 'medium')
                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                                Medium
                                            </span>
                                        @else
                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                                Low
                                            </span>
                                        @endif

                                    </td>

                                    <!-- Status -->
                                    <td class="px-6 py-4">

                                        @if ($task->status == 'completed')
                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                                Completed
                                            </span>
                                        @elseif($task->status == 'in_progress')
                                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                                In Progress
                                            </span>
                                        @else
                                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                                Pending
                                            </span>
                                        @endif

                                    </td>

                                    <td class="px-6 py-4 text-gray-700">

                                        {{ $task->due_date }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="text-center py-10 text-gray-500">

                                        No recent tasks found

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

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
                'Total Tasks',
                'Pending',
                'Completed',
                'High Priority'
            ],

            datasets: [{

                label: 'Task Statistics',

                data: [

                    {{ $totalTasks }},

                    {{ $pendingTasks }},

                    {{ $completedTasks }},

                    {{ $highPriorityTasks }}

                ],

                backgroundColor: [

                    'rgba(99, 102, 241, 0.7)',

                    'rgba(234, 179, 8, 0.7)',

                    'rgba(34, 197, 94, 0.7)',

                    'rgba(239, 68, 68, 0.7)'
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
