<x-app-layout>

    <div class="min-h-screen bg-[#3a4152] py-8">

        <div class="max-w-7xl mx-auto px-4">

            <!-- Header -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-10">

                <div>

                    <h1 class="text-5xl font-bold text-white">
                        Create Task
                    </h1>

                    <p class="text-slate-400 mt-3 text-lg">
                        AI Assisted Task Creation
                    </p>

                </div>

                <!-- Button -->
                <div>

                    <a href="{{ route('tasks.index') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl shadow-lg transition">

                        All Tasks

                    </a>

                </div>

            </div>

            <!-- Main Layout -->
            <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">

                <!-- Main Content -->
                <div class="xl:col-span-3">

                    <!-- Validation Errors -->
                    @if ($errors->any())

                        <div class="bg-red-500/20 border border-red-500/30 text-red-300 px-5 py-4 rounded-2xl mb-6">

                            <ul class="list-disc pl-5">

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <!-- Main Card -->
                    <div class="bg-white rounded-3xl shadow-2xl p-8">

                        <!-- Top -->
                        <div class="flex items-start justify-between mb-8">

                            <h2 class="text-4xl font-bold text-gray-800">

                                Create New Task

                            </h2>

                            <div class="text-gray-400 text-3xl">

                                ⋯

                            </div>

                        </div>

                        <!-- Form -->
                        <form method="POST" action="{{ route('tasks.store') }}" id="taskForm">

                            @csrf

                            <!-- Title -->
                            <div class="bg-gray-50 rounded-3xl p-5 mb-6">

                                <input type="text" name="title" placeholder="Enter Task Title"
                                    value="{{ old('title') }}"
                                    class="w-full bg-white border border-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-blue-500">

                            </div>

                            <!-- Description -->
                            <div class="bg-gray-50 rounded-3xl p-5 mb-6">

                                <textarea name="description" rows="6" placeholder="Task Description"
                                    class="w-full bg-white border border-gray-200 rounded-2xl p-4 leading-7 focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>

                            </div>

                            <!-- Priority -->
                            <div class="bg-gray-50 rounded-3xl p-5 mb-6">

                                <h3 class="text-xl font-bold text-gray-800 mb-5">

                                    Priority

                                </h3>

                                <div class="flex flex-wrap gap-3">

                                    <!-- Low -->
                                    <label class="cursor-pointer">

                                        <input type="radio" name="priority" value="low" class="hidden peer"
                                            checked>

                                        <div
                                            class="px-5 py-3 rounded-2xl border bg-white text-gray-700 peer-checked:bg-green-500 peer-checked:text-white peer-checked:border-green-500 transition">

                                            Low

                                        </div>

                                    </label>

                                    <!-- Medium -->
                                    <label class="cursor-pointer">

                                        <input type="radio" name="priority" value="medium" class="hidden peer">

                                        <div
                                            class="px-5 py-3 rounded-2xl border bg-white text-gray-700 peer-checked:bg-yellow-500 peer-checked:text-white peer-checked:border-yellow-500 transition">

                                            Medium

                                        </div>

                                    </label>

                                    <!-- High -->
                                    <label class="cursor-pointer">

                                        <input type="radio" name="priority" value="high" class="hidden peer">

                                        <div
                                            class="px-5 py-3 rounded-2xl border bg-white text-gray-700 peer-checked:bg-red-500 peer-checked:text-white peer-checked:border-red-500 transition">

                                            High

                                        </div>

                                    </label>

                                </div>

                            </div>

                            <!-- Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                                <!-- Due Date -->
                                <div class="bg-gray-50 rounded-3xl p-5">

                                    <label class="block text-sm font-semibold text-gray-600 mb-3">

                                        Due Date

                                    </label>

                                    <input type="date" name="due_date" value="{{ old('due_date') }}"
                                        class="w-full bg-white border border-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-blue-500">

                                </div>

                                <!-- Assign User -->
                                <div class="bg-gray-50 rounded-3xl p-5">

                                    <label class="block text-sm font-semibold text-gray-600 mb-3">

                                        Assign To

                                    </label>

                                    <select name="assigned_to"
                                        class="w-full bg-white border border-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-blue-500">

                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">

                                                {{ $user->name }}

                                            </option>
                                        @endforeach

                                    </select>

                                </div>

                            </div>

                            <!-- AI Loader -->
                            <div id="aiLoader" class="hidden bg-blue-50 border border-blue-100 rounded-3xl p-5 mb-8">

                                <div class="flex items-center gap-4">

                                    <!-- Spinner -->
                                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600">
                                    </div>

                                    <div>

                                        <h3 class="font-semibold text-blue-700 text-lg">

                                            AI Processing Task

                                        </h3>

                                        <p class="text-sm text-blue-500 mt-1">

                                            Generating AI summary and priority analysis...

                                        </p>

                                    </div>

                                </div>

                            </div>

                            <!-- Buttons -->
                            <div class="flex flex-wrap gap-4">

                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl shadow-lg font-semibold transition">

                                    Save Task

                                </button>

                                <a href="{{ route('tasks.index') }}"
                                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-8 py-4 rounded-2xl font-semibold transition">

                                    Cancel

                                </a>

                            </div>

                        </form>

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

                    <!-- AI Info -->
                    <div class="bg-white rounded-3xl shadow-xl p-6">

                        <div class="flex items-center gap-3 mb-4">

                            <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center text-2xl">

                                🤖

                            </div>

                            <div>

                                <h3 class="font-bold text-gray-800">

                                    AI Assistant

                                </h3>

                                <p class="text-sm text-gray-500">

                                    Smart task analysis

                                </p>

                            </div>

                        </div>

                        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4 text-blue-700 text-sm leading-7">

                            AI will automatically generate:
                            <br>
                            • Task Summary
                            <br>
                            • Priority Analysis
                            <br>
                            • Smart Insights

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

        // AI Loader
        const form = document.getElementById('taskForm');

        form.addEventListener('submit', function() {

            document
                .getElementById('aiLoader')
                .classList.remove('hidden');
        });
    </script>

</x-app-layout>
