<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\Task;
use App\Models\BoardColumnTask;
use Illuminate\Http\Request;

class BoardColumnTaskController extends Controller
{
    public function index()
    {
        $boardId = \request()->boardId;
        $board = Board::with(['columns.tasks' => function($query) {
                    $query->orderBy('index'); // Order tasks by index
                },
                'columns.tasks.taskType',
                'columns.tasks.taskStatus'])
            ->findOrFail($boardId);
        return $board;
    }

    public function updateTaskIndex()
    {
        $taskId = \request()->params["taskId"];
        $newIndex = \request()->params["index"];
        $columnId = \request()->params["columnId"];
        $task = Task::find($taskId);
        $boardColumnTask = BoardColumnTask::where('task_id', $task->id)->first();
        $boardColumnTask->update([
            'index' => $newIndex,
            'board_column_id' => $columnId
        ]);
        return $newIndex;
    }
}
