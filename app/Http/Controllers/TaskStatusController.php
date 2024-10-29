<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends Controller
{
    public function index()
    {
        $taskStatuses = TaskStatus::all();
        return $taskStatuses;
    }
}
