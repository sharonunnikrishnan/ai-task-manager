<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreTaskRequest;

use App\Http\Resources\TaskResource;

use App\Repositories\Contracts\TaskRepositoryInterface;

use App\Services\TaskService;

use Illuminate\Http\Request;

class TaskApiController extends Controller
{
    public function __construct(
        protected TaskRepositoryInterface $repo,
        protected TaskService $taskService
    ) {}

    /**
     * GET /api/tasks
     */
    public function index()
    {
        $tasks = $this->repo->all();

        return TaskResource::collection($tasks);
    }

    /**
     * POST /api/tasks
     */
    public function store(StoreTaskRequest $request)
    {
        $task = $this->taskService
            ->store($request->validated());

        return response()->json([

            'message' => 'Task created successfully',

            'data' => new TaskResource($task)

        ], 201);
    }

    /**
     * PATCH /api/tasks/{id}/status
     */
    public function updateStatus(Request $request, int $id)
    {
        $request->validate([

            'status' => 'required|in:pending,in_progress,completed'
        ]);

        $updatedTask = $this->repo
            ->updateStatus($id, $request->status);

        return response()->json([

            'message' => 'Task status updated',

            'data' => new TaskResource($updatedTask)

        ], 200);
    }

    /**
     * GET /api/tasks/{id}/ai-summary
     */
    public function aiSummary(int $id)
    {
        $task = $this->repo->find($id);

        return response()->json([

            'task_id' => $task->id,

            'title' => $task->title,

            'ai_summary' => $task->ai_summary,

            'ai_priority' => $task->ai_priority

        ], 200);
    }
}
