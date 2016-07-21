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

    /**
     * Resize/Fix the image according to the specification in the size array.
     *
     * @param string $size
     * @param string $table
     * @param string $folder
     * @param string $field
     * @param string $file
     *
     * @return Response
     */
    public function image($size, $table, $folder, $field, $file)
    {

        $size   = $this->getSize($size);
        $folder = config('filer.folder', 'uploads') . '/' . $table . '/' . folder_decode($folder) . '/' . $field;
        $image  = Filer::image($folder, $file, $size);

        $header = [
            'Content-Type'  => 'image/jpg',
            'Cache-Control' => 'max-age=864000, public',
            'Expires'       => gmdate('D, d M Y H:i:s \G\M\T', time() + 864000),
            'Pragma'        => 'public'];

        return Response::make($image, 200, $header);
    }

    /**
     * Get the resize array for the given size.
     *
     * @param type $size
     *
     * @return array
     */
    public function getSize($size)
    {
        $size = explode('.', $size);

        if (count($size) == 1) {
            $size = config('filer.size.' . $size[0]);
        } elseif (count($size) == 2) {
            $size = config('package.'. $size[0]. '.image.' . $size[1]);
        } else {
            $size = config(implode('.', $size));
        }

        if (empty($size)) {
            throw new NotFoundHttpException();
        }

        $size['action'] = (isset($size['action']) && in_array($size['action'], ['fit', 'resize'])) ? $size['action'] : 'fit';

        return $size;
    }

    /**
     * Download the given file.
     *
     * @param string $table
     * @param string $folder
     * @param string $field
     * @param string $file
     *
     * @return file
     */
    public function file($table, $folder, $field, $file)
    {
        $folder = config('filer.folder', 'uploads') . '/' . $table . '/' . folder_decode($folder) . '/' . $field;

        try {
            $contents = File::get(public_path($folder . '/' . $file));
        } catch (FileNotFoundException $exception) {
            throw new FileNotFoundException();
        }

        $header = [
            'Content-Type'  => 'application/*',
            'Cache-Control' => 'max-age=864000, public',
            'Expires'       => gmdate('D, d M Y H:i:s \G\M\T', time() + 864000),
            'Pragma'        => 'public'];

        return Response::make($contents, 200, $header);
    }

}
