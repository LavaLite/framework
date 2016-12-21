<?php
namespace Litepie\Install\Installers\Scripts;

use App\User;
use Illuminate\Console\Command;
use Litepie\Install\Installers\SetupScript;
use Validator;

class SetSuperuserUser implements SetupScript
{

    /**
     * Fire the install script
     *
     * @param  Command $command
     * @return mixed
     */
    public function fire(Command $command)
    {
        $this->command    = $command;
        $data['email']    = $this->askUserEmail();
        $data['password'] = $this->askUserPassword();
        $user             = User::find(1);
        $user->update($data);
    }

    /**
     * @param $gitignorePath
     * @return bool
     */
    private function askUserEmail()
    {

        do {
            $data['email'] = $this->command->ask('Please enter email for superuser', 'superuser@lavalite.org');
            $validator    = Validator::make($data, ['email' => 'required|email']);

            if ($validator->fails()) {
                $this->command->error($validator->errors()->first('email'));
            }

        } while ($validator->fails());

        return $data['email'];
    }

    /**
     * @param $gitignorePath
     * @return bool
     */
    private function askUserPassword()
    {

        do {
            $data['password'] = $this->command->secret("Please enter password for superuser");
            $validator               = Validator::make($data, [
                'password' => 'min:8|max:30',
            ]);

            if ($validator->fails()) {
                $this->command->error($validator->errors()->first('password'));
            }

        } while ($validator->fails());

        return bcrypt($data['password']);
    }

}
