<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BoardColumnTask extends Pivot
{
    protected $table = 'board_column_tasks';
    protected $guarded = [];
    const INDEX_GAP = 60000;

    public static function booted()
    {
        static::creating(function($model){
            $model->index = self::query()->where('id', $model->id)->orderByDesc('index')->first()?->position + self::INDEX_GAP;
        });
    }
}
