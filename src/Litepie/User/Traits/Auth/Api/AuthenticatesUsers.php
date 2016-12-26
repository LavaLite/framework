<?php

namespace Litepie\User\Traits\Auth\Api;

use Auth;
use Crypt;
use Illuminate\Foundation\Auth\AuthenticatesUsers as IlluminateAuthenticatesUsers;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Mail;
use Socialite;
use User;

trait AuthenticatesUsers
{

    use IlluminateAuthenticatesUsers, Common {
        Common::guard insteadof IlluminateAuthenticatesUsers;
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


    function sendVerification()
    {
        $this->sendVerificationMail(user());
        return redirect()->back()->withCode(201)->withMessage('Verification link send to your email please check the mail for actvation mail.');

    }

}
