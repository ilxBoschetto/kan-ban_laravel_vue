<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BoardColumn;
use Illuminate\Http\Request;

class BoardColumnController extends Controller
{
    const COLUMN_GAP = 1000;
    public function index()
    {
        $boardId = \request()->boardId;
        $columns = BoardColumn::where('board_id', $boardId)->orderBy('index')->get();
        return $columns;
    }

    public function create()
    {
        $lastedColumn = BoardColumn::orderBy('index','desc')->first();
        $latestIndex = $lastedColumn ? $lastedColumn->index + self::COLUMN_GAP : self::COLUMN_GAP;
        $column = BoardColumn::create([
            'name' => \request()->name,
            'background' => \request()->background_color ?? '#000000',
            'index' => $latestIndex,
            'board_id' => 1,
        ]);
        $column->tasks = [];
        return $column;
    }

    public function delete($id)
    {
        $column = BoardColumn::findOrFail($id);
        $column->delete();
        return 200;
    }

    public function update($id)
    {
        return BoardColumn::findOrFail($id)->update([
            'name' => \request()->name,
            'background' => \request()->background_color ?? '#000000',
        ]);
    }
}
