<?php

namespace Litepie\User\Models;

use Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Litepie\Database\Model as BaseModel;
use Litepie\User\Traits\CanResetPassword;

class Model extends BaseModel implements
AuthenticatableContract,
AuthorizableContract,
CanResetPasswordContract
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;

    /**
     * Encrypt user passwords.
     */
    public function setPasswordAttribute($val)
    {
        if (Hash::needsRehash($val)) {
            $this->attributes['password'] = bcrypt($val);
        } else {
            $this->attributes['password'] = ($val);
        }
    }
}
