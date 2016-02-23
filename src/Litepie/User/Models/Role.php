<?php

namespace Litepie\User\Models;

use Litepie\Database\Model;
use Litepie\Database\Traits\Slugger;
use Litepie\Hashids\Traits\Hashids;

class Role extends Model
{
    use Hashids, Slugger;

     /**
      * Configuartion for the model.
      *
      * @var array
      */
     protected $config = 'user.role';

    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany(config('auth.providers.users.model'));
    }
}
