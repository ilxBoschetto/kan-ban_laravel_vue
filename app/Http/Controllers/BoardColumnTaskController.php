<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\BoardColumn;
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
        $taskId = \request()->taskId;
        $newIndex = \request()->index;
        $columnId = \request()->columnId;
        $task = Task::find($taskId);
        $boardColumnTask = BoardColumnTask::where('task_id', $task->id)->first();
        $boardColumnTask->update([
            'index' => $newIndex,
            'board_column_id' => $columnId
        ]);
        return $newIndex;
    }

    public function create()
    {
        $task = new Task();
        $task->name = \request()->name;
        $task->description = \request()->description ?? '';
        $task->task_type_id = \request()->task_type_id;
        $task->task_status_id = \request()->task_status_id;
        $task->save();

        $column = BoardColumn::findOrFail(\request()->column_id);

        // Trova il valore minimo di index esistente
        $minIndex = $column->tasks()->min('board_column_tasks.index');

        // Se ci sono già task, posiziona la nuova task prima della prima esistente
        $newIndex = $minIndex ? $minIndex / 2 : Task::INDEX_GAP;

        // Associa la task alla colonna con il nuovo index nella tabella pivot
        $column->tasks()->attach($task->id, ['index' => $newIndex]);

        // Ricarica la task con la relazione boardColumns per ottenere i dati della pivot
        $task->load([
            'taskType',
            'taskStatus',
            'boardColumns' => function ($query) {
                $query->withPivot('board_column_id', 'index', 'created_at', 'updated_at');
            }
        ]);
    
        // Modifica il formato della risposta per restituire il pivot come parte principale
        $task->pivot = $task->boardColumns->first()->pivot ?? null;
        unset($task->boardColumns);
    
        return $task;
    }

}
