<?php

namespace Litepie\User\Models;

use Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Litepie\Database\Traits\DateFormatter;
use Litepie\Database\Traits\Slugger;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Repository\Traits\PresentableTrait;
use Litepie\Roles\Traits\HasRoleAndPermission;
use Litepie\User\Contracts\UserPolicy;
use Litepie\User\Traits\User as UserProfile;

class User extends Model implements UserPolicy
{
    use Filer, Notifiable, HasRoleAndPermission, UserProfile, SoftDeletes, Hashids, Slugger, PresentableTrait, DateFormatter;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'users.user.model';

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

    public function messages()
    {
        return $this->morphMany('\Litepie\Message\Models\Message', 'user');
    }

    public function setPasswordAttribute($val)
    {
        if (Hash::needsRehash($val)) {
            $this->attributes['password'] = bcrypt($val);
        } else {
            $this->attributes['password'] = ($val);
        }
    }
}
