<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{

    public const INDEX_GAP = 6000;

    use HasFactory;

    protected $guarded = [];

    // A task belongs to a task type
    public function taskType()
    {
        return $this->belongsTo(TaskType::class);
    }

    // A task belongs to a task status
    public function taskStatus()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function taskPriority()
    {
        return $this->belongsTo(TaskPriority::class);
    }

    // A task can belong to multiple board columns through pivot table
    public function boardColumns()
    {
        return $this->belongsToMany(BoardColumn::class, 'board_column_tasks')
                    ->withPivot('index')
                    ->withTimestamps();
    }
}
