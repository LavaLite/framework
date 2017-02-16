<?php

namespace Litepie\Alert\Http\Controllers;

use App\Http\Controllers\UserController as BaseController;
use Form;
use Litepie\Alert\Http\Requests\NotificationRequest;
use Litepie\Alert\Interfaces\NotificationRepositoryInterface;
use Litepie\Alert\Models\Notification;

class NotificationUserController extends BaseController
{
    /**
     * Initialize notification controller.
     *
     * @param type NotificationRepositoryInterface $notification
     *
     * @return type
     */
    public function __construct(NotificationRepositoryInterface $notification)
    {
        $this->repository = $notification;
        $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->pushCriteria(new \Litepie\Alert\Repositories\Criteria\NotificationUserCriteria());
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(NotificationRequest $request)
    {
        $notifications = $this->repository->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();

        $this->theme->prependTitle(trans('alert::notification.names'));

        return $this->theme->of('alert::user.notification.index', compact('notifications'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Notification $notification
     *
     * @return Response
     */
    public function show(NotificationRequest $request, Notification $notification)
    {
        Form::populate($notification);

        return $this->theme->of('alert::user.notification.show', compact('notification'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(NotificationRequest $request)
    {

        $notification = $this->repository->newInstance([]);
        Form::populate($notification);

        $this->theme->prependTitle(trans('alert::notification.names'));
        return $this->theme->of('alert::user.notification.create', compact('notification'))->render();
    }

    /**
     * Display the specified resource.
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
            $notification = $this->repository->create($attributes);

            return redirect(trans_url('/user/alert/notification'))
                -> with('message', trans('messages.success.created', ['Module' => trans('alert::notification.name')]))
                -> with('code', 201);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Notification $notification
     *
     * @return Response
     */
    public function edit(NotificationRequest $request, Notification $notification)
    {

        Form::populate($notification);
        $this->theme->prependTitle(trans('alert::notification.names'));

        return $this->theme->of('alert::user.notification.edit', compact('notification'))->render();
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param Notification $notification
     *
     * @return Response
     */
    public function update(NotificationRequest $request, Notification $notification)
    {
        try {
            $this->repository->update($request->all(), $notification->getRouteKey());

            return redirect(trans_url('/user/alert/notification'))
                ->with('message', trans('messages.success.updated', ['Module' => trans('alert::notification.name')]))
                ->with('code', 204);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Remove the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(NotificationRequest $request, Notification $notification)
    {
        try {
            $this->repository->delete($notification->getRouteKey());
            return redirect(trans_url('/user/alert/notification'))
                ->with('message', trans('messages.success.deleted', ['Module' => trans('alert::notification.name')]))
                ->with('code', 204);

        } catch (Exception $e) {

            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);

        }
    }
}
