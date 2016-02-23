<?php

namespace Litepie\Menu\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Database\Model;
use Litepie\Database\Traits\Slugger;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Node\Traits\SimpleNode;
use Litepie\Trans\Traits\Trans;

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
