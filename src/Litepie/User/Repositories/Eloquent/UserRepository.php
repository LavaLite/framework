<?php

namespace Litepie\User\Repositories\Eloquent;

use Litepie\User\Interfaces\UserRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
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
        $this->fieldSearchable = config('litepie.user.user.search');
        return config('litepie.user.user.model');
    }

    
    /**
     * Find a user by its id.
     *
     * @param type $id
     *
     * @return type
     */
    public function findUser($id)
    {
        return $this->model->whereId($id)->first();
    }
}
