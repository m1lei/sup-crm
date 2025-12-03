<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     *

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        //
        return $user->isAdmin() || $user->id === $task->assignee_id || $user->id === $task->deal->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        //
        return $user->isAdmin() || $user->id === $task->assignee_id || $user->id === $task->deal->user_id;
    }
}
