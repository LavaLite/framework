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
    public function image($size, $config, $folder, $field, $file)
    {

        $size   = $this->getSize($size);
        $folder = $this->getFolder($config, $folder, $field);
        $image = Filer::image($folder, $file, $size);

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
    public function getFolder($config, $folder, $field)
    {
        $path = config($config . '.upload_folder', config('litepie.' . $config . '.upload_folder'));

        if (empty($path)) {
            throw new FileNotFoundException();
        }

        $folder = folder_decode($folder);

        return config('filer.folder', 'uploads') . '/' . "{$path}/{$folder}/{$field}";

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
            $size = config('litepie.' . $size[0] . '.image.' . $size[1]);
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
    public function file($config, $folder, $field, $file)
    {
        $folder = $this->getFolder($config, $folder, $field);
        $file   = public_path($folder . '/' . $file);

        try {
            $contents = File::get($file);
        } catch (FileNotFoundException $exception) {
            throw new FileNotFoundException();
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime  = finfo_file($finfo, $file);
        finfo_close($finfo);

        $header = [
            'Cache-Control' => 'max-age=864000, public',
            'Expires'       => gmdate('D, d M Y H:i:s \G\M\T', time() + 864000),
            'Pragma'        => 'public'];

        $header['Content-Type'] = $mime;

        return Response::make($contents, 200, $header);
    }

}
