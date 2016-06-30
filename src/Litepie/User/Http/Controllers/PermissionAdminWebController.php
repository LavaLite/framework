<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\AdminWebController as AdminController;
use Form;
use Litepie\Contracts\User\PermissionRepository;
use Litepie\User\Http\Requests\PermissionAdminWebRequest;
use Litepie\User\Models\Permission;

/**
 * Admin web controller class.
 */
class PermissionAdminWebController extends AdminController
{
    /**
     * Initialize permission controller.
     *
     * @param type PermissionRepositoryInterface $permission
     *
     * @return type
     */
    public function __construct(PermissionRepository $permission)
    {
        parent::__construct();
        $this->repository = $permission;
    }

    /**
     * Display a list of permission.
     *
     * @return Response
     */
    public function index(PermissionAdminWebRequest $request)
    {

        if ($request->wantsJson()) {
            return $permissions = $this->repository->setPresenter('\\Litepie\\User\\Repositories\\Presenter\\PermissionListPresenter')
                ->scopeQuery(function ($query) {
                    return $query->orderBy('id', 'DESC');
                })->all();
            return response()->json($permissions, 200);

        }

        $this->theme->prependTitle(trans('user::user.permission.names') . ' :: ');
        return $this->theme->of('user::admin.permission.index')->render();
    }

    /**
     * Display permission.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function show(PermissionAdminWebRequest $request, Permission $permission)
    {

        if (!$permission->exists) {
            return response()->view('user::admin.permission.new', compact($permission));
        }

        Form::populate($permission);
        return response()->view('user::admin.permission.show', compact('permission'));
    }

    /**
     * Show the form for creating a new permission.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(PermissionAdminWebRequest $request)
    {

        $permission = $this->repository->newInstance([]);

        Form::populate($permission);

        return response()->view('user::admin.permission.create', compact('permission'));

    }

    /**
     * Create new permission.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(PermissionAdminWebRequest $request)
    {
        try {
            $attributes            = $request->all();
            $attributes['user_id'] = user_id('admin.web');
            $permission            = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('user::permission.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/user/permission/' . $permission->getRouteKey()),
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 400,
            ], 400);
        }

    }

    /**
     * Show permission for editing.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function edit(PermissionAdminWebRequest $request, Permission $permission)
    {
        Form::populate($permission);
        return response()->view('user::admin.permission.edit', compact('permission'));
    }

    /**
     * Update the permission.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(PermissionAdminWebRequest $request, Permission $permission)
    {
        try {

            $attributes = $request->all();

            $permission->update($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('user::permission.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/user/permission/' . $permission->getRouteKey()),
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/user/permission/' . $permission->getRouteKey()),
            ], 400);

        }

    }

    /**
     * Remove the permission.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(PermissionAdminWebRequest $request, Permission $permission)
    {

        try {

            $t = $permission->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('user::permission.name')]),
                'code'     => 202,
                'redirect' => trans_url('/admin/user/permission/0'),
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/user/permission/' . $permission->getRouteKey()),
            ], 400);
        }

    }

}
