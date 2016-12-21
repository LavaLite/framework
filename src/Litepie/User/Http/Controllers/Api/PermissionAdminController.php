<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\Api\AdminController as BaseController;
use Litepie\User\Http\Requests\PermissionRequest;
use Litepie\User\Interfaces\PermissionRepositoryInterface;
use Litepie\User\Models\Permission;

/**
 * Admin API controller class.
 */
class PermissionAdminApiController extends BaseController
{
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
     * @return json
     */
    public function index(PermissionRequest $request)
    {
        $permissions  = $this->repository
            ->setPresenter('\\Litepie\\User\\Repositories\\Presenter\\PermissionListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->all();
        $permissions['code'] = 2000;
        return response()->json($permissions) 
                         ->setStatusCode(200, 'INDEX_SUCCESS');

    }

    /**
     * Display permission.
     *
     * @param Request $request
     * @param Model   Permission
     *
     * @return Json
     */
    public function show(PermissionRequest $request, Permission $permission)
    {
        $permission         = $permission->presenter();
        $permission['code'] = 2001;
        return response()->json($permission)
                         ->setStatusCode(200, 'SHOW_SUCCESS');;

    }

    /**
     * Show the form for creating a new permission.
     *
     * @param Request $request
     *
     * @return json
     */
    public function create(PermissionRequest $request, Permission $permission)
    {
        $permission         = $permission->presenter();
        $permission['code'] = 2002;
        return response()->json($permission)
                         ->setStatusCode(200, 'CREATE_SUCCESS');

    }

    /**
     * Create new permission.
     *
     * @param Request $request
     *
     * @return json
     */
    public function store(PermissionRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.api');
            $permission          = $this->repository->create($attributes);
            $permission          = $permission->presenter();
            $permission['code']  = 2004;

            return response()->json($permission)
                             ->setStatusCode(201, 'STORE_SUCCESS');
        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4004,
            ])->setStatusCode(400, 'STORE_ERROR');
;
        }
    }

    /**
     * Show permission for editing.
     *
     * @param Request $request
     * @param Model   $permission
     *
     * @return json
     */
    public function edit(PermissionRequest $request, Permission $permission)
    {
        $permission         = $permission->presenter();
        $permission['code'] = 2003;
        return response()-> json($permission)
                        ->setStatusCode(200, 'EDIT_SUCCESS');;
    }

    /**
     * Update the permission.
     *
     * @param Request $request
     * @param Model   $permission
     *
     * @return json
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        try {

            $attributes = $request->all();

            $permission->update($attributes);
            $permission         = $permission->presenter();
            $permission['code'] = 2005;

            return response()->json($permission)
                             ->setStatusCode(201, 'UPDATE_SUCCESS');


        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4005,
            ])->setStatusCode(400, 'UPDATE_ERROR');

        }
    }

    /**
     * Remove the permission.
     *
     * @param Request $request
     * @param Model   $permission
     *
     * @return json
     */
    public function destroy(PermissionRequest $request, Permission $permission)
    {

        try {

            $t = $permission->delete();

            return response()->json([
                'message'  => trans('messages.success.delete', ['Module' => trans('user::permission.name')]),
                'code'     => 2006
            ])->setStatusCode(202, 'DESTROY_SUCCESS');

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4006,
            ])->setStatusCode(400, 'DESTROY_ERROR');
        }
    }
}
