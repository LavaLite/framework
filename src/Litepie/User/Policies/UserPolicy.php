<?php

namespace Litepie\User\Policies;

use Litepie\User\Interfaces\UserPolicyInterface;
use Litepie\User\Interfaces\UserRepositoryInterface;

class UserPolicy
{
    /**
     * Determine if the given user can view the user.
     *
     * @param UserPolicyInterface     $authUser
     * @param UserRepositoryInterface $user
     *
     * @return bool
     */
    public function view(UserPolicyInterface $authUser, UserRepositoryInterface $user)
    {
        return false;
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
        return  false;
    }

    /**
     * Determine if the given user can update the given user.
     *
     * @param UserPolicyInterface     $authUser
     * @param UserRepositoryInterface $user
     *
     * @return bool
     */
    public function update(UserPolicyInterface $authUser, UserRepositoryInterface $user)
    {
        return false;
    }

    /**
     * Determine if the given user can delete the given user.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function destroy(UserPolicyInterface $authUser, UserRepositoryInterface $user)
    {
        return false;
    }

    /**
     * Determine if the user can perform a given action ve.
     *
     * @param [type] $authUserRepositoryInterface    [description]
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
