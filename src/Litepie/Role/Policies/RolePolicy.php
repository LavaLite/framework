<?php

namespace Litepie\Role\Policies;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Litepie\Role\Models\Role;

class RolePolicy
{


    /**
     * Determine if the given user can view the role.
     *
     * @param Authenticatable $user
     * @param Role $role
     *
     * @return bool
     */
    public function view(Authenticatable $user, Role $role)
    {
        return false;
    }

    /**
     * Determine if the given user can create a role.
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
     * Determine if the given user can update the given role.
     *
     * @param Authenticatable $user
     * @param Role $role
     *
     * @return bool
     */
    public function update(Authenticatable $user, Role $role)
    {
        return false;
    }

    /**
     * Determine if the given user can delete the given role.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function destroy(Authenticatable $user, Role $role)
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
