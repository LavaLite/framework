<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\AdminController as BaseController;
use App\User;
use Form;
use Illuminate\Http\Request;
use Litepie\User\Http\Requests\UserRequest;
use Litepie\User\Interfaces\PermissionRepositoryInterface;
use Litepie\User\Interfaces\RoleRepositoryInterface;
use Litepie\User\Interfaces\UserRepositoryInterface;

/**
 * Admin web controller class.
 */
class UserAdminController extends BaseController
{

    /**
     * @var Permissions
     */
    protected $permission;

    /**
     * @var roles
     */
    protected $roles;

    /**
     * Initialize user controller.
     *
     * @param type UserRepositoryInterface $user
     *
     * @return type
     */
    public function __construct(UserRepositoryInterface $user,
        PermissionRepositoryInterface                       $permission,
        RoleRepositoryInterface                             $roles) {
        $this->repository = $user;
        $this->permission = $permission;
        $this->roles      = $roles;
        parent::__construct();
    }

    /**
     * Display a list of user.
     *
     * @return Response
     */
    public function index(UserRequest $request)
    {

        if ($request->wantsJson()) {
            return $this->getJson($request);
        }

        $this->theme->prependTitle(trans('user::user.names') . ' :: ');
        return $this->theme->of('vuser::admin.user.index')->render();
    }

    /**
     * Display a list of user.
     *
     * @return Response
     */
    public function getJson(UserRequest $request)
    {
        $pageLimit = $request->input('pageLimit');

        $users = $this->repository
            ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
            ->setPresenter('\\Litepie\\User\\Repositories\\Presenter\\UserListPresenter')
            ->scopeQuery(function ($query) {
                return $query->orderBy('id', 'DESC');
            })->paginate($pageLimit);
        $users['recordsTotal']    = $users['meta']['pagination']['total'];
        $users['recordsFiltered'] = $users['meta']['pagination']['total'];
        $users['request']         = $request->all();
        return response()->json($users, 200);

    }

    /**
     * Display user.
     *
     * @param Request $request
     * @param Model   $user
     *
     * @return Response
     */
    public function show(UserRequest $request, User $user)
    {

        if (!$user->exists) {
            return response()->view('vuser::admin.user.new', compact('user'));
        }

        $permissions = $this->permission->groupedPermissions(true);
        $roles       = $this->roles->all();

        Form::populate($user);
        return response()->view('vuser::admin.user.show', compact('user', 'roles', 'permissions'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(UserRequest $request)
    {

        $user        = $this->repository->newInstance([]);
        $permissions = $this->permission->groupedPermissions(true);
        $roles       = $this->roles->all();

        Form::populate($user);

        return response()->view('vuser::admin.user.create', compact('user', 'roles', 'permissions'));

    }

    /**
     * Create new user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(UserRequest $request)
    {
        try {
            $attributes            = $request->all();
            $attributes['user_id'] = user_id('admin.web');
            $attributes['password'] =bcrypt($attributes['password']);            
            $user                  = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('user::user.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/user/user/' . $user->getRouteKey()),
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'code'    => 400,
            ], 400);
        }

    }

    /**
     * Show user for editing.
     *
     * @param Request $request
     * @param Model   $user
     *
     * @return Response
     */
    public function edit(UserRequest $request, User $user)
    {
        $permissions = $this->permission->groupedPermissions(true);
        $roles       = $this->roles->all();
        Form::populate($user);
        return response()->view('vuser::admin.user.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the user.
     *
     * @param Request $request
     * @param Model   $user
     *
     * @return Response
     */
    public function update(UserRequest $request, User $user)
    {
        try {

            $attributes = $request->all();
            $attributes['password'] =bcrypt($attributes['password']);            

            $user->update($attributes);


            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('user::user.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/user/user/' . $user->getRouteKey()),
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/user/user/' . $user->getRouteKey()),
            ], 400);

        }

    }

    /**
     * Remove the user.
     *
     * @param Model   $user
     *
     * @return Response
     */
    public function destroy(UserRequest $request, User $user)
    {

        try {

            $t = $user->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('user::user.name')]),
                'code'     => 202,
                'redirect' => trans_url('/admin/user/user/0'),
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/user/user/' . $user->getRouteKey()),
            ], 400);
        }

    }


    /**
     * Change the default team.
     *
     * @param Request $request
     * @param Model   $user
     *
     * @return Response
     */
    public function changeTeam(Request $request)
    {
        try {

            $attributes = $request->all();
            $user = $request->user($this->getGuard());
            $user->update($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('user::user.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/user/user/' . $user->getRouteKey()),
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/user/user/' . $user->getRouteKey()),
            ], 400);

        }

    }


}
