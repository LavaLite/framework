<?php

namespace Litepie\Filer\Templates;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class ExtraLarge implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(480, 360);
    }
}