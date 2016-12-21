<?php

namespace Litepie\User\Traits;

use Auth;
use Form;
use Hash;
use Illuminate\Http\Request;
use Litepie\User\Traits\Auth\Common;
use Response;
/**
 * Trait for managing user profile.
 */
trait ProfileAndPassword
{
    use Common;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function home()
    {
        $this->theme->asset()->usepath()->add('fullcalendar-css', 'packages/fullcalendar/fullcalendar.min.css');
        $this->theme->asset()->container('extra')->usepath()->add('fullcalendar-js', 'packages/fullcalendar/fullcalendar.min.js');

        $this->theme->prependTitle('Dashboard');
        return $this->theme->of($this->getView('home'))->render();
    }

    /**
     * List apis for a particular user.
     *
     * @param Model   $user
     * @param step    next step for the workflow.
     *
     * @return Response
     */

    public function logout(Request $request)
    {
        Auth::logout();
        Auth::logout('admin.web');
        return redirect('/');
    }

    /**
     * List apis for a particular user.
     *
     * @param Model   $user
     * @param step    next step for the workflow.
     *
     * @return Response
     */

    public function apiList(Request $request)
    {
        $this->theme->prependTitle(trans('user::user.names').' :: ');
        return $this->theme->of($this->getView('api'))->render();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getPassword(Request $request, $role = null)
    {
        $this->theme->prependTitle('Change Password');
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

        $this->theme->asset()->usepath()->add('cropper-css', 'packages/cropper/css/cropper.css');
        $this->theme->asset()->container('footer')->usepath()->add('cropper-js', 'packages/cropper/js/cropper.js');
        $this->theme->asset()->container('footer')->add('cropper-main-js', 'js/cropper.js');

        $this->theme->prependTitle('Settings');
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

    /**
     * Show locked screen.
     *
     * @return \Illuminate\Http\Response
     */
    public function locked()
    {
        $this->theme->layout('blank');

        return $this->theme->of($this->getView('lock'))->render();
    }

    /**
     * Show master table lists.
     *
     * @return \Illuminate\Http\Response
     */
    public function masters()
    {
        return $this->theme->of($this->getView('masters'))->render();
    }

    /**
     * Show reports homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function reports()
    {
        return $this->theme->of($this->getView('reports'))->render();
    }

}
