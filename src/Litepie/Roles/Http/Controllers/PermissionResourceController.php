<?php

namespace Litepie\Roles\Http\Controllers;

use App\Http\Controllers\ResourceController as BaseController;
use Litepie\Roles\Http\Requests\PermissionRequest;
use Litepie\Roles\Interfaces\PermissionRepositoryInterface;
use Litepie\Roles\Models\Permission;

/**
 * Resource controller class for permission.
 */
class PermissionResourceController extends BaseController
{
    /**
     * Initialize permission resource controller.
     *
     * @param type PermissionRepositoryInterface $permission
     *
     * @return null
     */
    public function __construct(PermissionRepositoryInterface $permission)
    {
        parent::__construct();
        $this->repository = $permission;
        $this->repository
            ->pushCriteria(\Litepie\Repository\Criteria\RequestCriteria::class)
            ->pushCriteria(\Litepie\Roles\Repositories\Criteria\PermissionResourceCriteria::class);
    }

    /**
     * Display a list of permission.
     *
     * @return Response
     */
    public function index(PermissionRequest $request)
    {
        if ($this->response->typeIs('json')) {
            $pageLimit = $request->input('pageLimit');
            $data = $this->repository
                ->setPresenter(\Litepie\Roles\Repositories\Presenter\PermissionListPresenter::class)
                ->getDataTable($pageLimit);

            return $this->response
                ->data($data)
                ->output();
        }

        $permissions = $this->repository->paginate();

        return $this->response->setMetaTitle(trans('roles::permission.names'))
            ->view('roles::permission.index', true)
            ->data(compact('permissions'))
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
    public function show(PermissionRequest $request, Permission $permission)
    {
        if ($permission->exists) {
            $view = 'roles::permission.show';
        } else {
            $view = 'roles::permission.new';
        }

        return $this->response->setMetaTitle(trans('app.view').' '.trans('roles::permission.name'))
            ->data(compact('permission'))
            ->view($view, true)
            ->output();
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

        return $this->response->setMetaTitle(trans('app.new').' '.trans('roles::permission.name'))
            ->view('roles::permission.create', true)
            ->data(compact('permission'))
            ->output();
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
            $attributes = $request->all();
            $attributes['user_id'] = user_id();
            $attributes['user_type'] = user_type();
            $permission = $this->repository->create($attributes);

            return $this->response->message(trans('messages.success.created', ['Module' => trans('roles::permission.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('roles/permission/'.$permission->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('/roles/permission'))
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
    public function edit(PermissionRequest $request, Permission $permission)
    {
        return $this->response->setMetaTitle(trans('app.edit').' '.trans('roles::permission.name'))
            ->view('roles::permission.edit', true)
            ->data(compact('permission'))
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
    public function update(PermissionRequest $request, Permission $permission)
    {
        try {
            $attributes = $request->all();

            $permission->update($attributes);

            return $this->response->message(trans('messages.success.updated', ['Module' => trans('roles::permission.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('roles/permission/'.$permission->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('roles/permission/'.$permission->getRouteKey()))
                ->redirect();
        }
    }

    /**
     * Remove the permission.
     *
     * @param Model $permission
     *
     * @return Response
     */
    public function destroy(PermissionRequest $request, Permission $permission)
    {
        try {
            $permission->delete();

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('roles::permission.name')]))
                ->code(202)
                ->status('success')
                ->url(guard_url('roles/permission/0'))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('roles/permission/'.$permission->getRouteKey()))
                ->redirect();
        }
    }

    /**
     * Remove multiple permission.
     *
     * @param Model $permission
     *
     * @return Response
     */
    public function delete(PermissionRequest $request, $type)
    {
        try {
            $ids = hashids_decode($request->input('ids'));

            if ($type == 'purge') {
                $this->repository->purge($ids);
            } else {
                $this->repository->delete($ids);
            }

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('roles::permission.name')]))
                ->status('success')
                ->code(202)
                ->url(guard_url('roles/permission/0'))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->status('error')
                ->code(400)
                ->url(guard_url('/roles/permission'))
                ->redirect();
        }
    }

    /**
     * Restore deleted permissions.
     *
     * @param Model $permission
     *
     * @return Response
     */
    public function restore(PermissionRequest $request)
    {
        try {
            $ids = hashids_decode($request->input('ids'));
            $this->repository->restore($ids);

            return $this->response->message(trans('messages.success.restore', ['Module' => trans('roles::permission.name')]))
                ->status('success')
                ->code(202)
                ->url(guard_url('/roles/permission'))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->status('error')
                ->code(400)
                ->url(guard_url('/roles/permission/'))
                ->redirect();
        }
    }
}
