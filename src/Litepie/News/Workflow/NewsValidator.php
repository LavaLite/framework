<?php

namespace Litepie\News\Workflow;

use Litepie\News\Models\News;
use Validator;

class NewsValidator
{

    /**
     * Determine if the given news is valid for complete status.
     *
     * @param News $news
     *
     * @return bool / Validator
     */
    public function complete(News $news)
    {
        return Validator::make($news->toArray(), [
            'title' => 'required|min:15',
            'status' => 'in:cancel,draft',
        ]);
    }

    /**
     * Determine if the given news is valid for verify status.
     *
     * @param News $news
     *
     * @return bool / Validator
     */
    public function verify(News $news)
    {
        return Validator::make($news->toArray(), [
            'title'  => 'required|min:15',
            'status' => 'in:cancel,complete',
        ]);
    }

    /**
     * Determine if the given news is valid for approve status.
     *
     * @param News $news
     *
     * @return bool / Validator
     */
    public function approve(News $news)
    {
        return Validator::make($news->toArray(), [
            'title'  => 'required|min:15',
            'status' => 'in:cancel,verify',
        ]);

    }

    /**
     * Determine if the given news is valid for publish status.
     *
     * @param News $news
     *
     * @return bool / Validator
     */
    public function publish(News $news)
    {
        return Validator::make($news->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:cancel,approve,archive,unpublish',
        ]);

    }

    /**
     * Determine if the given news is valid for archive status.
     *
     * @param News $news
     *
     * @return bool / Validator
     */
    public function archive(News $news)
    {
        return Validator::make($news->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:cancel,approve,publish,unpublish',
        ]);

    }

    /**
     * Determine if the given news is valid for unpublish status.
     *
     * @param News $news
     *
     * @return bool / Validator
     */
    public function unpublish(News $news)
    {
        return Validator::make($news->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:cancel,publish',
        ]);

    }
    /**
     * Determine if the given news is valid for cancel status.
     *
     * @param News $news
     *
     * @return bool / Validator
     */
    public function cancel(News $news)
    {
        return Validator::make($news->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:complete,verify,approve,publish,archive,unpublish',
        ]);

    }
}
