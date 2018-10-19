<?php

namespace Litepie\Filer\Templates;

use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class ExtraLarge implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $action = config('image.size.xl.action', 'fit');
        $width = config('image.size.xl.width', 2000);
        $height = config('image.size.xl.height', 1500);

        if ($action == 'resize') {
            $image->resize($width, $height);
        } else {
            $image->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            });
        }

        if (!empty(config('image.size.xl.watermark'))) {
            $image->insert(config('image.size.xl.watermark'), 'center');
        }

        return $image;
    }
}
