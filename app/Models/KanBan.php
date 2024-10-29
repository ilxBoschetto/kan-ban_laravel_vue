<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KanBan extends Model
{
    public function __invoke(){
        return view('admin.layout');
    }
}
