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
trait UserPages
{
    use Common;

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
        $this->response->title('Change Password')
            ->view($this->getView('auth.changepassword', 'user', $this->getViewFolder()))->output();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function home()
    {
        return $this->response->title('Dashboard')
            ->view($this->getView('home'))
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

        $this->theme->asset()->add('cropper-css', 'packages/cropper/css/cropper.css');
        $this->theme->asset()->container('footer')->add('cropper-js', 'packages/cropper/js/cropper.js');
        $this->theme->asset()->add('fullcalendar-css', 'packages/fullcalendar/fullcalendar.min.css');
        $this->theme->asset()->container('extra')->add('fullcalendar-js', 'packages/fullcalendar/fullcalendar.min.js');

        $this->response->title('Profile')
            ->view($this->getView('auth.profile', 'user', $this->getViewFolder()))
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
        $this->response->title('Locked')
            ->view($this->getView('lock', $this->getViewFolder(), false))
            ->output();
    }

    /**
     * Show master table lists.
     *
     * @return \Illuminate\Http\Response
     */
    public function masters()
    {
        return $this->response->title('Masters')
            ->view($this->getView('masters', $this->getViewFolder(), false))
            ->output();
    }

    /**
     * Show reports homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function reports()
    {
        return $this->response->title('Reports')
            ->view($this->getView('reports', $this->getViewFolder(), false))
            ->output();
    }

}
