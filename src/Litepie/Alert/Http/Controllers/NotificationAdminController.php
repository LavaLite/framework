<?php

namespace Litepie\Alert\Http\Controllers;

use App\Http\Controllers\AdminController as BaseController;
use Form;
use Litepie\Alert\Http\Requests\NotificationRequest;
use Litepie\Alert\Interfaces\NotificationRepositoryInterface;
use Litepie\Alert\Models\Notification;

/**
 * Admin web controller class.
 */
class NotificationAdminController extends BaseController
{
    // use NotificationWorkflow;
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
        parent::__construct();
    }

    /**
     * Display a list of notification.
     *
     * @return Response
     */
    public function index(NotificationRequest $request)
    {
        if ($request->wantsJson()) {
            return $this->getJson($request);
        }
        $this   ->theme->prependTitle(trans('alert::notification.names').' :: ');
        return $this->theme->of('alert::admin.notification.index')->render();
    }

    /**
     * Display a list of notification.
     *
     * @return Response
     */
    public function getJson(NotificationRequest $request)
    {
        $pageLimit = $request->input('pageLimit');

        $notifications  = $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->setPresenter('\\Litepie\\Alert\\Repositories\\Presenter\\NotificationListPresenter')
                ->scopeQuery(function($query){
                    return $query->orderBy('id','DESC');
                })->paginate($pageLimit);
        $notifications['recordsTotal']    = $notifications['meta']['pagination']['total'];
        $notifications['recordsFiltered'] = $notifications['meta']['pagination']['total'];
        $notifications['request']         = $request->all();
        return response()->json($notifications, 200);

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
        if (!$notification->exists) {
            return response()->view('alert::admin.notification.new', compact('notification'));
        }

        Form::populate($notification);
        return response()->view('alert::admin.notification.show', compact('notification'));
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

        Form::populate($notification);

        return response()->view('alert::admin.notification.create', compact('notification'));

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
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.web');
            $notification          = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('alert::notification.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/alert/notification/'.$notification->getRouteKey())
            ], 201);


        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
            ], 400);
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
        Form::populate($notification);
        return  response()->view('alert::admin.notification.edit', compact('notification'));
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

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('alert::notification.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/alert/notification/'.$notification->getRouteKey())
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/alert/notification/'.$notification->getRouteKey()),
            ], 400);

        }
    }

    /**
     * Update the notification.
     *
     * @param Request $request
     * @param Model   $notification
     *
     * @return Response
     */
    public function read(NotificationRequest $request, Notification $notification)
    {
        if (empty($notification->read_at)) {
            $notification->update(['read_at' => date('Y-m-d H:i:s')]);
        }
    }

    /**
     * Remove the notification.
     *
     * @param Model   $notification
     *
     * @return Response
     */
    public function destroy(NotificationRequest $request, Notification $notification)
    {

        try {

            $t = $notification->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('alert::notification.name')]),
                'code'     => 202,
                'redirect' => trans_url('/admin/alert/notification/0'),
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/alert/notification/'.$notification->getRouteKey()),
            ], 400);
        }
    }

}
