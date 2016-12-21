<?php

namespace Litepie\User\Traits\Auth;

use Auth;
use Crypt;
use Illuminate\Foundation\Auth\AuthenticatesUsers as IlluminateAuthenticatesUsers;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Mail;
use Socialite;
use User;
use Session;

trait SocialAuthentication
{

    use IlluminateAuthenticatesUsers, Common {
        Common::guard insteadof IlluminateAuthenticatesUsers;
    }

    /**
     * Redirect the user to the provider authentication page.
     *
     * @return Response
     */
    function redirectToProvider($guard = null, $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @return Response
     */
    function handleProviderCallback($guard = null, $provider)
    {
        $user   = Socialite::driver($provider)->user();       
        /*$image = $user->getAvatar();
        $upload_folder['folder'] = public_path() . '/uploads/patients/photo/'.date("Y/m/d").'/'.time();*/
        $model =  $this->getModel($guard);
        $data  = [
            'name'          => $user->getName(),
            'email'         => $user->getEmail(),
            'status'        => 'Active',
            'password'      => bcrypt(str_random(8)),
            'api_token'     => str_random(60),
        ];
        $user = $model::whereEmail($data['email'])->first();

        if (!is_null($user)) {
            User::login($user, false, $guard);
        } else {
            $user = $model::create($data);
            User::login($user, false, $guard);
        }

        return $this->theme->of($this->getView('social', $guard), compact('user'))->render();
    }


    /**
     * Check the given guard.
     *
     * @param  string  $name
     * @return \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     *
     * @throws \InvalidArgumentException
     */
    function check($name)
    {

        $config = config("auth.guards.{$name}");

        if (!is_null($name) && is_null($config)) {
            throw new InvalidArgumentException("Auth guard [{$name}] is not defined.");
        }

        return;

    }

    /**
     * Show email verification page.
     *
     * @param string code
     *
     * @return view
     **/
    function verify($code = null)
    {
        $guard = $this->getGuard();

        if (!is_null($code)) {

            if ($this->activate($code)) {
                return redirect()->guest($guard . '/login')->withCode(201)->withMessage('Your account is activated.');
            } else {
                return redirect()->guest($guard . '/login')->withCode(301)->withMessage('Activation link is invalid or expired.');
            }

        }

        if (Auth::guard($guard)->guest()) {
            return redirect()->guest($guard . '/login');
        }

        return $this->theme->of($this->getView('verify', $guard), compact('code'))->render();
    }

    /**
     * Activate the user with given activation code.
     *
     * @param string code
     *
     * @return view
     **/
    function activate($code)
    {

        $id = Crypt::decrypt($code);
        return User::activate($id);

    }

    /**
     * Display locked screen.
     *
     * @return response
     */
    function locked()
    {
        return $this->theme->of($this->getView('locked'))->render();

    }

    function sendVerification()
    {
        $this->sendVerificationMail(user());
        return redirect()->back()->withCode(201)->withMessage('Verification link send to your email please check the mail for actvation mail.');

    }

}
