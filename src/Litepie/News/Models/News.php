<?php

namespace Litepie\News\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Database\Model;
use Litepie\Database\Traits\Slugger;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Repository\Traits\PresentableTrait;
use Litepie\Revision\Traits\Revision;
use Litepie\Trans\Traits\Translatable;
use Litepie\Workflow\Model\Workflow;

class News extends Model
{
    use Filer, SoftDeletes, Hashids, Slugger, Translatable, Revision, PresentableTrait, Workflow;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
     protected $config = 'litepie.news.news';
     
    /**
     * User morph to many relation.
     */
    public function user()
    {
        return $this->morphTo();
    }
}
