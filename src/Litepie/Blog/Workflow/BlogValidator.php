<?php

namespace Litepie\Blog\Workflow;

use Litepie\Blog\Models\Blog;
use Validator;

class BlogValidator
{

    /**
     * Determine if the given blog is valid for complete status.
     *
     * @param Blog $blog
     *
     * @return bool / Validator
     */
    public function complete(Blog $blog)
    {
        return Validator::make($blog->toArray(), [
            'title' => 'required|min:15',
        ]);
    }

    /**
     * Determine if the given blog is valid for verify status.
     *
     * @param Blog $blog
     *
     * @return bool / Validator
     */
    public function verify(Blog $blog)
    {
        return Validator::make($blog->toArray(), [
            'title'  => 'required|min:15',
            'status' => 'in:complete',
        ]);
    }

    /**
     * Determine if the given blog is valid for approve status.
     *
     * @param Blog $blog
     *
     * @return bool / Validator
     */
    public function approve(Blog $blog)
    {
        return Validator::make($blog->toArray(), [
            'title'  => 'required|min:15',
            'status' => 'in:verify',
        ]);

    }

    /**
     * Determine if the given blog is valid for publish status.
     *
     * @param Blog $blog
     *
     * @return bool / Validator
     */
    public function publish(Blog $blog)
    {
        return Validator::make($blog->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:approve,archive,unpublish',
        ]);

    }

    /**
     * Determine if the given blog is valid for archive status.
     *
     * @param Blog $blog
     *
     * @return bool / Validator
     */
    public function archive(Blog $blog)
    {
        return Validator::make($blog->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:approve,publish,unpublish',
        ]);

    }

    /**
     * Determine if the given blog is valid for unpublish status.
     *
     * @param Blog $blog
     *
     * @return bool / Validator
     */
    public function unpublish(Blog $blog)
    {
        return Validator::make($blog->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:publish',
        ]);

    }
}
