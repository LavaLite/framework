<?php

namespace Litepie\Alerts\Policies;

use App\User;
use Litepie\Alerts\Models\Notification;

class NotificationPolicy
{

    /**
     * Determine if the given user can view the notification.
     *
     * @param User $user
     * @param Notification $notification
     *
     * @return bool
     */
    public function view(User $user, Notification $notification)
    {
        if ($user->canDo('alerts.notification.view') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.view') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $notification->user_id;
    }

    /**
     * Determine if the given user can create a notification.
     *
     * @param User $user
     * @param Notification $notification
     *
     * @return bool
     */
    public function create(User $user)
    {
        return  $user->canDo('alerts.notification.create');
    }

    /**
     * Determine if the given user can update the given notification.
     *
     * @param User $user
     * @param Notification $notification
     *
     * @return bool
     */
    public function update(User $user, Notification $notification)
    {
        if ($user->canDo('alerts.notification.update') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.update') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $notification->user_id;
    }

    /**
     * Determine if the given user can delete the given notification.
     *
     * @param User $user
     * @param Notification $notification
     *
     * @return bool
     */
    public function destroy(User $user, Notification $notification)
    {
        if ($user->canDo('alerts.notification.delete') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.delete') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $notification->user_id;
    }

    /**
     * Determine if the given user can verify the given notification.
     *
     * @param User $user
     * @param Notification $notification
     *
     * @return bool
     */
    public function verify(User $user, Notification $notification)
    {
        if ($user->canDo('alerts.notification.verify') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('alerts.notification.verify') 
        && $user->is('manager')
        && $notification->user->parent_id == $user->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given notification.
     *
     * @param User $user
     * @param Notification $notification
     *
     * @return bool
     */
    public function approve(User $user, Notification $notification)
    {
        if ($user->canDo('alerts.notification.approve') && $user->is('admin')) {
            return true;
        }

        return false;
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
        if ($user->isSuperUser()) {
            return true;
        }
    }
}
