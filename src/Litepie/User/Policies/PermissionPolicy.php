<?php

namespace Litepie\User\Policies;

use App\User;
use Litepie\User\Models\Permission;

class PermissionPolicy
{

    /**
     * Determine if the given user can view the permission.
     *
     * @param User $user
     * @param Permission $permission
     *
     * @return bool
     */
    public function view(User $user, Permission $permission)
    {
        return false;
    }

    /**
     * Determine if the given user can create a permission.
     *
     * @param User $user
     * @param Permission $permission
     *
     * @return bool
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine if the given user can update the given permission.
     *
     * @param User $user
     * @param Permission $permission
     *
     * @return bool
     */
    public function update(User $user, Permission $permission)
    {
        return false;
    }

    /**
     * Determine if the given user can delete the given permission.
     *
     * @param User $user
     * @param Permission $permission
     *
     * @return bool
     */
    public function destroy(User $user, Permission $permission)
    {
        return false;
    }

    /**
     * Determine if the given user can verify the given permission.
     *
     * @param User $user
     * @param Permission $permission
     *
     * @return bool
     */
    public function verify(User $user, Permission $permission)
    {
        return false;
    }

    /**
     * Determine if the given user can approve the given permission.
     *
     * @param User $user
     * @param Permission $permission
     *
     * @return bool
     */
    public function approve(User $user, Permission $permission)
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
        if ($user->isSuperUser()) {
            return true;
        }
    }
}
