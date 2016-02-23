<?php

namespace Litepie\Filer\Http\Controllers;

use App\Http\Controllers\Controller;
use File;
use Filer;
use Illuminate\Filesystem\FileNotFoundException;
use Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FileController extends Controller
{
    /**
     * Create a new file controller instance.
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    public function image($size, $table, $folder, $field, $file)
    {
        $size = $this->getSize($size);
        $folder = config('files.folder', 'uploads').'/'.$table.'/'.folder_decode($folder).'/'.$field;

        if (!is_file(public_path($folder.'/'.$file))) {
            $image = Filer::image($size['default'], $size);
        } else {
            $image = Filer::$size['action']($folder, $file, $size);
        }
        $header = [
            'Content-Type'  => 'image/jpg',
            'Cache-Control' => 'max-age=864000, public',
            'Expires'       => gmdate('D, d M Y H:i:s \G\M\T', time() + 864000),
            'Pragma'        => 'public', ];

        return Response::make($image, 200, $header);
    }

    public function getSize($size)
    {
        $size = config($size, config('files.size.'.$size));

        if (empty($size)) {
            throw new NotFoundHttpException();
        }

        $size['action'] = (isset($size['action']) && in_array($size['action'], ['fit', 'resize'])) ? $size['action'] : 'fit';

        return $size;
    }

    public function file($table, $folder, $field, $file)
    {
        $folder = config('files.folder', 'uploads').'/'.$table.'/'.folder_decode($folder).'/'.$field;

        try {
            $contents = File::get(public_path($folder.'/'.$file));
        } catch (FileNotFoundException $exception) {
            throw new FileNotFoundException();
        }

        $header = [
            'Content-Type'  => 'image/jpg',
            'Cache-Control' => 'max-age=864000, public',
            'Expires'       => gmdate('D, d M Y H:i:s \G\M\T', time() + 864000),
            'Pragma'        => 'public', ];

        return Response::make($contents, 200, $header);
    }
}
