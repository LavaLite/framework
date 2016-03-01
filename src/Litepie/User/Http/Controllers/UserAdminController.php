<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\AdminController as AdminController;
use App\User;
use Form;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Litepie\Contracts\User\PermissionRepository;
use Litepie\Contracts\User\RoleRepository;
use Litepie\Contracts\User\UserRepository;
use Litepie\User\Http\Requests\UserAdminRequest;
use Response;

class UserAdminController extends AdminController
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
     * @param type UserRepository $user
     *
     * @return type
     */
    public function __construct(UserRepository $user,
                                PermissionRepository $permission,
                                RoleRepository $roles)
    {
        $this->repository = $user;
        $this->permission = $permission;
        $this->roles = $roles;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(UserAdminRequest $request, $role = null)
    {

        if ($request->has('role')) {
                $users = $this->roles->with(['users'])->findByField('name', $request->get('role'));

                return $users;
            }
        $users = $this->repository->setPresenter('\\Litepie\\User\\Repositories\\Presenter\\UserListPresenter')->paginate(null, ['*']);
        $this->theme->prependTitle(trans('user::user.names').' :: ');
        $view = $this->theme->of('User::user.index')->render();
        $this->responseCode = 200;
        $this->responseMessage = trans('messages.success.loaded', ['Module' => 'User']);
        $this->responseData = $users['data'];
        $this->responseMeta = $users['meta'];
        $this->responseView = $view;
        $this->responseRedirect = '';

        return $this->respond($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function show(UserAdminRequest $request, User $user)
    {

        if (!$user->exists) {
            $this->responseCode = 404;
            $this->responseMessage = trans('messages.success.notfound', ['Module' => 'User']);
            $this->responseData = $user;
            $this->responseView = view('User::user.new');

            return $this->respond($request);
        }

        $permissions = $this->permission->groupedPermissions(true);
        $roles = $this->roles->all();
        Form::populate($user);
        $this->responseCode = 200;
        $this->responseMessage = trans('messages.success.loaded', ['Module' => 'User']);
        $this->responseData = $user;
        $this->responseView = view('User::user.show', compact('user', 'roles', 'permissions'));

        return $this->respond($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(UserAdminRequest $request)
    {
        $user = $this->repository->newInstance([]);
        $permissions = $this->permission->groupedPermissions(true);
        $roles = $this->roles->all();
        Form::populate($user);

        $this->responseCode = 200;
        $this->responseMessage = trans('messages.success.loaded', ['Module' => 'User']);
        $this->responseData = $user;
        $this->responseView = view('User::user.create', compact('user', 'roles', 'permissions'));

        return $this->respond($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(UserAdminRequest $request)
    {
        try {
            $attributes = $request->all();
            $user = $this->repository->create($attributes);
            $user->syncRoles($request->get('roles'));
            $this->responseCode = 201;
            $this->responseMessage = trans('messages.success.created', ['Module' => 'User']);
            $this->responseData = $user;
            $this->responseMeta = '';
            $this->responseRedirect = trans_url('/admin/user/user/'.$user->getRouteKey());
            $this->responseView = view('User::user.create', compact('user'));

            return $this->respond($request);
        } catch (Exception $e) {
            $this->responseCode = 400;
            $this->responseMessage = $e->getMessage();

            return $this->respond($request);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function edit(UserAdminRequest $request, User $user)
    {
        $permissions = $this->permission->groupedPermissions(true);
        $roles = $this->roles->all();
        Form::populate($user);
        $this->responseCode = 200;
        $this->responseMessage = trans('messages.success.loaded', ['Module' => 'User']);
        $this->responseData = $user;
        $this->responseView = view('User::user.edit', compact('user', 'roles', 'permissions'));

        return $this->respond($request);
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(UserAdminRequest $request, User $user)
    {
        try {
            $attributes = $request->all();
            $user->update($attributes);
            $user->syncRoles($request->get('roles'));
            $this->responseCode = 204;
            $this->responseMessage = trans('messages.success.updated', ['Module' => 'User']);
            $this->responseData = $user;
            $this->responseRedirect = trans_url('/admin/user/user/'.$user->getRouteKey());

            return $this->respond($request);
        } catch (Exception $e) {
            $this->responseCode = 400;
            $this->responseMessage = $e->getMessage();
            $this->responseRedirect = trans_url('/admin/user/user/'.$user->getRouteKey());

            return $this->respond($request);
        }
    }

    /**
     * Remove the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(UserAdminRequest $request, User $user)
    {
        try {
            $t = $user->delete();

            $this->responseCode = 202;
            $this->responseMessage = trans('messages.success.deleted', ['Module' => 'User']);
            $this->responseData = $user;
            $this->responseMeta = '';
            $this->responseRedirect = trans_url('/admin/user/user/0');

            return $this->respond($request);
        } catch (Exception $e) {
            $this->responseCode = 400;
            $this->responseMessage = $e->getMessage();
            $this->responseRedirect = trans_url('/admin/user/user/'.$user->getRouteKey());

            return $this->respond($request);
        }
    }

    /**
     * Update profile of logged user.
     *
     * @return Response
     */
    public function updateProfile(Authenticatable $user, Request $request)
    {
        if ($user->update($request->all())) {
            return Response::json(['message' => 'Profile updated sucessfully', 'type' => 'success', 'title' => 'Success'], 201);
        } else {
            return Response::json(['message' => $e->getMessage(), 'type' => 'error', 'title' => 'Error'], 400);
        }
    }

    /**
     * Reset the given user's password.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Authenticatable $user, Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $password = $request->get('password');

        $user->password = bcrypt($password);

        if ($user->save()) {
            return Response::json(['message' => 'Password changed sucessfully', 'type' => 'success', 'title' => 'Success'], 201);
        } else {
            return Response::json(['message' => $e->getMessage(), 'type' => 'error', 'title' => 'Error'], 400);

            return $this->error($e->getMessage());
        }
    }
}
