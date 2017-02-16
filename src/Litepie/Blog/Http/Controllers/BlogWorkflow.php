<?php

namespace Litepie\Blog\Http\Controllers;
use Litepie\Blog\Http\Requests\BlogRequest;
use Litepie\Blog\Models\Blog;

trait BlogWorkflow {
	
    /**
     * Workflow controller function for blog.
     *
     * @param Model   $blog
     * @param step    next step for the workflow.
     *
     * @return Response
     */

    public function putWorkflow(BlogRequest $request, Blog $blog, $step)
    {

        try {

            $blog->updateWorkflow($step);

            return response()->json([
                'message'  => trans('messages.success.changed', ['Module' => trans('blog::blog.name'), 'status' => trans("app.{$step}")]),
                'code'     => 204,
                'redirect' => trans_url('/admin/blog/blog/' . $blog->getRouteKey()),
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/blog/blog/' . $blog->getRouteKey()),
            ], 400);

        }

    }

    /**
     * Workflow controller function for blog.
     *
     * @param Model   $blog
     * @param step    next step for the workflow.
     * @param user    encrypted user id.
     *
     * @return Response
    */

    public function getWorkflow(Blog $blog, $step, $user)
    {
        try {
            $user_id = decrypt($user);

            Auth::onceUsingId($user_id);

            $blog->updateWorkflow($step);

            $data = [
                'message' => trans('messages.success.changed', ['Module' => trans('blog::blog.name'), 'status' => trans("app.{$step}")]),
                'status'  => 'success',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('blog::admin.blog.message', $data)->render();

        } catch (ValidationException $e) {

            $data = [
                'message' => '<b>' . $e->getMessage() . '</b> <br /><br />' . implode('<br />', $e->validator->errors()->all()),
                'status'  => 'error',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('blog::admin.blog.message', $data)->render();

        } catch (Exception $e) {

            $data = [
                'message' => '<b>' . $e->getMessage(). '</b>',
                'status'  => 'error',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('blog::admin.blog.message', $data)->render();

        }

    }
}