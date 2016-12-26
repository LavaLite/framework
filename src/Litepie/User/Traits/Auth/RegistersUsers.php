<?php

namespace Litepie\User\Traits\Auth;

use Auth;
use Crypt;
use Illuminate\Foundation\Auth\RegistersUsers as IlluminateRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Litepie\User\Traits\Auth\Common;
use Mail;
use Socialite;
use User;
use Validator;

trait RegistersUsers
{

    use IlluminateRegistersUsers, ThrottlesLogins, Common {
        Common::guard insteadof IlluminateRegistersUsers;
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    function showRegistrationForm()
    {
        $guard = $this->getGuard();
        $this->check($guard);
        
        $this->theme->prependTitle('Register');
        return $this->theme->of($this->getView('register'), compact('guard'))->render();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    function validator(array $data)
    {
        $table = $this->getTable($this->getGuard());
        $rules = [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:' . $table,
            'password' => 'required|min:6|confirmed',
        ];

        if (config('recaptcha.enable')) {
            $rules['g-recaptcha-response'] = 'required|recaptcha';
        }

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    function create(array $data)
    {
        $guard = $this->getGuard();
        $this->check($guard);

        $data = [
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
            'api_token' => str_random(60),
        ];

        if (!config('litepie.user.verify_email')) {
            $data['status'] = 'Active';
        }

        $model      = $this->getModel($this->getGuard());
        $user       = $model::create($data);
        $roleKey    = ($guard =='web' || $guard == null )? 'user' : current(explode(".", $guard));
        $roleId     = User::findRoleByKey($roleKey)->id;
        $user->roles()->attach($roleId);

        if (config('litepie.user.verify_email')) {
            $this->sendVerificationMail($user);
        }

        return $user;
    }

    /**
     * Send email verification email to the user.
     *
     * @return Response
     */
    function sendVerificationMail($user)
    {
        $data['confirmation_code'] = Crypt::encrypt($user->id);
        $data['guard']             = $this->getGuard();

        Mail::send($this->getView('emails.verify'), $data, function ($message) use ($user) {
            $message->to($user->email, $user->name)
                ->subject('Verify your email address');
        });
    }

    /**
     * Redirect the user to the provider authentication page.
     *
     * @return Response
     */
    function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @return Response
     */
    function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

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

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */

    function handleUserWasAuthenticated(Request $request, $throttles, $token = null)
    {

        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated') && !is_null($token)) {
            return $this->authenticated($request, Auth::guard($this->getApiGuard())->user(), $token);
        }

        return redirect()->intended($this->redirectPath());
    }

    function authenticated($request, $user, $token)
    {
        return response()->json([
            'user'    => $user,
            'request' => $request->all(),
            'token'   => $token,
        ]);
    }

    function sendVerification()
    {
        $this->sendVerificationMail(user());
        return redirect()->back()->withCode(201)->withMessage('Verification link send to your email please check the mail for actvation mail.');

    }

}
