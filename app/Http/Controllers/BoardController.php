<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function get()
    {
        $id = \request()->id;
        $board = Board::find($id);
        return $board;
    }
}
