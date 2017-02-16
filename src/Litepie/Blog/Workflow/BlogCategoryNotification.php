<?php

namespace Litepie\Blog\Workflow;

use Litepie\Blog\Models\BlogCategory;
use Litepie\Blog\Notifications\BlogCategory as BlogCategoryNotifyer;
use Notification;

class BlogCategoryNotification
{

    /**
     * Send the notification to the users after complete.
     *
     * @param BlogCategory $blog_category
     *
     * @return void
     */
    public function complete(BlogCategory $blog_category)
    {
        return Notification::send($blog_category->user, new BlogCategoryNotifyer($blog_category, 'complete'));;
    }

    /**
     * Send the notification to the users after verify.
     *
     * @param BlogCategory $blog_category
     *
     * @return void
     */
    public function verify(BlogCategory $blog_category)
    {
        return Notification::send($blog_category->user, new BlogCategoryNotifyer($blog_category, 'verify'));;
    }

    /**
     * Send the notification to the users after approve.
     *
     * @param BlogCategory $blog_category
     *
     * @return void
     */
    public function approve(BlogCategory $blog_category)
    {
        return Notification::send($blog_category->user, new BlogCategoryNotifyer($blog_category, 'approve'));;

    }

    /**
     * Send the notification to the users after publish.
     *
     * @param BlogCategory $blog_category
     *
     * @return void
     */
    public function publish(BlogCategory $blog_category)
    {
        return Notification::send($blog_category->user, new BlogCategoryNotifyer($blog_category, 'publish'));;
    }

    /**
     * Send the notification to the users after archive.
     *
     * @param BlogCategory $blog_category
     *
     * @return void
     */
    public function archive(BlogCategory $blog_category)
    {
        return Notification::send($blog_category->user, new BlogCategoryNotifyer($blog_category, 'archive'));;

    }

    /**
     * Send the notification to the users after unpublish.
     *
     * @param BlogCategory $blog_category
     *
     * @return void
     */
    public function unpublish(BlogCategory $blog_category)
    {
        return Notification::send($blog_category->user, new BlogCategoryNotifyer($blog_category, 'unpublish'));;

    }
}
