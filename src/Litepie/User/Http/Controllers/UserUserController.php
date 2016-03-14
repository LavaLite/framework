<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\UserController as UserController;
use App\User;
use Form;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Litepie\Contracts\User\PermissionRepository;
use Litepie\Contracts\User\RoleRepository;
use Litepie\Contracts\User\UserRepository;
use Response;

/**
 *
 */
class UserUserController extends UserController
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
    public function __construct(UserRepository $user)
    {
        $this->repository = $user;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getPassword(Request $request, $role = null)
    {
        return $this->theme->of('public::user.changepassword')->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function postPassword(Request $request, User $user)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function getProfile(Request $request)
    {
        return $this->theme->of('public::user.updateprofile')->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postProfile(Request $request)
    {
        print_r($request->all());
    }

}
