<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Models\Task;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {

    $totalTasks = Task::count();

    $pendingTasks = Task::where(
        'status',
        'pending'
    )->count();

    $completedTasks = Task::where(
        'status',
        'completed'
    )->count();

    $highPriorityTasks = Task::where(
        'priority',
        'high'
    )->count();

    $recentTasks = Task::latest()
        ->take(5)
        ->get();

    return view('dashboard', compact(

        'totalTasks',

        'pendingTasks',

        'completedTasks',

        'highPriorityTasks',

        'recentTasks'
    ));

})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {

    Route::resource('tasks', TaskController::class);
});

require __DIR__.'/auth.php';
