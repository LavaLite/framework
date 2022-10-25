<?php

namespace Litepie\Activities;

use Spatie\Activitylog\LogOptions as SpatieLogOptions;

class LogOptions  extends SpatieLogOptions
{
    public bool $logFillable = true;
    public bool $logOnlyDirty = true;

}
