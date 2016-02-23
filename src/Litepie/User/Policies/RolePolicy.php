<?php

namespace Litepie\User\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Litepie\User\Models\Role;

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
        return false;
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
        return false;
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
        return false;
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
