<?php

namespace Litepie\User\Repositories\Eloquent;

use Litepie\User\Interfaces\ClientRepositoryInterface;
use Litepie\Repository\BaseRepository;


class ClientRepository extends BaseRepository implements ClientRepositoryInterface
{

    public function boot()
    {
        $this->fieldSearchable = config('user.client.model.search');
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('user.client.model.model');
    }

}
