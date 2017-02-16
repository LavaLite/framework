<?php

namespace Litepie\News\Workflow;

use Litepie\News\Models\News;
use Litepie\News\Notifications\News as NewsNotifyer;
use Notification;

class NewsNotification
{

    /**
     * Send the notification to the users after complete.
     *
     * @param News $news
     *
     * @return void
     */
    public function complete(News $news, $workflow)
    {
        return Notification::send($news->reporting, new NewsNotifyer($news, $workflow, 'complete'));;
    }

    /**
     * Send the notification to the users after verify.
     *
     * @param News $news
     *
     * @return void
     */
    public function verify(News $news, $workflow)
    {
        return Notification::send($news->reporting, new NewsNotifyer($news, $workflow, 'verify'));;
    }

    /**
     * Send the notification to the users after approve.
     *
     * @param News $news
     *
     * @return void
     */
    public function approve(News $news, $workflow)
    {
        return Notification::send($news->reporting, new NewsNotifyer($news, $workflow, 'approve'));;

    }

    /**
     * Send the notification to the users after publish.
     *
     * @param News $news
     *
     * @return void
     */
    public function publish(News $news, $workflow)
    {
        return Notification::send($news->reporting, new NewsNotifyer($news, $workflow, 'publish'));;
    }

    /**
     * Send the notification to the users after archive.
     *
     * @param News $news
     *
     * @return void
     */
    public function archive(News $news, $workflow)
    {
        return Notification::send($news->reporting, new NewsNotifyer($news, $workflow, 'archive'));;

    }

    /**
     * Send the notification to the users after unpublish.
     *
     * @param News $news
     *
     * @return void
     */
    public function unpublish(News $news, $workflow)
    {
        return Notification::send($news->reporting, new NewsNotifyer($news, $workflow, 'unpublish'));;

    }
    /**
     * Send the notification to the users after cancel.
     *
     * @param News $news
     *
     * @return void
     */
    public function cancel(News $news, $workflow)
    {
        return Notification::send($news->user, new NewsNotifyer($news, $workflow, 'cancel'));;

    }
}
