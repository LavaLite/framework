<?php

namespace Litepie\Roles\Models;

use Litepie\Database\Model;
use Litepie\Database\Traits\Slugger;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Repository\Traits\PresentableTrait;
use Litepie\Roles\Interfaces\RoleHasRelations as RoleHasRelationsContract;
use Litepie\Roles\Traits\RoleHasRelations;

class Role extends Model implements RoleHasRelationsContract
{
    use Filer, Hashids, Slugger, PresentableTrait, RoleHasRelations;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'roles.role.model';

    public function setLevelAttribute($value)
    {
        if (empty($value)) {
            return $this->level = 1;
        }

        return $this->level = $value;
    }
}
