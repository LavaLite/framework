<?php

namespace Litepie\User\Traits;

use Auth;
use Form;
use Hash;
use Illuminate\Http\Request;
use Response;

/**
 * Trait for managing user profile.
 */
trait UserPages
{
    /**
     * List apis for a particular user.
     *
     * @param Model $user
     * @param step    next step for the workflow.
     *
     * @return Response
     */
    public function logout(Request $request)
    {
        Auth::logout(getenv('guard'));

        return redirect('/');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getPassword(Request $request, $role = null)
    {
        return $this->response->setMetaTitle('Change Password')
            ->layout('user')
            ->view('user.password')
            ->output();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function home()
    {
        return $this->response
            ->layout('user')
            ->setMetaTitle('Dashboard')
            ->view('home')
            ->output();
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
        $user = $request->user(guard());

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
        $user = $request->user(guard());
        Form::populate($user);

        return $this->response->setMetaTitle('Profile')
            ->layout('user')
            ->view('user.profile')
            ->data(compact('user'))
            ->output();
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
        $user = $request->user();

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

    /**
     * Show locked screen.
     *
     * @return \Illuminate\Http\Response
     */
    public function locked()
    {
        return $this->response
            ->setMetaTitle('Locked')
            ->layout('blank')
            ->view('user.locked')
            ->output();
    }

    /**
     * Show reports homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function reports()
    {
        return $this->response->setMetaTitle('Reports')
            ->view('reports')
            ->output();
    }
}
