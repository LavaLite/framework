<?php

namespace Litepie\User\Http\Controllers;

use Exception;
use Illuminate\Http\Response;
use Litepie\Http\Controllers\ResourceController as BaseController;
use Litepie\User\Actions\UserActions;
use Litepie\User\Http\Requests\UserActionsRequest;

class UserActionsController extends BaseController
{
    /**
     * Action controller function for User.
     *
     * @param Model $model
     * @param action next action for the model.
     *
     * @return Response
     */
    public function __invoke(UserActionsRequest $request, $action)
    {
        try {
            $request = $request->all();
            $data = UserActions::run($action, $request);

            return self::$response->message(trans("messages.success.{$action}", ['Module' => trans('user::user.name')]))
                ->code(204)
                ->data(compact('data'))
                ->status('success')
                ->url(guard_url('user/user/'.$action))
                ->redirect();
        } catch (Exception $e) {
            return self::$response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('user/user/'.$action))
                ->redirect();
        }
    }
}
