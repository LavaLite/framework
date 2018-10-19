<?php

namespace Litepie\User\Models;

use Litepie\Database\Model;
use Litepie\Database\Traits\Slugger;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Repository\Traits\PresentableTrait;
use Litepie\Trans\Traits\Translatable;
use Litepie\User\Traits\Team as TeamTrait;

// use Litepie\Workflow\Model\Workflow;

class Team extends Model
{
    use Filer, Hashids, Slugger, Translatable,  PresentableTrait, TeamTrait;
    // use Workflow;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'users.team.model';
}
