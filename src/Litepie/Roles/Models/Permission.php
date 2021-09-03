<?php

namespace Litepie\Roles\Models;

use Litepie\Database\Model;
use Litepie\Database\Traits\Sluggable;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Repository\Traits\PresentableTrait;
use Litepie\Roles\Traits\PermissionHasRelations;
use Litepie\Trans\Traits\Translatable;

class Permission extends Model
{
    use Filer;
    use Hashids;
    use Sluggable;
    use Translatable;
    use PresentableTrait;
    use PermissionHasRelations;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'role.permission.model';

    public function getSlugIdAttribute()
    {
        return $this->slug.'.'.$this->id;
    }
}
