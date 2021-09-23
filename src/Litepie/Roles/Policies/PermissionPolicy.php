<?php

namespace Litepie\Roles\Policies;

use Litepie\Roles\Interfaces\PermissionRepositoryInterface;
use Litepie\User\Interfaces\UserPolicyInterface;

class PermissionPolicy
{
    /**
     * Determine if the given user can view the permission.
     *
     * @param UserPolicyInterface           $authUser
     * @param PermissionRepositoryInterface $permission
     *
     * @return bool
     */
    public function view(UserPolicyInterface $authUser, PermissionRepositoryInterface $permission)
    {
        return false;
    }

    /**
     * Determine if the given user can create a permission.
     *
     * @param UserPolicyInterface           $authUser
     * @param PermissionRepositoryInterface $permission
     *
     * @return bool
     */
    public function create(UserPolicyInterface $authUser)
    {
        return false;
    }

    /**
     * Determine if the given user can update the given permission.
     *
     * @param UserPolicyInterface           $authUser
     * @param PermissionRepositoryInterface $permission
     *
     * @return bool
     */
    public function update(UserPolicyInterface $authUser, PermissionRepositoryInterface $permission)
    {
        return false;
    }

    /**
     * Determine if the given user can delete the given permission.
     *
     * @param UserPolicyInterface           $authUser
     * @param PermissionRepositoryInterface $permission
     *
     * @return bool
     */
    public function destroy(UserPolicyInterface $authUser, PermissionRepositoryInterface $permission)
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
