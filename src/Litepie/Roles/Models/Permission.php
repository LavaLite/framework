<?php

namespace Litepie\Roles\Models;

use Litepie\Database\Model;
use Litepie\Database\Traits\Slugger;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Repository\Traits\PresentableTrait;
use Litepie\Revision\Traits\Revision;
use Litepie\Trans\Traits\Translatable;
use Litepie\Roles\Traits\PermissionHasRelations;

class Permission extends Model
{
    use Filer, Hashids, Slugger, Translatable, Revision, PresentableTrait, PermissionHasRelations;


    /**
     * Configuartion for the model.
     *
     * @var array
     */
     protected $config = 'roles.permission.model';

	public function getSlugIdAttribute()
	{
	    return $this->slug . '.' . $this->id;
	}

}
