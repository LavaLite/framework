<?php
namespace Litepie\User\Http\Controllers;

use Form;
use Response;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\AdminController;
use Litepie\User\Http\Requests\UserAdminRequest;
use Litepie\Contracts\User\UserRepository;
use Litepie\Contracts\User\RoleRepository;
use Litepie\Contracts\User\PermissionRepository;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 *
 * @package User
 */

class UserAdminController extends AdminController
{
    /**
     * @var Permissions
     *
     */
    protected $permission;

    /**
     * @var roles
     *
     */
    protected $roles;

    /**
     * Initialize user controller
     * @param type UserRepository $user
     * @return type
     */
    public function __construct(UserRepository $user,
                                PermissionRepository $permission,
                                RoleRepository $roles)
    {
        $this->model = $user;
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
        if ($request->wantsJson()) {
            if ($request->has('role')) {
                $users = $this->roles->with(['users'])->findByField('name', $request->get('role'));
                return $users;
            }
            $users = $this->model->setPresenter('\\Lavalite\\User\\Repositories\\Presenter\\UserListPresenter')->all();
            return $users;
        }

        $this->theme->prependTitle(trans('user.user.names').' :: ');

        return $this->theme->of('user::admin.user.index')->render();
    }


    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @param  int  $id
     *
     * @return Response
     */
    public function show(UserAdminRequest $request, User $user)
    {
        if (!$user->exists) {
            if ($request->wantsJson()) {
                return [];
            }

            return view('user::admin.user.new');
        }

        if ($request->wantsJson()) {
            return $user;
        }

        $permissions  = $this->permission->groupedPermissions(true);
        $roles  = $this->roles->all();

        Form::populate($user);

        return view('user::admin.user.show', compact('user', 'roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(UserAdminRequest $request)
    {
        $user = $this->model->findOrNew(0);
        $permissions  = $this->permission->groupedPermissions(true);
        $roles  = $this->roles->all();
        Form::populate($user);

        return view('user::admin.user.create', compact('user', 'roles', 'permissions'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(UserAdminRequest $request)
    {
        try {
            $attributes         = $request->all();
            $user       = $this->model->create($attributes);
            $user->syncRoles($request->get('roles'));
            return $this->success(trans('messages.success.created', ['Module' => trans('user.user.name')]));
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
    public function edit(UserAdminRequest $request, User $user)
    {
        $permissions  = $this->permission->groupedPermissions(true);
        $roles  = $this->roles->all();
        Form::populate($user);

        return view('user::admin.user.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UserAdminRequest $request, User $user)
    {
        try {
            $attributes         = $request->all();
            $user->update($attributes);
            $user->syncRoles($request->get('roles'));
            return $this->success(trans('messages.success.updated', ['Module' => trans('user.user.name')]));
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
    public function destroy(UserAdminRequest $request, User $user)
    {
        try {
            $user->delete();
            return $this->success(trans('message.success.deleted', ['Module' => trans('user.user.name')]), 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Authenticatable $user, Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $password   = $request->get('password');

        $user->password = bcrypt($password);

        if ($user->save()) {
            return Response::json(['message' => 'Password changed sucessfully', 'type' => 'success', 'title' => 'Success'], 201);
        } else {
            return Response::json(['message' => $e->getMessage(), 'type' => 'error', 'title' => 'Error'], 400);
            return $this->error($e->getMessage());
        }
    }
}
