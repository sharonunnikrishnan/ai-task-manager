<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreTaskRequest;
use App\Repositories\Contracts\TaskRepositoryInterface;
use App\Services\TaskService;

class TaskController extends Controller
{
    public function __construct(
        protected TaskRepositoryInterface $repo,
        protected TaskService $taskService
    ) {}

    public function index()
    {
        $tasks = $this->repo->all();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $users = User::all();

        return view('tasks.create', compact('users'));
    }

    public function store(StoreTaskRequest $request)
    {
        $this->taskService
            ->store($request->validated());

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task Created');
    }
}
