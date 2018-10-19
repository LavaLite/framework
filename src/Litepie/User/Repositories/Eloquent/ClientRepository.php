<?php

namespace Litepie\User\Repositories\Eloquent;

use Litepie\Repository\Eloquent\BaseRepository;
use Litepie\User\Interfaces\ClientRepositoryInterface;

class ClientRepository extends BaseRepository implements ClientRepositoryInterface
{
    public function boot()
    {
        $type = request('type', 'client');
        $this->fieldSearchable = config('users.'.$type.'.model.search');
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        $type = request('type', 'client');

        return config('users.'.$type.'.model.model');
    }
}
