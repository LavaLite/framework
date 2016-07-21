<?php

namespace Litepie\Filer\Traits;

use Filer as Uploader;
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
     * Root folder for uploading files.
     **/
    protected $uploadfolder;

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
            return folder_encode($value, true, false);
        } else {
            $folder                            = folder_new($this->table, null);
            $this->attributes['upload_folder'] = $folder;

            return folder_decode($folder);
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
        $this->attributes['upload_folder'] = folder_decode($value);
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
        return URL::to('upload/' . $this->upload_folder . '/' . $field . '/' . $file);
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

        if (Session::has('upload.' . $this->table . '.' . $field)) {
            $value = Request::session()->pull('upload.' . $this->table . '.' . $field);
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

        if (Session::has('upload.' . $this->table . '.' . $field)) {
            $session = Request::session()->pull('upload.' . $this->table . '.' . $field);
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

        if (!is_array($this->$field) || empty($this->$field)) {
            return 'test';
        }

        return 'image/' . $size . '/' . folder_encode($this->$field['folder']) . '/' . $this->$field['file'];
    }

}
