<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\AdminController as AdminController;
use Form;
use Litepie\Contracts\User\PermissionRepository;
use Litepie\User\Http\Requests\PermissionAdminRequest;
use Litepie\User\Models\Permission;
use Response;

class PermissionAdminController extends AdminController
{
    /**
     * Initialize permission controller.
     *
     * @param type PermissionRepository $permission
     *
     * @return type
     */
    public function __construct(PermissionRepository $permission)
    {
        $this->model = $permission;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(PermissionAdminRequest $request)
    {
        $permissions = $this->model->setPresenter('\\Litepie\\User\\Repositories\\Presenter\\PermissionListPresenter')->paginate(null, ['*']);
        $this->theme->prependTitle(trans('user.permission.names').' :: ');
        $view = $this->theme->of('User::permission.index')->render();

        $this->responseCode = 200;
        $this->responseMessage = trans('messages.success.loaded', ['Module' => 'Permission']);
        $this->responseData = $permissions['data'];
        $this->responseMeta = $permissions['meta'];
        $this->responseView = $view;
        $this->responseRedirect = '';

        return $this->respond($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function show(PermissionAdminRequest $request, Permission $permission)
    {
        if (!$permission->exists) {
            $this->responseCode = 404;
            $this->responseMessage = trans('messages.success.notfound', ['Module' => 'Permission']);
            $this->responseView = view('User::permission.new');

            return $this->respond($request);
        }
        Form::populate($permission);
        $this->responseCode = 200;
        $this->responseMessage = trans('messages.success.loaded', ['Module' => 'Permission']);
        $this->responseView = view('User::permission.show', compact('permission'));

        return $this->respond($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(PermissionAdminRequest $request)
    {
        $permission = $this->model->newInstance([]);

        Form::populate($permission);

        $this->responseCode = 200;
        $this->responseMessage = trans('messages.success.loaded', ['Module' => 'Permission']);
        $this->responseData = $permission;
        $this->responseView = view('User::permission.create', compact('permission'));

        return $this->respond($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(PermissionAdminRequest $request)
    {
        try {
            $attributes = $request->all();
            $permission = $this->model->create($attributes);

            $this->responseCode = 201;
            $this->responseMessage = trans('messages.success.created', ['Module' => 'Permission']);
            $this->responseRedirect = trans_url('/admin/user/permission/'.$permission->getRouteKey());

            return $this->respond($request);
        } catch (Exception $e) {
            $this->responseCode = 400;
            $this->responseMessage = $e->getMessage();

            return $this->respond($request);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function edit(PermissionAdminRequest $request, Permission $permission)
    {
        Form::populate($permission);
        $this->responseCode = 200;
        $this->responseMessage = trans('messages.success.loaded', ['Module' => 'Permission']);
        $this->responseData = $permission;
        $this->responseView = view('User::permission.edit', compact('permission'));

        return $this->respond($request);
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(PermissionAdminRequest $request, Permission $permission)
    {
        try {
            $attributes = $request->all();

            $permission->update($attributes);

            $this->responseCode = 204;
            $this->responseMessage = trans('messages.success.updated', ['Module' => 'Permission']);
            $this->responseRedirect = trans_url('/admin/user/permission/'.$permission->getRouteKey());

            return $this->respond($request);
        } catch (Exception $e) {
            $this->responseCode = 400;
            $this->responseMessage = $e->getMessage();
            $this->responseRedirect = trans_url('/admin/user/permission/'.$permission->getRouteKey());

            return $this->respond($request);
        }
    }

    /**
     * Remove the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(PermissionAdminRequest $request, Permission $permission)
    {
        try {
            $t = $permission->delete();

            $this->responseCode = 202;
            $this->responseMessage = trans('messages.success.deleted', ['Module' => 'Permission']);
            $this->responseRedirect = trans_url('/admin/user/permission/0');

            return $this->respond($request);
        } catch (Exception $e) {
            $this->responseCode = 400;
            $this->responseMessage = $e->getMessage();
            $this->responseRedirect = trans_url('/admin/user/permission/'.$permission->getRouteKey());

            return $this->respond($request);
        }
    }
}
