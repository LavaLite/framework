<?php

namespace Litepie\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as ContractMustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Database\Traits\Sluggable;
use Litepie\Database\Traits\Sortable;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Roles\Traits\CheckRoleAndPermission;
use Litepie\Trans\Traits\Translatable;
use Litepie\User\Interfaces\UserPolicyInterface;
use Litepie\User\Models\Model as BaseModel;
use Litepie\User\Traits\Auth\MustVerifyEmail;

class Client extends BaseModel implements ContractMustVerifyEmail, UserPolicyInterface
{
    use MustVerifyEmail;
    use Filer;
    use Hashids;
    use Sluggable;
    use SoftDeletes;
    use Sortable;
    use Translatable;
    use CheckRoleAndPermission;
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

        foreach ($config as $key => $val) {
            if (property_exists(get_called_class(), $key)) {
                $this->$key = $val;
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
        $this->role = app('Litepie\Roles\Interfaces\RoleRepositoryInterface')->findBySlug($role);
    }
}
