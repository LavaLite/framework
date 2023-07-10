<?php

namespace Litepie\Role\Http\Controllers;

use Exception;
use Litepie\Http\Controllers\ResourceController as BaseController;
use Litepie\Role\Actions\PermissionAction;
use Litepie\Role\Actions\PermissionActions;
use Litepie\Role\Forms\Permission as PermissionForm;
use Litepie\Role\Http\Requests\PermissionResourceRequest;
use Litepie\Role\Http\Resources\PermissionResource;
use Litepie\Role\Http\Resources\PermissionsCollection;
use Litepie\Role\Models\Permission;

/**
 * Resource controller class for permission.
 */
class PermissionResourceController extends BaseController
{

    /**
     * Initialize permission resource controller.
     *
     *
     * @return null
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(function ($request, $next) {
            $this->form = PermissionForm::only('main')
                ->setAttributes()
                ->toArray();
            $this->modules = $this->modules(config('role.modules'), 'role', guard_url('role'));
            return $next($request);
        });
    }

    /**
     * Display a list of permission.
     *
     * @return Response
     */
    public function index(PermissionResourceRequest $request)
    {
        $request = $request->all();
        $page = PermissionActions::run('paginate', $request);

        $data = new PermissionsCollection($page);

        $form = $this->form;
        $modules = $this->modules;

        return $this->response->setMetaTitle(trans('role::permission.names'))
            ->view('role::permission.index')
            ->data(compact('data', 'modules', 'form'))
            ->output();

    }

    /**
     * Display permission.
     *
     * @param Request $request
     * @param Model   $permission
     *
     * @return Response
     */
    public function show(PermissionResourceRequest $request, Permission $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new PermissionResource($model);
        return $this->response
            ->setMetaTitle(trans('app.view') . ' ' . trans('role::permission.name'))
            ->data(compact('data', 'form', 'modules'))
            ->view('role::permission.show')
            ->output();
    }

    /**
     * Show the form for creating a new permission.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(PermissionResourceRequest $request, Permission $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new PermissionResource($model);
        return $this->response->setMetaTitle(trans('app.new') . ' ' . trans('role::permission.name'))
            ->view('role::permission.create')
            ->data(compact('data', 'form', 'modules'))
            ->output();

    }

    /**
     * Create new permission.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(PermissionResourceRequest $request, Permission $model)
    {
        try {
            $request = $request->all();
            $model = PermissionAction::run('store', $model, $request);
            $data = new PermissionResource($model);
            return $this->response->message(trans('messages.success.created', ['Module' => trans('role::permission.name')]))
                ->code(204)
                ->data(compact('data'))
                ->status('success')
                ->url(guard_url('role/permission/' . $model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('/role/permission'))
                ->redirect();
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
    public function edit(PermissionResourceRequest $request, Permission $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new PermissionResource($model);
        // return view('role::permission.edit', compact('data', 'form', 'modules'));

        return $this->response->setMetaTitle(trans('app.edit') . ' ' . trans('role::permission.name'))
            ->view('role::permission.edit')
            ->data(compact('data', 'form', 'modules'))
            ->output();

    }

    /**
     * Update the permission.
     *
     * @param Request $request
     * @param Model   $permission
     *
     * @return Response
     */
    public function update(PermissionResourceRequest $request, Permission $model)
    {
        try {
            $request = $request->all();
            $model = PermissionAction::run('update', $model, $request);
            $data = new PermissionResource($model);

            return $this->response->message(trans('messages.success.updated', ['Module' => trans('role::permission.name')]))
                ->code(204)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('role/permission/' . $model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('role/permission/' . $model->getRouteKey()))
                ->redirect();
        }

    }

    /**
     * Remove the permission.
     *
     * @param Model   $permission
     *
     * @return Response
     */
    public function destroy(PermissionResourceRequest $request, Permission $model)
    {
        try {

            $request = $request->all();
            $model = PermissionAction::run('destroy', $model, $request);
            $data = new PermissionResource($model);

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('role::permission.name')]))
                ->code(202)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('role/permission/0'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('role/permission/' . $model->getRouteKey()))
                ->redirect();
        }

    }
}
