<?php

namespace Litepie\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as ContractMustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Litepie\Database\Traits\Sluggable;
use Litepie\Database\Traits\Sortable;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Roles\Traits\HasRoleAndPermission;
use Litepie\Trans\Traits\Translatable;
use Litepie\User\Interfaces\UserPolicyInterface;
use Litepie\User\Models\Model as BaseModel;
use Litepie\User\Traits\Auth\MustVerifyEmail;

class User extends BaseModel implements ContractMustVerifyEmail, UserPolicyInterface
{
    use Filer;
    use HasRoleAndPermission;
    use HasApiTokens;
    use Hashids;
    use MustVerifyEmail;
    use Sluggable;
    use SoftDeletes;
    use Sortable;
    use Translatable;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'user.user.model';

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

    /**
     * The User that belong to the team.
     */
    public function teams()
    {
        return $this->belongsToMany('Litepie\Team\Models\Team')
            ->withPivot([
                'id', 'role',
            ]);
    }
}
