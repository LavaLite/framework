<?php

namespace Litepie\Filer\Http\Controllers;

use App\Http\Controllers\Controller;
use Filer;
use Request;
use Session;

class UploadController extends Controller
{
    /**
     * Create a new upload controller instance.
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Upload folder to the given path
     *
     * @param type $package
     * @param type $module
     * @param type $folder
     * @param type $field
     * @param type|string $file
     *
     * @return array|json
     */
    public function upload($config, $folder, $field, $file = 'file')
    {

        if (Request::hasFile($file)) {

            $ufolder         = $this->uploadFolder($config, $folder, $field);
            $array           = Filer::upload(Request::file($file), $ufolder);
            $array['folder'] = folder_decode($folder)."/{$field}";
            Session::push("upload.{$config}.{$field}", $array);

            return $array;
        }

    }

    /**
     * Return the upload folder path.
     *
     * @param type $package
     * @param type $module
     * @param type $folder
     * @param type $field
     *
     * @return string
     */
    public function uploadFolder($config, $folder, $field)
    {
        $path = config($config . '.upload_folder', config('package.' . $config . '.upload_folder'));

        if (empty($path)) {
            throw new FileNotFoundException();
        }

        $folder = folder_decode($folder);

        return "{$path}/{$folder}/{$field}";

    }

}
