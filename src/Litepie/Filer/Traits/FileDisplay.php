<?php

namespace Litepie\Filer\Traits;

use Intervention\Image\Facades\Image as Intervention;

trait FileDisplay
{
    /* Resize an image.
     *
     * @param $folder
     * @param $file
     * @param $size
     *
     * @return Intervention
     */
    public function resize($folder, $file, $size)
    {
        // pass calls to picture cache
        return $this->image->cache(function ($picture) use ($folder, $file, $size) {
            $file = public_path().'/'.$folder.'/'.$file;

            return $picture->make($file)->resize($size['width'], $size['height'], function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        });
    }

    /**
     * @param $folder
     * @param $file
     * @param $size
     *
     * @return Intervention
     */
    public function image($folder, $file, $size)
    {
        if ($size['action'] == 'resize') {
            return $this->resize($folder, $file, $size);
        } else {
            return $this->fit($folder, $file, $size);
        }
    }

    /**
     * @param $folder
     * @param $file
     * @param $size
     *
     * @return Intervention
     */
    public function fit($folder, $file, $size)
    {

        // pass calls to picture cache
        return $this->image->cache(function ($picture) use ($folder, $file, $size) {
            $file = public_path().'/'.$folder.'/'.$file;

            return $picture->make($file)->fit($size['width'], $size['height']);
        });
    }

    /**
     * @param $folder
     * @param $file
     * @param $size
     *
     * @return Intervention
     */
    public function watermark($folder, $file, $size)
    {

        // pass calls to picture cache
        return $this->image->cache(function ($picture) use ($folder, $file, $size) {
            $file = public_path().'/'.$folder.'/'.$file;

            return $picture->make($file)->resize($size['width'], $size['height']);
        });
    }
}
