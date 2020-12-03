<?php

namespace Litepie\Roles\Policies;

use Litepie\Roles\Models\Permission;
use Litepie\User\Contracts\UserPolicy;

class PermissionPolicy
{
    /**
     * Determine if the given user can view the permission.
     *
     * @param UserPolicy $user
     * @param Permission $permission
     *
     * @return bool
     */
    public function view(UserPolicy $user, Permission $permission)
    {
        return true;
    }

    /**
     * Determine if the given user can create a permission.
     *
     * @param UserPolicy $user
     * @param Permission $permission
     *
     * @return bool
     */
    public function create(UserPolicy $user)
    {
        return  true;
    }

    /**
     * Determine if the given user can update the given permission.
     *
     * @param UserPolicy $user
     * @param Permission $permission
     *
     * @return bool
     */
    public function update(UserPolicy $user, Permission $permission)
    {
        return true;
    }

    /**
     * Determine if the given user can delete the given permission.
     *
     * @param UserPolicy $user
     * @param Permission $permission
     *
     * @return bool
     */
    public function destroy(UserPolicy $user, Permission $permission)
    {
        return true;
    }

    /**
     * Determine if the given user can verify the given permission.
     *
     * @param UserPolicy $user
     * @param Permission $permission
     *
     * @return bool
     */
    public function verify(UserPolicy $user, Permission $permission)
    {
        return false;
    }

    /**
     * Determine if the given user can approve the given permission.
     *
     * @param UserPolicy $user
     * @param Permission $permission
     *
     * @return bool
     */
    public function approve(UserPolicy $user, Permission $permission)
    {
        return false;
    }

    /**
     * Determine if the user can perform a given action ve.
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
