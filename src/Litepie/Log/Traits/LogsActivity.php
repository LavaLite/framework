<?php

namespace Litepie\Log\Traits;

use Spatie\Activitylog\Traits\LogsActivity as SpatieLogActivity;
use Litepie\Log\Models\Activity;
use Litepie\Log\LogOptions;

trait LogsActivity
{
    use SpatieLogActivity;

    /**
     * Get all of the post's comments.
     */
    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll()->logOnlyDirty();
    }

}
