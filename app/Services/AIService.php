<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Str;

class AIService
{
    public function generateSummary(Task $task): array
    {
        return [

            'ai_summary' =>
                'AI Summary: ' .
                Str::limit($task->description, 120),

            'ai_priority' => $task->priority
        ];
    }
}
