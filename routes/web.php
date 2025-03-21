<?php

use App\Http\Controllers\TaskTypeController;
use App\Http\Controllers\UserController;
use App\Models\KanBan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardColumnTaskController;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskPriorityController;
use App\Http\Controllers\BoardColumnController;
use App\Http\Controllers\BoardController;

Route::get('/', function () {
    return redirect('/kanban');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/api/kanban', [BoardColumnTaskController::class, 'index']);

    /**
     * Task info
     */
    Route::get('/api/tasktypes', [TaskTypeController::class, 'index']);
    Route::get('/api/taskstatuses', [TaskStatusController::class, 'index']);
    Route::get('/api/taskpriorities', [TaskPriorityController::class, 'index']);


    /**
     * Columns
     */
    Route::post('/api/column', [BoardColumnController::class, 'create']);
    Route::put('/api/column/{id}', [BoardColumnController::class, 'update']);
    Route::delete('/api/column/{id}', [BoardColumnController::class, 'delete']);

    /**
     * Tasks
     */
    Route::get('/api/alltasks', [BoardColumnTaskController::class, 'getAllTasks']);
    Route::post('/api/task', [BoardColumnTaskController::class, 'create']);
    Route::put('/api/task/{id}', [BoardColumnTaskController::class, 'update']);
    Route::delete('/api/task/{id}', [BoardColumnTaskController::class, 'delete']);

    Route::put('/api/updateTaskIndex', [BoardColumnTaskController::class, 'updateTaskIndex']);

    /**
     * Users
     */
    Route::get('/api/get_logged_user', [UserController::class, 'getLoggedUser']);
    Route::post('/api/update_logged_user', [UserController::class, 'updateLoggedUser']);

    Route::get('{view}', KanBan::class)->where('view', '(.*)');

});

Route::fallback(function () {
    return redirect('/kanban');
});