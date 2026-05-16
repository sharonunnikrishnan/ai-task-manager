<?php

namespace App\Http\Controllers;

use App\Models\Task;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        // Search
        if ($request->search) {

            $query->where(
                'title',
                'like',
                '%' . $request->search . '%'
            );
        }

        // Status Filter
        if ($request->status) {

            $query->where(
                'status',
                $request->status
            );
        }

        // Priority Filter
        if ($request->priority) {

            $query->where(
                'priority',
                $request->priority
            );
        }

        // Role-based access
        if (auth()->user()->role !== 'admin') {

            $query->where(
                'assigned_to',
                auth()->id()
            );
        }

        $tasks = $query
            ->latest()
            ->get();

        return view('dashboard', [

            'tasks' => $tasks,

            'totalTasks' => Task::count(),

            'pendingTasks' => Task::where(
                'status',
                'pending'
            )->count(),

            'completedTasks' => Task::where(
                'status',
                'completed'
            )->count(),

            'highPriorityTasks' => Task::where(
                'priority',
                'high'
            )->count(),
        ]);
    }
}
