<?php

namespace Litepie\Master\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Database\Model;
use Litepie\Database\Traits\DateFormatter;
use Litepie\Database\Traits\Slugger;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Repository\Traits\PresentableTrait;
use Litepie\Trans\Traits\Translatable;

class Master extends Model
{
    use Filer, SoftDeletes, Hashids, Slugger, DateFormatter, Translatable, PresentableTrait;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'master.master.model';

    public function parent()
    {
        return $this->belongsTo('Litepie\Master\Models\Master', 'parent_id');
    }

}
