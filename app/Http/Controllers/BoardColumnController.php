<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BoardColumn;
use Illuminate\Http\Request;

class BoardColumnController extends Controller
{
    public function index()
    {
        $columns = BoardColumn::all();
        return $columns;
    }
}
