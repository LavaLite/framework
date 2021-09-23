<?php

namespace Litepie\Roles\Policies;

use Litepie\Roles\Interfaces\RoleRepositoryInterface;
use Litepie\User\Interfaces\UserPolicyInterface;

class RolePolicy
{
    /**
     * Determine if the given user can view the role.
     *
     * @param UserPolicyInterface     $authUser
     * @param RoleRepositoryInterface $role
     *
     * @return bool
     */
    public function view(UserPolicyInterface $authUser, RoleRepositoryInterface $role)
    {
        return false;
    }

    /**
     * Determine if the given user can create a role.
     *
     * @param UserPolicyInterface     $authUser
     * @param RoleRepositoryInterface $role
     *
     * @return bool
     */
    public function create(UserPolicyInterface $authUser)
    {
        return false;
    }

    /**
     * Determine if the given user can update the given role.
     *
     * @param UserPolicyInterface     $authUser
     * @param RoleRepositoryInterface $role
     *
     * @return bool
     */
    public function update(UserPolicyInterface $authUser, RoleRepositoryInterface $role)
    {
        return false;
    }

    /**
     * Determine if the given user can delete the given role.
     *
     * @param UserPolicyInterface     $authUser
     * @param RoleRepositoryInterface $role
     *
     * @return bool
     */
    public function destroy(UserPolicyInterface $authUser, RoleRepositoryInterface $role)
    {
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
