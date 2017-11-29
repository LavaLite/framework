<?php

namespace Litepie\Filer\Http\Controllers;

use App\Http\Controllers\Controller;
use Filer;
use Request;

class UploadController extends Controller
{

    /**
     * Upload folder to the given path
     *
     * @param type $config
     * @param type $folder
     * @param type $field
     * @param type|string $file
     *
     * @return array|json
     */
    public function upload($config, $path)
    {

        $path   = explode('/', $path);
        $file   = array_pop($path);
        $field  = array_pop($path);
        $folder = implode('/', $path);

        if (Request::hasFile($file)) {
            $ufolder         = $this->uploadFolder($config, $folder, $field);
            $count           = $this->getCount($config, $field);
            $array           = Filer::upload(Request::file($file), $ufolder);
            $array['folder'] = ($folder) . '/' . $field;
            $array['path']   = $ufolder . '/' . $array['file'];
            $this->setFiles("upload.{$config}.{$field}", $array, $count);
            return response()->json($array)
                ->setStatusCode(203, 'UPLOAD_SUCCESS');
        }

    }

    /**
     * Set uploaded file details to cache for saving to db later
     *
     * @return void
     * @author
     **/
    public function setFiles($key, $value, $count)
    {
        $session = session()->pull($key, []);
        array_push($session, $value);
        $session = array_slice($session, 0, $count);
        session()->put($key, $session);
    }

    /**
     * Return the upload folder path.
     *
     * @param type $config
     * @param type $folder
     * @param type $field
     *
     * @return string
     */
    public function uploadFolder($config, $folder, $field)
    {
        $path = config($config . '.upload_folder');

        if (empty($path)) {
            throw new FileNotFoundException('Invalid upload configuration value.');
        }

        return "{$path}/{$folder}/{$field}";

    }

    /**
     * Return the upload folder path.
     *
     * @param type $config
     * @param type $folder
     * @param type $field
     *
     * @return string
     */
    public function getCount($config, $field)
    {
        $count = config("{$config}.uploads.{$field}.count");

        if (empty($count) && !is_integer($count)) {
            $count = 1;
        }

        return $count;
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
    public function crop($config, $folder, $field, $file = 'file')
    {
        $item      = Request::all();
        $file      = $item['cropping'];
        $file_name = $item['name'];
        $ufolder   = $this->uploadFolder($config, $folder, $field);
        $path      = Filer::checkUploadFolder($ufolder);

        if (!empty($file)) {
            $file = str_replace('data:image/jpeg;base64,', '', $file);
            $img  = str_replace(' ', '+', $file);
            $data = base64_decode($img);
            $path = $path . "/" . $file_name;

            if (file_put_contents($path, $data)) {
                $array['folder']  = folder_decode($folder) . "/{$field}";
                $array['file']    = $file_name;
                $array['caption'] = ucwords(substr($file_name, 0, strpos($file_name, '.')));

                return $array;
            }

        }

    }

}
