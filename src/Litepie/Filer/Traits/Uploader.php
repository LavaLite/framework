<?php

namespace Litepie\Filer\Traits;

use File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Litepie\Filer\Exceptions\InvalidFileSizeException;
use Litepie\Filer\Exceptions\InvalidFileTypeException;

trait Uploader
{
    /**
     * Upload file to the folder.
     *
     * @param UploadedFile $file
     * @param string       $path
     *
     * @return array
     */
    public function upload(UploadedFile $file, $disk, $path)
    {

        // Check the upload type is valid by extension and mimetype
        $this->verifyFile($file);

        $original = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();

        $name = $this->getName($file);

        $hashed = $file->hashName();

        $file = $file->storeAs(
            $path,
            $hashed,
            $disk
        );

        // If it returns an array it's a successful upload. Otherwise an exception will be thrown.
        $array = [
            'folder' => $path,
            'file' => $hashed,
            'path' => $path . '/' . $hashed,
            'disk' => $disk,
            'original' => $original,
            'title' => $name,
            'caption' => $name,
            'time' => date('Y-m-d H:i:s'),
        ];

        return $array;
    }

    /**
     * Checks the upload vs the upload types in the config.
     *
     * @param $file
     *
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     */
    public function verifyFile(UploadedFile $file)
    {
        if ($file->getSize() > config('filer.max_upload_size', 2048)) {
            // Check file size
            throw new InvalidFileSizeException();
        }

        if (!in_array($file->getMimeType(), config('filer.allowed_types'))
            && config('filer.allowed_types_check')) {
            throw new InvalidFileTypeException();
        }

        if (!in_array(strtolower($file->getClientOriginalExtension()), config('filer.allowed_extensions'))
            && config('filer.allowed_extensions_check')) {
            throw new InvalidFileTypeException();
        }
    }

    public function getName($file)
    {
        // Get the file bits
        $basename = basename($file->getClientOriginalName(), '.' . $file->getClientOriginalExtension());
        // Remove trailing period
        $name = ucfirst(strtolower(preg_replace('/[^A-Za-z0-9]/', ' ', $basename)));

        return $name;
    }

}
