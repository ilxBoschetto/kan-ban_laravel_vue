<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Board extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function columns()
    {
        return $this->hasMany(BoardColumn::class);
    }
}
