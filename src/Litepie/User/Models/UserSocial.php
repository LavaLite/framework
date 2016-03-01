<?php

namespace Litepie\User\Models;

use Litepie\Database\Model;
use Litepie\Database\Traits\Slugger;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Trans\Traits\Trans;

class UserSocial extends Model
{
    use Filer, Hashids, Slugger, Trans;

     /**
      * Configuartion for the model.
      *
      * @var array
      */
     protected $config = 'user.user_social';

    public function users()
    {
        return $this->belongsToMany('Litepie\User\Models\User', 'users', 'id', 'user_id');
    }
}
