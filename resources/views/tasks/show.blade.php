<x-app-layout>

    <div class="py-8">

        <div class="max-w-5xl mx-auto px-4">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Main Task -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow p-8">

                    <h1 class="text-3xl font-bold text-gray-800 mb-4">
                        {{ $task->title }}
                    </h1>

                    <div class="flex gap-3 mb-5">

                        <span class="bg-indigo-100 text-indigo-700 px-4 py-1 rounded-full text-sm">
                            {{ ucfirst($task->priority) }} Priority
                        </span>

                        <span class="bg-green-100 text-green-700 px-4 py-1 rounded-full text-sm">
                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        </span>

                    </div>

                    <div class="border-t pt-5">

                        <h3 class="font-semibold text-lg mb-3">
                            Description
                        </h3>

                        <p class="text-gray-600 leading-7">
                            {{ $task->description }}
                        </p>

                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-5">

                        <div class="bg-gray-50 p-5 rounded-xl">

                            <div class="text-sm text-gray-500">
                                Assigned User
                            </div>

                            <div class="font-semibold mt-1">
                                {{ $task->user->name }}
                            </div>

                        </div>

                        <div class="bg-gray-50 p-5 rounded-xl">

                            <div class="text-sm text-gray-500">
                                Due Date
                            </div>

                            <div class="font-semibold mt-1">
                                {{ $task->due_date }}
                            </div>

                        </div>

                    </div>

                </div>

                <!-- AI Section -->
                <div class="bg-white rounded-2xl shadow p-6">

                    <div class="flex items-center gap-2 mb-5">

                        <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                            🤖
                        </div>

                        <div>

                            <h3 class="font-bold text-lg">
                                AI Analysis
                            </h3>

                            <p class="text-sm text-gray-500">
                                AI Generated Insights
                            </p>

                        </div>

                    </div>

                    <!-- AI Summary -->
                    <div class="mb-5">

                        <div class="text-sm text-gray-500 mb-2">
                            AI Summary
                        </div>

                        <div class="bg-gray-50 rounded-xl p-4 text-gray-700 leading-7">

                            {{ $task->ai_summary }}

                        </div>

                    </div>

                    <!-- AI Priority -->
                    <div>

                        <div class="text-sm text-gray-500 mb-2">
                            AI Priority
                        </div>

                        <div class="inline-block bg-red-100 text-red-700 px-4 py-2 rounded-full">

                            {{ ucfirst($task->ai_priority) }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
