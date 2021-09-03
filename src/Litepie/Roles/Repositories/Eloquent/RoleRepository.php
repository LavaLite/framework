<?php

namespace Litepie\Roles\Repositories\Eloquent;

use Litepie\Roles\Interfaces\RoleRepositoryInterface;
use Litepie\Repository\BaseRepository;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{


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
        return config('role.role.model.model');
    }
}
