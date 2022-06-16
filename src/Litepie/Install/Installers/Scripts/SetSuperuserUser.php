<?php

namespace Litepie\Install\Installers\Scripts;

use Illuminate\Console\Command;
use Litepie\Install\Installers\SetupScript;
use Litepie\User\Models\User;
use Validator;

class SetSuperuserUser implements SetupScript
{
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
            'table'    => 'users',
            'fillable' => ['password', 'email'],
        ]]);

        $user = User::find(1);
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
        do {
            $data['email'] = $this->command->ask('Please enter email for superuser', 'superuser@lavalite.org');
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
    private function askUserPassword()
    {
        do {
            $data['password'] = $this->command->secret('Please enter password for superuser');
            $validator = Validator::make($data, [
                'password' => 'min:6|max:30',
            ]);

            if ($validator->fails()) {
                $this->command->error($validator->errors()->first('password'));
            }
        } while ($validator->fails());

        return bcrypt($data['password']);
    }
}
