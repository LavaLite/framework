<?php

namespace Litepie\Blog\Policies;

use App\User;
use Litepie\Blog\Models\BlogCategory;

class BlogCategoryPolicy
{

    /**
     * Determine if the given user can view the blog_category.
     *
     * @param User $user
     * @param BlogCategory $blog_category
     *
     * @return bool
     */
    public function view(User $user, BlogCategory $blog_category)
    {
        if ($user->canDo('blog.blog_category.view') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.view') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $blog_category->user_id;
    }

    /**
     * Determine if the given user can create a blog_category.
     *
     * @param User $user
     * @param BlogCategory $blog_category
     *
     * @return bool
     */
    public function create(User $user)
    {
        return  $user->canDo('blog.blog_category.create');
    }

    /**
     * Determine if the given user can update the given blog_category.
     *
     * @param User $user
     * @param BlogCategory $blog_category
     *
     * @return bool
     */
    public function update(User $user, BlogCategory $blog_category)
    {
        if ($user->canDo('blog.blog_category.update') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.update') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $blog_category->user_id;
    }

    /**
     * Determine if the given user can delete the given blog_category.
     *
     * @param User $user
     * @param BlogCategory $blog_category
     *
     * @return bool
     */
    public function destroy(User $user, BlogCategory $blog_category)
    {
        if ($user->canDo('blog.blog_category.delete') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.delete') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $blog_category->user_id;
    }

    /**
     * Determine if the given user can verify the given blog_category.
     *
     * @param User $user
     * @param BlogCategory $blog_category
     *
     * @return bool
     */
    public function verify(User $user, BlogCategory $blog_category)
    {
        if ($user->canDo('blog.blog_category.verify') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blog.blog_category.verify') 
        && $user->is('manager')
        && $blog_category->user->parent_id == $user->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given blog_category.
     *
     * @param User $user
     * @param BlogCategory $blog_category
     *
     * @return bool
     */
    public function approve(User $user, BlogCategory $blog_category)
    {
        if ($user->canDo('blog.blog_category.approve') && $user->is('admin')) {
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
