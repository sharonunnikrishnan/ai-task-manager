<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

use App\Repositories\Contracts\TaskRepositoryInterface;

use App\Services\TaskService;

class TaskController extends Controller
{
    public function __construct(
        protected TaskRepositoryInterface $repo,
        protected TaskService $taskService
    ) {}

    /**
     * Display all tasks
     */
    public function index()
    {
        $tasks = $this->repo->all();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $users = User::all();

        return view('tasks.create', compact('users'));
    }

    /**
     * Store task
     */
    public function store(StoreTaskRequest $request)
    {
        $this->taskService
            ->store($request->validated());

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    /**
     * Show single task
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);

        return view('tasks.show', compact('task'));
    }

    /**
     * Show edit form
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $users = User::all();

        return view('tasks.edit', compact(
            'task',
            'users'
        ));
    }

    /**
     * Update task
     */
    public function update(
        UpdateTaskRequest $request,
        Task $task
    ) {
        $this->authorize('update', $task);

        $this->repo->update(
            $task->id,
            $request->validated()
        );

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Delete task
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $this->repo->delete($task->id);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
}
