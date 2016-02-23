<?php

namespace Litepie\User\Repositories\Eloquent;

use Litepie\Database\Eloquent\BaseRepository;
use User;

class UserSocialRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return 'Litepie\\User\\Models\\UserSocial';
    }

    public function findByUserNameOrCreate($userData, $provider)
    {
        $user_social = $this->model->where('provider_id', '=', $userData->id)->first();

        if (!$user_social) {
            $new_user = User::create([
                'name'     => $userData->name,
                'email'    => $userData->email,
                'password' => 'user@user.com',
                'active'   => 1,
            ]);

            $user_social = $this->model->create([
                'provider'    => $provider,
                'provider_id' => $userData->id,
                'user_id'     => $new_user['id'],
            ]);
        }
        $user = User::findUser($user_social['user_id']);
        $this->checkIfUserNeedsUpdating($userData, $user);

        return $user;
    }

    public function checkIfUserNeedsUpdating($userData, $user)
    {
        $socialData = [

            'name' => $userData->name,
        ];
        $dbData = [

            'name' => $user['name'],
        ];

        if (!empty(array_diff($socialData, $dbData))) {
            $user->name = $userData->name;
            $user->save();
        }
    }
}
