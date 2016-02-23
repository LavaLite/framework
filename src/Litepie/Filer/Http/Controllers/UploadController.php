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
     * @param $url
     *
     * @return string
     */
    public function upload($table, $folder, $field, $file = 'file')
    {
        if (Request::hasFile($file)) {
            $dfolder = folder_decode($folder);
            $array = Filer::upload(Request::file($file), "{$table}/{$dfolder}/{$field}");
            $array['efolder'] = "{$table}/{$folder}/{$field}";
            Session::push("upload.{$table}.{$field}", $array);

            return $array;
        }
    }
}
