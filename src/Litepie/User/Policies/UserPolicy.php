<?php

namespace Litepie\User\Policies;

use Litepie\User\Interfaces\UserPolicyInterface;
use Litepie\User\Models\User;

class UserPolicy
{


    /**
     * Determine if the given user can view the user.
     *
     * @param UserPolicyInterface $authUser
     * @param User $user
     *
     * @return bool
     */
    public function view(UserPolicyInterface $authUser, User $user)
    {
        if ($authUser->canDo('user.user.view') && $authUser->isAdmin()) {
            return true;
        }

        return $user->user_id == user_id() && $user->user_type == user_type();
    }

    /**
     * Determine if the given user can create a user.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function create(UserPolicyInterface $authUser)
    {
        return  $authUser->canDo('user.user.create');
    }

    /**
     * Determine if the given user can update the given user.
     *
     * @param UserPolicyInterface $authUser
     * @param User $user
     *
     * @return bool
     */
    public function update(UserPolicyInterface $authUser, User $user)
    {
        if ($authUser->canDo('user.user.edit') && $authUser->isAdmin()) {
            return true;
        }

        return $user->user_id == user_id() && $user->user_type == user_type();
    }

    /**
     * Determine if the given user can delete the given user.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function destroy(UserPolicyInterface $authUser, User $user)
    {
        return $user->user_id == user_id() && $user->user_type == user_type();
    }

    /**
     * Determine if the given user can verify the given user.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function verify(UserPolicyInterface $authUser, User $user)
    {
        if ($authUser->canDo('user.user.verify')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given user.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function approve(UserPolicyInterface $authUser, User $user)
    {
        if ($authUser->canDo('user.user.approve')) {
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
