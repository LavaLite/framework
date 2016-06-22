<?php
namespace Litepie\Filer\Traits;

trait UploadForm
{

    /**
     * Description
     * @param type $files
     * @param type $count
     * @param type|string $view
     * @return type
     */
    public function show($files, $count = -1, $view = 'filer.show')
    {

        if (!is_array($files) && !is_object($files)) {
            $files = json_decode($files, true);
        }

        if (empty($files)) {
            $files = [];
        }

        if (is_object($files)) {
            $files = (array) $files;
        }

        return view($view, compact('files', 'field', 'count'));
    }

    public function editor($field, $files, $count = -1, $view = 'filer.editor')
    {
        $view = is_null($view) ? 'filer.editor' : $view;

        if (!is_array($files) && !is_object($files)) {
            $files = json_decode($files, true);
        }

        if (empty($files)) {
            $files = [];
        }

        if (is_object($files)) {
            $files = (array) $files;
        }

        return view($view, compact('files', 'field', 'count'));
    }

    public function uploader($field, $path, $files = 10, $view = 'filer.upload', $mime = 'image/*')
    {
        $view = is_null($view) ? 'filer.upload' : $view;

        return view($view, compact('path', 'field', 'files', 'mime'));
    }

}
