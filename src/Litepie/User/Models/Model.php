<?php

namespace Litepie\User\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Litepie\User\Traits\User;

class Model extends  Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, User;
    /**
     * Initialiaze page modal.
     *
     * @param $name
     */
    public function __construct(array $attributes = [])
    {
        $this->initialize();

        return parent::__construct($attributes);
    }
    
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

    /**
     * Initialize modal variables form config.
     *
     * @param $key
     * @param $value
     */
    public function initialize()
    {
        $config = config($this->config);

        foreach ($config as $key => $val) {
            if (property_exists(get_called_class(), $key)) {
                $this->$key = $val;
            }
            if (method_exists(get_called_class(), $key)) {
                $this->$key($val);
            }
        }
    }
}
