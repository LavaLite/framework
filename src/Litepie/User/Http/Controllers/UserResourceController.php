<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\ResourceController as BaseController;
use App\User;
use Litepie\Roles\Interfaces\PermissionRepositoryInterface;
use Litepie\Roles\Interfaces\RoleRepositoryInterface;
use Litepie\User\Http\Requests\UserRequest;
use Litepie\User\Interfaces\UserRepositoryInterface;

/**
 * Resource controller class for user.
 */
class UserResourceController extends BaseController
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
     * Initialize user resource controller.
     *
     * @param type UserRepositoryInterface $user
     *
     * @return null
     */
    public function __construct(
        UserRepositoryInterface       $user,
        PermissionRepositoryInterface $permissions,
        RoleRepositoryInterface       $roles
    ) {
        parent::__construct();
        $this->permissions = $permissions;
        $this->roles = $roles;
        $this->repository = $user;
        $this->repository
            ->pushCriteria(\Litepie\Repository\Criteria\RequestCriteria::class)
            ->pushCriteria(\Litepie\User\Repositories\Criteria\UserResourceCriteria::class);
    }

    /**
     * Display a list of user.
     *
     * @return Response
     */
    public function index(UserRequest $request)
    {
        if ($this->response->typeIs('json')) {
            $pageLimit = $request->input('pageLimit');
            $data = $this->repository
                ->setPresenter(\Litepie\User\Repositories\Presenter\UserPresenter::class)
                ->getDataTable($pageLimit);

            return $this->response
                ->data($data)
                ->output();
        }

        $users = $this->repository->paginate();

        return $this->response->setMetaTitle(trans('user::user.names'))
            ->view('user::user.index')
            ->data(compact('users'))
            ->output();
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
        if ($user->exists) {
            $view = 'user::user.show';
        } else {
            $view = 'user::user.new';
        }

        $roles = $this->roles->all();
        $permissions = $this->permissions->groupedPermissions();

        return $this->response->setMetaTitle(trans('app.view').' '.trans('user::user.name'))
            ->data(compact('user', 'roles', 'permissions'))
            ->view($view)
            ->output();
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
        $user = $this->repository->newInstance([]);
        $roles = $this->roles->all();
        $permissions = $this->permissions->groupedPermissions();

        return $this->response->setMetaTitle(trans('app.new').' '.trans('user::user.name'))
            ->view('user::user.create')
            ->data(compact('user', 'roles', 'permissions'))
            ->output();
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
            $attributes = $request->all();
            $attributes['user_id'] = user_id();
            $attributes['user_type'] = user_type();
            $attributes['api_token'] = str_random(60);
            $user = $this->repository->create($attributes);

            return $this->response->message(trans('messages.success.created', ['Module' => trans('user::user.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('user/user/'.$user->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('/user/user'))
                ->redirect();
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
        $roles = $this->roles->all();
        $permissions = $this->permissions->groupedPermissions();

        return $this->response->setMetaTitle(trans('app.edit').' '.trans('user::user.name'))
            ->view('user::user.edit')
            ->data(compact('user', 'roles', 'permissions'))
            ->output();
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
            $roles = $request->get('roles');
            $permissions = $request->get('permissions');
            $user->update($attributes);
            $user->userPermissions()->sync($permissions);
            $user->roles()->sync($roles);

            return $this->response->message(trans('messages.success.updated', ['Module' => trans('user::user.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('user/user/'.$user->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('user/user/'.$user->getRouteKey()))
                ->redirect();
        }
    }

    /**
     * Remove the user.
     *
     * @param Model $user
     *
     * @return Response
     */
    public function destroy(UserRequest $request, User $user)
    {
        try {
            $user->delete();

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('user::user.name')]))
                ->code(202)
                ->status('success')
                ->url(guard_url('user/user'))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('user/user/'.$user->getRouteKey()))
                ->redirect();
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
                'redirect' => trans_url('/admin/user/user/'.$user->getRouteKey()),
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/user/user/'.$user->getRouteKey()),
            ], 400);
        }
    }
}
