<?php

namespace Litepie\Roles\Policies;

use Litepie\User\Contracts\UserPolicy;
use Litepie\Roles\Models\Role;

class RolePolicy
{

    /**
     * Determine if the given user can view the role.
     *
     * @param UserPolicy $user
     * @param Role $role
     *
     * @return bool
     */
    public function view(UserPolicy $user, Role $role)
    {
        if ($user->canDo('roles.role.view') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.view') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $role->user_id;
    }

    /**
     * Determine if the given user can create a role.
     *
     * @param UserPolicy $user
     * @param Role $role
     *
     * @return bool
     */
    public function create(UserPolicy $user)
    {
        return  $user->canDo('roles.role.create');
    }

    /**
     * Determine if the given user can update the given role.
     *
     * @param UserPolicy $user
     * @param Role $role
     *
     * @return bool
     */
    public function update(UserPolicy $user, Role $role)
    {
        if ($user->canDo('roles.role.update') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.update') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $role->user_id;
    }

    /**
     * Determine if the given user can delete the given role.
     *
     * @param UserPolicy $user
     * @param Role $role
     *
     * @return bool
     */
    public function destroy(UserPolicy $user, Role $role)
    {
        if ($user->canDo('roles.role.delete') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.delete') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $role->user_id;
    }

    /**
     * Determine if the given user can verify the given role.
     *
     * @param UserPolicy $user
     * @param Role $role
     *
     * @return bool
     */
    public function verify(UserPolicy $user, Role $role)
    {
        if ($user->canDo('roles.role.verify') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('roles.role.verify') 
        && $user->is('manager')
        && $role->user->parent_id == $user->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given role.
     *
     * @param UserPolicy $user
     * @param Role $role
     *
     * @return bool
     */
    public function approve(UserPolicy $user, Role $role)
    {
        if ($user->canDo('roles.role.approve') && $user->is('admin')) {
            return true;
        }

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
