<?php

namespace Litepie\Activities\Relations;

use Litepie\Activities\Traits\FiresPivotEventsTrait;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class MorphToManyCustom extends MorphToMany
{
    use FiresPivotEventsTrait;
}
