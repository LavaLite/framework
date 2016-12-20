<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\Api\UserController as BaseController;
use Litepie\User\Http\Requests\RoleRequest;
use Litepie\User\Interfaces\RoleRepositoryInterface;
use Litepie\User\Models\Role;

/**
 * User API controller class.
 */
class RoleUserApiController extends BaseController
{
    /**
     * Initialize role controller.
     *
     * @param type RoleRepositoryInterface $role
     *
     * @return type
     */
    public function __construct(RoleRepositoryInterface $role)
    {
        $this->repository = $role;
        parent::__construct();
    }

    /**
     * Display a list of role.
     *
     * @return json
     */
    public function index(RoleRequest $request)
    {
        $roles  = $this->repository
            ->pushCriteria(new \Lavalite\User\Repositories\Criteria\RoleUserCriteria())
            ->setPresenter('\\Litepie\\User\\Repositories\\Presenter\\RoleListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->all();
        $roles['code'] = 2000;
        return response()->json($roles) 
            ->setStatusCode(200, 'INDEX_SUCCESS');

    }

    /**
     * Display role.
     *
     * @param Request $request
     * @param Model   Role
     *
     * @return Json
     */
    public function show(RoleRequest $request, Role $role)
    {

        if ($role->exists) {
            $role         = $role->presenter();
            $role['code'] = 2001;
            return response()->json($role)
                ->setStatusCode(200, 'SHOW_SUCCESS');;
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }

    /**
     * Show the form for creating a new role.
     *
     * @param Request $request
     *
     * @return json
     */
    public function create(RoleRequest $request, Role $role)
    {
        $role         = $role->presenter();
        $role['code'] = 2002;
        return response()->json($role)
            ->setStatusCode(200, 'CREATE_SUCCESS');
    }

    /**
     * Create new role.
     *
     * @param Request $request
     *
     * @return json
     */
    public function store(RoleRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.api');
            $role          = $this->repository->create($attributes);
            $role          = $role->presenter();
            $role['code']  = 2004;

            return response()->json($role)
                ->setStatusCode(201, 'STORE_SUCCESS');
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 4004,
            ])->setStatusCode(400, 'STORE_ERROR');
        }

    }

    /**
     * Show role for editing.
     *
     * @param Request $request
     * @param Model   $role
     *
     * @return json
     */
    public function edit(RoleRequest $request, Role $role)
    {
        if ($role->exists) {
            $role         = $role->presenter();
            $role['code'] = 2003;
            return response()-> json($role)
                ->setStatusCode(200, 'EDIT_SUCCESS');;
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }
    }

    /**
     * Update the role.
     *
     * @param Request $request
     * @param Model   $role
     *
     * @return json
     */
    public function update(RoleRequest $request, Role $role)
    {
        try {

            $attributes = $request->all();

            $role->update($attributes);
            $role         = $role->presenter();
            $role['code'] = 2005;

            return response()->json($role)
                ->setStatusCode(201, 'UPDATE_SUCCESS');


        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4005,
            ])->setStatusCode(400, 'UPDATE_ERROR');

        }
    }

    /**
     * Remove the role.
     *
     * @param Request $request
     * @param Model   $role
     *
     * @return json
     */
    public function destroy(RoleRequest $request, Role $role)
    {

        try {

            $t = $role->delete();

            return response()->json([
                'message'  => trans('messages.success.delete', ['Module' => trans('user::role.name')]),
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
