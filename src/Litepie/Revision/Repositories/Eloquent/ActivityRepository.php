<?php

namespace Litepie\Revision\Repositories\Eloquent;

use Litepie\Revision\Interfaces\ActivityRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class ActivityRepository extends BaseRepository implements ActivityRepositoryInterface
{
    /**
     * Booting the repository.
     *
     * @return null
     */
    public function boot()
    {
        $this->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'));
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        $this->fieldSearchable = config('litepie.revision.activity.search');
        return config('litepie.revision.activity.model');
    }
}
