<x-app-layout>

    <div class="min-h-screen bg-[#3a4152] py-8">

        <div class="max-w-7xl mx-auto px-4">

            <!-- Header -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-10">

                <div>

                    <h1 class="text-5xl font-bold text-white">
                        Task Detail + AI Summary
                    </h1>

                    <p class="text-slate-400 mt-3 text-lg">
                        AI Assisted Task Analysis
                    </p>

                </div>

                <!-- Button -->
                <div>

                    <a href="{{ route('tasks.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl shadow-lg transition">

                        + New Task

                    </a>

                </div>

            </div>

            <!-- Main Layout -->
            <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">

                <!-- Main Content -->
                <div class="xl:col-span-3">

                    <!-- Card -->
                    <div class="bg-white rounded-3xl shadow-2xl p-8">

                        <!-- Top -->
                        <div class="flex items-start justify-between mb-8">

                            <div>

                                <h2 class="text-4xl font-bold text-gray-800">

                                    {{ $task->title }}

                                </h2>

                                <!-- Badges -->
                                <div class="flex flex-wrap gap-3 mt-5">

                                    <!-- Status -->
                                    @if ($task->status == 'completed')
                                        <span
                                            class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">

                                            ✅ Completed

                                        </span>
                                    @elseif($task->status == 'in_progress')
                                        <span
                                            class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">

                                            🚀 In Progress

                                        </span>
                                    @else
                                        <span
                                            class="bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-semibold">

                                            ⏳ Pending

                                        </span>
                                    @endif

                                    <!-- Priority -->
                                    @if ($task->priority == 'high')
                                        <span
                                            class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-semibold">

                                            🔥 High Priority

                                        </span>
                                    @elseif($task->priority == 'medium')
                                        <span
                                            class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-semibold">

                                            ⚡ Medium Priority

                                        </span>
                                    @else
                                        <span
                                            class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">

                                            ✅ Low Priority

                                        </span>
                                    @endif

                                </div>

                            </div>

                            <!-- Dots -->
                            <div class="text-gray-400 text-3xl">

                                ⋯

                            </div>

                        </div>

                        <!-- Description Card -->
                        <div class="bg-gray-50 rounded-3xl p-6 mb-6">

                            <h3 class="text-2xl font-bold text-gray-800 mb-5">

                                Description

                            </h3>

                            <!-- User -->
                            <div class="flex items-center gap-4 mb-5">

                                <div
                                    class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-lg">

                                    {{ strtoupper(substr($task->user->name, 0, 1)) }}

                                </div>

                                <div>

                                    <div class="font-semibold text-gray-700">

                                        Assigned to:
                                        {{ $task->user->name }}

                                    </div>

                                    <div class="text-sm text-gray-500">

                                        Due:
                                        {{ $task->due_date }}

                                    </div>

                                </div>

                            </div>

                            <!-- Description -->
                            <div class="bg-white rounded-2xl p-5 border border-gray-100">

                                <p class="text-gray-600 leading-8">

                                    {{ $task->description }}

                                </p>

                            </div>

                        </div>

                        <!-- AI Section -->
                        <div class="bg-gray-50 rounded-3xl p-6 mb-6">

                            <div class="flex items-center gap-3 mb-5">

                                <div
                                    class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center text-2xl">

                                    🤖

                                </div>

                                <div>

                                    <h3 class="text-2xl font-bold text-gray-800">

                                        AI Generated Summary

                                    </h3>

                                    <p class="text-gray-500 text-sm">

                                        AI-powered task analysis

                                    </p>

                                </div>

                            </div>

                            <!-- AI Summary -->
                            <div class="bg-white rounded-2xl p-5 border border-gray-100 mb-5">

                                <p class="text-gray-700 leading-8">

                                    {{ $task->ai_summary }}

                                </p>

                            </div>

                            <!-- AI Priority -->
                            <div class="bg-white rounded-2xl p-5 border border-gray-100">

                                <div class="flex items-center justify-between">

                                    <div class="font-semibold text-gray-700">

                                        AI Priority Analysis

                                    </div>

                                    @if ($task->ai_priority == 'high')
                                        <span
                                            class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-semibold">

                                            🔥 High

                                        </span>
                                    @elseif($task->ai_priority == 'medium')
                                        <span
                                            class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-semibold">

                                            ⚡ Medium

                                        </span>
                                    @else
                                        <span
                                            class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">

                                            ✅ Low

                                        </span>
                                    @endif

                                </div>

                            </div>

                        </div>

                        <!-- Buttons -->
                        <div class="flex flex-wrap gap-4">

                            @can('update', $task)
                                <a href="{{ route('tasks.edit', $task->id) }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl shadow-lg font-semibold transition">

                                    Edit Task

                                </a>
                            @endcan

                            <a href="{{ route('tasks.index') }}"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-8 py-4 rounded-2xl font-semibold transition">

                                Back

                            </a>

                        </div>

                    </div>

                </div>

                <!-- Sidebar -->
                <div class="space-y-6">

                    <!-- User Card -->
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

                        <div class="p-6">

                            <div class="flex items-center gap-4">

                                <div
                                    class="w-14 h-14 bg-blue-600 rounded-full flex items-center justify-center text-white text-xl font-bold">

                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                                </div>

                                <div>

                                    <div class="font-bold text-gray-800">

                                        {{ auth()->user()->name }}

                                    </div>

                                    <div class="text-gray-500 text-sm">

                                        {{ auth()->user()->role }}

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Menu -->
                        <div class="border-t">

                            <a href="{{ route('tasks.index') }}"
                                class="block px-6 py-4 bg-blue-600 text-white font-medium">

                                Tasks

                            </a>

                            <a href="{{ route('dashboard') }}"
                                class="block px-6 py-4 hover:bg-blue-50 text-gray-700 font-medium">

                                Dashboard

                            </a>

                        </div>

                    </div>

                    <!-- AI Status -->
                    <div class="bg-white rounded-3xl shadow-xl p-6">

                        <div class="flex items-center gap-3 mb-4">

                            <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center text-2xl">

                                ✨

                            </div>

                            <div>

                                <h3 class="font-bold text-gray-800">

                                    AI Status

                                </h3>

                                <p class="text-sm text-gray-500">

                                    Analysis completed

                                </p>

                            </div>

                        </div>

                        <div class="bg-green-50 border border-green-100 rounded-2xl p-4 text-green-700 text-sm">

                            AI summary and task insights generated successfully.

                        </div>

                    </div>

                    <!-- Chart -->
                    <div class="bg-slate-800 rounded-3xl p-6 shadow-xl">

                        <h3 class="text-white text-xl font-bold mb-6">

                            Monthly Task Completion

                        </h3>

                        <div class="h-64">

                            <canvas id="miniChart"></canvas>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('miniChart');

        new Chart(ctx, {

            type: 'bar',

            data: {

                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],

                datasets: [{

                    data: [12, 18, 10, 22, 15],

                    backgroundColor: [
                        '#3B82F6',
                        '#60A5FA',
                        '#2563EB',
                        '#1D4ED8',
                        '#93C5FD'
                    ],

                    borderRadius: 10
                }]
            },

            options: {

                plugins: {

                    legend: {
                        display: false
                    }
                },

                scales: {

                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#CBD5E1'
                        },
                        grid: {
                            color: '#334155'
                        }
                    },

                    x: {
                        ticks: {
                            color: '#CBD5E1'
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>

</x-app-layout>
