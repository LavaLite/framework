<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Litepie\Database\Model;
use Litepie\Database\Traits\Slugger;
use Litepie\Foundation\Auth\User as Authenticatable;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Repository\Traits\PresentableTrait;
use Litepie\User\Traits\Acl\CheckPermission;
use Litepie\User\Traits\User as UserProfile;

class User extends Authenticatable implements CanResetPasswordContract
{
    use Notifiable, CanResetPassword, CheckPermission, UserProfile, SoftDeletes, Hashids, Slugger, PresentableTrait;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'litepie.user.user';

    /**
     * Initialiaze page modal.
     *
     * @var attributes
     */

    public function __construct($attributes = [])
    {
        $config = config($this->config);

        foreach ($config as $key => $val) {

            if (property_exists(get_called_class(), $key)) {
                $this->$key = $val;
            }

        }

        parent::__construct($attributes);
    }


}
