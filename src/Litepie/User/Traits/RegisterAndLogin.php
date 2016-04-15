<?php

namespace Litepie\User\Traits;

use Auth;
use Crypt;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Mail;
use Socialite;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use User;
use Validator;

trait RegisterAndLogin
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Show the user login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return $this->theme->of('user::user.login')->render();
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function showRegistrationForm($role = null)
    {
        $role = empty($role) ? $this->getDefaultRole() : $role;

        if (!$this->isValidRole($role)) {
            throw new NotFoundHttpException();
        }

        return $this->theme->of('user::user.register', compact('role'))->render();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'                 => 'required|max:255',
            'email'                => 'required|email|max:255|unique:users',
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
    protected function create(array $data)
    {
        $role = empty($data['role']) ? $this->getDefaultRole() : $data['role'];

        if (!$this->isValidRole($role)) {
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

        $user = User::create($data);

        $role = User::findRole($role);
        $user->attachRole($role);

        if (!config('user.verify_email')) {
            $data['confirmation_code'] = Crypt::encrypt($user->id);

            Mail::send('user::email.verify', $data, function ($message) use ($data) {
                $message->to($data['email'], $data['name'])
                    ->subject('Verify your email address');
            });
        }

        return $user;
    }

    /**
     * Redirect the user to the provider authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        return $this->theme->of('user::user.social', compact('user'))->render();
    }

    /**
     * Get the default role for a user.
     *
     * @return string
     **/
    public function getDefaultRole()
    {
        return config('user.default_role', 'user');
    }

    /**
     * Validate a given role.
     *
     * @return bool
     **/
    public function isValidRole($role)
    {

        if (in_array($role, config('user.restricted_roles'))) {
            return false;
        }

        if (!User::roleExists($role)) {
            return false;
        }

        return true;
    }

    /**
     * Show email verification page.
     *
     * @param string code
     *
     * @return view
     **/
    public function verify($code = null)
    {

        if (!is_null($code)) {

            if ($this->activate($code)) {
                return redirect()->guest('login')->withCode(201)->withMessage('Your account is activated.');
            } else {
                return redirect()->guest('login')->withCode(301)->withMessage('Activation link is invalid or expired.');
            }

        }

        if (Auth::guard(null)->guest()) {
            return redirect()->guest('login');
        }

        return $this->theme->of('user::user.verify', compact('code'))->render();
    }

    /**
     * Activate the user with given activation code.
     *
     * @param string code
     *
     * @return view
     **/
    public function activate($code)
    {

        $id = Crypt::decrypt($code);
        return User::activate($id);

    }

    /**
     * Display locked screen.
     *
     * @return response
     */
    public function locked()
    {
        return $this->theme->of('user::user.locked')->render();

    }

    /**
     * Send verification code link to the email.
     *
     * @return response
     */
    public function sendVerification(Authenticatable $user)
    {

        if (Auth::guard(null)->guest()) {
            return redirect()->guest('login');
        }

        $user['confirmation_code'] = Crypt::encrypt($user->id);

        Mail::send('user::email.verify', $user->toArray(), function ($message) use ($user) {
            $message->to($user['email'], $user['name'])
                ->subject('Verify your email address.');
        });

        return redirect()->back()->withCode(100)->withMessage('Verification mail send to your email.');
    }

}
