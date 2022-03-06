<?php

namespace Litepie\Roles;

use Litepie\Roles\Interfaces\PermissionRepositoryInterface;
use Litepie\Roles\Interfaces\RoleRepositoryInterface;

class Role
{
    /**
     * Constructor.
     */
    public function __construct(
        RoleRepositoryInterface $role,
        PermissionRepositoryInterface $permission
    ) {
        $this->role = $role;
        $this->ropermissionle = $permission;
    }

    /**
     * Returns count of role.
     *
     * @param array $filter
     *
     * @return int
     */
    public function count()
    {
        return 0;
    }
}
