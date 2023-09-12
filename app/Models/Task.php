<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//class Task extends Model
//{
//    use HasFactory;
//}
class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'priority',
        'title',
        'description',
        'createdAt',
        'completedAt',
    ];
    public function subtasks()
    {
        return $this->hasMany(Subtask::class);
    }
    public function hasUnfinishedSubtasks()
    {
        return $this->subtasks()->where('status', 'todo')->exists();
    }

}
