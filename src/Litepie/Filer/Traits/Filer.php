<?php

namespace Litepie\Filer\Traits;

use Filer as Uploader;
use Illuminate\Support\Arr;
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
     */
    public function uploadFiles()
    {
        foreach ($this->uploads as $field => $settings) {
            $files = [];
            $rootFolder = $this->upload_folder_config;

            if (is_array(Request::file($field))) {
                foreach (Request::file($field) as $file) {
                    if ($file instanceof UploadedFile) {
                        $files[] = Uploader::upload($file, $rootFolder . DIRECTORY_SEPARATOR . $this->upload_folder . DIRECTORY_SEPARATOR . $field);
                    }
                }
            } elseif (Request::hasFile($field)) {
                $file = Request::file($field);

                if ($file instanceof UploadedFile) {
                    $files[] = Uploader::upload($file, $rootFolder . DIRECTORY_SEPARATOR . $this->upload_folder . DIRECTORY_SEPARATOR . $field);
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

        $folder = folder_new(null, null);
        $this->attributes['upload_folder'] = $folder;

        return $folder;
    }

    /**
     * Return upload_folder attribute for the model.
     *
     * @param string $value
     *
     * @return string
     */
    public function getUploadFolderConfigAttribute($value)
    {
        return config($this->config . '.' . 'upload_folder');
    }

    /**
     * Return url to upload the file.
     *
     * @param srting        $field
     * @param srting|string $file
     *
     * @return null
     */
    public function getUploadURL($field, $file = 'file')
    {
        return guard_url('upload/' . $this->config . DIRECTORY_SEPARATOR . ($this->upload_folder) . DIRECTORY_SEPARATOR . $field . DIRECTORY_SEPARATOR . $file);
    }

    /**
     * Return url to upload the file.
     *
     * @param srting        $field
     * @param srting|string $file
     *
     * @return null
     */
    public function getCropURL($field, $file = 'file')
    {
        return trans_url('crop/' . $this->config . DIRECTORY_SEPARATOR . ($this->upload_folder) . DIRECTORY_SEPARATOR . $field . DIRECTORY_SEPARATOR . $file);
    }

    /**
     * Return url to upload the file.
     *
     * @param srting        $field
     * @param srting|string $file
     *
     * @return null
     */
    public function getFileURL($field, $file = 'file')
    {
        return trans_url('file/' . $this->config . DIRECTORY_SEPARATOR . ($this->upload_folder) . DIRECTORY_SEPARATOR . $field . DIRECTORY_SEPARATOR . $file);
    }

    /**
     * Set single file field after upload.
     *
     * @param srting $field
     * @param srting $value
     *
     * @return null
     */
    public function setFiles($field, $files)
    {

        if (!is_array($files) && !Request::has($field)) {
            return;
        }

        if (Request::has($field)) {
            $files = Request::get($field);
        }

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
    public function defaultImage($field, $size = 'original', $pos = 0)
    {
        $image = $this->$field;

        if (!is_array($image) || empty($image)) {
            return 'img/default/' . $size . '.jpg';
        }

        $image = Arr::pull($image, $pos, head($image));

        return "image/{$size}/" . ($image['path']);
    }

    /**
     * Return the array of images for the data.
     *
     * @param type|string $size
     * @param type|string $field
     *
     * @return string path
     */
    public function getImages($field, $size = 'sm')
    {
        $image = $this->$field;

        if (!is_array($image) || empty($image)) {
            return ['img/default/' . $size . '.jpg'];
        }

        foreach ($image as $key => $img) {
            $image[$key] = url("image/{$size}/") . DIRECTORY_SEPARATOR . ($img['path']);
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
        $files = $this->$field;

        $prefix = ($download) ? 'original' : 'download';

        if (!is_array($files) || empty($files)) {
            return [];
        }

        foreach ($files as $key => $file) {
            $files[$key]['url'] = $this->getPublicUrl($file['folder'], $file['file'], $prefix);
        }

        return $files;
    }

    /**
     * Return the main image for the record.
     *
     * @param type|string $size
     * @param type|string $field
     *
     * @return string path
     */
    public function getPublicUrl($folder, $file, $prefix = 'download')
    {
        return url("{$prefix}" . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $file);
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
        $form->url($this->getUploadUrl($field));

        return $form;
    }
}
