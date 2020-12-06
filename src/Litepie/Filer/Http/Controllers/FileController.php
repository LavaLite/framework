<?php

namespace Litepie\Filer\Http\Controllers;

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
}
