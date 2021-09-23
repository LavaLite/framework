<?php

namespace Litepie\Roles\Repositories\Eloquent;

use Litepie\Repository\BaseRepository;
use Litepie\Roles\Interfaces\RoleRepositoryInterface;

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
