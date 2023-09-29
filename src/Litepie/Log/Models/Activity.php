<?php

namespace Litepie\Log\Models;

use Litepie\Hashids\Traits\Hashids;
use Spatie\Activitylog\Models\Activity as SpatieActivity;
use Spatie\Activitylog\Contracts\Activity as ActivityContract;

class Activity extends SpatieActivity implements ActivityContract
{
    use Hashids;
}
