<?php

namespace Litepie\Filer\Traits;

use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as Intervention;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait Uploader
{
    /**
     * Name of file to be uploaded.
     *
     * @var bool
     */
    protected $fileSystemName;

    /**
     * Upload file to the folder.
     *
     * @param UploadedFile $file
     * @param string       $path
     *
     * @return array
     */
    public function upload(UploadedFile $file, $path)
    {
        if ($file->getSize() > config('filer.max_upload_size', 2048)) {
            // Check file size
            throw new FileException('File is too big.');
        }

        // Check the upload type is valid by extension and mimetype
        $this->verifyUploadType($file);

        // Get the folder for uploads
        $folder = $this->checkUploadFolder($path);

        // Check to see if file exists already. If so append a random string.
        $file = $this->resolveFileName($folder, $file);

        // Upload the file to the folder. Exception thrown from move.
        $file->move($folder, $file->fileSystemName);

        $this->resizeImage($folder, $file->fileSystemName);

        // If it returns an array it's a successful upload. Otherwise an exception will be thrown.
        $array = [
            'folder'  => $this->relativePath($folder),
            'file'    => $file->fileSystemName,
            'caption' => $this->getName($file),
            'time'    => date('Y-m-d H:i:s'),
        ];

        return $array;
    }

    public function s3Upload($uploadFolder, $file)
    {
        $imageUrl = Storage::disk('s3')->put($uploadFolder, $file);
        $imageData = pathinfo($imageUrl);
        if (isset($imageData['basename'])) {
            $fileName = $imageData['basename'];
        } else {
            $fileName = '';
        }
    }

    public function localUpload($uploadFolder, $file)
    {
        $imageUrl = Storage::disk('s3')->put($uploadFolder, $file);
        $imageData = pathinfo($imageUrl);
        if (isset($imageData['basename'])) {
            $fileName = $imageData['basename'];
        } else {
            $fileName = '';
        }
    }

    /**
     * Resolve whether the file exists and if it already does, change the file name.
     *
     * @param string $folder
     * @param $file
     * @param bool $enableObfuscation
     *
     * @return array
     */
    public function resolveFileName($folder, UploadedFile $file, $enableObfuscation = true)
    {
        if (!isset($file->fileSystemName)) {
            $file->fileSystemName = Str::slug(basename($file->getClientOriginalName(), $file->getClientOriginalExtension())).'.'.strtolower($file->getClientOriginalExtension());
        }

        if (config('filer.obfuscate_filenames') && $enableObfuscation) {
            $fileName = basename($file->fileSystemName, $file->getClientOriginalExtension()).'_'.md5(uniqid(mt_rand(), true)).'.'.$file->getClientOriginalExtension();
        } else {
            $fileName = $file->fileSystemName;
        }

        if (File::isFile($folder.$fileName)) {
            $basename = $this->getBasename($file);
            $pose = strrpos($basename, '_');

            if ($pose) {
                $f = substr($basename, 0, $pose);
                $s = substr($basename, $pose + 1);

                if (is_numeric($s)) {
                    $s++;
                    $basename = $f;
                } else {
                    $s = 1;
                }
            } else {
                $s = 1;
            }

            $file->fileSystemName = $basename.'_'.$s.'.'.$file->getClientOriginalExtension();

            return $this->resolveFileName($folder, $file, false);
        }

        return $file;
    }

    /**
     * Get upload path with date folders.
     *
     * @param $date
     *
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     *
     * @return string
     */
    public function checkUploadFolder($folder, $isLocal = true)
    {
        $folder = base_path(config('filer.folder', 'storage/uploads').DIRECTORY_SEPARATOR.$folder);
        $folder = Str::finish($folder, DIRECTORY_SEPARATOR);

        if (!$isLocal) {
            return $folder;
        }

        // Check to see if the upload folder exists
        if (!File::exists($folder)) {

            // Try and create it
            if (!File::makeDirectory($folder, config('filer.folder_permission'), true)) {
                throw new FileException('Directory is not writable. Please make upload folder writable.');
            }
        }

        return $folder;
    }

    /**
     * Checks the upload vs the upload types in the config.
     *
     * @param $file
     *
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     */
    public function verifyUploadType(UploadedFile $file)
    {
        if (!in_array($file->getMimeType(), config('filer.allowed_types')) && config('filer.allowed_types_check')) {
            throw new FileException('Invalid file type.');
        } elseif (!in_array(strtolower($file->getClientOriginalExtension()), config('filer.allowed_extensions')) && config('filer.allowed_extensions_check')) {
            throw new FileException('Invalid file extension.');
        }
    }

    /**
     * Checks the upload vs the upload types in the config.
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return bool
     */
    public function verifyImageType($file)
    {
        if (in_array($file->getMimeType(), config('filer.image_types')) ||
            in_array(strtolower($file->getClientOriginalExtension()), config('filer.image_extensions'))
        ) {
            return true;
        } else {
            return false;
        }
    }

    public function getBasename($file)
    {
        // Get the file bits
        $basename = basename((isset($file->fileSystemName) ? $file->fileSystemName : $file->getClientOriginalName()), $file->getClientOriginalExtension());
        // Remove trailing period
        return substr($basename, -1) == '.' ? substr($basename, 0, strlen($basename) - 1) : $basename;
    }

    public function getName($file)
    {
        // Get the file bits
        $basename = basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
        // Remove trailing period
        $name = ucfirst(strtolower(preg_replace('/[^A-Za-z0-9]/', ' ', $basename)));

        return $name;
    }

    public function resizeImage($folder, $file)
    {
        if (!config('filer.image_resize_on_upload')) {
            return;
        }

        if (is_string($file)) {
            $uFile = new UploadedFile($folder.$file, $file);
        }

        /*
         * Check the image type is valid by extension and mimetype
         */
        if ($this->verifyImageType($uFile)) {
            $image = $this->image->make($folder.$file);

            if ($image->width() > config('filer.image_max_size.w') || $image->height() > config('filer.image_max_size.h')) {
                $image->resize(config('filer.image_max_size.w'), config('filer.image_max_size.h'), function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image->save($folder.$file);
            }
        }
    }

    public function relativePath($path)
    {
        $path = str_replace(base_path(config('filer.folder')), '', $path);

        // Check to see if it begins in a slash
        if (substr($path, 0, 1) != DIRECTORY_SEPARATOR) {
            $path = DIRECTORY_SEPARATOR.$path;
        }

        // Check to see if it ends in a slash
        if (substr($path, -1) != DIRECTORY_SEPARATOR) {
            $path .= DIRECTORY_SEPARATOR;
        }

        $path = str_replace('//', DIRECTORY_SEPARATOR, $path);

        return $path;
    }

    /**
     * Allowed extensions.
     *
     * @param $folder
     * @param $file
     * @param $size
     *
     * @return Intervention
     */
    public function allowedExtensions($type = 'image')
    {
        if ($type == 'image') {
            return '.'.implode(',.', config('filer.image_extensions'));
        }

        return '.'.implode(',.', config('filer.allowed_extensions'));
    }
}
