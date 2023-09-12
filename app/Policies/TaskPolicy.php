<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function update(User $user, Task $task)
    {
        // Check if the user owns the task and it's not completed
        return $user->id === $task->user_id && $task->status !== 'done';
    }

    public function delete(User $user, Task $task)
    {
        // Check if the user owns the task and it's not completed
        return $user->id === $task->user_id && $task->status !== 'done';
    }

    public function complete(User $user, Task $task)
    {
        // Check if the user owns the task and it has no unfinished subtasks
        return $user->id === $task->user_id && $task->subtasks()->where('status', 'todo')->count() === 0;
    }
}
