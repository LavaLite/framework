<?php

namespace Lavalite\User\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class UserListTransformer extends TransformerAbstract
{
    public function transform(\App\User $user)
    {
        return [
            'id' => $user->eid,
            'name' => $user->name,
            'email' => $user->email,
            'sex' => ucfirst($user->sex),
            'designation' => $user->designation,
            'active' => $user->active,
            'mobile' => $user->mobile,
            'status' => $user->status
        ];
    }
}


