<?php

namespace Litepie\Log\Models;

use Litepie\Hashids\Traits\Hashids;
use Spatie\Activitylog\Contracts\Activity as ActivityContract;
use Spatie\Activitylog\Models\Activity as SpatieActivity;

class Activity extends SpatieActivity implements ActivityContract
{
    use Hashids;
}
