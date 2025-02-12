<?php

namespace App\Http\Controllers;

use App\Models\TaskPriority;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskPriorityController extends Controller
{
    public function index()
    {
        $priorities = TaskPriority::all();
        return $priorities;
    }
}
