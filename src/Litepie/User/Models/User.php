<?php

namespace Litepie\User\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Actions\Traits\Actionable;
use Litepie\Database\Traits\Scopable;
use Litepie\Database\Traits\Searchable;
use Litepie\Database\Traits\Sluggable;
use Litepie\Database\Traits\Sortable;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Role\Traits\HasRoleAndPermission;
use Litepie\Trans\Traits\Translatable;
use Litepie\User\Interfaces\UserPolicyInterface;
use Litepie\User\Models\Model as BaseModel;
use Litepie\Workflow\Traits\Workflowable;

class User extends BaseModel implements UserPolicyInterface
{
    use Filer;
    use HasRoleAndPermission;
    use Hashids;
    use Sluggable;
    use SoftDeletes;
    use Sortable;
    use Translatable;
    use Scopable;
    use Actionable;
    use Searchable;
    use Workflowable;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'user.user.model';

    /*
     * Get the model that the creator belongs to.
     */
    public function owner()
    {
        return $this->morphTo(__FUNCTION__, 'user_type', 'user_id');
    }
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
