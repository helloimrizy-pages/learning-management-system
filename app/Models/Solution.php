<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    
    public function student()
    {
        return $this->belongsTo(User::class);
    }    
}
