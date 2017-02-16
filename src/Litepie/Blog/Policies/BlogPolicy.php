<?php

namespace Litepie\Blog\Policies;

use App\User;
use Litepie\Blog\Models\Blog;

class BlogPolicy
{

    /**
     * Determine if the given user can view the blog.
     *
     * @param User $user
     * @param Blog $blog
     *
     * @return bool
     */
    public function view(User $user, Blog $blog)
    {
        if ($user->canDo('blog.blog.view') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.view') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $blog->user_id;
    }

    /**
     * Determine if the given user can create a blog.
     *
     * @param User $user
     * @param Blog $blog
     *
     * @return bool
     */
    public function create(User $user)
    {
        return  $user->canDo('blog.blog.create');
    }

    /**
     * Determine if the given user can update the given blog.
     *
     * @param User $user
     * @param Blog $blog
     *
     * @return bool
     */
    public function update(User $user, Blog $blog)
    {
        if ($user->canDo('blog.blog.update') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.update') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $blog->user_id;
    }

    /**
     * Determine if the given user can delete the given blog.
     *
     * @param User $user
     * @param Blog $blog
     *
     * @return bool
     */
    public function destroy(User $user, Blog $blog)
    {
        if ($user->canDo('blog.blog.delete') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.delete') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $blog->user_id;
    }

    /**
     * Determine if the given user can verify the given blog.
     *
     * @param User $user
     * @param Blog $blog
     *
     * @return bool
     */
    public function verify(User $user, Blog $blog)
    {
        if ($user->canDo('blog.blog.verify') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blog.blog.verify') 
        && $user->is('manager')
        && $blog->user->parent_id == $user->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given blog.
     *
     * @param User $user
     * @param Blog $blog
     *
     * @return bool
     */
    public function approve(User $user, Blog $blog)
    {
        if ($user->canDo('blog.blog.approve') && $user->is('admin')) {
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
    public function before($user, $ability)
    {
        if ($user->isSuperUser()) {
            return true;
        }
    }
}
