<x-app-layout>

    <div class="py-8">

        <div class="max-w-4xl mx-auto px-4">

            <div class="bg-white rounded-2xl shadow p-8">

                <h1 class="text-3xl font-bold text-gray-800 mb-8">
                    Create New Task
                </h1>

                <form method="POST" action="{{ route('tasks.store') }}">

                    @csrf

                    <!-- Title -->
                    <div class="mb-5">

                        <label class="block text-sm font-medium mb-2">
                            Task Title
                        </label>

                        <input type="text" name="title" class="w-full border-gray-300 rounded-lg shadow-sm">

                    </div>

                    <!-- Description -->
                    <div class="mb-5">

                        <label class="block text-sm font-medium mb-2">
                            Description
                        </label>

                        <textarea name="description" rows="5" class="w-full border-gray-300 rounded-lg shadow-sm"></textarea>

                    </div>

                    <!-- Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <!-- Priority -->
                        <div>

                            <label class="block text-sm font-medium mb-2">
                                Priority
                            </label>

                            <select name="priority" class="w-full border-gray-300 rounded-lg shadow-sm">

                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>

                            </select>

                        </div>

                        <!-- Due Date -->
                        <div>

                            <label class="block text-sm font-medium mb-2">
                                Due Date
                            </label>

                            <input type="date" name="due_date" class="w-full border-gray-300 rounded-lg shadow-sm">

                        </div>

                    </div>

                    <!-- Assigned User -->
                    <div class="mt-5">

                        <label class="block text-sm font-medium mb-2">
                            Assign User
                        </label>

                        <select name="assigned_to" class="w-full border-gray-300 rounded-lg shadow-sm">

                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <!-- Buttons -->
                    <div class="mt-8 flex gap-3">

                        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg">
                            Save Task
                        </button>

                        <a href="{{ route('tasks.index') }}" class="bg-gray-200 hover:bg-gray-300 px-6 py-3 rounded-lg">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
