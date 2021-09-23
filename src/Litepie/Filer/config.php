<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Upload Folder
    |--------------------------------------------------------------------------
    |
    | Folder the Uploader will use.
    | This will need to writable by the web server.
    | Recommendation: storage/uploads/
    |
     */
    'folder'            => env('UPLOAD_FOLDER', 'storage/uploads'),
    'storage'           => env('UPLOAD_TARGET', 'local'),
    'folder_permission' => 0777, // Default 0777 - Other likely values 0775, 0755

    /*
    |--------------------------------------------------------------------------
    | Upload Filer Configurations
    |--------------------------------------------------------------------------
    |
    | Configuration items for uploaded files.
    |
     */

    'allowed_types_check' => false,
    'allowed_types'       => [
        'application/msword',
        'application/pdf',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/x-compressed-zip',
        'application/zip',
        'image/gif',
        'image/jpeg',
        'image/jpg',
        'image/png',
        'text/plain',
    ],

    'allowed_extensions_check' => true,
    // Case insensitive
    'allowed_extensions' => [
        'bmp',
        'doc',
        'docx',
        'gif',
        'jpeg',
        'jpeg',
        'jpg',
        'mp3',
        'pdf',
        'png',
        'txt',
        'xls',
        'xlsx',
        'zip',
    ],

    // Max upload size - In BYTES. 1GB = 1073741824 bytes, 10 MB = 10485760, 1 MB = 1048576
    'max_upload_size' => 10485760,

    // [True] will change all uploaded file names to an obfuscated name. (Example_Image.jpg becomes Example_Image_p4n8wfnt8nwh5gc7ynwn8gtu4se8u.jpg)
    // [False] attempts to leaves the filename as is.
    'obfuscate_filenames' => true, // True/False

    /*
    |--------------------------------------------------------------------------
    | Image
    |--------------------------------------------------------------------------
    |
    | Configuration items for image filer.
    |
     */

    // Enabled image manipulation for uploaded images.
    'image_manipulation' => true,

    // Must be in the upload list as well.
    // Must also be supported by invention. http://intervention.olivervogel.net/image/formats/image
    'image_types' => [
        'image/png',
        'image/gif',
        'image/jpg',
        'image/jpeg',
    ],

    'image_extensions' => [
        'png',
        'gif',
        'jpg',
        'jpeg',
    ], // Case insensitive

    'image_resize_on_upload' => false,

    'image_max_size' => [
        'w' => 2000,
        'h' => 2000,
    ],

];
