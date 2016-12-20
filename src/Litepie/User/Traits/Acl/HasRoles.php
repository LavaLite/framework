<?php

namespace Litepie\User\Traits\Acl;

/**
 * Trait HasRoles.
 */
trait HasRoles
{
    /**
     * Returns true if the given user has any of the given roles.
     *
     * @param string|array $roles array or many strings of role name
     *
     * @return bool
     */
    public function hasRoles($roles)
    {
        $roles = is_array($roles) ? $roles : func_get_args();

        foreach ($roles as $role) {

            if ($this->hasRole($role)) {
                return true;
            }

        }

        return false;
    }

    /**
     * Returns if the given user has an specific role.
     *
     * @param string $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->roles
            ->where('name', $role)
            ->first() != null;
    }


    /**
     * check has superuser role.
     *
     * @return bool
     */
    public function isSuperUser()
    {
        return $this->hasRole(config('litepie.user.superuser_role', 'superuser'));
    }

    /**
     * Attach the given role.
     *
     * @param \Litepie\User\Role $role
     */
    public function attachRole($role)
    {

        if (!$this->hasRole($role)) {
            $this->roles()->attach($role);
        }

    }

    /**
     * Many-to-many role-user relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        $roleModel = config('litepie.user.role.model', 'Litepie\User\Models\Role');
        $roleKey = config('litepie.user.role.key', 'roleable');       
        return $this->morphToMany($roleModel, $roleKey);
    }

    /**
     * Detach the given role from the model.
     *
     * @param \Litepie\User\Role $role
     *
     * @return int
     */
    public function detachRole($role)
    {
        return $this->roles()->detach($role);
    }

    /**
     * Sync the given roles.
     *
     * @param array $roles
     *
     * @return array
     */
    public function syncRoles($roles)
    {

        if (is_array($roles)) {
            return $this->roles()->sync($roles);
        }

        return $this->roles()->sync([]);
    }

    /**
     * Take user by roles.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @param string|array                       $roles
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeWhichRoles($query, $roles)
    {
        return $query->whereHas('roles', function ($query) use ($roles) {
            $roles = (is_array($roles)) ? $roles : [$roles];

            $query->whereIn('name', $roles);
        });
    }

}
