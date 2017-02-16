<?php

namespace Litepie\Workflow\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Database\Model;
use Litepie\Database\Traits\Slugger;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Repository\Traits\PresentableTrait;
use Litepie\Revision\Traits\Revision;
use Litepie\Trans\Traits\Translatable;
// use Litepie\Workflow\Model\Workflow;

class Workflow extends Model
{
    use Filer, SoftDeletes, Hashids, Slugger, Translatable, Revision, PresentableTrait;
    // use Workflow;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'litepie.workflow.workflow';

   /**
     * incrementing for the model.
     */
    public $incrementing = false;

    /**
     * User morph to many relation.
     */
    public function performable()
    {
        return $this->morphTo();
    }

    /**
     * Workflow morph to many relation.
     */
    public function workflowable()
    {
        return $this->morphTo();
    }

}
