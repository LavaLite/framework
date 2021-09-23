<?php

namespace Litepie\Notification\Repositories\Eloquent;

use Litepie\Notification\Interfaces\NotificationRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class NotificationRepository extends BaseRepository implements NotificationRepositoryInterface
{
    public function boot()
    {
        $this->fieldSearchable = config('litepie.alerts.notification.search');
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('litepie.alerts.notification.model');
    }
}
