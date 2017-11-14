<?php

namespace Litepie\Roles\Policies;

use Litepie\User\Contracts\UserPolicy;
use Litepie\Roles\Models\Permission;

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
        if ($user->canDo('roles.permission.view') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.view') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $permission->user_id;
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
        return  $user->canDo('roles.permission.create');
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
        if ($user->canDo('roles.permission.update') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.update') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $permission->user_id;
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
        if ($user->canDo('roles.permission.delete') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.delete') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $permission->user_id;
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
        if ($user->canDo('roles.permission.verify') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('roles.permission.verify') 
        && $user->is('manager')
        && $permission->user->parent_id == $user->id) {
            return true;
        }

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
        if ($user->canDo('roles.permission.approve') && $user->is('admin')) {
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
