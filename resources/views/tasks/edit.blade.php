<x-app-layout>

    <div class="py-8">

        <div class="max-w-4xl mx-auto px-4">

            <div class="bg-white rounded-2xl shadow p-8">

                <!-- Header -->
                <div class="flex items-center justify-between mb-8">

                    <div>

                        <h1 class="text-3xl font-bold text-gray-800">
                            Edit Task
                        </h1>

                        <p class="text-gray-500 mt-1">
                            Update task details and assignment
                        </p>

                    </div>

                    <a href="{{ route('tasks.index') }}"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg">

                        ← Back

                    </a>

                </div>

                <!-- Validation Errors -->
                @if ($errors->any())

                    <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">

                        <ul class="list-disc pl-5">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('tasks.update', $task->id) }}">

                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-5">

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Task Title
                        </label>

                        <input type="text" name="title" value="{{ old('title', $task->title) }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

                    </div>

                    <!-- Description -->
                    <div class="mb-5">

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>

                        <textarea name="description" rows="6"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $task->description) }}</textarea>

                    </div>

                    <!-- Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <!-- Priority -->
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Priority
                            </label>

                            <select name="priority"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

                                <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>
                                    Low
                                </option>

                                <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>
                                    Medium
                                </option>

                                <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>
                                    High
                                </option>

                            </select>

                        </div>

                        <!-- Status -->
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Status
                            </label>

                            <select name="status"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

                                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>

                                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>
                                    In Progress
                                </option>

                                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>
                                    Completed
                                </option>

                            </select>

                        </div>

                    </div>

                    <!-- Second Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">

                        <!-- Due Date -->
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Due Date
                            </label>

                            <input type="date" name="due_date" value="{{ old('due_date', $task->due_date) }}"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

                        </div>

                        <!-- Assigned User -->
                        <div>

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Assigned User
                            </label>

                            <select name="assigned_to"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">

                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $task->assigned_to == $user->id ? 'selected' : '' }}>

                                        {{ $user->name }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                    <!-- AI Info Box -->
                    <div class="mt-8 bg-indigo-50 border border-indigo-100 rounded-xl p-5">

                        <div class="flex items-center gap-3 mb-3">

                            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                🤖
                            </div>

                            <div>

                                <h3 class="font-semibold text-indigo-700">
                                    AI Generated Information
                                </h3>

                                <p class="text-sm text-indigo-500">
                                    Auto generated task analysis
                                </p>

                            </div>

                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            <div>

                                <div class="text-sm text-gray-500 mb-2">
                                    AI Summary
                                </div>

                                <div class="bg-white rounded-lg p-4 text-gray-700 text-sm leading-6">

                                    {{ $task->ai_summary ?? 'No AI summary available.' }}

                                </div>

                            </div>

                            <div>

                                <div class="text-sm text-gray-500 mb-2">
                                    AI Priority
                                </div>

                                <div class="inline-block bg-red-100 text-red-700 px-4 py-2 rounded-full">

                                    {{ ucfirst($task->ai_priority ?? 'low') }}

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="mt-8 flex items-center gap-3">

                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg shadow">

                            Update Task

                        </button>

                        <a href="{{ route('tasks.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
