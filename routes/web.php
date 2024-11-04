<?php

use App\Http\Controllers\TaskTypeController;
use App\Models\KanBan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardColumnTaskController;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\BoardColumnController;
use App\Http\Controllers\BoardController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/api/kanban', [BoardColumnTaskController::class, 'index']);
Route::get('/api/tasktypes', [TaskTypeController::class, 'index']);
Route::get('/api/taskstatuses', [TaskStatusController::class, 'index']);
Route::put('/api/updateTaskIndex', [BoardColumnTaskController::class, 'updateTaskIndex']);
Route::post('/api/column', [BoardColumnController::class, 'create']);
Route::delete('/api/column/{id}', [BoardColumnController::class, 'delete']);
Route::get('{view}', KanBan::class)->where('view', '(.*)');