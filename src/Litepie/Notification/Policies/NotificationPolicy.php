<?php

namespace Litepie\Notification\Policies;

use Litepie\Notification\Models\Notification;
use Litepie\User\Models\User;

class NotificationPolicy
{
    /**
     * Determine if the given user can view the notification.
     *
     * @param User         $user
     * @param Notification $notification
     *
     * @return bool
     */
    public function view(User $user, Notification $notification)
    {
        if ($user->canDo('alerts.notification.view') && $user->isAdmin()) {
            return true;
        }

        return $user->id == $notification->user_id;
    }

    /**
     * Determine if the given user can create a notification.
     *
     * @param User         $user
     * @param Notification $notification
     *
     * @return bool
     */
    public function create(User $user)
    {
        return $user->canDo('alerts.notification.create');
    }

    /**
     * Determine if the given user can update the given notification.
     *
     * @param User         $user
     * @param Notification $notification
     *
     * @return bool
     */
    public function update(User $user, Notification $notification)
    {
        if ($user->canDo('alerts.notification.update') && $user->isAdmin()) {
            return true;
        }

        return $user->id == $notification->user_id;
    }

    /**
     * Determine if the given user can delete the given notification.
     *
     * @param User         $user
     * @param Notification $notification
     *
     * @return bool
     */
    public function destroy(User $user, Notification $notification)
    {
        if ($user->canDo('alerts.notification.delete') && $user->isAdmin()) {
            return true;
        }

        return $user->id == $notification->user_id;
    }

    /**
     * Determine if the user can perform a given alerts ve.
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
