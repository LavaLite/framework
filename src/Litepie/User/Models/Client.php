<?php

namespace Litepie\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as ContractMustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Database\Traits\Sluggable;
use Litepie\Database\Traits\Sortable;
use Litepie\Database\Traits\Scopable;
use Litepie\Database\Traits\Searchable;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Role\Traits\CheckRoleAndPermission;
use Litepie\Trans\Traits\Translatable;
use Litepie\User\Interfaces\UserPolicyInterface;
use Litepie\User\Models\Model as BaseModel;
use Litepie\User\Traits\Auth\MustVerifyEmail;
use Litepie\Role\Models\Role;
use Illuminate\Notifications\Notifiable;

class Client extends BaseModel implements ContractMustVerifyEmail, UserPolicyInterface
{
    use MustVerifyEmail;
    use Filer;
    use Hashids;
    use Sluggable;
    use SoftDeletes;
    use Sortable;
    use Translatable;
    use Searchable;
    use Scopable;
    use CheckRoleAndPermission;
    use Notifiable;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'user.client.model';

    /**
     * Initialiaze client modal.
     *
     * @param $name
     */
    public function __construct($attributes = [])
    {
        $config = config($this->config);
        $dd =[];
        foreach ($config as $key => $val) {
            if (property_exists(get_called_class(), $key)) {
                $this->$key = $val;
            } elseif (method_exists(get_called_class(), $key)) {
                $this->$key($val);
            } else {
                $dd[$key]=$val;
            }
        }

        $this->setRole('client');

        parent::__construct($attributes);
    }

    /**
     * Set role for the model.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function setRole($role)
    {
        $this->role = app(Role::class)->findBySlug($role);
    }
}
