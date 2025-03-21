<?php

namespace Litepie\Notification\Http\Controllers;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Litepie\Database\Scopes\RequestScope;
use Litepie\Http\Controllers\ResourceController as BaseController;
use Litepie\Notification\Forms\Notification as NotificationForm;
use Litepie\Notification\Http\Requests\NotificationResourceRequest;
use Litepie\Notification\Http\Resources\NotificationResource;
use Litepie\Notification\Http\Resources\NotificationsCollection;
use Litepie\Notification\Models\Notification;
use Litepie\Notification\Scopes\NotificationResourceScope;

/**
 * Resource controller class for notification.
 */
class NotificationResourceController extends BaseController
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return array_merge(
            parent::middleware(),
            [
                function (Request $request, Closure $next) {
                    self::$form = NotificationForm::only('main')
                        ->setAttributes()
                        ->toArray();
                    self::$modules = self::modules(config('notification.modules'), 'notification', guard_url('notification'));

                    return $next($request);
                },
            ]
        );
    }

    /**
     * Display a list of notification.
     *
     * @return Response
     */
    public function index(NotificationResourceRequest $request)
    {
        $pageLimit = $request->input('pageLimit', config('database.pagination.limit'));
        $page = Notification::pushScope(new RequestScope())
            ->pushScope(new NotificationResourceScope())
            ->paginate($pageLimit);

        $data = new NotificationsCollection($page);

        $form = self::$form;
        $modules = self::$modules;

        return self::$response->setMetaTitle(trans('notification::notification.names'))
            ->view('notification::notification.index')
            ->data(compact('data', 'modules', 'form'))
            ->output();
    }

    /**
     * Display notification.
     *
     * @param Request $request
     * @param Model   $notification
     *
     * @return Response
     */
    public function show(NotificationResourceRequest $request, Notification $model)
    {
        $form = self::$form;
        $modules = self::$modules;
        $data = new NotificationResource($model);

        return self::$response
            ->setMetaTitle(trans('app.view').' '.trans('notification::notification.name'))
            ->data(compact('data', 'form', 'modules'))
            ->view('notification::notification.show')
            ->output();
    }

    /**
     * Show the form for creating a new notification.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(NotificationResourceRequest $request, Notification $model)
    {
        $form = self::$form;
        $modules = self::$modules;
        $data = new NotificationResource($model);

        return self::$response->setMetaTitle(trans('app.new').' '.trans('notification::notification.name'))
            ->view('notification::notification.create')
            ->data(compact('data', 'form', 'modules'))
            ->output();
    }

    /**
     * Create new notification.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(NotificationResourceRequest $request, Notification $model)
    {
        try {
            $attributes = $request->all();
            $attributes['user_id'] = user_id();
            $attributes['user_type'] = user_type();
            $model = $model->create($attributes);
            $data = new NotificationResource($model);

            return self::$response->message(trans('messages.success.created', ['Module' => trans('notification::notification.name')]))
                ->code(204)
                ->data(compact('data'))
                ->status('success')
                ->url(guard_url('notification/notification/'.$model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return self::$response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('/notification/notification'))
                ->redirect();
        }
    }

    /**
     * Show notification for editing.
     *
     * @param Request $request
     * @param Model   $notification
     *
     * @return Response
     */
    public function edit(NotificationResourceRequest $request, Notification $model)
    {
        $form = self::$form;
        $modules = self::$modules;
        $data = new NotificationResource($model);
        // return view('notification::notification.edit', compact('data', 'form', 'modules'));

        return self::$response->setMetaTitle(trans('app.edit').' '.trans('notification::notification.name'))
            ->view('notification::notification.edit')
            ->data(compact('data', 'form', 'modules'))
            ->output();
    }

    /**
     * Update the notification.
     *
     * @param Request $request
     * @param Model   $notification
     *
     * @return Response
     */
    public function update(NotificationResourceRequest $request, Notification $model)
    {
        try {
            $attributes = $request->all();
            $model->update($attributes);
            $data = new NotificationResource($model);

            return self::$response->message(trans('messages.success.updated', ['Module' => trans('notification::notification.name')]))
                ->code(204)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('notification/notification/'.$model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return self::$response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('notification/notification/'.$model->getRouteKey()))
                ->redirect();
        }
    }

    /**
     * Remove the notification.
     *
     * @param Model $notification
     *
     * @return Response
     */
    public function destroy(NotificationResourceRequest $request, Notification $model)
    {
        try {
            $model->delete();
            $data = new NotificationResource($model);

            return self::$response->message(trans('messages.success.deleted', ['Module' => trans('notification::notification.name')]))
                ->code(202)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('notification/notification/0'))
                ->redirect();
        } catch (Exception $e) {
            return self::$response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('notification/notification/'.$model->getRouteKey()))
                ->redirect();
        }
    }
}
