<?php

namespace Litepie\Roles\Repositories\Eloquent;

use Litepie\Roles\Interfaces\RoleRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    /**
     * @var array
     */
    public function boot()
    {

    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        $this->fieldSearchable = config('litepie.role.role.search');
        return config('litepie.role.role.model');
    }

    /**
     * Find a user by its key.
     *
     * @param type $key
     *
     * @return type
     */
    public function findRoleByKey($key)
    {
        return $this->model->whereKey($key)->first();
    }
}
