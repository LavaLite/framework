<?php

namespace Litepie\News\Policies;

use Litepie\News\Models\News;
use Litepie\User\Contracts\UserPolicy;

class NewsPolicy
{

    /**
     * Determine if the given user can view the news.
     *
     * @param User $user
     * @param News $news
     *
     * @return bool
     */
    public function view(UserPolicy $user, News $news)
    {
        if ($user->canDo('news.news.view') && $user->hasRole('admin')) {
            return true;
        }

        if ($user->canDo('news.news.view') 
        && $user->hasRole('manager')
        && $news->user->parent_id == $user->id
        && get_class($user) === $user->user_type) {
            return true;
        }

        return $user->id === $news->user_id && get_class($user) === $news->user_type;
    }

    /**
     * Determine if the given user can create a news.
     *
     * @param User $user
     * @param News $news
     *
     * @return bool
     */
    public function create(UserPolicy $user)
    {
        return  $user->canDo('news.news.create');
    }

    /**
     * Determine if the given user can update the given news.
     *
     * @param User $user
     * @param News $news
     *
     * @return bool
     */
    public function update(UserPolicy $user, News $news)
    {
        if ($user->canDo('news.news.update') && $user->hasRole('admin')) {
            return true;
        }

        if ($user->canDo('news.news.update') 
            && $user->hasRole('manager') 
            && $news->user->parent_id == $user->id
            && get_class($user) === $user->user_type) {
            return true;
        }

        return $user->id === $news->user_id && get_class($user) === $news->user_type;
    }

    /**
     * Determine if the given user can delete the given news.
     *
     * @param User $user
     * @param News $news
     *
     * @return bool
     */
    public function destroy(UserPolicy $user, News $news)
    {
        if ($user->canDo('news.news.delete') && $user->hasRole('admin')) {
            return true;
        }

        if ($user->canDo('news.news.delete') 
        && $user->hasRole('manager')
        && $news->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $news->user_id && get_class($user) === $news->user_type;
    }

    /**
     * Determine if the given user can verify the given news.
     *
     * @param User $user
     * @param News $news
     *
     * @return bool
     */
    public function verify(UserPolicy $user, News $news)
    {
        if ($user->canDo('news.news.verify') && $user->hasRole('admin')) {
            return true;
        }

        if ($user->canDo('news.news.verify') 
        && $user->hasRole('manager')
        && $news->user->parent_id == $user->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given news.
     *
     * @param User $user
     * @param News $news
     *
     * @return bool
     */
    public function approve(UserPolicy $user, News $news)
    {
        if ($user->canDo('news.news.approve') && $user->hasRole('admin')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the user can perform a given action ve.
     *
     * @param [type] $user    [description]
     * @param [type] $ability [description]
     *
     * @return [type] [description]
     */
    public function before(UserPolicy $user, $ability)
    {
        if ($user->hasRole('superuser')) {
            return true;
        }
    }
}
