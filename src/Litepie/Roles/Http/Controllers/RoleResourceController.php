<?php

namespace Litepie\Roles\Http\Controllers;

use App\Http\Controllers\ResourceController as BaseController;
use Litepie\Roles\Http\Requests\RoleRequest;
use Litepie\Roles\Interfaces\PermissionRepositoryInterface;
use Litepie\Roles\Interfaces\RoleRepositoryInterface;
use Litepie\Roles\Models\Role;

/**
 * Resource controller class for role.
 */
class RoleResourceController extends BaseController
{
    /**
     * Initialize role resource controller.
     *
     * @param type RoleRepositoryInterface $role
     *
     * @return null
     */
    public function __construct(
        RoleRepositoryInterface       $role,
        PermissionRepositoryInterface $permission
    ) {
        parent::__construct();
        $this->repository = $role;
        $this->permission = $permission;
        $this->repository
            ->pushCriteria(\Litepie\Repository\Criteria\RequestCriteria::class)
            ->pushCriteria(\Litepie\Roles\Repositories\Criteria\RoleResourceCriteria::class);
    }

    /**
     * Display a list of role.
     *
     * @return Response
     */
    public function index(RoleRequest $request)
    {
        if ($this->response->typeIs('json')) {
            $pageLimit = $request->input('pageLimit');
            $data = $this->repository
                ->setPresenter(\Litepie\Roles\Repositories\Presenter\RoleListPresenter::class)
                ->getDataTable($pageLimit);

            return $this->response
                ->data($data)
                ->output();
        }

        $roles = $this->repository->paginate();

        return $this->response->setMetaTitle(trans('roles::role.names'))
            ->view('roles::role.index', true)
            ->data(compact('roles'))
            ->output();
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
        if ($role->exists) {
            $view = 'roles::role.show';
        } else {
            $view = 'roles::role.new';
        }
        $permissions = $this->permission->groupedPermissions(true);

        return $this->response->setMetaTitle(trans('app.view').' '.trans('roles::role.name'))
            ->data(compact('role', 'permissions'))
            ->view($view, true)
            ->output();
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
        $permissions = $this->permission->groupedPermissions(true);
        $role = $this->repository->newInstance([]);

        return $this->response->setMetaTitle(trans('app.new').' '.trans('roles::role.name'))
            ->view('roles::role.create', true)
            ->data(compact('role', 'permissions'))
            ->output();
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
            $attributes = $request->all();
            $attributes['user_id'] = user_id();
            $attributes['user_type'] = user_type();
            $role = $this->repository->create($attributes);

            return $this->response->message(trans('messages.success.created', ['Module' => trans('roles::role.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('roles/role/'.$role->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('/roles/role'))
                ->redirect();
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
        $permissions = $this->permission->groupedPermissions(true);

        return $this->response->setMetaTitle(trans('app.edit').' '.trans('roles::role.name'))
            ->view('roles::role.edit', true)
            ->data(compact('role', 'permissions'))
            ->output();
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
            $permissions = $request->input('permissions');
            $role->update($attributes);
            $role->permissions()->sync($permissions);

            return $this->response->message(trans('messages.success.updated', ['Module' => trans('roles::role.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('roles/role/'.$role->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('roles/role/'.$role->getRouteKey()))
                ->redirect();
        }
    }

    /**
     * Remove the role.
     *
     * @param Model $role
     *
     * @return Response
     */
    public function destroy(RoleRequest $request, Role $role)
    {
        try {
            $role->delete();

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('roles::role.name')]))
                ->code(202)
                ->status('success')
                ->url(guard_url('roles/role/0'))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('roles/role/'.$role->getRouteKey()))
                ->redirect();
        }
    }
}
