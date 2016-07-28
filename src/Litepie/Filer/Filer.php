<?php

namespace Litepie\Filer;

use App;
use Litepie\Filer\Traits\FileDisplay;
use Litepie\Filer\Traits\Uploader;
use Litepie\Filer\Form\Forms;

class Filer
{

    use FileDisplay, Uploader;

    public function __construct()
    {
        $this->image = App::make('image');
    }

}
