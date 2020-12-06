<?php

namespace Litepie\Settings\Models;

use Litepie\Database\Model;
use Litepie\Filer\Traits\Filer;
use Litepie\Repository\Traits\PresentableTrait;

class Setting extends Model
{
    use Filer;
    use PresentableTrait;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'settings.setting';
}
