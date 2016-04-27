<?php

namespace Litepie\User\Traits\Auth;

use Auth;
use Form;
use Hash;
use Illuminate\Http\Request;
use Litepie\User\Traits\Auth\Common;
use Response;
/**
 * Trait for managing user profile.
 */
trait UserManager
{
    use Common;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function home()
    {
        return $this->theme->of($this->getView('home'))->render();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getPassword(Request $request, $role = null)
    {
        return $this->theme->of($this->getView('changepassword'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function postPassword(Request $request, $role = null)
    {
        $user = $request->user($this->getGuard());

        $this->validate($request, [
            'password'     => 'required|confirmed|min:6',
            'old_password' => 'required',
        ]);

        if (!Hash::check($request->get('old_password'), $user->password)) {
            return redirect()->back()->withMessage('Invalid old password')->withCode(400);
        }

        $password = $request->get('password');

        $user->password = bcrypt($password);

        if ($user->save()) {
            return redirect()->back()->withMessage('Password updated successfully.')->withCode(201);
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
        $user = $request->user($this->getGuard());
        Form::populate($user);
        return $this->theme->of($this->getView('profile'), compact('user'))->render();
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
        $user = $request->user($this->getGuard());

        $this->validate($request, [
            'name' => 'required|min:3',
        ]);

        $user->fill($request->all());

        if ($user->save()) {
            return redirect()->back()->withMessage('Profile updated successfully.')->withCode(201);
        } else {
            return redirect()->back()->withMessage('Error while updating profile.')->withCode(400);
        }

    }

}
