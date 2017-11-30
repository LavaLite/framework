<?php

namespace Litepie\Task\Policies;

use Litepie\Task\Models\Task;
use Litepie\User\Contracts\UserPolicy;

class TaskPolicy
{
    /**
     * Determine if the given user can view the task.
     *
     * @param User $user
     * @param Task $task
     *
     * @return bool
     */
    public function view(UserPolicy $user, Task $task)
    {
        if ($user->canDo('task.task.view') && $user->isAdmin()) {
            return true;
        }

        return $user->id == $task->user_id && get_class($user) === $task->user_type;
    }

    /**
     * Determine if the given user can create a task.
     *
     * @param User $user
     * @param Task $task
     *
     * @return bool
     */
    public function create(UserPolicy $user)
    {
        return  $user->canDo('task.task.create');
    }

    /**
     * Determine if the given user can update the given task.
     *
     * @param User $user
     * @param Task $task
     *
     * @return bool
     */
    public function update(UserPolicy $user, Task $task)
    {
        if ($user->canDo('task.task.update') && $user->isAdmin()) {
            return true;
        }

        return $user->id == $task->user_id && get_class($user) === $task->user_type;
    }


    /**
     * Determine if the given user can delete the given task.
     *
     * @param User $user
     * @param Task $task
     *
     * @return bool
     */
    public function destroy(UserPolicy $user, Task $task)
    {
        if ($user->canDo('task.task.delete') && $user->isAdmin()) {
            return true;
        }

        return $user->id == $task->user_id && get_class($user) === $task->user_type;
    }

    /**
     * Determine if the given user can verify the given task.
     *
     * @param User $user
     * @param Task $task
     *
     * @return bool
     */
    public function verify(UserPolicy $user, Task $task)
    {
        if ($user->canDo('task.task.verify') && $user->isAdmin()) {
            return true;
        }


        return false;
    }

    /**
     * Determine if the given user can approve the given task.
     *
     * @param User $user
     * @param News $task
     *
     * @return bool
     */
    public function approve(UserPolicy $user, Task $task)
    {
        if ($user->canDo('task.task.approve') && $user->isAdmin()) {
            return true;
        }

        return false;
    }
    /**
     * Determine if the user can perform a given action ve.
     *
     * @param [type] $user    [description]
     * @param [type] $ability [description]
     *
     * @return [type] [description]
     */
    public function before($user, $ability)
    {
        if ($user->isSuperuser()) {
            return true;
        }
    }
}
