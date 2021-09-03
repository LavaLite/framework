<?php

namespace Litepie\User\Repositories\Eloquent;

use Litepie\User\Interfaces\UserRepositoryInterface;
use Litepie\Repository\BaseRepository;


class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    public function boot()
    {
        $this->fieldSearchable = config('user.user.model.search');
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('user.user.model.model');
    }

}
