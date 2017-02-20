<?php

namespace Litepie\Blog\Http\Controllers;
use Litepie\Blog\Http\Requests\BlogCategoryRequest;
use Litepie\Blog\Models\BlogCategory;

trait BlogCategoryWorkflow {
	
    /**
     * Workflow controller function for category.
     *
     * @param Model   $category
     * @param step    next step for the workflow.
     *
     * @return Response
     */

    public function putWorkflow(BlogCategoryRequest $request, BlogCategory $category, $step)
    {

        try {

            $category->updateWorkflow($step);

            return response()->json([
                'message'  => trans('messages.success.changed', ['Module' => trans('blog::category.name'), 'status' => trans("app.{$step}")]),
                'code'     => 204,
                'redirect' => trans_url('/admin/category/category/' . $category->getRouteKey()),
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/category/category/' . $category->getRouteKey()),
            ], 400);

        }

    }

    /**
     * Workflow controller function for category.
     *
     * @param Model   $category
     * @param step    next step for the workflow.
     * @param user    encrypted user id.
     *
     * @return Response
    */

    public function getWorkflow(BlogCategory $category, $step, $user)
    {
        try {
            $user_id = decrypt($user);

            Auth::onceUsingId($user_id);

            $category->updateWorkflow($step);

            $data = [
                'message' => trans('messages.success.changed', ['Module' => trans('blog::category.name'), 'status' => trans("app.{$step}")]),
                'status'  => 'success',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('blog::admin.category.message', $data)->render();

        } catch (ValidationException $e) {

            $data = [
                'message' => '<b>' . $e->getMessage() . '</b> <br /><br />' . implode('<br />', $e->validator->errors()->all()),
                'status'  => 'error',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('blog::admin.category.message', $data)->render();

        } catch (Exception $e) {

            $data = [
                'message' => '<b>' . $e->getMessage(). '</b>',
                'status'  => 'error',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('blog::admin.category.message', $data)->render();

        }

    }
}