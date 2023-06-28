<?php

namespace Litepie\Role\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Actions\Traits\Actionable;
use Litepie\Database\Model;
use Litepie\Database\Traits\Scopable;
use Litepie\Database\Traits\Searchable;
use Litepie\Database\Traits\Sluggable;
use Litepie\Database\Traits\Sortable;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Trans\Traits\Translatable;

class Permission extends Model
{
    use Hashids;
    use Sluggable;
    use SoftDeletes;
    use Sortable;
    use Translatable;
    use Searchable;
    use Scopable;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'role.permission.model';

    /*
     * Get the model that the creator belongs to.
     */
    public function owner()
    {
        return $this->morphTo(__FUNCTION__, 'user_type', 'user_id');
    }

}
