<?php

namespace Litepie\Filer\Traits;

use Filer as Uploader;
use Illuminate\Support\Arr;
use Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait Filer
{
    /**
     * Upload field variable.
     **/
    protected $uploads = [];

    /**
     * Upload field variable.
     **/
    protected $upload_root = '';

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
                        $files[] = Uploader::upload($file, $rootFolder . '/' . $this->upload_folder . DIRECTORY_SEPARATOR . $field);
                    }
                }
            } elseif (Request::hasFile($field)) {
                $file = Request::file($field);

                if ($file instanceof UploadedFile) {
                    $files[] = Uploader::upload($file, $rootFolder . '/' . $this->upload_folder . DIRECTORY_SEPARATOR . $field);
                }
            }
            if (!empty($files)) {
                $this->setFiles($field, $files);
            }
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
    public function getUploadURL($field, $disk = 'local', $file = 'file')
    {
        return guard_url('upload/' . $this->config . '/' . ($this->upload_folder)
            . '/' . $field . '/' . $file . '?disk=' . $disk);
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
        return trans_url('crop/' . $this->config . '/' . ($this->upload_folder) . '/' . $field . '/' . $file);
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
        return trans_url('file/' . $this->config . '/' . ($this->upload_folder) . '/' . $field . '/' . $file);
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
        if (!is_array($current) && !Request::has($field)) {
            return;
        }

        if (Request::has($field)) {
            $current = Request::get($field);
        }

        $prev = $this->getOriginalFile($field);

        if (!is_array($prev)) {
            $prev = [];
        }

        if (!is_array($current)) {
            $current = [];
        }

        $files = array_merge($current, $prev);
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
        return parent::getOriginal($field);
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

        $image = Arr::pull($image, $pos, head($image));

        $disk = $image['disk'];
        return "image/{$disk}/{$size}/" . $image['path'];
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
        $images = $this->$field;

        if (empty($images) || !is_array($images)) {
            return [];
        }

        foreach ($images as $key => $image) {
            $images[$key]['url'] = $this->getPublicUrl($image['disk'], $image['folder'], $image['file'], 'image');
            $images[$key]['caption'] = $image['caption'];
            $images[$key]['disk'] = $image['disk'];
            $images[$key]['folder'] = $image['folder'];
            $images[$key]['file'] = $image['file'];
            $images[$key]['time'] = $image['time'];
            $images[$key]['path'] = $image['path'];
        }

        return $images;
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
            $files[$key]['url'] = $this->getPublicUrl($file['disk'], $file['folder'], $file['file'], $prefix);
            $files[$key]['caption'] = $file['caption'];
            $files[$key]['disk'] = $file['disk'];
            $files[$key]['folder'] = $file['folder'];
            $files[$key]['file'] = $file['file'];
            $files[$key]['time'] = $file['time'];
            $files[$key]['path'] = $file['path'];
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
    public function getPublicUrl($disk, $folder, $file, $prefix = 'filer/download')
    {
        return url("{$prefix}/{$disk}" . '/' . $folder . '/' . $file);
    }
}
