<?php

namespace Litepie\Roles\Repositories\Eloquent;

use Litepie\Repository\Eloquent\BaseRepository;
use Litepie\Roles\Interfaces\PermissionRepositoryInterface;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    public function boot()
    {
        $this->fieldSearchable = config('roles.permission.search');
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('roles.permission.model.model');
    }

    /**
     * Returns all users with given role.
     *
     * @return mixed
     */
    public function groupedPermissions($grouped = false)
    {
        $result = $this->model->orderBy('slug')->get()->pluck('id', 'slug')->toArray();

        $array = [];

        foreach ($result as $key => $value) {
            $key = explode('.', $key, 4);
            @$array[$key[0]][$key[1]][$key[2]] = $value;
        }

        return $array;
    }

    /**
     * Create a new permission using the given name.
     *
     * @param string $name
     * @param string $slug
     *
     * @throws PermissionExistsException
     *
     * @return Permission
     */
    public function createPermission($name, $slug = null)
    {
        if (!is_null($this->findByName($name))) {
            throw new PermissionExistsException('The permission '.$name.' already exists'); // TODO: add translation support
        }

        // Do we have a display_name set?
        $slug = is_null($slug) ? $name : $slug;

        return $permission = $this->model->create([
            'name' => $name,
            'slug' => $slug,
        ]);
    }

    /**
     * @param array $rolesIds
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByRoles(array $rolesIds)
    {
        return $this->model->whereHas('roles', function ($query) use ($rolesIds) {
            $query->whereIn('id', $rolesIds);
        })->get();
    }

    /**
     * @param $user
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getActivesByUser($user)
    {
        $table = $user->permissions()->getTable();

        return $user->permissions()
            ->where($table.'.value', true)
            ->where(function ($q) use ($table) {
                $q->where($table.'.expires', '>=', Carbon::now());
                $q->orWhereNull($table.'.expires');
            })
            ->get();
    }
}
