<?php

namespace Litepie\Log\Models;

use Spatie\Activitylog\Models\Activity as SpatieActivity;
use Spatie\Activitylog\Contracts\Activity as ActivityContract;

class Activity extends SpatieActivity implements ActivityContract
{

}
