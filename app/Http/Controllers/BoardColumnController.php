<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BoardColumn;
use Illuminate\Http\Request;

class BoardColumnController extends Controller
{
    public function index()
    {
        $boardId = \request()->boardId;
        $columns = BoardColumn::where('board_id', $boardId)->orderBy('index')->get();
        return $columns;
    }
}
