<?php

namespace Litepie\User\Models;

use Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Repository\Traits\PresentableTrait;
use Litepie\Roles\Traits\CheckRoleAndPermission;
use Litepie\User\Traits\User as UserProfile;
use Str;

class Client extends Model
{
    use Filer, Notifiable, CheckRoleAndPermission, UserProfile, SoftDeletes, Hashids, PresentableTrait;
    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = null;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $role = null;

    /**
     * Initialiaze client modal.
     *
     * @param $name
     */
    public function __construct($attributes = [])
    {
        $config = config($this->config);

        foreach ($config as $key => $val) {
            if (property_exists(get_called_class(), $key)) {
                $this->$key = $val;
            }
        }

        $this->setRole($this->role);

        parent::__construct($attributes);
    }
}
