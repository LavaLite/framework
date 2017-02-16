<?php

namespace Litepie\News\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Database\Model;
use Litepie\Database\Traits\Slugger;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Repository\Traits\PresentableTrait;
use Litepie\Revision\Traits\Revision;
use Litepie\Revision\Traits\Activity;
use Litepie\Workflow\Traits\Workflow;
use Litepie\Trans\Traits\Translatable;
use Litepie\Workflow\Model\Workflow as WorkflowModel;

class News extends Model
{
    use Filer, SoftDeletes, Hashids, Slugger, Translatable, Revision, Activity, PresentableTrait, Workflow, WorkflowModel;

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

    /**
     * The team that belong to the news.
     */
    public function team()
    {
        return $this->belongsTo('Litepie\User\Models\Team','team_id');
    }
    /**
     * The team that belong to the news.
     */
    public function reporting()
    {
        return $this->belongsTo('App\User','reporting_to');
    }

        
        


    /**
     * Returns the reporting_to.
     *
     * @return string int
     */
    public function getReportingToAttribute()
    {
        if ($this->team_id == 0) {
            return $this->user->reporting_to;
        }

        return $this->team->reported_to;
    }
}
