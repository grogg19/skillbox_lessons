<?php

namespace App\Broadcasting;

use App\Models\Task;
use App\Models\User;

class TaskChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param User $user
     * @param Task $task
     * @return bool
     */
    public function join(User $user, Task $task)
    {
        return $user->id == $task->owner_id;
    }
}
