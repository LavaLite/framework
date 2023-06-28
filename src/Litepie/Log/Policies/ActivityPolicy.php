<?php

namespace Litepie\Log\Policies;

use Litepie\User\Interfaces\UserPolicyInterface;
use Litepie\Log\Models\Activity;

class ActivityPolicy
{


    /**
     * Determine if the given user can view the activity.
     *
     * @param UserPolicyInterface $authUser
     * @param Activity $activity
     *
     * @return bool
     */
    public function view(UserPolicyInterface $authUser, Activity $activity)
    {
        if ($authUser->canDo('log.activity.view') && $authUser->isAdmin()) {
            return true;
        }

        return $activity->user_id == user_id() && $activity->user_type == user_type();
    }

    /**
     * Determine if the given user can create a activity.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function create(UserPolicyInterface $authUser)
    {
        return  $authUser->canDo('log.activity.create');
    }

    /**
     * Determine if the given user can update the given activity.
     *
     * @param UserPolicyInterface $authUser
     * @param Activity $activity
     *
     * @return bool
     */
    public function update(UserPolicyInterface $authUser, Activity $activity)
    {
        if ($authUser->canDo('log.activity.edit') && $authUser->isAdmin()) {
            return true;
        }

        return $activity->user_id == user_id() && $activity->user_type == user_type();
    }

    /**
     * Determine if the given user can delete the given activity.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function destroy(UserPolicyInterface $authUser, Activity $activity)
    {
        return $activity->user_id == user_id() && $activity->user_type == user_type();
    }

    /**
     * Determine if the given user can verify the given activity.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function verify(UserPolicyInterface $authUser, Activity $activity)
    {
        if ($authUser->canDo('log.activity.verify')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given activity.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function approve(UserPolicyInterface $authUser, Activity $activity)
    {
        if ($authUser->canDo('log.activity.approve')) {
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
