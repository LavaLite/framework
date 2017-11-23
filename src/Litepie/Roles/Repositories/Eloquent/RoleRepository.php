<?php

namespace Litepie\Roles\Repositories\Eloquent;

use Litepie\Roles\Interfaces\RoleRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{


    public function boot()
    {
        $this->fieldSearchable = config('roles.role.search');

    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('roles.role.model.model');
    }

    /**
     * Find a user by its key.
     *
     * @param type $key
     *
     * @return type
     */
    public function findRoleBySlug($key)
    {
        return $this->model->whereSlug($key)->first();
    }
}
