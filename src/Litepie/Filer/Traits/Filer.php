<?php

namespace Litepie\Filer\Traits;

use Cache;
use Filer as Uploader;
use Litepie\Filer\Form\Forms;
use Request;
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

        $model->uploadFiles();

    }

    /**
     * Upload single file save as single diamentional array.
     *
     * @return null
     *
     */
    public function uploadFiles()
    {

        foreach ($this->uploads as $field => $settings) {
            $files = [];

            if (is_array(Request::file($field))) {

                foreach (Request::file($field) as $file) {

                    if ($file instanceof UploadedFile) {
                        $files[] = Uploader::upload($file, $this->upload_folder . DIRECTORY_SEPARATOR . $field);
                    }

                }

            } elseif (Request::hasFile($field)) {

                $file = Request::file($field);

                if ($file instanceof UploadedFile) {
                    $files[] = Uploader::upload($file, $this->upload_folder . DIRECTORY_SEPARATOR . $field);
                }

            }

            $this->setFiles($field, $files);
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
            return $value;
        }

        $folder                            = folder_new(null, null);
        $this->attributes['upload_folder'] = $folder;

        return $folder;

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
        return trans_url('upload/' . $this->config . '/' . folder_encode($this->upload_folder) . '/' . $field . '/' . $file);
    }

    /**
     * Return url to upload the file.
     *
     * @param srting $field
     * @param srting|string $file
     *
     * @return null
     */
    public function getCropURL($field, $file = 'file')
    {
        return trans_url('crop/' . $this->config . '/' . folder_encode($this->upload_folder) . '/' . $field . '/' . $file);
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
        return trans_url('file/' . $this->config . '/' . folder_encode($this->upload_folder) . '/' . $field . '/' . $file);
    }

    /**
     * Set single file field after upload.
     *
     * @param srting $field
     * @param srting $value
     *
     * @return null
     */
    public function setFiles($field, $current)
    {

        if (empty($current)) {
            $current = [];
        }

        $cache = [];

        if (Cache::has('upload.' . $this->config . '.' . $field)) {
            $cache = Cache::pull('upload.' . $this->config . '.' . $field);
        }

        if (empty($current) && empty($cache) && !Request::has($field)) {
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

        $files = array_merge($current, $cache, $prev);

        $files = array_slice($files, 0, $this->getUploadFileCount($field));

        $this->setAttribute($field, $files);
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
     * Get the original value of file field.
     *
     * @param string $field
     *
     * @return array
     */
    public function getUploadFileCount($field)
    {
        return $this->uploads[$field]['count'];
    }

    /**
     * Return the main image for the record.
     *
     * @param type|string $size
     * @param type|string $field
     *
     * @return string path
     */
    public function defaultImage($field, $size = 'md', $pos = 0)
    {
        $image = $this->$field;

        if (!is_array($image) || empty($image)) {
            return 'img/default/' . $size . '.jpg';
        }

        $config = $this->config;
        $config = preg_replace('~\.(?!.*\.)~', '/', $config);

        $image = array_pull($image, $pos);

        return "image/{$config}/{$size}/" . folder_encode($image['folder']) . '/' . $image['file'];
    }

    /**
     * Return the array of images for the data.
     *
     * @param type|string $size
     * @param type|string $field
     *
     * @return string path
     */
    public function getImages($field, $size = 'md')
    {
        $image = $this->$field;

        if (!is_array($image) || empty($image)) {
            return ['img/default/' . $size . '.jpg'];
        }

        $config = $this->config;
        $config = preg_replace('~\.(?!.*\.)~', '/', $config);

        foreach ($image as $key => $img) {
            $image[$key] = "image/{$config}/{$size}/" . folder_encode($img['folder']) . '/' . $img['file'];
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

        $prefix = ($download) ? 'file' : 'download';

        if (!is_array($file) || empty($file)) {
            return [];
        }

        $config = $this->config;
        $config = preg_replace('~\.(?!.*\.)~', '/', $config);

        foreach ($file as $key => $fil) {
            $file[$key]['url'] = url("{$prefix}/{$config}/" . folder_encode($fil['folder']) . '/' . $fil['file']);
        }

        return $file;
    }

    /**
     * Display files inside a form.
     *
     * @param type|string $field
     *
     * @return string path
     */
    public function files($field)
    {
        $form = new Forms($field, $this->config, $this->getFile($field));
        return $form;
    }

}
