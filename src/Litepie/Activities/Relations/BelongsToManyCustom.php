<?php

namespace Litepie\Activities\Relations;

use Litepie\Activities\Traits\FiresPivotEventsTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BelongsToManyCustom extends BelongsToMany
{
    use FiresPivotEventsTrait;
}
