<?php

namespace Litepie\Blog\Workflow;

use Exception;
use Litepie\Workflow\Exceptions\WorkflowActionNotPerformedException;

use Litepie\Blog\Models\BlogCategory;

class BlogCategoryAction
{
    /**
     * Perform the complete action.
     *
     * @param BlogCategory $blog_category
     *
     * @return BlogCategory
     */
    public function complete(BlogCategory $blog_category)
    {
        try {
            $blog_category->status = 'complete';
            return $blog_category->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the verify action.
     *
     * @param BlogCategory $blog_category
     *
     * @return BlogCategory
     */public function verify(BlogCategory $blog_category)
    {
        try {
            $blog_category->status = 'verify';
            return $blog_category->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the approve action.
     *
     * @param BlogCategory $blog_category
     *
     * @return BlogCategory
     */public function approve(BlogCategory $blog_category)
    {
        try {
            $blog_category->status = 'approve';
            return $blog_category->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the publish action.
     *
     * @param BlogCategory $blog_category
     *
     * @return BlogCategory
     */public function publish(BlogCategory $blog_category)
    {
        try {
            $blog_category->status = 'publish';
            return $blog_category->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the archive action.
     *
     * @param BlogCategory $blog_category
     *
     * @return BlogCategory
     */
    public function archive(BlogCategory $blog_category)
    {
        try {
            $blog_category->status = 'archive';
            return $blog_category->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the unpublish action.
     *
     * @param BlogCategory $blog_category
     *
     * @return BlogCategory
     */
    public function unpublish(BlogCategory $blog_category)
    {
        try {
            $blog_category->status = 'unpublish';
            return $blog_category->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }
}
