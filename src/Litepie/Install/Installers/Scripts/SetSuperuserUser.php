<?php

namespace Litepie\Install\Installers\Scripts;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Litepie\Install\Installers\SetupScript;
use Litepie\User\Models\User;
use Validator;

class SetSuperuserUser implements SetupScript
{
    private $domain = null;

    /**
     * Fire the install script.
     *
     * @param Command $command
     *
     * @return mixed
     */
    public function fire(Command $command)
    {
        if ($command->option('verbose')) {
            $command->blockMessage('Set password', 'Set password for superuser.', 'comment');
        }

        $this->command = $command;

        config(['litepie.user.user' => [
            'table' => 'users',
            'fillable' => ['password', 'email'],
        ]]);

        $user = User::find(1);
        $user->email = $this->askDomain();
        $user->email = $this->askUserEmail();
        $user->password = $this->askUserPassword();
        $user->save();
    }

    /**
     * @param $gitignorePath
     *
     * @return bool
     */
    private function askUserEmail()
    {
        if (empty($this->domain)) {
            $this->askDomain();
        }
        $email = 'superuser@' . $this->domain;
        do {
            $data['email'] = $this->command->ask('Please enter email for superuser', $email);
            $validator = Validator::make($data, ['email' => 'required|email']);

            if ($validator->fails()) {
                $this->command->error($validator->errors()->first('email'));
            }
        } while ($validator->fails());

        return $data['email'];
    }

    /**
     * @param $gitignorePath
     *
     * @return bool
     */
    private function askDomain()
    {
        do {
            $domain = $this->command->ask('Please enter your domain name', 'lavalite.org');

            $isValid = $this->isDomainValid($domain);

            if (!$isValid) {
                $this->command->error('Please enter a valid domain name.');
            }
        } while (!$isValid);

        return $this->domain = $domain;

    }

    /**
     * @param $gitignorePath
     *
     * @return bool
     */
    private function askUserPassword()
    {
        do {
            $password = Str::random(8);
            $data['password'] = $this->command->ask('Please enter password for superuser', $password);
            $validator = Validator::make($data, [
                'password' => 'required|min:6|max:30',
            ]);

            if ($validator->fails()) {
                $this->command->error($validator->errors()->first('password'));
            }
        } while ($validator->fails());

        return bcrypt($data['password']);
    }

    public function isDomainValid($domain)
    {
        return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain) //valid chars check
            && preg_match("/^.{1,253}$/", $domain) //overall length check
            && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain)); //length of each label
    }

}
