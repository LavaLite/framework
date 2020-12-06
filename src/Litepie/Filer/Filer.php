<?php

namespace Litepie\Filer;

use App;
use Litepie\Filer\Traits\FileDisplay;
use Litepie\Filer\Traits\Uploader;

class Filer
{
    use FileDisplay;
    use Uploader;

    public function __construct()
    {
        $this->image = App::make('image');
    }
}
