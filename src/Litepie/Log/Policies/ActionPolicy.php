<?php

namespace Litepie\Log\Policies;

use Litepie\User\Interfaces\UserPolicyInterface;
use Litepie\Log\Models\Action;

class ActionPolicy
{


    /**
     * Determine if the given user can view the action.
     *
     * @param UserPolicyInterface $authUser
     * @param Action $action
     *
     * @return bool
     */
    public function view(UserPolicyInterface $authUser, Action $action)
    {
        if ($authUser->canDo('log.action.view') && $authUser->isAdmin()) {
            return true;
        }

        return $action->user_id == user_id() && $action->user_type == user_type();
    }

    /**
     * Determine if the given user can create a action.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function create(UserPolicyInterface $authUser)
    {
        return  $authUser->canDo('log.action.create');
    }

    /**
     * Determine if the given user can update the given action.
     *
     * @param UserPolicyInterface $authUser
     * @param Action $action
     *
     * @return bool
     */
    public function update(UserPolicyInterface $authUser, Action $action)
    {
        if ($authUser->canDo('log.action.edit') && $authUser->isAdmin()) {
            return true;
        }

        return $action->user_id == user_id() && $action->user_type == user_type();
    }

    /**
     * Determine if the given user can delete the given action.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function destroy(UserPolicyInterface $authUser, Action $action)
    {
        return $action->user_id == user_id() && $action->user_type == user_type();
    }

    /**
     * Determine if the given user can verify the given action.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function verify(UserPolicyInterface $authUser, Action $action)
    {
        if ($authUser->canDo('log.action.verify')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given action.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function approve(UserPolicyInterface $authUser, Action $action)
    {
        if ($authUser->canDo('log.action.approve')) {
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
