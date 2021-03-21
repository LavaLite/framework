<?php

namespace Litepie\Activities\Repositories\Eloquent;

use Litepie\Activities\Interfaces\ActivityLogRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class ActionLogRepository extends BaseRepository implements ActivityLogRepositoryInterface
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
        return config('activitylog.action_model');
    }
}
