<?php

namespace Litepie\User\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Database\Model;
use Litepie\Database\Traits\Slugger;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Repository\Traits\PresentableTrait;
use Litepie\Revision\Traits\Revision;
use Litepie\Trans\Traits\Translatable;
// use Litepie\Workflow\Model\Workflow;

class Role extends Model
{
    use Hashids, Slugger, Revision, PresentableTrait;
    // use Workflow;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
     protected $config = 'litepie.user.role';

    /**
     * The users that belong to the role.
     */
    public function users(){
        return $this->belongsToMany(config('auth.providers.users.model'));
    }
}
