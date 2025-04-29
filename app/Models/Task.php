<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    
    public function solutions()
    {
        return $this->hasMany(Solution::class);
    }    
}
