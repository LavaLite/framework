<?php

namespace Litepie\User\Repositories\Eloquent;

use Litepie\User\Interfaces\TeamRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class TeamRepository extends BaseRepository implements TeamRepositoryInterface
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
        return config('litepie.user.team.model');
    }
}
