<?php

use App\Models\KanBan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardColumnTaskController;
use App\Http\Controllers\BoardColumnController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('{view}', KanBan::class)->where('view', '(.*)');
Route::get('/tasks', [BoardColumnTaskController::class, 'index']);
Route::get('/columns', [BoardColumnController::class, 'index']);