<?php

namespace Litepie\User\Traits\Auth;

use Auth;
use Crypt;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers as IlluminateRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Mail;
use Role;
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
    public function showRegistrationForm()
    {
        $this->canRegister();

        return $this->response->setMetaTitle('Register')
            ->view('auth.register')
            ->layout('auth')
            ->output();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        $rules = [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:'.$this->getTable(),
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
    public function create(array $data)
    {
        $this->canRegister();

        $data = [
            'name'      => $data['name'],
            'email'     => $data['email'],
        'password'      => $data['password'],
            'api_token' => str_random(60),
        ];

        if (!config('auth.verify_email')) {
            $data['status'] = 'Active';
        }

        $model = $this->getAuthModel();
        $user = $model::create($data);
        $this->attachRoles($user);

        if (config('auth.verify_email')) {
            $this->sendVerificationMail($user);
        }

        return $user;
    }

    /**
     * Send email verification email to the user.
     *
     * @return Response
     */
    public function sendVerificationMail($user)
    {
        $data['confirmation_code'] = Crypt::encrypt($user->id);
        $data['guard'] = $this->getGuard();

        Mail::send('auth.emails.verify', $data, function ($message) use ($user) {
            $message->to($user->email, $user->name)
                ->subject('Verify your email address');
        });
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
        $guard = $this->getGuard();

        if (!is_null($code)) {
            if ($this->activate($code)) {
                return redirect()->guest($guard.'/login')->withCode(201)->withMessage('Your account is activated.');
            } else {
                return redirect()->guest($guard.'/login')->withCode(301)->withMessage('Activation link is invalid or expired.');
            }
        }

        if (Auth::guard($guard)->guest()) {
            return redirect()->guest($guard.'/login');
        }
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

    public function sendVerification()
    {
        $this->sendVerificationMail(user());

        return redirect()->back()->withCode(201)->withMessage('Verification link send to your email please check the mail for actvation mail.');
    }

    public function canRegister()
    {
        $guard = $this->getGuardRoute();

        if (in_array($guard, config('auth.register.allowed'))) {
            return true;
        }

        throw new Exception("You are not allowed to register as [$guard]");
    }

    public function attachRoles($user)
    {
        $guard = $this->getGuardRoute();
        $roles = config('auth.register.roles.'.$guard, null);

        if ($roles == null) {
            return;
        }

        foreach ($roles as $role) {
            $roleId = Role::findBySlug($role)->id;
            $user->attachRole($roleId);
        }

        return true;
    }
}
