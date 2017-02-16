<?php

namespace Litepie\Blog\Workflow;

use Litepie\Blog\Models\BlogCategory;
use Validator;

class BlogCategoryValidator
{

    /**
     * Determine if the given blog_category is valid for complete status.
     *
     * @param BlogCategory $blog_category
     *
     * @return bool / Validator
     */
    public function complete(BlogCategory $blog_category)
    {
        return Validator::make($blog_category->toArray(), [
            'title' => 'required|min:15',
        ]);
    }

    /**
     * Determine if the given blog_category is valid for verify status.
     *
     * @param BlogCategory $blog_category
     *
     * @return bool / Validator
     */
    public function verify(BlogCategory $blog_category)
    {
        return Validator::make($blog_category->toArray(), [
            'title'  => 'required|min:15',
            'status' => 'in:complete',
        ]);
    }

    /**
     * Determine if the given blog_category is valid for approve status.
     *
     * @param BlogCategory $blog_category
     *
     * @return bool / Validator
     */
    public function approve(BlogCategory $blog_category)
    {
        return Validator::make($blog_category->toArray(), [
            'title'  => 'required|min:15',
            'status' => 'in:verify',
        ]);

    }

    /**
     * Determine if the given blog_category is valid for publish status.
     *
     * @param BlogCategory $blog_category
     *
     * @return bool / Validator
     */
    public function publish(BlogCategory $blog_category)
    {
        return Validator::make($blog_category->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:approve,archive,unpublish',
        ]);

    }

    /**
     * Determine if the given blog_category is valid for archive status.
     *
     * @param BlogCategory $blog_category
     *
     * @return bool / Validator
     */
    public function archive(BlogCategory $blog_category)
    {
        return Validator::make($blog_category->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:approve,publish,unpublish',
        ]);

    }

    /**
     * Determine if the given blog_category is valid for unpublish status.
     *
     * @param BlogCategory $blog_category
     *
     * @return bool / Validator
     */
    public function unpublish(BlogCategory $blog_category)
    {
        return Validator::make($blog_category->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:publish',
        ]);

    }
}
