<?php

namespace Litepie\News\Http\Controllers;

use Auth;
use Exception;
use Illuminate\Validation\ValidationException;
use Litepie\News\Http\Requests\NewsRequest;
use Litepie\News\Models\News;

trait NewsWorkflow
{

    /**
     * Workflow controller function for news.
     *
     * @param Model   $news
     * @param step    next step for the workflow.
     *
     * @return Response
     */

    public function putWorkflow(NewsRequest $request, News $news, $step)
    {

        try {

            $news->applyWorkflow($step);

            return response()->json([
                'message'  => trans('messages.success.changed', ['Module' => trans('news::news.name'), 'status' => trans("app.{$step}")]),
                'code'     => 204,
                'redirect' => trans_url('/admin/news/news/' . $news->getRouteKey()),
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/news/news/' . $news->getRouteKey()),
            ], 400);

        }

    }

    /**
     * Workflow controller function for news.
     *
     * @param Model   $news
     * @param step    next step for the workflow.
     * @param user    encrypted user id.
     *
     * @return Response
     */

    public function getWorkflow(News $news, $step, $user)
    {
        try {
            $user_id = decrypt($user);

            Auth::onceUsingId($user_id);

            $news->applyWorkflow($step);

            $data = [
                'message' => trans('messages.success.changed', ['Module' => trans('news::news.name'), 'status' => trans("app.{$step}")]),
                'status'  => 'success',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('news::admin.news.message', $data)->render();

        } catch (ValidationException $e) {

            $data = [
                'message' => '<b>' . $e->getMessage() . '</b> <br /><br />' . implode('<br />', $e->validator->errors()->all()),
                'status'  => 'error',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('news::admin.news.message', $data)->render();

        } catch (Exception $e) {

            $data = [
                'message' => '<b>' . $e->getMessage() . '</b>',
                'status'  => 'error',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('news::admin.news.message', $data)->render();

        }

    }
}
