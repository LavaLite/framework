<?php

namespace Litepie\Activities\Test\Models;

use Litepie\Activities\Models\Activity;

class CustomActivityModel extends Activity
{
    public function getCustomPropertyAttribute()
    {
        return $this->changes();
    }
}
