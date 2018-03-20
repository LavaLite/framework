<?php

namespace Litepie\Roles\Models;

use Litepie\Database\Model;
use Litepie\Database\Traits\Slugger;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Repository\Traits\PresentableTrait;
use Litepie\Trans\Traits\Translatable;
use Litepie\Roles\Traits\RoleHasRelations;
use Litepie\Roles\Interfaces\RoleHasRelations as RoleHasRelationsContract;

class Role extends Model implements RoleHasRelationsContract
{
    use Filer, Hashids, Slugger, Translatable,  PresentableTrait, RoleHasRelations;


    /**
     * Configuartion for the model.
     *
     * @var array
     */
     protected $config = 'roles.role.model';


}
