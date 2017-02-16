<?php

namespace Litepie\Alert;

use User;

class Alert
{
    /**
     * $notification object.
     */
    protected $notification;

    /**
     * Constructor.
     */
    public function __construct(\Litepie\Alert\Interfaces\NotificationRepositoryInterface $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Returns count of alert.
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
     * Make gadget View
     *
     * @param string $view
     *
     * @param int $count
     *
     * @return View
     */
    public function gadget($view = 'admin.notification.gadget')
    {

        $notifications = user('admin.web')->unreadNotifications;

        return view('alert::' . $view, compact('notifications'))->render();
    }
}
