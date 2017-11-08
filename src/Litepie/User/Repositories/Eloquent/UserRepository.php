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
        $this->fieldSearchable = config('users.user.model.search');
        return config('users.user.model.model');
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
    
    /**
     * Find a agents.
     *
     * @param type $id
     *
     * @return type
     */
    public function agents()
    {
        $temp = array();
        $agents = $this->model->select('id','name')->orderBy('name','ASC')->get();
        foreach ($agents as $key => $value) {
            $temp[$value->id] = $value->name;
        }

        return $temp;
    }
}
