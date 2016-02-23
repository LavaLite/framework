<?php

namespace Litepie\User\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Lavalite\Package\Models\Role;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can view the role.
     *
     * @param User $user
     * @param Role $role
     *
     * @return bool
     */
    public function view(User $user, Role $role)
    {
        if ($user->canDo('package.role.view')) {
            return true;
        }

        return $user->id === $role->user_id;
    }

    /**
     * Determine if the given user can create a role.
     *
     * @param User $user
     * @param Role $role
     *
     * @return bool
     */
    public function create(User $user)
    {
        return  $user->canDo('package.role.create');
    }

    /**
     * Determine if the given user can update the given role.
     *
     * @param User $user
     * @param Role $role
     *
     * @return bool
     */
    public function update(User $user, Role $role)
    {
        if ($user->canDo('package.role.update')) {
            return true;
        }

        return $user->id === $role->user_id;
    }

    /**
     * Determine if the given user can delete the given role.
     *
     * @param User $user
     * @param Role $role
     *
     * @return bool
     */
    public function destroy(User $user, Role $role)
    {
        if ($user->canDo('package.role.delete')) {
            return true;
        }

        return $user->id === $role->user_id;
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