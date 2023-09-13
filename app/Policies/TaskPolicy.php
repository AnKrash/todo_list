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

    /**
     * Determine whether the user can update the task.
     *
     * @param User $user
     * @param Task $task
     * @return bool
     */
    public function update(User $user, Task $task)
    {
        // Перевіряє, чи користувач є власником завдання та воно не виконане
        return $user->id === $task->user_id && $task->status !== 'done';
    }

    /**
     * Determine whether the user can delete the task.
     *
     * @param User $user
     * @param Task $task
     * @return bool
     */
    public function delete(User $user, Task $task)
    {
        // Перевіряє, чи користувач є власником завдання та воно не виконане
        return $user->id === $task->user_id && $task->status !== 'done';
    }

    /**
     * Determine whether the user can complete the task.
     *
     * @param User $user
     * @param Task $task
     * @return bool
     */
    public function complete(User $user, Task $task)
    {
        // Перевіряє, чи користувач є власником завдання та в ньому немає незавершених підзавдань
        return $user->id === $task->user_id && $task->subtasks()->where('status', 'todo')->count() === 0;
    }
}
