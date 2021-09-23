<?php

namespace Litepie\Filer\Http\Controllers;

use Filer;
use Illuminate\Http\Request;
use Litepie\Http\Controllers\Controller;

class UploadController extends Controller
{
    /**
     * Upload folder to the given path.
     *
     * @param string $config
     * @param string $path
     *
     * @return array|json
     */
    public function upload(Request $request, $config, $path)
    {
        $path = explode('/', $path);
        $file = array_pop($path);
        $field = array_pop($path);
        $folder = implode('/', $path);
        if ($request->hasFile($file)) {
            $ufolder = $this->uploadFolder($config, $folder, $field);
            $array = Filer::upload($request->file($file), $ufolder);
            $array['folder'] = $folder.'/'.$field;
            $array['path'] = $ufolder.'/'.$array['file'];

            $ext = pathinfo($array['file'], PATHINFO_EXTENSION);

            if (in_array($ext, config('filer.image_extensions'))) {
                $array['url'] = url('image/original/'.$ufolder.'/'.$array['file']);
            } else {
                $array['url'] = url('file/display/'.$ufolder.'/'.$array['file']);
            }

            return response()->json($array)
                ->setStatusCode(203, 'UPLOAD_SUCCESS');
        }
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
        $path = config($config.'.upload_folder');

        if (empty($path)) {
            throw new FileNotFoundException('Invalid upload configuration value.');
        }

        return "{$path}/{$folder}/{$field}";
    }
}
