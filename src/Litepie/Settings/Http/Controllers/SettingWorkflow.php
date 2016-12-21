<?php

namespace Litepie\Settings\Http\Controllers;
use Litepie\Settings\Http\Requests\SettingRequest;
use Litepie\Settings\Models\Setting;

trait SettingWorkflow {
	
    /**
     * Workflow controller function for setting.
     *
     * @param Model   $setting
     * @param step    next step for the workflow.
     *
     * @return Response
     */

    public function putWorkflow(SettingRequest $request, Setting $setting, $step)
    {

        try {

            $setting->updateWorkflow($step);

            return response()->json([
                'message'  => trans('messages.success.changed', ['Module' => trans('settings::setting.name'), 'status' => trans("app.{$step}")]),
                'code'     => 204,
                'redirect' => trans_url('/admin/setting/setting/' . $setting->getRouteKey()),
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/setting/setting/' . $setting->getRouteKey()),
            ], 400);

        }

    }

    /**
     * Workflow controller function for setting.
     *
     * @param Model   $setting
     * @param step    next step for the workflow.
     * @param user    encrypted user id.
     *
     * @return Response
    */

    public function getWorkflow(Setting $setting, $step, $user)
    {
        try {
            $user_id = decrypt($user);

            Auth::onceUsingId($user_id);

            $setting->updateWorkflow($step);

            $data = [
                'message' => trans('messages.success.changed', ['Module' => trans('settings::setting.name'), 'status' => trans("app.{$step}")]),
                'status'  => 'success',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('settings::admin.setting.message', $data)->render();

        } catch (ValidationException $e) {

            $data = [
                'message' => '<b>' . $e->getMessage() . '</b> <br /><br />' . implode('<br />', $e->validator->errors()->all()),
                'status'  => 'error',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('settings::admin.setting.message', $data)->render();

        } catch (Exception $e) {

            $data = [
                'message' => '<b>' . $e->getMessage(). '</b>',
                'status'  => 'error',
                'step'    => trans("app.{$step}"),
            ];

            return $this->theme->layout('blank')->of('settings::admin.setting.message', $data)->render();

        }

    }
}