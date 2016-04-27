<?php

namespace Litepie\User\Traits\Auth;

use Crypt;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Request;
use InvalidArgumentException;
use Litepie\User\Traits\Auth\Common;
use Mail;
use Socialite;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        $table = $this->getGuardTable();

        return Validator::make($data, [
            'name'                 => 'required|max:255',
            'email'                => 'required|email|max:255|unique:' . $table,
            'password'             => 'required|min:6',
            'g-recaptcha-response' => 'required|recaptcha',
        ]);
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
        $this->redirectTo = $this->getGuard();

        if (!$this->isValidRole($guard)) {
            throw new NotFoundHttpException();
        }

        $data = [
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => $data['password'],
        ];

        if (!config('user.verify_email')) {
            $data['status'] = 'Active';
        }

        $model = $this->getGuardModel();

        $user = $model::create($data);

        if (!config('user.verify_email')) {
            $this->sendVerificationMail($guard, $user);
        }

        return $user;
    }

    /**
     * Get the model for the current guard.
     *
     * @return Response
     */
    function getGuardModel()
    {
        $guard    = $this->getGuard();
        $provider = config("auth.guards.$guard.web.provider", 'users');
        $table    = config("auth.providers.$provider.model", App\User::class);
    }

    /**
     * Get the model for the current guard.
     *
     * @return Response
     */
    function getGuardTable()
    {
        $guard    = $this->getGuard();
        $provider = config("auth.guards.$guard.web.provider", 'users');
        $table    = config("auth.providers.$provider.table", 'users');
    }

    /**
     * Send email verification email to the user.
     *
     * @return Response
     */
    function sendVerificationMail($user)
    {
        $guard                     = $this->getGrard();
        $data['confirmation_code'] = Crypt::encrypt($user->id);

        Mail::send($this->getView('email.verify', $guard), $data, function ($message) use ($user) {
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

}
