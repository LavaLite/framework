<?php

namespace Litepie\Roles\Http\Controllers;

use App\Http\Controllers\ResourceController as BaseController;
use Form;
use Litepie\Roles\Http\Requests\RoleRequest;
use Litepie\Roles\Interfaces\PermissionRepositoryInterface;
use Litepie\Roles\Interfaces\RoleRepositoryInterface;
use Litepie\Roles\Models\Role;

/**
 * Admin web controller class.
 */
class RoleResourceController extends BaseController
{

// use RoleWorkflow;
    /**
     * Initialize role controller.
     *
     * @param type RoleRepositoryInterface $role
     *
     * @return type
     */
    public function __construct(RoleRepositoryInterface $role, PermissionRepositoryInterface $permission)
    {
        $this->permission = $permission;
        $this->repository = $role;
        parent::__construct();
    }

    /**
     * Display a list of role.
     *
     * @return Response
     */
    public function index(RoleRequest $request)
    {

        if ($request->wantsJson()) {
            return $this->getJson($request);
        }

        $this->response->title(trans('user::role.names'))
            ->view($this->getView('user::admin.role.index'))
            ->output();
    }

    /**
     * Display a list of role.
     *
     * @return Response
     */
    public function getJson(RoleRequest $request)
    {
        $pageLimit = $request->input('pageLimit');

        $roles = $this->repository
            ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
            ->setPresenter('\\Litepie\\User\\Repositories\\Presenter\\RoleListPresenter')
            ->scopeQuery(function ($query) {
                return $query->orderBy('id', 'DESC');
            })->paginate($pageLimit);
        $roles['recordsTotal']    = $roles['meta']['pagination']['total'];
        $roles['recordsFiltered'] = $roles['meta']['pagination']['total'];
        $roles['request']         = $request->all();
        return response()->json($roles, 200);

    }

    /**
     * Display role.
     *
     * @param Request $request
     * @param Model   $role
     *
     * @return Response
     */
    public function show(RoleRequest $request, Role $role)
    {
        if (!$role->exists) {
            return response()->view('user::admin.role.new', compact('role'));
        }

        $permissions     = $this->permission->groupedPermissions(true);
        $rolePermissions = [];

        Form::populate($role);
        return response()->view('user::admin.role.show', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Show the form for creating a new role.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(RoleRequest $request)
    {

        $role = $this->repository->newInstance([]);

        $permissions     = $this->permission->groupedPermissions(true);
        $rolePermissions = [];

        Form::populate($role);

        return response()->view('user::admin.role.create', compact('role', 'permissions', 'rolePermissions'));

    }

    /**
     * Create new role.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(RoleRequest $request)
    {
        try {
            $attributes            = $request->all();
            $attributes['user_id'] = user_id('admin.web');
            $role                  = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('user::role.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/user/role/' . $role->getRouteKey()),
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 400,
            ], 400);
        }

    }

    /**
     * Show role for editing.
     *
     * @param Request $request
     * @param Model   $role
     *
     * @return Response
     */
    public function edit(RoleRequest $request, Role $role)
    {
        $permissions     = $this->permission->groupedPermissions(true);
        $rolePermissions = [];

        Form::populate($role);

        return response()->view('user::admin.role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the role.
     *
     * @param Request $request
     * @param Model   $role
     *
     * @return Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        try {

            $attributes = $request->all();

            $role->update($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('user::role.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/user/role/' . $role->getRouteKey()),
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/user/role/' . $role->getRouteKey()),
            ], 400);

        }

    }

    /**
     * Remove the role.
     *
     * @param Model   $role
     *
     * @return Response
     */
    public function destroy(RoleRequest $request, Role $role)
    {

        try {

            $t = $role->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('user::role.name')]),
                'code'     => 202,
                'redirect' => trans_url('/admin/user/role/0'),
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/user/role/' . $role->getRouteKey()),
            ], 400);
        }

    }

}
