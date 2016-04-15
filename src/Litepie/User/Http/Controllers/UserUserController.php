<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\UserController as UserController;
use App\User;
use Form;
use Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
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
        return $this->theme->of('user::user.changepassword')->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function postPassword(Request $request, Authenticatable $user)
    {
        $this->validate($request, [
            'password'     => 'required|confirmed|min:6',
            'old_password' => 'required',
        ]);

        if (!Hash::check($request->get('old_password'), $user->password)) {
            return redirect()->back()->withMessage('Invalid old password')->withCode(300);
        }

        $password = $request->get('password');

        $user->password = bcrypt($password);

        if ($user->save()) {
            return redirect('home')->withMessage('Password updated successfully.')->withCode(201);
        } else {
            return redirect()->back()->withMessage('Error while resetting password.')->withCode(400);
        }

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
        Form::populate($request->user());
        return $this->theme->of('user::user.profile')->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postProfile(Request $request, Authenticatable $user)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
        ]);

        $user->fill($request->all());

        if ($user->save()) {
            return redirect('home')->withMessage('Profile updated successfully.')->withCode(201);
        } else {
            return redirect()->back()->withMessage('Error while updating profile.')->withCode(400);
        }

    }

}
