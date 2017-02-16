<?php

namespace Litepie\Alert\Http\Controllers\Api;

use App\Http\Controllers\Api\AdminController as BaseController;
use Litepie\Alert\Http\Requests\NotificationRequest;
use Litepie\Alert\Interfaces\NotificationRepositoryInterface;
use Litepie\Alert\Models\Notification;

/**
 * Admin API controller class.
 */
class NotificationAdminController extends BaseController
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
        parent::__construct();
    }

    /**
     * Display a list of notification.
     *
     * @return json
     */
    public function index(NotificationRequest $request)
    {
        $notifications  = $this->repository
            ->setPresenter('\\Litepie\\Alert\\Repositories\\Presenter\\NotificationListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->all();
        $notifications['code'] = 2000;
        return response()->json($notifications) 
                         ->setStatusCode(200, 'INDEX_SUCCESS');

    }

    /**
     * Display notification.
     *
     * @param Request $request
     * @param Model   Notification
     *
     * @return Json
     */
    public function show(NotificationRequest $request, Notification $notification)
    {
        $notification         = $notification->presenter();
        $notification['code'] = 2001;
        return response()->json($notification)
                         ->setStatusCode(200, 'SHOW_SUCCESS');;

    }

    /**
     * Show the form for creating a new notification.
     *
     * @param Request $request
     *
     * @return json
     */
    public function create(NotificationRequest $request, Notification $notification)
    {
        $notification         = $notification->presenter();
        $notification['code'] = 2002;
        return response()->json($notification)
                         ->setStatusCode(200, 'CREATE_SUCCESS');

    }

    /**
     * Create new notification.
     *
     * @param Request $request
     *
     * @return json
     */
    public function store(NotificationRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.api');
            $notification          = $this->repository->create($attributes);
            $notification          = $notification->presenter();
            $notification['code']  = 2004;

            return response()->json($notification)
                             ->setStatusCode(201, 'STORE_SUCCESS');
        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4004,
            ])->setStatusCode(400, 'STORE_ERROR');
        }
    }

    /**
     * Show notification for editing.
     *
     * @param Request $request
     * @param Model   $notification
     *
     * @return json
     */
    public function edit(NotificationRequest $request, Notification $notification)
    {
        $notification         = $notification->presenter();
        $notification['code'] = 2003;
        return response()-> json($notification)
                        ->setStatusCode(200, 'EDIT_SUCCESS');;
    }

    /**
     * Update the notification.
     *
     * @param Request $request
     * @param Model   $notification
     *
     * @return json
     */
    public function update(NotificationRequest $request, Notification $notification)
    {
        try {

            $attributes = $request->all();

            $notification->update($attributes);
            $notification         = $notification->presenter();
            $notification['code'] = 2005;

            return response()->json($notification)
                             ->setStatusCode(201, 'UPDATE_SUCCESS');


        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4005,
            ])->setStatusCode(400, 'UPDATE_ERROR');

        }
    }

    /**
     * Remove the notification.
     *
     * @param Request $request
     * @param Model   $notification
     *
     * @return json
     */
    public function destroy(NotificationRequest $request, Notification $notification)
    {
        try {
            $t = $notification->delete();

            return response()->json([
                'message'  => trans('messages.success.delete', ['Module' => trans('alert::notification.name')]),
                'code'     => 2006
            ])->setStatusCode(202, 'DESTROY_SUCCESS');

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4006,
            ])->setStatusCode(400, 'DESTROY_ERROR');
        }
    }
}
