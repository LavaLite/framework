<?php

namespace Litepie\Notification;

class Alerts
{
    /**
     * $notification object.
     */
    protected $notification;

    /**
     * Constructor.
     */
    public function __construct(\Litepie\Notification\Interfaces\NotificationRepositoryInterface $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Returns count of alerts.
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
     * Make gadget View.
     *
     * @param string $view
     * @param int    $count
     *
     * @return View
     */
    public function gadget($view = 'admin.notification.gadget')
    {
        $notifications = user('admin.web')->unreadNotifications;

        return view('alerts::'.$view, compact('notifications'))->render();
    }
}
