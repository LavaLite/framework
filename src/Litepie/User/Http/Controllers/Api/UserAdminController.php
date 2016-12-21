<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\Api\AdminController as BaseController;
use Litepie\User\Http\Requests\UserRequest;
use Litepie\User\Interfaces\UserRepositoryInterface;
use App\User;

/**
 * Admin API controller class.
 */
class UserAdminApiController extends BaseController
{
    /**
     * Initialize user controller.
     *
     * @param type UserRepositoryInterface $user
     *
     * @return type
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->repository = $user;
        parent::__construct();
    }

    /**
     * Display a list of user.
     *
     * @return json
     */
    public function index(UserRequest $request)
    {
        $users  = $this->repository
            ->setPresenter('\\Litepie\\User\\Repositories\\Presenter\\UserListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->all();
        $users['code'] = 2000;
        return response()->json($users) 
                         ->setStatusCode(200, 'INDEX_SUCCESS');

    }

    /**
     * Display user.
     *
     * @param Request $request
     * @param Model   User
     *
     * @return Json
     */
    public function show(UserRequest $request, User $user)
    {
        $user         = $user->presenter();
        $user['code'] = 2001;
        return response()->json($user)
                         ->setStatusCode(200, 'SHOW_SUCCESS');;

    }

    /**
     * Show the form for creating a new user.
     *
     * @param Request $request
     *
     * @return json
     */
    public function create(UserRequest $request, User $user)
    {
        $user         = $user->presenter();
        $user['code'] = 2002;
        return response()->json($user)
                         ->setStatusCode(200, 'CREATE_SUCCESS');

    }

    /**
     * Create new user.
     *
     * @param Request $request
     *
     * @return json
     */
    public function store(UserRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.api');
            $user          = $this->repository->create($attributes);
            $user          = $user->presenter();
            $user['code']  = 2004;

            return response()->json($user)
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
     * Show user for editing.
     *
     * @param Request $request
     * @param Model   $user
     *
     * @return json
     */
    public function edit(UserRequest $request, User $user)
    {
        $user         = $user->presenter();
        $user['code'] = 2003;
        return response()-> json($user)
                        ->setStatusCode(200, 'EDIT_SUCCESS');;
    }

    /**
     * Update the user.
     *
     * @param Request $request
     * @param Model   $user
     *
     * @return json
     */
    public function update(UserRequest $request, User $user)
    {
        try {

            $attributes = $request->all();

            $user->update($attributes);
            $user         = $user->presenter();
            $user['code'] = 2005;

            return response()->json($user)
                             ->setStatusCode(201, 'UPDATE_SUCCESS');


        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4005,
            ])->setStatusCode(400, 'UPDATE_ERROR');

        }
    }

    /**
     * Remove the user.
     *
     * @param Request $request
     * @param Model   $user
     *
     * @return json
     */
    public function destroy(UserRequest $request, User $user)
    {

        try {

            $t = $user->delete();

            return response()->json([
                'message'  => trans('messages.success.delete', ['Module' => trans('user::user.name')]),
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
