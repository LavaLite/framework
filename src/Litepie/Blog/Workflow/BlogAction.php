<?php

namespace Litepie\Blog\Workflow;

use Exception;
use Litepie\Workflow\Exceptions\WorkflowActionNotPerformedException;

use Litepie\Blog\Models\Blog;

class BlogAction
{
    /**
     * Perform the complete action.
     *
     * @param Blog $blog
     *
     * @return Blog
     */
    public function complete(Blog $blog)
    {
        try {
            $blog->status = 'complete';
            return $blog->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the verify action.
     *
     * @param Blog $blog
     *
     * @return Blog
     */public function verify(Blog $blog)
    {
        try {
            $blog->status = 'verify';
            return $blog->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the approve action.
     *
     * @param Blog $blog
     *
     * @return Blog
     */public function approve(Blog $blog)
    {
        try {
            $blog->status = 'approve';
            return $blog->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the publish action.
     *
     * @param Blog $blog
     *
     * @return Blog
     */public function publish(Blog $blog)
    {
        try {
            $blog->status = 'publish';
            return $blog->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the archive action.
     *
     * @param Blog $blog
     *
     * @return Blog
     */
    public function archive(Blog $blog)
    {
        try {
            $blog->status = 'archive';
            return $blog->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the unpublish action.
     *
     * @param Blog $blog
     *
     * @return Blog
     */
    public function unpublish(Blog $blog)
    {
        try {
            $blog->status = 'unpublish';
            return $blog->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }
}
