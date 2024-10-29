<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BoardColumn extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    // A board column can have many tasks
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'board_column_tasks')
                    ->withPivot('index')
                    ->withTimestamps();
    }
}
