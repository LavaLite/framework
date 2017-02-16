<?php

namespace Litepie\Blog\Workflow;

use Litepie\Blog\Models\Blog;
use Litepie\Blog\Notifications\Blog as BlogNotifyer;
use Notification;

class BlogNotification
{

    /**
     * Send the notification to the users after complete.
     *
     * @param Blog $blog
     *
     * @return void
     */
    public function complete(Blog $blog)
    {
        return Notification::send($blog->user, new BlogNotifyer($blog, 'complete'));;
    }

    /**
     * Send the notification to the users after verify.
     *
     * @param Blog $blog
     *
     * @return void
     */
    public function verify(Blog $blog)
    {
        return Notification::send($blog->user, new BlogNotifyer($blog, 'verify'));;
    }

    /**
     * Send the notification to the users after approve.
     *
     * @param Blog $blog
     *
     * @return void
     */
    public function approve(Blog $blog)
    {
        return Notification::send($blog->user, new BlogNotifyer($blog, 'approve'));;

    }

    /**
     * Send the notification to the users after publish.
     *
     * @param Blog $blog
     *
     * @return void
     */
    public function publish(Blog $blog)
    {
        return Notification::send($blog->user, new BlogNotifyer($blog, 'publish'));;
    }

    /**
     * Send the notification to the users after archive.
     *
     * @param Blog $blog
     *
     * @return void
     */
    public function archive(Blog $blog)
    {
        return Notification::send($blog->user, new BlogNotifyer($blog, 'archive'));;

    }

    /**
     * Send the notification to the users after unpublish.
     *
     * @param Blog $blog
     *
     * @return void
     */
    public function unpublish(Blog $blog)
    {
        return Notification::send($blog->user, new BlogNotifyer($blog, 'unpublish'));;

    }
}
