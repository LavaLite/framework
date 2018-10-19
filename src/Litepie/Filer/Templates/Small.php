<?php

namespace Litepie\Filer\Templates;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Small implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $action = config('filer.size.sm.action', 'fit');
        $width = config('filer.size.sm.width', 400);
        $height = config('filer.size.sm.height', 300);

        if ($action == 'resize') {
            $image->resize($width, $height);
        } else {
            $image->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            });
        }

        if (!empty(config('filer.size.sm.watermark'))) {
            $image->insert(config('filer.size.sm.watermark'), 'center');
        }

        return $image;
    }
}
