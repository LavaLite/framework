<?php

namespace Litepie\Page\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Database\Traits\Slugger;
use Litepie\Database\Model;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Trans\Traits\Translatable;
use Litepie\Revision\Traits\Revision;

class Page extends Model
{
    use Filer, SoftDeletes, Hashids, Slugger, Translatable, Revision;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
     protected $config = 'litepie.page.page';
}
