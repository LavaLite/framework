<?php

namespace Litepie\Filer\Traits;

use Filer as Uploader;
use Litepie\Filer\Form\Forms;
use Request;
use Session;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use URL;

trait Filer
{
    /**
     * Upload field variable.
     **/
    protected $uploads = [];

    /**
     * Boot the Sorter trait for this model.
     *
     * @return void
     */
    public static function bootFiler()
    {
        static::saving(function ($model) {
            $model->upload($model);
        });
    }

    /**
     * Upload files and save to the table.
     *
     * @param Eloquent $model
     *
     * @return null
     */
    public function upload($model)
    {

        if (empty($model->uploads)) {
            return;
        }

        if (isset($model->uploads['single'])) {
            $model->uploadSingle();
        }

        if (isset($model->uploads['multiple'])) {
            $model->uploadMultiple();
        }

    }

    /**
     * Upload single file save as single diamentional array.
     *
     * @return null
     *
     */
    public function uploadSingle()
    {

        foreach ($this->uploads['single'] as $field) {
            $file = [];

            if (Request::hasFile($field)) {
                $upfile = Request::file($field);

                if ($upfile instanceof UploadedFile) {
                    $file = Uploader::upload($upfile, $this->upload_folder . '/' . $field);
                }

            }

            $this->setFileSingle($field, $file);
        }

    }

    /**
     * Upload multiple files and save as multidiamentional array.
     *
     * @return null
     *
     */
    public function uploadMultiple()
    {

        foreach ($this->uploads['multiple'] as $field) {
            $files = [];

            if (is_array(Request::file($field))) {

                foreach (Request::file($field) as $file) {

                    if ($file instanceof UploadedFile) {
                        $files[] = Uploader::upload($file, $this->upload_folder . '/' . $field);
                    }

                }

            }

            $this->setFileMultiple($field, $files);
        }

    }

    /**
     * Return upload_folder attribute for the model.
     *
     * @param string $value
     *
     * @return string
     */
    public function getUploadFolderAttribute($value)
    {

        if (!empty($value)) {
            return folder_encode($value, false, false);
        } else {
            $folder                            = folder_new(null, null);
            $this->attributes['upload_folder'] = $folder;

            return folder_encode($folder, false, false);
        }

    }

    /**
     * Set upload_folder attribute for the model.
     *
     * @param string $value
     *
     * @return string
     */
    public function setUploadFolderAttribute($value)
    {
        $this->attributes['upload_folder'] = folder_decode($value, false, false);
    }

    /**
     * Return url to upload the file.
     *
     * @param srting $field
     * @param srting|string $file
     *
     * @return null
     */
    public function getUploadURL($field, $file = 'file')
    {
        return URL::to('upload/' . $this->config . '/' . $this->upload_folder . '/' . $field . '/' . $file);
    }

    /**
     * Return url to upload the file.
     *
     * @param srting $field
     * @param srting|string $file
     *
     * @return null
     */
    public function getFileURL($field, $file = 'file')
    {
        return URL::to('file/' . $this->config . '/' . $this->upload_folder . '/' . $field . '/' . $file);
    }

    /**
     * Set single file field after upload.
     *
     * @param srting $field
     * @param srting $value
     *
     * @return null
     */
    public function setFileSingle($field, $value)
    {

        if (Session::has('upload.' . $this->config . '.' . $field)) {
            $value = Request::session()->pull('upload.' . $this->config . '.' . $field);
            $value = end($value);
            Request::session()->save();
        } elseif (!empty($value)) {
            $value = $value;
        } elseif (Request::has($field)) {
            $value = Request::get($field);
        } else {
            return;
        }

        if (empty($value)) {
            $value = [];
        }

        $this->setAttribute($field, $value);
    }

    /**
     * Set single file field after upload.
     *
     * @param srting $field
     * @param srting $value
     *
     * @return null
     */
    public function setFileMultiple($field, $current)
    {

        if (empty($current)) {
            $current = [];
        }

        $session = [];

        if (Session::has('upload.' . $this->config . '.' . $field)) {
            $session = Request::session()->pull('upload.' . $this->config . '.' . $field);
            Request::session()->save();

        }

        if (empty($current) && empty($session) && !Request::has($field)) {
            return;
        }

        if (Request::has($field)) {
            $prev = Request::get($field);
        } else {
            $prev = $this->getOriginalFile($field);
        }

        if (empty($prev)) {
            $prev = [];
        }

        $value = array_merge($prev, $current, $session);

        $this->setAttribute($field, $value);
    }

    /**
     * Get the original value of file field.
     *
     * @param string $field
     *
     * @return array
     */
    public function getOriginalFile($field)
    {
        $original = parent::getOriginal($field);

        return json_decode($original);
    }

    /**
     * Return the main image for the record.
     *
     * @param type|string $size
     * @param type|string $field
     *
     * @return string path
     */
    public function defaultImage($size = 'md', $field = 'image')
    {
        $image  = $this->$field;

        if (!is_array($image) || empty($image)) {
            return 'img/default/' . $size . '.jpg';
        }

        $config = $this->config;

        if (in_array($field, $this->uploads['single'])) {
            return "image/{$size}/{$config}/" . folder_encode($image['folder']) . '/' . $image['file'];
        }

        $image = $image[0];

        return "image/{$size}/{$config}/" . folder_encode($image['folder']) . '/' . $image['file'];
    }

    /**
     * Return the main image for the record.
     *
     * @param type|string $size
     * @param type|string $field
     *
     * @return string path
     */
    public function getImages($size = 'md', $field = 'image')
    {
        $image = $this->$field;
        $config = $this->config;
        
        if (!is_array($image) || empty($image)) {
            return ['img/default/' . $size . '.jpg'];
        }

        if (in_array($field, $this->uploads['single'])) {
            return ["image/{$size}/{$config}/" . folder_encode($image['folder']) . '/' . $image['file']];
        }

        foreach ($image as $key => $img) {
            $image[$key] = "image/{$size}/{$config}/" . folder_encode($img['folder']) . '/' . $img['file'];
        }

        return $image;
    }

    /**
     * Return the main image for the record.
     *
     * @param type|string $size
     * @param type|string $field
     *
     * @return string path
     */
    public function getFile($field, $download = false)
    {
        $file = $this->$field;

        $prefix = ($download) ? 'file/' : 'download/';

        if (!is_array($file) || empty($file)) {

            if (in_array($field, $this->uploads['single'])) {
                return '';
            } else {
                return [];
            }

        }

        if (in_array($field, $this->uploads['single'])) {
            return $file['url'] = url($prefix . folder_encode($file['folder']) . '/' . $file['file']);
            return $file;
        }

        foreach ($file as $key => $fil) {
            $file[$key]['url'] = url($prefix . folder_encode($fil['folder']) . '/' . $fil['file']);
        }

        return $file;
    }

    /**
     * Display file upload form.
     *
     * @param type|string $field
     *
     * @return string path
     */
    public function fileUpload($field, $count = null)
    {
        $form = new Forms($field, $this->config);

        if (in_array($field, $this->uploads['single'])) {
            $form->count(1, true);
        } else {
            $form->count($count);
        }

        return $form->url($this->getUploadURL($field))
            ->uploader();
    }

    /**
     * Display files.
     *
     * @param type|string $field
     *
     * @return string path
     */
    public function fileShow($field)
    {
        $form = new Forms($field, $this->config, $this->getFile($field));
        if (in_array($field, $this->uploads['single'])) {
            $form->count(1, true);
        }
        return $form->show();
    }

    /**
     * Display file editor window.
     *
     * @param type|string $field
     *
     * @return string path
     */
    public function fileEdit($field)
    {
        $form = new Forms($field, $this->config,  $this->getFile($field));
        if (in_array($field, $this->uploads['single'])) {
            $form->count(1, true);
        }
        return $form->editor();
    }

    /**
     * Display file upload form.
     *
     * @param type|string $field
     *
     * @return string path
     */
    public function fileCropper($field, $count = null)
    {
        $form = new Forms($field, $this->config);

        if (in_array($field, $this->uploads['single'])) {
            $form->count(1, true);
        } else {
            $form->count($count);
        }
        
        $url = $this->getUploadURL($field);

        return view('filer::cropper',compact('url'))->render();
    }
}
