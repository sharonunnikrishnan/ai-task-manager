<x-app-layout>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">

            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">
                        Task Management
                    </h1>

                    <p class="text-gray-500 mt-1">
                        Manage all project tasks efficiently
                    </p>
                </div>

                <a href="{{ route('tasks.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-lg shadow">
                    + Create Task
                </a>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-5">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Table -->
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
                                Assigned User
                            </th>

                            <th class="text-left px-6 py-4">
                                Due Date
                            </th>

                            <th class="text-left px-6 py-4">
                                Actions
                            </th>

                        </tr>
                    </thead>

                    <tbody>

                        @forelse($tasks as $task)
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

                                <td class="px-6 py-4">
                                    {{ $task->user->name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $task->due_date }}
                                </td>

                                <td class="px-6 py-4 flex gap-2">

                                    @can('view', $task)
                                        <a href="{{ route('tasks.show', $task->id) }}"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded">

                                            View

                                        </a>
                                    @endcan

                                    @can('update', $task)
                                        <a href="{{ route('tasks.edit', $task->id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded">

                                            Edit

                                        </a>
                                    @endcan

                                    @can('delete', $task)
                                        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">

                                            @csrf
                                            @method('DELETE')

                                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded">

                                                Delete

                                            </button>

                                        </form>
                                    @endcan

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center py-10 text-gray-500">

                                    No Tasks Found

                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- Pagination -->
            <div class="mt-5">
                {{ $tasks->links() }}
            </div>

        </div>
    </div>

</x-app-layout>
