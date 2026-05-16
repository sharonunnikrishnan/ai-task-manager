@php
    use Illuminate\Support\Str;
@endphp

<x-app-layout>

    <div class="min-h-screen bg-[#3a4152] py-8">

        <div class="max-w-7xl mx-auto px-4">

            <!-- Header -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-10">

                <div>

                    <h1 class="text-5xl font-bold text-white">
                        Task List
                    </h1>

                    <p class="text-slate-400 mt-3 text-lg">
                        AI Assisted Task Management System
                    </p>

                </div>

                <!-- Buttons -->
                <div class="flex gap-3">

                    <a href="{{ route('dashboard') }}"
                        class="bg-slate-700 hover:bg-slate-600 text-white px-5 py-3 rounded-2xl shadow-lg transition">

                        Dashboard

                    </a>

                    <a href="{{ route('tasks.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl shadow-lg transition">

                        + New Task

                    </a>

                </div>

            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-500/20 border border-green-500/30 text-green-300 px-5 py-4 rounded-2xl mb-8">

                    {{ session('success') }}

                </div>
            @endif

            <!-- Filters -->
            <form method="GET" action="{{ route('tasks.index') }}"
                class="bg-slate-800 rounded-3xl p-5 mb-8 border border-slate-700">

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <!-- Search -->
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Task"
                        class="bg-slate-700 border border-slate-600 text-white rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500">

                    <!-- Status -->
                    <select name="status" class="bg-slate-700 border border-slate-600 text-white rounded-xl px-4 py-3">

                        <option value="">
                            All Status
                        </option>

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
                    <select name="priority"
                        class="bg-slate-700 border border-slate-600 text-white rounded-xl px-4 py-3">

                        <option value="">
                            All Priority
                        </option>

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

                    <!-- Buttons -->
                    <div class="flex gap-3">

                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white rounded-xl px-5 py-3 font-semibold w-full">

                            Filter

                        </button>

                        <a href="{{ route('tasks.index') }}"
                            class="bg-slate-600 hover:bg-slate-500 text-white rounded-xl px-5 py-3 font-semibold flex items-center justify-center">

                            Reset

                        </a>

                    </div>

                </div>

            </form>

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                @forelse($tasks as $task)
                    <!-- Card -->
                    <div
                        class="bg-slate-800 border border-slate-700 rounded-3xl p-6 shadow-xl hover:scale-[1.02] transition duration-300">

                        <!-- Top -->
                        <div class="flex items-start justify-between mb-5">

                            <!-- Status -->
                            <div>

                                @if ($task->status == 'completed')
                                    <span
                                        class="bg-green-500/20 text-green-300 px-3 py-1 rounded-full text-xs font-semibold">

                                        ✅ Completed

                                    </span>
                                @elseif($task->status == 'in_progress')
                                    <span
                                        class="bg-blue-500/20 text-blue-300 px-3 py-1 rounded-full text-xs font-semibold">

                                        🚀 In Progress

                                    </span>
                                @else
                                    <span
                                        class="bg-slate-600 text-slate-300 px-3 py-1 rounded-full text-xs font-semibold">

                                        ⏳ Pending

                                    </span>
                                @endif

                            </div>

                            <!-- Dots -->
                            <div class="text-slate-500 text-xl">

                                ⋯

                            </div>

                        </div>

                        <!-- Title -->
                        <h2 class="text-2xl font-bold text-white mb-4 leading-snug">

                            {{ $task->title }}

                        </h2>

                        <!-- Description -->
                        <p class="text-slate-400 leading-7 text-sm mb-5">

                            {{ Str::limit($task->description, 120) }}

                        </p>

                        <!-- Priority -->
                        <div class="mb-5">

                            @if ($task->priority == 'high')
                                <span class="bg-red-500/20 text-red-300 px-4 py-2 rounded-full text-sm font-semibold">

                                    🔥 High Priority

                                </span>
                            @elseif($task->priority == 'medium')
                                <span
                                    class="bg-yellow-500/20 text-yellow-300 px-4 py-2 rounded-full text-sm font-semibold">

                                    ⚡ Medium Priority

                                </span>
                            @else
                                <span
                                    class="bg-green-500/20 text-green-300 px-4 py-2 rounded-full text-sm font-semibold">

                                    ✅ Low Priority

                                </span>
                            @endif

                        </div>

                        <!-- User -->
                        <div class="flex items-center gap-4 mb-6">

                            <div
                                class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">

                                {{ strtoupper(substr($task->user->name, 0, 1)) }}

                            </div>

                            <div>

                                <div class="text-white font-semibold">

                                    {{ $task->user->name }}

                                </div>

                                <div class="text-slate-400 text-sm">

                                    Due:
                                    {{ $task->due_date }}

                                </div>

                            </div>

                        </div>

                        <!-- AI Section -->
                        <div class="bg-slate-700/50 rounded-2xl p-4 mb-6 border border-slate-600">

                            <div class="flex items-center gap-2 mb-2">

                                <span class="text-lg">
                                    🤖
                                </span>

                                <span class="text-sm font-semibold text-blue-300">

                                    AI Summary

                                </span>

                            </div>

                            <p class="text-slate-300 text-sm leading-6">

                                {{ $task->ai_summary }}

                            </p>

                        </div>

                        <!-- Actions -->
                        <div class="flex flex-wrap gap-3">

                            @can('view', $task)
                                <a href="{{ route('tasks.show', $task->id) }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">

                                    View

                                </a>
                            @endcan

                            @can('update', $task)
                                <a href="{{ route('tasks.edit', $task->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">

                                    Edit

                                </a>
                            @endcan

                            @can('delete', $task)
                                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">

                                        Delete

                                    </button>

                                </form>
                            @endcan

                        </div>

                    </div>

                @empty

                    <div class="col-span-full">

                        <div class="bg-slate-800 border border-slate-700 rounded-3xl p-16 text-center">

                            <div class="text-7xl mb-5">
                                📋
                            </div>

                            <h2 class="text-3xl font-bold text-white mb-3">

                                No Tasks Found

                            </h2>

                            <p class="text-slate-400 text-lg">

                                Start by creating your first task

                            </p>

                        </div>

                    </div>
                @endforelse

            </div>

            <!-- Pagination -->
            <div class="mt-10">

                {{ $tasks->links() }}

            </div>

        </div>

    </div>

</x-app-layout>
