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
    public function complete(News $news)
    {
        return Notification::send($news->user, new NewsNotifyer($news, 'complete'));;
    }

    /**
     * Send the notification to the users after verify.
     *
     * @param News $news
     *
     * @return void
     */
    public function verify(News $news)
    {
        return Notification::send($news->user, new NewsNotifyer($news, 'verify'));;
    }

    /**
     * Send the notification to the users after approve.
     *
     * @param News $news
     *
     * @return void
     */
    public function approve(News $news)
    {
        return Notification::send($news->user, new NewsNotifyer($news, 'approve'));;

    }

    /**
     * Send the notification to the users after publish.
     *
     * @param News $news
     *
     * @return void
     */
    public function publish(News $news)
    {
        return Notification::send($news->user, new NewsNotifyer($news, 'publish'));;
    }

    /**
     * Send the notification to the users after archive.
     *
     * @param News $news
     *
     * @return void
     */
    public function archive(News $news)
    {
        return Notification::send($news->user, new NewsNotifyer($news, 'archive'));;

    }

    /**
     * Send the notification to the users after unpublish.
     *
     * @param News $news
     *
     * @return void
     */
    public function unpublish(News $news)
    {
        return Notification::send($news->user, new NewsNotifyer($news, 'unpublish'));;

    }
}
