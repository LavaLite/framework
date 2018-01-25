<?php

namespace Litepie\User\Repositories\Eloquent;

use Litepie\User\Interfaces\ClientRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class ClientRepository extends BaseRepository implements ClientRepositoryInterface
{


    public function boot()
    {
        $type = request('type');
        $this->fieldSearchable = config('users.' . $type . '.model.search');

    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        $type = request('type');
        return config('users.' . $type . '.model.model');
    }
}
