<?php

namespace Litepie\Roles\Repositories\Eloquent;

use Litepie\Roles\Interfaces\PermissionRepositoryInterface;
use Litepie\Repository\BaseRepository;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
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
        return config('role.permission.model.model');
    }
}
