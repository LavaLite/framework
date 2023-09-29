<?php

namespace Litepie\Notification\Policies;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Litepie\Notification\Models\Notification;

class NotificationPolicy
{


    /**
     * Determine if the given user can view the notification.
     *
     * @param Authenticatable $user
     * @param Notification $notification
     *
     * @return bool
     */
    public function view(Authenticatable $user, Notification $notification)
    {
        if ($user->canDo('notification.notification.view') && $user->isAdmin()) {
            return true;
        }

        return $notification->user_id == user_id() && $notification->user_type == user_type();
    }

    /**
     * Determine if the given user can create a notification.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function create(Authenticatable $user)
    {
        return  $user->canDo('notification.notification.create');
    }

    /**
     * Determine if the given user can update the given notification.
     *
     * @param Authenticatable $user
     * @param Notification $notification
     *
     * @return bool
     */
    public function update(Authenticatable $user, Notification $notification)
    {
        if ($user->canDo('notification.notification.edit') && $user->isAdmin()) {
            return true;
        }

        return $notification->user_id == user_id() && $notification->user_type == user_type();
    }

    /**
     * Determine if the given user can delete the given notification.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function destroy(Authenticatable $user, Notification $notification)
    {
        return $notification->user_id == user_id() && $notification->user_type == user_type();
    }

    /**
     * Determine if the given user can verify the given notification.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function verify(Authenticatable $user, Notification $notification)
    {
        if ($user->canDo('notification.notification.verify')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given notification.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function approve(Authenticatable $user, Notification $notification)
    {
        if ($user->canDo('notification.notification.approve')) {
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
