<?php

namespace Litepie\Role\Policies;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Litepie\Role\Models\Permission;

class PermissionPolicy
{


    /**
     * Determine if the given user can view the permission.
     *
     * @param Authenticatable $user
     * @param Permission $permission
     *
     * @return bool
     */
    public function view(Authenticatable $user, Permission $permission)
    {
        return false;
    }

    /**
     * Determine if the given user can create a permission.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function create(Authenticatable $user)
    {
        return false;
    }

    /**
     * Determine if the given user can update the given permission.
     *
     * @param Authenticatable $user
     * @param Permission $permission
     *
     * @return bool
     */
    public function update(Authenticatable $user, Permission $permission)
    {
        return false;
    }

    /**
     * Determine if the given user can delete the given permission.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function destroy(Authenticatable $user, Permission $permission)
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
