<?php

namespace Litepie\User\Http\Controllers;
use Litepie\User\Http\Requests\UserRequest;
use App\User;

trait UserWorkflow {
	
    /**
     * Workflow controller function for user.
     *
     * @param Model   $user
     * @param step    next step for the workflow.
     *
     * @return Response
     */

    public function putWorkflow(UserRequest $request, User $user, $step)
    {

        try {

            $user->updateWorkflow($step);

            return response()->json([
                'message'  => trans('messages.success.changed', ['Module' => trans('user::user.name'), 'status' => trans("app.{$step}")]),
                'code'     => 204,
                'redirect' => trans_url('/admin/user/user/' . $user->getRouteKey()),
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/user/user/' . $user->getRouteKey()),
            ], 400);

        }

    }

    /**
     * Workflow controller function for user.
     *
     * @param Model   $user
     * @param step    next step for the workflow.
     * @param user    encrypted user id.
     *
     * @return Response
    */

    public function getWorkflow(User $user, $step, $userid)
    {
        try {
            $user_id = decrypt($userid);

            Auth::onceUsingId($user_id);

            $user->updateWorkflow($step);

            $data = [
                'message' => trans('messages.success.changed', ['Module' => trans('user::user.name'), 'status' => trans("app.{$step}")]),
                'status'  => 'success',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('user::admin.user.message', $data)->render();

        } catch (ValidationException $e) {

            $data = [
                'message' => '<b>' . $e->getMessage() . '</b> <br /><br />' . implode('<br />', $e->validator->errors()->all()),
                'status'  => 'error',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('user::admin.user.message', $data)->render();

        } catch (Exception $e) {

            $data = [
                'message' => '<b>' . $e->getMessage(). '</b>',
                'status'  => 'error',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('user::admin.user.message', $data)->render();

        }

    }
}