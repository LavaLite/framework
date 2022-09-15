<?php

namespace Litepie\Filer\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Image;
use Litepie\Http\Controllers\Controller;

class FileController extends Controller
{
    /**
     * Download file.
     *
     * @param string $path
     */
    public function download($path)
    {
        $file_path = base_path(config('filer.folder')).'/'.str_replace('..', '', $path);

        if (file_exists($file_path) && is_file($file_path)) {
            // file found
            return response()->download($file_path);
        }
        abort(404);
    }

    /**
     * Display file.
     *
     * @param type $path
     */
    public function display($path)
    {
        $file_path = base_path(config('filer.folder')).'/'.str_replace('..', '', $path);

        if (file_exists($file_path) && is_file($file_path)) {
            // file found
            return response()->file($file_path);
        }
        abort(404);
    }

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
            $disk = $request->get('disk', config('filesystems.default'));
            $ufolder = $this->uploadFolder($config, $folder, $field);
            $array = Filer::upload($request->file($file), $disk, $ufolder);
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
    /**
     * Get HTTP response of either original image file or
     * template applied file.
     *
     * @param string $template
     * @param string $filename
     *
     * @return Illuminate\Http\Response
     */
    public function image($disk, $template, $path)
    {
        $template = $this->getTemplate($template);
        $image = Storage::disk($disk)->get($path);
        $image = Image::make($image);
        $image->filter($template);
        return $image->response();
    }

    /**
     * Returns corresponding template object from given template name.
     *
     * @param string $template
     *
     * @return mixed
     */
    private function getTemplate($template)
    {
        $template = config("image.templates.{$template}");

        switch (true) {
            // closure template found
            case is_callable($template):
                return $template;

            // filter template found
            case class_exists($template):
                return new $template();

            default:
                // template not found
                abort(404);
                break;
        }
    }

}
