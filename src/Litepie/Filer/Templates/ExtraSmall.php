<?php

namespace Litepie\Filer\Templates;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class ExtraSmall implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $action = config('filer.size.xs.action', 'fit');
        $width = config('filer.size.xs.width', 100);
        $height = config('filer.size.xs.height', 80);

        if ($action == 'resize') {
            $image->resize($width, $height);
        } else {
            $image->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            });
        }

        if (!empty(config('filer.size.xs.watermark'))) {
            $image->insert(config('filer.size.xs.watermark'), 'center');
        }

        return $image;
    }
}
