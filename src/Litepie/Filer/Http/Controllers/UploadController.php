<?php

namespace Litepie\Filer\Http\Controllers;

use App\Http\Controllers\Controller;
use Cache;
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
    public function upload($config, $folder, $field, $file = 'file')
    {

        if (Request::hasFile($file)) {
            $ufolder         = $this->uploadFolder($config, $folder, $field);
            $count           = $this->getCount($config, $field);
            $array           = Filer::upload(Request::file($file), $ufolder);
            $array['folder'] = folder_decode($folder) . DIRECTORY_SEPARATOR . $field;
            $this->setCache("upload.{$config}.{$field}", $array, $count);
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
    public function setCache($key, $value, $count)
    {
        $cache = Cache::pull($key, []);
        array_push($cache, $value);
        $cache = array_slice($cache, 0, $count);
        Cache::put($key, $cache, strtotime('+10 minutes'));
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

        $folder = folder_decode($folder);

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

        if (empty($path) && !is_integer($count)) {
            throw new FileNotFoundException('Invalid upload file count.');
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
