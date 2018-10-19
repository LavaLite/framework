<?php

namespace Litepie\User\Traits\Auth;

use Auth;
use Crypt;
use Illuminate\Foundation\Auth\AuthenticatesUsers as IlluminateAuthenticatesUsers;
use Mail;
use User;

trait AuthenticatesUsers
{
    use IlluminateAuthenticatesUsers, Common {
         Common::guard insteadof IlluminateAuthenticatesUsers;
    }

    /**
     * Show the user login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $guard = $this->getGuardRoute();

        return $this->response
            ->setMetaTitle('Login')
            ->layout('auth')
            ->view('auth.login')
            ->data(compact('guard'))
            ->output();
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
                return redirect(guard_url('login'))->withCode(201)->withMessage('Your account is activated.');
            } else {
                return redirect(guard_url('login'))->withCode(301)->withMessage('Activation link is invalid or expired.');
            }
        }

        if (Auth::guard()->guest()) {
            return redirect(guard_url('login'));
        }

        return $this->response
            ->setMetaTitle('Verify email address')
            ->layout('auth')
            ->view('auth.verify')
            ->output();
    }

    /**
     * Activate the user with given activation code.
     *
     * @param string code
     *
     * @return view
     **/
    protected function activate($code)
    {
        $id = Crypt::decrypt($code);

        return User::activate($id);
    }

    protected function sendVerification()
    {
        $this->sendVerificationMail(user());

        return redirect()->back()->withCode(201)->withMessage('Verification link send to your email please check the mail for activation mail.');
    }

    /**
     * Send email verification email to the user.
     *
     * @return Response
     */
    protected function sendVerificationMail($user)
    {
        $data['confirmation_code'] = Crypt::encrypt($user->id);
        $data['guard'] = $this->getGuard();
        Mail::send('auth.emails.verify', $data, function ($message) use ($user) {
            $message->to($user->email, $user->name)
                ->subject('Verify your email address');
        });
    }
}
