<?php

namespace Litepie\Roles\Repositories\Eloquent;

use Litepie\Repository\BaseRepository;
use Litepie\Roles\Interfaces\PermissionRepositoryInterface;

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
