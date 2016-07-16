<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\AdminWebController as AdminController;
use App\User;
use Form;
use Litepie\Contracts\User\PermissionRepository;
use Litepie\Contracts\User\RoleRepository;
use Litepie\Contracts\User\UserRepository;
use Litepie\User\Http\Requests\UserAdminWebRequest;

/**
 * Admin web controller class.
 */
class UserAdminWebController extends AdminController
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
    public function __construct(UserRepository $user,
        PermissionRepository                       $permission,
        RoleRepository                             $roles) {
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
    public function index(UserAdminWebRequest $request)
    {

        if ($request->has('role')) {
            $role  = $request->get('role');
            $roles = $this->roles->scopeQuery(function ($model) use ($role) {
                return $model->whereName($role);
            })->first();
            return response()->json(['data' => $roles->users], 200);
        }

        if ($request->wantsJson()) {
            return $users = $this->repository->setPresenter('\\Litepie\\User\\Repositories\\Presenter\\UserListPresenter')
                ->scopeQuery(function ($query) {
                    return $query->orderBy('id', 'DESC');
                })->all();
            return response()->json($users, 200);

        }

        $this->theme->prependTitle(trans('user::user.user.names') . ' :: ');
        return $this->theme->of('user::admin.user.index')->render();
    }

    /**
     * Display user.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function show(UserAdminWebRequest $request, User $user)
    {

        if (!$user->exists) {
            return response()->view('user::admin.user.new', compact('user'));
        }

        $permissions = $this->permission->groupedPermissions(true);
        $roles       = $this->roles->all();

        Form::populate($user);
        return response()->view('user::admin.user.show', compact('user', 'roles', 'permissions'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(UserAdminWebRequest $request)
    {
        $user = $this->repository->newInstance([]);

        Form::populate($user);

        $permissions = $this->permission->groupedPermissions(true);
        $roles       = $this->roles->all();

        return response()->view('user::admin.user.create', compact('user', 'roles', 'permissions'));

    }

    /**
     * Create new user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(UserAdminWebRequest $request)
    {
        try {
            $attributes            = $request->all();
            $attributes['user_id'] = user_id('admin.web');
            $user                  = $this->repository->create($attributes);
            $user->syncRoles($request->get('roles'));
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
     * @param int     $id
     *
     * @return Response
     */
    public function edit(UserAdminWebRequest $request, User $user)
    {
        Form::populate($user);
        $permissions = $this->permission->groupedPermissions(true);
        $roles       = $this->roles->all();
        return response()->view('user::admin.user.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the user.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(UserAdminWebRequest $request, User $user)
    {
        try {

            $attributes = $request->all();
            $attributes['password'] = bcrypt($attributes['password']);

            $user->update($attributes);
            $user->syncRoles($request->get('roles'));
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
     * @param int $id
     *
     * @return Response
     */
    public function destroy(UserAdminWebRequest $request, User $user)
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

}
