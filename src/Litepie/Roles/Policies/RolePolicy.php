<?php

namespace Litepie\Roles\Policies;

use Litepie\Roles\Models\Role;
use Litepie\User\Contracts\UserPolicy;

class RolePolicy
{
    /**
     * Determine if the given user can view the role.
     *
     * @param UserPolicy $user
     * @param Role       $role
     *
     * @return bool
     */
    public function view(UserPolicy $user, Role $role)
    {
        return false;
    }

    /**
     * Determine if the given user can create a role.
     *
     * @param UserPolicy $user
     * @param Role       $role
     *
     * @return bool
     */
    public function create(UserPolicy $user)
    {
        return  false;
    }

    /**
     * Determine if the given user can update the given role.
     *
     * @param UserPolicy $user
     * @param Role       $role
     *
     * @return bool
     */
    public function update(UserPolicy $user, Role $role)
    {
        return false;
    }

    /**
     * Determine if the given user can delete the given role.
     *
     * @param UserPolicy $user
     * @param Role       $role
     *
     * @return bool
     */
    public function destroy(UserPolicy $user, Role $role)
    {
        return false;
    }

    /**
     * Determine if the given user can verify the given role.
     *
     * @param UserPolicy $user
     * @param Role       $role
     *
     * @return bool
     */
    public function verify(UserPolicy $user, Role $role)
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
