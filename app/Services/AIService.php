<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Str;
use OpenAI;

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

    // public function generateSummary(Task $task): array
    // {
    //     $client = OpenAI::client(
    //         env('OPENAI_API_KEY')
    //     );

    //     $prompt = "
    //         Analyze this task.

    //         Generate:
    //         1. Short summary
    //         2. Priority level

    //         Title: {$task->title}
    //         Description: {$task->description}
    //     ";

    //     $response = $client->chat()->create([

    //         'model' => 'gpt-3.5-turbo',

    //         'messages' => [

    //             [
    //                 'role' => 'user',
    //                 'content' => $prompt
    //             ]
    //         ],
    //     ]);

    //     $content =
    //         $response->choices[0]
    //         ->message
    //         ->content;

    //     return [

    //         'ai_summary' => $content,

    //         'ai_priority' => 'high'
    //     ];
    // }
}
