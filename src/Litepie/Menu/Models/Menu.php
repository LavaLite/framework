<?php

namespace Litepie\Menu\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Database\Traits\Slugger;
use Litepie\Database\Model;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Trans\Traits\Trans;

class Menu extends Model
{
    use Hashids, Slugger, Trans, SoftDeletes;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
     protected $config = 'menu.menu';
}
