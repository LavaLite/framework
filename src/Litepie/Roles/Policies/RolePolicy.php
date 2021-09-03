<?php

namespace Litepie\Roles\Policies;

use Litepie\User\Interfaces\UserPolicyInterface;
use Litepie\Roles\Interfaces\RoleRepositoryInterface;

class RolePolicy
{

    /**
     * Determine if the given user can view the role.
     *
     * @param UserPolicyInterface $authUser
     * @param RoleRepositoryInterface $role
     *
     * @return bool
     */
    public function view(UserPolicyInterface $authUser, RoleRepositoryInterface $role)
    {
        if ($authUser->canDo('role.role.view')) {
            return true;
        }

        return $role->user_id == user_id() && $role->user_type == user_type();
    }

    /**
     * Determine if the given user can create a role.
     *
     * @param UserPolicyInterface $authUser
     * @param RoleRepositoryInterface $role
     *
     * @return bool
     */
    public function create(UserPolicyInterface $authUser)
    {
        return  $authUser->canDo('role.role.create');
    }

    /**
     * Determine if the given user can update the given role.
     *
     * @param UserPolicyInterface $authUser
     * @param RoleRepositoryInterface $role
     *
     * @return bool
     */
    public function update(UserPolicyInterface $authUser, RoleRepositoryInterface $role)
    {
        if ($authUser->canDo('role.role.edit')) {
            return true;
        }

        return $role->user_id == user_id() && $role->user_type == user_type();
    }

    /**
     * Determine if the given user can delete the given role.
     *
     * @param UserPolicyInterface $authUser
     * @param RoleRepositoryInterface $role
     *
     * @return bool
     */
    public function destroy(UserPolicyInterface $authUser, RoleRepositoryInterface $role)
    {
        return $role->user_id == user_id() && $role->user_type == user_type();
    }

    /**
     * Determine if the given user can verify the given role.
     *
     * @param UserPolicyInterface $authUser
     * @param RoleRepositoryInterface $role
     *
     * @return bool
     */
    public function verify(UserPolicyInterface $authUser, RoleRepositoryInterface $role)
    {
        if ($authUser->canDo('role.role.verify')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given role.
     *
     * @param UserPolicyInterface $authUser
     * @param RoleRepositoryInterface $role
     *
     * @return bool
     */
    public function approve(UserPolicyInterface $authUser, RoleRepositoryInterface $role)
    {
        if ($authUser->canDo('role.role.approve')) {
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
