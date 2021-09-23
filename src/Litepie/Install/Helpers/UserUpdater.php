<?php

namespace Litepie\Install\Helpers;

use Litepie\User\Models\Client;
use Litepie\User\Models\User;
use RachidLaasri\LaravelInstaller\Helpers\EnvironmentManager as BaseEnvironmentManager;

class UserUpdater extends BaseEnvironmentManager
{
    /**
     * Save the form content to the .env file.
     *
     * @param Request $request
     *
     * @return string
     */
    public function UpdateUsers()
    {
        $domain = $this->getDomainName();

        $admin = User::find(1);
        $password = Str::random(8);
        $admin->email = "admin@{$domain}";
        $admin->password = $password;
        $admin->save();
        $message = "Admin login details\nUrl: ".url('admin')."\nUser name: admin@{$domain}\nPassword: ".$password."\n\n";

        $user = User::find(2);
        $password = Str::random(8);
        $user->email = "user@{$domain}";
        $user->password = Str::random(8);
        $user->save();
        $message .= "User login details\nUrl: ".url('user')."\nUser name: user@{$domain}\nPassword: ".$password."\n\n";

        $client = Client::find(1);
        $password = Str::random(8);
        $client->email = "client@{$domain}";
        $client->password = $password;
        $client->save();
        $message .= "Client login details \nUrl: ".url('client')." \nUser name: client@{$domain} \nPassword: ".$password." \n\n";

        return $message;
    }

    /**
     * Save the form content to the .env file.
     *
     * @param Request $request
     *
     * @return string
     */
    public function getDomainName()
    {
        $url = parse_url(env('APP_URL'));

        return $url['host'];
    }
}
