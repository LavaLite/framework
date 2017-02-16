<?php

namespace Litepie\Alert\Repositories\Eloquent;

use Litepie\Alert\Interfaces\NotificationRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{


    public function boot()
    {
        $this->fieldSearchable = config('litepie.alert.notification.search');

    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('litepie.alert.notification.model');
    }
}
