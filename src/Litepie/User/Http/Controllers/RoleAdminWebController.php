<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\AdminWebController as AdminController;
use Form;
use Litepie\Contracts\User\PermissionRepository;
use Litepie\Contracts\User\RoleRepository;
use Litepie\User\Http\Requests\RoleAdminWebRequest;
use Litepie\User\Models\Role;

/**
 * Admin web controller class.
 */
class RoleAdminWebController extends AdminController
{
    /**
     * Initialize role controller.
     *
     * @param type RoleRepositoryInterface $role
     *
     * @return type
     */
    public function __construct(RoleRepository $role,
        PermissionRepository                       $permission) {
        $this->permission = $permission;
        $this->repository = $role;
        parent::__construct();
    }

    /**
     * Display a list of role.
     *
     * @return Response
     */
    public function index(RoleAdminWebRequest $request)
    {

        if ($request->wantsJson()) {
            return $roles = $this->repository->setPresenter('\\Litepie\\User\\Repositories\\Presenter\\RoleListPresenter')
                ->scopeQuery(function ($query) {
                    return $query->orderBy('id', 'DESC');
                })->all();
            return response()->json($roles, 200);

        }

        $this->theme->prependTitle(trans('user::user.role.names') . ' :: ');
        return $this->theme->of('user::admin.role.index')->render();
    }

    /**
     * Display role.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function show(RoleAdminWebRequest $request, Role $role)
    {

        if (!$role->exists) {
            return response()->view('user::admin.role.new', compact('role', 'permissions', 'rolePermissions'));
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
    public function create(RoleAdminWebRequest $request)
    {

        $role            = $this->repository->newInstance([]);
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
    public function store(RoleAdminWebRequest $request)
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
     * @param int     $id
     *
     * @return Response
     */
    public function edit(RoleAdminWebRequest $request, Role $role)
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
     * @param int     $id
     *
     * @return Response
     */
    public function update(RoleAdminWebRequest $request, Role $role)
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
     * @param int $id
     *
     * @return Response
     */
    public function destroy(RoleAdminWebRequest $request, Role $role)
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
