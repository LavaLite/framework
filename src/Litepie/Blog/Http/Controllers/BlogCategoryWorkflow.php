<?php

namespace Litepie\Blog\Http\Controllers;
use Litepie\Blog\Http\Requests\BlogCategoryRequest;
use Litepie\Blog\Models\BlogCategory;

trait BlogCategoryWorkflow {
	
    /**
     * Workflow controller function for blog_category.
     *
     * @param Model   $blog_category
     * @param step    next step for the workflow.
     *
     * @return Response
     */

    public function putWorkflow(BlogCategoryRequest $request, BlogCategory $blog_category, $step)
    {

        try {

            $blog_category->updateWorkflow($step);

            return response()->json([
                'message'  => trans('messages.success.changed', ['Module' => trans('blog::blog_category.name'), 'status' => trans("app.{$step}")]),
                'code'     => 204,
                'redirect' => trans_url('/admin/blog_category/blog_category/' . $blog_category->getRouteKey()),
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/blog_category/blog_category/' . $blog_category->getRouteKey()),
            ], 400);

        }

    }

    /**
     * Workflow controller function for blog_category.
     *
     * @param Model   $blog_category
     * @param step    next step for the workflow.
     * @param user    encrypted user id.
     *
     * @return Response
    */

    public function getWorkflow(BlogCategory $blog_category, $step, $user)
    {
        try {
            $user_id = decrypt($user);

            Auth::onceUsingId($user_id);

            $blog_category->updateWorkflow($step);

            $data = [
                'message' => trans('messages.success.changed', ['Module' => trans('blog::blog_category.name'), 'status' => trans("app.{$step}")]),
                'status'  => 'success',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('blog::admin.blog_category.message', $data)->render();

        } catch (ValidationException $e) {

            $data = [
                'message' => '<b>' . $e->getMessage() . '</b> <br /><br />' . implode('<br />', $e->validator->errors()->all()),
                'status'  => 'error',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('blog::admin.blog_category.message', $data)->render();

        } catch (Exception $e) {

            $data = [
                'message' => '<b>' . $e->getMessage(). '</b>',
                'status'  => 'error',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('blog::admin.blog_category.message', $data)->render();

        }

    }
}