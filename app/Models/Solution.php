<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Solution extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'task_id',
        'content',
        'points_obtained',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }      
}
