<?php

namespace Litepie\User\Traits\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers as IlluminateAuthenticatesUsers;
use Illuminate\Support\Str;
use Socialite;
use User;

trait SocialAuthentication
{
    use IlluminateAuthenticatesUsers;

    //use IlluminateAuthenticatesUsers;

    /**
     * Redirect the user to the provider authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        if (!config("services.{$provider}.client_id")) {
            abort(404, "Please configure the [{$provider}] ids.");
        }

        $this->setCallbackUrl($provider);

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $this->setCallbackUrl($provider);
        $guard = $this->getGuard();
        $user = Socialite::driver($provider)->user();
        $model = $this->getAuthModel();
        $data = [
            'name'      => $user->getName(),
            'email'     => $user->getEmail(),
            'status'    => 'Active',
            'password'  => bcrypt(Str::random(8)),
            'api_token' => Str::random(60),
        ];
        $user = $model::whereEmail($data['email'])->first();

        if (!is_null($user)) {
            User::login($user, false, $guard);
        } else {
            $user = $model::create($data);
            User::login($user, false, $guard);
        }

        return redirect()->intented($this->redirectTo);
    }

    /**
     * undocumented function.
     *
     * @return void
     *
     * @author
     **/
    public function setCallbackUrl($provider)
    {
        $guard = $this->getGuardRoute();
        $currentUrl = config("services.{$provider}.redirect");
        $newUrl = str_replace('/user/', "/$guard/", $currentUrl);
        config(["services.{$provider}.redirect" => $newUrl]);
    }
}
