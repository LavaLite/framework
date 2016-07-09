<?php

namespace Litepie\User\Traits\Auth;

use Auth;
use Crypt;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Litepie\User\Traits\Auth\Common;
use Mail;
use Socialite;
use User;
use Validator;

trait RegisterAndLogin
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins, Common {
        Common::getGuard insteadof AuthenticatesAndRegistersUsers;
    }

    /**
     * Show the user login form.
     *
     * @return \Illuminate\Http\Response
     */
    function showLoginForm()
    {
        $guard = $this->getGuard();
        $this->check($guard);
        return $this->theme->of($this->getView('login'), compact('guard'))->render();
    }

    /**
     * Authenticate using api request.
     *
     * @param Request $request
     * @return string $token
     */
    function apiLogin(Request $request)
    {
        $this->validateLogin($request);

        /**
         * If the class is using the ThrottlesLogins trait, we can automatically throttle
         * the login attempts for this application. We'll key this by the username and
         * the IP address of the client making these requests into this application.
         */
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if ($token = Auth::guard($this->getApiGuard())->attempt($credentials)) {
            return $this->handleUserWasAuthenticated($request, $throttles, $token);
        }

        /**
         * sIf the login attempt was unsuccessful we will increment the number of attempts
         * to login and redirect the user back to the login form. Of course, when this
         * user surpasses their maximum number of attempts they will get locked out.
         */

        if ($throttles && !$lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);

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
            'password' => 'required|min:6',
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

        if (!config('user.verify_email')) {
            $data['status'] = 'Active';
        }

        $model = $this->getModel($this->getGuard());

        $user = $model::create($data);

        if (config('user.verify_email')) {
            $this->sendVerificationMail($user);
        }

        return $user;
    }

    /**
     * Get the model for the current guard.
     *
     * @return Response
     */
    function getModel($guard)
    {
        $provider = config("auth.guards.$guard.provider", 'users');
        return config("auth.providers.$provider.model", App\User::class);
    }

    /**
     * Get the model for the current guard.
     *
     * @return Response
     */
    function getTable($guard)
    {
        $provider = config("auth.guards.$guard.provider", 'users');

        return config("auth.providers.$provider.table", 'users');
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
     * Get the default role for a user.
     *
     * @return string
     **/
    function getDefaultUserType()
    {
        return config('user.default_user_type', 'user');
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
