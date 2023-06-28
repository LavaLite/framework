<?php

namespace Litepie\Notification;

use User;

class Notifications
{
    /**
     * $notification object.
     */
    protected $notification;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->notification = $notification;
    }

    /**
     * Returns count of notification.
     *
     * @param array $filter
     *
     * @return int
     */
    public function count()
    {
        return  0;
    }

    /**
     * Find notification by slug.
     *
     * @param array $filter
     *
     * @return int
     */
    public function notification($slug)
    {
        return  $this->notification
            ->findBySlug($slig)
            ->toArray();
    }
}
