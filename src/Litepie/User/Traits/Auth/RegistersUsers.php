<?php

namespace Litepie\User\Traits\Auth;

use Illuminate\Foundation\Auth\RegistersUsers as IlluminateRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Role;
use Validator;

trait RegistersUsers
{
    use IlluminateRegistersUsers, ThrottlesLogins;

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
            'email'    => 'required|email|max:255|unique:' . $this->getGuardTable(),
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
            'password'  => $data['password'],
            'api_token' => str_random(60),
        ];

        $model = $this->getAuthModel();
        $user  = $model::create($data);
        $this->attachRoles($user);

        return $user;
    }

    public function canRegister()
    {
        $guard = $this->getGuardRoute();

        if (in_array($guard, config('auth.register.allowed'))) {
            return true;
        }

        return abort(403, "You are not allowed to register as [$guard]");
    }

    public function attachRoles($user)
    {
        $guard = $this->getGuardRoute();
        $roles = config('auth.register.roles.' . $guard, null);

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
