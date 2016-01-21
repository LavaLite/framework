<?php
namespace Litepie\User\Http\Controllers;

use Form;
use Response;
use Litepie\User\Models\Role;
use App\Http\Controllers\AdminController as AdminController;
use Litepie\User\Http\Requests\RoleAdminRequest;
use Litepie\User\Interfaces\RoleRepositoryInterface;
use Litepie\User\Interfaces\PermissionRepositoryInterface;

/**
 *
 * @package Role
 */

class RoleAdminController extends AdminController
{
    /**
     * @var Permissions
     *
     */
    protected $permission;

    /**
     * Initialize role controller
     * @param type RoleRepositoryInterface $role
     * @return type
     */
    public function __construct(RoleRepositoryInterface $role,
                                PermissionRepositoryInterface $permission)
    {
        $this->permission = $permission;
        $this->model = $role;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(RoleAdminRequest $request)
    {
        if ($request->wantsJson()) {
            $array = $this->model->toArray(['*'], config('user.role.listfields'));

            return ['data' => $array];
        }

        $this->theme->prependTitle(trans('user::role.names').' :: ');

        return $this->theme->of('user::admin.role.index')->render();
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @param  int  $id
     *
     * @return Response
     */
    public function show(RoleAdminRequest $request, Role $role)
    {
        if (!$role->exists) {
            if ($request->wantsJson()) {
                return [];
            }

            return view('user::admin.role.new');
        }

        if ($request->wantsJson()) {
            return $role;
        }

        $permissions        = $this->permission->groupedPermissions(true);
        $rolePermissions    = [];
        Form::populate($role);

        return view('user::admin.role.show', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(RoleAdminRequest $request)
    {
        $role = $this->model->findOrNew(0);
        Form::populate($role);
        $permissions  = $this->permission->groupedPermissions(true);
        return view('user::admin.role.create', compact('role', 'permissions'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(RoleAdminRequest $request)
    {
        try {
            $attributes         = $request->all();
            $role       = $this->model->create($attributes);
            return $this->success(trans('messages.success.created', ['Module' => trans('user::role.name')]));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function edit(RoleAdminRequest $request, Role $role)
    {
        $permissions  = $this->permission->groupedPermissions(true);

        Form::populate($role);
        $rolePermissions    = [];
        return view('user::admin.role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(RoleAdminRequest $request, Role $role)
    {
        try {
            $attributes         = $request->all();
            $role->update($attributes);
            return $this->success(trans('messages.success.updated', ['Module' => trans('user::role.name')]));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(RoleAdminRequest $request, Role $role)
    {
        try {
            $role->delete();
            return $this->success(trans('message.success.deleted', ['Module' => trans('user::role.name')]), 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
