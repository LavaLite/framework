<?php

namespace Litepie\User\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Lavalite\Package\Models\Permission;

class PermissionPolicy
{
    use HandlesAuthorization;

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
        if ($user->canDo('package.permission.view')) {
            return true;
        }

        return $user->id === $permission->user_id;
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
        return  $user->canDo('package.permission.create');
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
        if ($user->canDo('package.permission.update')) {
            return true;
        }

        return $user->id === $permission->user_id;
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
        if ($user->canDo('package.permission.delete')) {
            return true;
        }

        return $user->id === $permission->user_id;
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