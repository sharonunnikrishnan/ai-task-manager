<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\TaskApiController;

Route::get('/tasks', [
    TaskApiController::class,
    'index'
]);

Route::post('/tasks', [
    TaskApiController::class,
    'store'
]);

Route::patch('/tasks/{id}/status', [
    TaskApiController::class,
    'updateStatus'
]);

Route::get('/tasks/{id}/ai-summary', [
    TaskApiController::class,
    'aiSummary'
]);
