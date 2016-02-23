<?php

namespace Litepie\User\Traits;

use Litepie\User\Traits\Permissions\InteractsWithPermissions;
use Litepie\User\Traits\Users\HasRoles;

/**
 * Trait HasPermission.
 */
trait CheckPermission
{
    use HasRoles, InteractsWithPermissions;

    /**
     * @var \Illuminate\Support\Collection
     */
    private $cachedPermissions;

    /**
     * @var \Illuminate\Support\Collection
     */
    private $cachedRolePermissions;

    /**
     * Returns if the current user has the given permission.
     * User permissions override role permissions.
     *
     * @param string $permission
     * @param bool   $force
     *
     * @return bool
     */
    public function hasPermission($permission, $force = false)
    {
        $permissions = $this->getAllPermissions($force);

        return array_key_exists($permission, $permissions);
    }

    /**
     * Checks for permission
     * If has superuser group automatically passes.
     *
     * @param string $permission
     * @param bool   $force
     *
     * @return bool
     */
    public function canDo($permission, $force = false)
    {
        // If has superuser role
        if ($this->isSuperUser()) {
            return true;
        }

        return $this->hasPermission($permission, $force);
    }

    /**
     * check has superuser role.
     *
     * @return bool
     */
    public function isSuperUser()
    {
        return $this->hasRole(config('user.superuser_role', 'superuser'));
    }

    /**
     * Check if the user has the given permission using
     * only his roles.
     *
     * @param string $permission
     * @param bool   $force
     *
     * @return bool
     */
    public function roleHasPermission($permission, $force = false)
    {
        $permissions = $this->getRolesPermissions($force);

        return array_key_exists($permission, $permissions);
    }

    /**
     * Retrieve all user permissions.
     *
     * @param bool $force
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllPermissions($force = false)
    {
        if (empty($this->cachedPermissions) or $force) {
            $this->cachedPermissions = $this->getFreshAllPermissions();
        }

        return $this->cachedPermissions;
    }

    /**
     * @param bool $force
     *
     * @return \Illuminate\Support\Collection
     */
    public function getRolesPermissions($force = false)
    {
        if (empty($this->cachedRolePermissions) or $force) {
            $this->cachedRolePermissions = $this->getFreshRolesPermissions();
        }

        return $this->cachedRolePermissions;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    protected function getFreshRolesPermissions()
    {
        $roles = $this->roles()->get(['permissions']);
        $permissions = [];

        foreach ($roles as $role) {
            if (!empty($role->permissions)) {
                $permissions = array_merge($permissions, $role->permissions);
            }
        }

        return $permissions;
    }

    /**
     * Get fresh permissions from database.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getFreshAllPermissions()
    {
        $permissionsRoles = $this->getRolesPermissions(true);

        $permissions = empty($this->permissions) ? [] : $this->permissions;
        $permissions = array_merge($permissions, $permissionsRoles);

        return $permissions;
    }

    /**
     * Find a user by its id.
     *
     * @param int $id
     *
     * @return \Litepie\User\Contracts\User
     */
    public function findById($id)
    {
        return $this->find($id);
    }
}
