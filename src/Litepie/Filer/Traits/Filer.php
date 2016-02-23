<?php

namespace Litepie\Filer\Traits;

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

    public function uploadSingle()
    {
        foreach ($this->uploads['single'] as $field) {
            $file = [];
            if (Request::hasFile($field)) {
                $upfile = Request::file($field);
                if ($upfile instanceof  UploadedFile) {
                    $file = self::upload($upfile, $this->upload_folder.'/'.$field);
                }
            }
            $this->setFileSingle($field, $file);
        }
    }

    public function uploadMultiple()
    {
        foreach ($this->uploads['multiple'] as $field) {
            $files = [];
            if (is_array(Request::file($field))) {
                foreach (Request::file($field) as $file) {
                    if ($file instanceof  UploadedFile) {
                        $files[] = self::upload($file, $this->upload_folder.'/'.$field);
                    }
                }
            }
            $this->setFileMultiple($field, $files);
        }
    }

    /**
     * @param $value
     *
     * @return string - path to the upload folder
     */
    public function getUploadFolderAttribute($value)
    {
        if (!empty($value)) {
            $folder = json_decode($value, true);

            return $folder['encrypted'];
        } else {
            $folder = folder_new($this->table, null);
            $this->attributes['upload_folder'] = json_encode($folder);

            return $folder['encrypted'];
        }
    }

    /**
     * @param $value
     *
     * @return string - path to the upload folder
     */
    public function setUploadFolderAttribute($value)
    {
        $folder['folder'] = folder_decode($value);
        $folder['encrypted'] = $value;
        $this->attributes['upload_folder'] = json_encode($folder);
    }

    /**
     * @param $value
     *
     * @return string - path to the upload folder
     */
    public function getUploadURL($field, $file = 'file')
    {
        return URL::to('upload/'.$this->upload_folder.'/'.$field.'/'.$file);
    }

    public function setFileSingle($field, $value)
    {
        if (Session::has('upload.'.$this->table.'.'.$field)) {
            $value = Session::pull('upload.'.$this->table.'.'.$field);
            $value = end($value);
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

    public function setFileMultiple($field, $current)
    {
        if (empty($current)) {
            $current = [];
        }

        $session = [];
        if (Session::has('upload.'.$this->table.'.'.$field)) {
            $session = Session::pull('upload.'.$this->table.'.'.$field);
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

    public function getOriginalFile($field)
    {
        $original = parent::getOriginal($field);

        return json_decode($original);
    }
}
