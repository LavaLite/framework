<?php

namespace Litepie\Role\Traits;

use Illuminate\Support\Str;
use Litepie\Role\Models\Role;

trait CheckRoleAndPermission
{

    protected $role;

    /**
     * Check if the user has a specific role.
     *
     * @param  string  $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->role->slug == $role;
    }

    /**
     * Check if the user has a specific permission.
     *
     * @param  string  $permission
     * @return bool
     */
    public function canDo($permission)
    {
        return $this->role->hasPermission($permission);
    }

    /**
     * Dynamically handle calls to the class.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (Str::startsWith($method, 'is')) {
            return $this->hasRole(Str::snake(substr($method, 2), config('role.separator', '.')));
        }

        return parent::__call($method, $parameters);
    }

    /**
     * Set the user's role.
     *
     * @param  string  $role
     * @return void
     */
    public function setRole($role)
    {
        $this->role = app(Role::class)->findBySlug($role);
    }
}