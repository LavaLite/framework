<?php

namespace Litepie\Filer\Templates;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Medium implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $action = config('filer.size.md.action', 'fit');
        $width  = config('filer.size.md.width', 800);
        $height = config('filer.size.md.height', 600);

        if ($action == 'resize') {
            $image->resize($width, $height);
        } else {
            $image->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            });
        }

        if (!empty(config('filer.size.md.watermark'))) {
            $image->insert(config('filer.size.md.watermark'), 'center');
        }

        return $image;
    }
}