<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use \App\Models\TaskType;
use Illuminate\Http\Request;

class TaskTypeController extends Controller
{
    public function index()
    {
        $types = TaskType::all();
        return $types;
    }
}
