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

        return $user->id == $message->user_id && get_class($user) == $message->user_type;
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
        return $user->id == $message->user_id && get_class($user) == $message->user_type;
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
        return $user->id == $message->user_id && get_class($user) == $message->user_type;
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
    }
}
