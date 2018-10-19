<?php

namespace Litepie\Filer\Templates;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Large implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $action = config('filer.size.lg.action', 'fit');
        $width = config('filer.size.lg.width', 1000);
        $height = config('filer.size.lg.height', 750);

        if ($action == 'resize') {
            $image->resize($width, $height);
        } else {
            $image->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            });
        }

        if (!empty(config('filer.size.lg.watermark'))) {
            $image->insert(config('filer.size.lg.watermark'), 'center');
        }

        return $image;
    }
}
