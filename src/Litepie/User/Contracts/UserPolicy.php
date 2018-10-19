<?php

namespace Litepie\User\Contracts;

/**
 * User policy interface.
 */
interface UserPolicy
{
    /**
     * Check if the user has at least one role.
     *
     * @param int|string|array $role
     *
     * @return bool
     */
    public function hasRole($role);

    /**
     * Check if the user has the permission.
     *
     * @param int|string|array $permission
     *
     * @return bool
     */
    public function canDo($permission);
}
