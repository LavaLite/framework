<?php

namespace Litepie\User\Repositories\Eloquent;

use Litepie\Repository\Eloquent\BaseRepository;
use Litepie\User\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @var array
     */
    public function boot()
    {
        $this->fieldSearchable = config('users.user.model.search');
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        $provider = config('auth.guards.'.getenv('guard').'.web.provider', 'users');

        return config("auth.providers.$provider.model", App\User::class);
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
        $temp = [];
        $agents = $this->model->select('id', 'name')->orderBy('name', 'ASC')->get();

        foreach ($agents as $key => $value) {
            $temp[$value->id] = $value->name;
        }

        return $temp;
    }

    /**
     * Activate user with the given id.
     *
     * @param type $id
     *
     * @return type
     */
    public function activate($id)
    {
        $user = $this->model->whereId($id)->whereStatus('New')->first();

        if (is_null($user)) {
            return false;
        }

        $user->status = 'Active';

        if ($user->save()) {
            return true;
        }

        return false;
    }
}
