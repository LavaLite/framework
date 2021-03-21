<?php

namespace Litepie\Activities\Models;

use Spatie\Activitylog\Models\Activity as SpatieModel;

class Activity extends SpatieModel
{
    protected static $logFillable = true;

    protected static $logOnlyDirty = true;

    public function activities()
    {
        return $this->morphMany('Litepie\Activities\Models\Activity', 'subject');
    }

    public function activatable()
    {
        return $this->morphTo();
    }
}
