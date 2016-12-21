<?php

namespace Litepie\News\Workflow;

use Exception;
use Litepie\News\Models\News;
use Litepie\Workflow\Exceptions\WorkflowActionNotPerformedException;

class NewsAction
{
    /**
     * Perform the complete action.
     *
     * @param News $news
     *
     * @return News
     */
    public function complete(News $news)
    {
        try {
            $news->status = 'complete';
            return $news->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the verify action.
     *
     * @param News $news
     *
     * @return News
     */public function verify(News $news)
    {
        try {
            $news->status = 'verify';
            return $news->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the approve action.
     *
     * @param News $news
     *
     * @return News
     */public function approve(News $news)
    {
        try {
            $news->status = 'approve';
            return $news->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the publish action.
     *
     * @param News $news
     *
     * @return News
     */public function publish(News $news)
    {
        try {
            $news->status = 'publish';
            return $news->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the archive action.
     *
     * @param News $news
     *
     * @return News
     */
    public function archive(News $news)
    {
        try {
            $news->status = 'archive';
            return $news->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the unpublish action.
     *
     * @param News $news
     *
     * @return News
     */
    public function unpublish(News $news)
    {
        try {
            $news->status = 'unpublish';
            return $news->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }
}
