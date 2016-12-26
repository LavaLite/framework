<?php

namespace Litepie\Message\Policies;

use Litepie\Message\Models\Message;
use Litepie\User\Contracts\UserPolicy;

class MessagePolicy
{
    /**
     * Determine if the given user can view the message.
     *
     * @param User $user
     * @param Message $message
     *
     * @return bool
     */
    public function view(UserPolicy $user, Message $message)
    {
        if ($user->canDo('message.message.view') && $user->hasRole('admin')) {
            return true;
        }

        if ($user->canDo('message.message.view') 
        && $user->hasRole('manager')
        && $message->user->parent_id == $user->id
        && get_class($user) === $user->user_type) {
            return true;
        }

        return $user->id === $message->user_id && get_class($user) === $message->user_type;
    }

    /**
     * Determine if the given user can create a message.
     *
     * @param User $user
     * @param Message $message
     *
     * @return bool
     */
    public function create(UserPolicy $user)
    {
        return  $user->canDo('message.message.create');
    }

    /**
     * Determine if the given user can update the given message.
     *
     * @param User $user
     * @param Message $message
     *
     * @return bool
     */
    public function update(UserPolicy $user, Message $message)
    {  
        if ($user->canDo('message.message.update') && $user->hasRole('admin')) {
            return true;
        }

        if ($user->canDo('message.message.update') 
            && $user->hasRole('manager') 
            && $message->user->parent_id == $user->id
            && get_class($user) === $user->user_type) {
            return true;
        }

        return $user->id === $message->user_id && get_class($user) === $message->user_type;
    }

    /**
     * Determine if the given user can delete the given message.
     *
     * @param User $user
     * @param Message $message
     *
     * @return bool
     */
    public function destroy(UserPolicy $user, Message $message)
    {    

        if ($user->canDo('message.message.delete') && $user->hasRole('admin')) {
            return true;
        }

        if ($user->canDo('message.message.delete') 
        && $user->hasRole('manager')
        && $message->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $message->user_id && get_class($user) === $message->user_type;
    }

    /**
     * Determine if the given user can verify the given message.
     *
     * @param User $user
     * @param Message $message
     *
     * @return bool
     */
    public function verify(UserPolicy $user, Message $message)
    {
        if ($user->canDo('message.message.verify') && $user->hasRole('admin')) {
            return true;
        }

        if ($user->canDo('message.message.verify') 
        && $user->hasRole('manager')
        && $message->user->parent_id == $user->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given message.
     *
     * @param User $user
     * @param Message $message
     *
     * @return bool
     */
    public function approve(UserPolicy $user, Message $message)
    {
        if ($user->canDo('message.message.approve') && $user->hasRole('admin')) {
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
    public function before(UserPolicy $user, $ability)
    {
        if ($user->hasRole('superuser')) {
            return true;
        }
        return true;
    }
}
