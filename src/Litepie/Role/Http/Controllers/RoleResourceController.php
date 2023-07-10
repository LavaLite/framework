<?php

namespace Litepie\Role\Http\Controllers;

use Exception;
use Litepie\Http\Controllers\ResourceController as BaseController;
use Litepie\Role\Actions\PermissionActions;
use Litepie\Role\Actions\RoleAction;
use Litepie\Role\Actions\RoleActions;
use Litepie\Role\Forms\Role as RoleForm;
use Litepie\Role\Http\Requests\RoleResourceRequest;
use Litepie\Role\Http\Resources\RoleResource;
use Litepie\Role\Http\Resources\RolesCollection;
use Litepie\Role\Models\Role;

/**
 * Resource controller class for role.
 */
class RoleResourceController extends BaseController
{

    /**
     * Initialize role resource controller.
     *
     *
     * @return null
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(function ($request, $next) {
            $this->form = RoleForm::only('main')
                ->setAttributes()
                ->toArray();
            $this->modules = $this->modules(config('role.modules'), 'role', guard_url('role'));
            return $next($request);
        });
    }

    /**
     * Display a list of role.
     *
     * @return Response
     */
    public function index(RoleResourceRequest $request)
    {
        $request = $request->all();
        $page = RoleActions::run('paginate', $request);

        $data = new RolesCollection($page);

        $form = $this->form;
        $modules = $this->modules;

        return $this->response->setMetaTitle(trans('role::role.names'))
            ->view('role::role.index')
            ->data(compact('data', 'modules', 'form'))
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
    public function show(RoleResourceRequest $request, Role $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new RoleResource($model);
        $permissions = PermissionActions::run('grouped', []);

        return $this->response
            ->setMetaTitle(trans('app.view') . ' ' . trans('role.role.name'))
            ->data(compact('data', 'form', 'modules', 'permissions'))
            ->view('role::role.show')
            ->output();
    }

    /**
     * Show the form for creating a new role.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(RoleResourceRequest $request, Role $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new RoleResource($model);
        $permissions = PermissionActions::run('grouped', []);

        return $this->response->setMetaTitle(trans('app.new') . ' ' . trans('role::role.name'))
            ->view('role::role.create')
            ->data(compact('data', 'form', 'modules', 'permissions'))
            ->output();

    }

    /**
     * Create new role.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(RoleResourceRequest $request, Role $model)
    {
        try {
            $request = $request->all();
            $model = RoleAction::run('store', $model, $request);
            $data = new RoleResource($model);
            return $this->response->message(trans('messages.success.created', ['Module' => trans('role::role.name')]))
                ->code(204)
                ->data(compact('data'))
                ->status('success')
                ->url(guard_url('role/role/' . $model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('/role/role'))
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
    public function edit(RoleResourceRequest $request, Role $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new RoleResource($model);
        $permissions = PermissionActions::run('grouped', []);

        return $this->response->setMetaTitle(trans('app.edit') . ' ' . trans('role::role.name'))
            ->view('role::role.edit')
            ->data(compact('data', 'form', 'modules', 'permissions'))
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
    public function update(RoleResourceRequest $request, Role $model)
    {
        try {
            $request = $request->all();
            $model = RoleAction::run('update', $model, $request);
            $data = new RoleResource($model);

            return $this->response->message(trans('messages.success.updated', ['Module' => trans('role::role.name')]))
                ->code(204)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('role/role/' . $model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('role/role/' . $model->getRouteKey()))
                ->redirect();
        }

    }

    /**
     * Remove the role.
     *
     * @param Model   $role
     *
     * @return Response
     */
    public function destroy(RoleResourceRequest $request, Role $model)
    {
        try {

            $request = $request->all();
            $model = RoleAction::run('destroy', $model, $request);
            $data = new RoleResource($model);

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('role::role.name')]))
                ->code(202)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('role/role/0'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('role/role/' . $model->getRouteKey()))
                ->redirect();
        }

    }
}
