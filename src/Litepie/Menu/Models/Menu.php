<?php

namespace Litepie\Menu\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Database\Traits\Slugger;
use Litepie\Database\Model;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Trans\Traits\Trans;
use Litepie\Node\Traits\SimpleNode;

class Menu extends Model
{
    use Hashids, Slugger, Trans, SoftDeletes, SimpleNode;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
     protected $config = 'menu.menu';
}
