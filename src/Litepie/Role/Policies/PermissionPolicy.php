<?php

namespace Litepie\Role\Policies;

use Litepie\User\Interfaces\UserPolicyInterface;
use Litepie\Role\Models\Permission;

class PermissionPolicy
{


    /**
     * Determine if the given user can view the permission.
     *
     * @param UserPolicyInterface $authUser
     * @param Permission $permission
     *
     * @return bool
     */
    public function view(UserPolicyInterface $authUser, Permission $permission)
    {
        return false;
    }

    /**
     * Determine if the given user can create a permission.
     *
     * @param UserPolicyInterface $authUser
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
     * @param UserPolicyInterface $authUser
     * @param Permission $permission
     *
     * @return bool
     */
    public function update(UserPolicyInterface $authUser, Permission $permission)
    {
        return false;
    }

    /**
     * Determine if the given user can delete the given permission.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function destroy(UserPolicyInterface $authUser, Permission $permission)
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
