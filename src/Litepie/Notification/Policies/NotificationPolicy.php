<?php

namespace Litepie\Notification\Policies;

use Litepie\User\Interfaces\UserPolicyInterface;
use Litepie\Notification\Models\Notification;

class NotificationPolicy
{


    /**
     * Determine if the given user can view the notification.
     *
     * @param UserPolicyInterface $authUser
     * @param Notification $notification
     *
     * @return bool
     */
    public function view(UserPolicyInterface $authUser, Notification $notification)
    {
        if ($authUser->canDo('notification.notification.view') && $authUser->isAdmin()) {
            return true;
        }

        return $notification->user_id == user_id() && $notification->user_type == user_type();
    }

    /**
     * Determine if the given user can create a notification.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function create(UserPolicyInterface $authUser)
    {
        return  $authUser->canDo('notification.notification.create');
    }

    /**
     * Determine if the given user can update the given notification.
     *
     * @param UserPolicyInterface $authUser
     * @param Notification $notification
     *
     * @return bool
     */
    public function update(UserPolicyInterface $authUser, Notification $notification)
    {
        if ($authUser->canDo('notification.notification.edit') && $authUser->isAdmin()) {
            return true;
        }

        return $notification->user_id == user_id() && $notification->user_type == user_type();
    }

    /**
     * Determine if the given user can delete the given notification.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function destroy(UserPolicyInterface $authUser, Notification $notification)
    {
        return $notification->user_id == user_id() && $notification->user_type == user_type();
    }

    /**
     * Determine if the given user can verify the given notification.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function verify(UserPolicyInterface $authUser, Notification $notification)
    {
        if ($authUser->canDo('notification.notification.verify')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given notification.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function approve(UserPolicyInterface $authUser, Notification $notification)
    {
        if ($authUser->canDo('notification.notification.approve')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the user can perform a given action ve.
     *
     * @param [type] $authUser    [description]
     * @param [type] $ability [description]
     *
     * @return [type] [description]
     */
    public function before($authUser, $ability)
    {
        if ($authUser->isSuperuser()) {
            return true;
        }
    }
}
