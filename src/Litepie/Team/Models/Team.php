<?php

namespace Litepie\Team\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Actions\Traits\Actionable;
use Litepie\Database\Model;
use Litepie\Database\Traits\Scopable;
use Litepie\Database\Traits\Searchable;
use Litepie\Database\Traits\Sortable;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Trans\Traits\Translatable;
use Litepie\Workflow\Traits\Workflowable;

class Team extends Model
{
    use Filer;
    use Hashids;
    // use Sluggable;
    use SoftDeletes;
    use Sortable;
    use Translatable;
    use Searchable;
    use Scopable;
    use Actionable;
    use Workflowable;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'team.team.model';

    /*
     * Get the model that the creator belongs to.
     */
    public function owner()
    {
        return $this->morphTo(__FUNCTION__, 'user_type', 'user_id');
    }
    /**
     * The User that belong to the team.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User')
            ->withPivot([
                'id', 'role', 'level',
            ]);
    }
}
