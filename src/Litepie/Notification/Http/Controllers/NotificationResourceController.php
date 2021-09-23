<?php

namespace Litepie\Notification\Http\Controllers;

use Litepie\Http\Controllers\ResourceController;
use Litepie\Notification\Http\Requests\NotificationRequest;
use Litepie\Notification\Interfaces\NotificationRepositoryInterface;
use Litepie\Notification\Models\Notification;

/**
 * Resource controller class for notification.
 */
class NotificationResourceController extends ResourceController
{
    /**
     * Initialize notification resource controller.
     *
     * @param type NotificationRepositoryInterface $notification
     *
     * @return null
     */
    public function __construct(NotificationRepositoryInterface $notification)
    {
        parent::__construct();
        $this->repository = $notification;
        $this->repository
            ->pushCriteria(\Litepie\Repository\Criteria\RequestCriteria::class)
            ->pushCriteria(\Litepie\Notification\Repositories\Criteria\NotificationResourceCriteria::class);
    }

    /**
     * Display a list of notification.
     *
     * @return Response
     */
    public function index(NotificationRequest $request)
    {
        if ($this->response->typeIs('json')) {
            $pageLimit = $request->input('pageLimit');
            $data = $this->repository
                ->setPresenter(\Litepie\Notification\Repositories\Presenter\NotificationListPresenter::class)
                ->getDataTable($pageLimit);

            return $this->response
                ->data($data)
                ->output();
        }

        $notifications = $this->repository->paginate();

        return $this->response->setMetaTitle(trans('alerts::notification.names'))
            ->view('alerts::admin.notification.index')
            ->data(compact('notifications'))
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
    public function show(NotificationRequest $request, Notification $notification)
    {
        if ($notification->exists) {
            $view = 'alerts::admin.notification.show';
        } else {
            $view = 'alerts::admin.notification.new';
        }

        return $this->response->setMetaTitle(trans('app.view').' '.trans('alerts::notification.name'))
            ->data(compact('notification'))
            ->view($view)
            ->output();
    }

    /**
     * Show the form for creating a new notification.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(NotificationRequest $request)
    {
        $notification = $this->repository->newInstance([]);
        $this->response->setMetaTitle(trans('app.new').' '.trans('alerts::notification.name'))
            ->view('alerts::admin.notification.create')
            ->data(compact('notification'))
            ->output();
    }

    /**
     * Create new notification.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(NotificationRequest $request)
    {
        try {
            $attributes = $request->all();
            $attributes['user_id'] = user_id();
            $attributes['user_type'] = user_type();
            $notification = $this->repository->create($attributes);

            return $this->response->message(trans('messages.success.created', ['Module' => trans('alerts::notification.name')]))
                ->code(204)
                ->status('success')
                ->url(trans_url(guard_url('/alerts/notification/'.$notification->getRouteKey())))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(trans_url(guard_url('/alerts/notification')))
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
    public function edit(NotificationRequest $request, Notification $notification)
    {
        return $this->response->setMetaTitle(trans('app.edit').' '.trans('alerts::notification.name'))
            ->view('alerts::admin.notification.edit')
            ->data(compact('notification'))
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
    public function update(NotificationRequest $request, Notification $notification)
    {
        try {
            $attributes = $request->all();

            $notification->update($attributes);

            return $this->response->message(trans('messages.success.updated', ['Module' => trans('alerts::notification.name')]))
                ->code(204)
                ->status('success')
                ->url(trans_url(guard_url('/alerts/notification/'.$notification->getRouteKey())))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('/alerts/notification/'.$notification->getRouteKey()))
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
    public function destroy(NotificationRequest $request, Notification $notification)
    {
        try {
            $notification->delete();

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('alerts::notification.name')]))
                ->code(202)
                ->status('success')
                ->url(trans_url(guard_url('/alerts/notification')))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(trans_url(guard_url('/alerts/notification/'.$notification->getRouteKey())))
                ->redirect();
        }
    }

    /**
     * Remove multiple notification.
     *
     * @param Model $notification
     *
     * @return Response
     */
    public function delete(NotificationRequest $request, $type)
    {
        try {
            $ids = hashids_decode($request->input('ids'));

            if ($type == 'purge') {
                $this->repository->purge($ids);
            } else {
                $this->repository->delete($ids);
            }

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('alerts::notification.name')]))
                ->status('success')
                ->code(202)
                ->url(trans_url(guard_url('/alerts/notification')))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->status('error')
                ->code(400)
                ->url(trans_url(guard_url('/alerts/notification')))
                ->redirect();
        }
    }

    /**
     * Restore deleted notifications.
     *
     * @param Model $notification
     *
     * @return Response
     */
    public function restore(NotificationRequest $request)
    {
        try {
            $ids = hashids_decode($request->input('ids'));
            $this->repository->restore($ids);

            return $this->response->message(trans('messages.success.restore', ['Module' => trans('alerts::notification.name')]))
                ->status('success')
                ->code(202)
                ->url(trans_url(guard_url('/alerts/notification')))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->status('error')
                ->code(400)
                ->url(trans_url(guard_url('/alerts/notification/')))
                ->redirect();
        }
    }
}
