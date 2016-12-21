<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\AdminController as BaseController;
use Form;
use Litepie\User\Http\Requests\PermissionRequest;
use Litepie\User\Interfaces\PermissionRepositoryInterface;
use Litepie\User\Models\Permission;

/**
 * Admin web controller class.
 */
class PermissionAdminController extends BaseController
{
    // use PermissionWorkflow;
    /**
     * Initialize permission controller.
     *
     * @param type PermissionRepositoryInterface $permission
     *
     * @return type
     */
    public function __construct(PermissionRepositoryInterface $permission)
    {
        $this->repository = $permission;
        parent::__construct();
    }

    /**
     * Display a list of permission.
     *
     * @return Response
     */
    public function index(PermissionRequest $request)
    {
        if ($request->wantsJson()) {
            return $this->getJson($request);
        }
        $this   ->theme->prependTitle(trans('user::permission.names').' :: ');
        return $this->theme->of('vuser::admin.permission.index')->render();
    }

    /**
     * Display a list of permission.
     *
     * @return Response
     */
    public function getJson(PermissionRequest $request)
    {
        $pageLimit = $request->input('pageLimit');

        $permissions  = $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->setPresenter('\\Litepie\\User\\Repositories\\Presenter\\PermissionListPresenter')
                ->scopeQuery(function($query){
                    return $query->orderBy('id','DESC');
                })->paginate($pageLimit);
        $permissions['recordsTotal']    = $permissions['meta']['pagination']['total'];
        $permissions['recordsFiltered'] = $permissions['meta']['pagination']['total'];
        $permissions['request']         = $request->all();
        return response()->json($permissions, 200);

    }

    /**
     * Display permission.
     *
     * @param Request $request
     * @param Model   $permission
     *
     * @return Response
     */
    public function show(PermissionRequest $request, Permission $permission)
    {
        if (!$permission->exists) {
            return response()->view('vuser::admin.permission.new', compact('permission'));
        }

        Form::populate($permission);
        return response()->view('vuser::admin.permission.show', compact('permission'));
    }

    /**
     * Show the form for creating a new permission.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(PermissionRequest $request)
    {

        $permission = $this->repository->newInstance([]);

        Form::populate($permission);

        return response()->view('vuser::admin.permission.create', compact('permission'));

    }

    /**
     * Create new permission.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(PermissionRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.web');
            $permission          = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('user::permission.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/user/permission/'.$permission->getRouteKey())
            ], 201);


        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
            ], 400);
        }
    }

    /**
     * Show permission for editing.
     *
     * @param Request $request
     * @param Model   $permission
     *
     * @return Response
     */
    public function edit(PermissionRequest $request, Permission $permission)
    {
        Form::populate($permission);
        return  response()->view('vuser::admin.permission.edit', compact('permission'));
    }

    /**
     * Update the permission.
     *
     * @param Request $request
     * @param Model   $permission
     *
     * @return Response
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        try {

            $attributes = $request->all();

            $permission->update($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('user::permission.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/user/permission/'.$permission->getRouteKey())
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/user/permission/'.$permission->getRouteKey()),
            ], 400);

        }
    }

    /**
     * Remove the permission.
     *
     * @param Model   $permission
     *
     * @return Response
     */
    public function destroy(PermissionRequest $request, Permission $permission)
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
                'redirect' => trans_url('/admin/user/permission/'.$permission->getRouteKey()),
            ], 400);
        }
    }

}
