<?php

use Litepie\Support\Facades\Hashids;

if (! function_exists('hashids_encode')) {
    /**
     * Throw an HttpException with the given data.
     *
     * @param  int     $id
     *
     * @return void
     */
    function hashids_encode($idorarray)
    {
        return Hashids::encode($idorarray);
    }
}

if (! function_exists('hashids_decode')) {
    /**
     * Decode the given value.
     *
     * @param  string  $value
     *
     * @return array or int
     */
    function hashids_decode($value)
    {
        $return =  Hashids::decode($value);

        if (count($return) == 1){
            return $return[0];
        }

        return $return;
    }
}


if (!function_exists('folder_new')) {
    /**
     * Get new upload folder pathes.
     *
     * @param string $prefix
     * @param string $sufix
     *
     * @return array
     */
    function folder_new($prefix = NULL, $sufix = NULL)
    {
        $arr    = [];

        $prefix = empty($prefix) ? NULL : $prefix . '/';
        $sufix  = empty($sufix) ? NULL : '/' . $sufix;
        $folder         = date('Y/m/d/His') . rand(100, 999);
        $arr['folder']  = $prefix . $folder . $sufix;

        $folder         = folder_encode($folder);
        $arr['encrypted'] = $prefix . $folder . $sufix;

        return $arr;
    }
}

if (!function_exists('folder_encode')) {
    /**
     * Encrypt upload folder.
     *
     * @param string $folder
     *
     * @return string
     */
    function folder_encode($folder)
    {
        $arr        = explode('/', $folder);
        return hashids_encode($arr);
    }
}

if (!function_exists('folder_decode')) {
    /**
     * Get upload folder.
     *
     * @param string $folder
     *
     * @return string
     */
    function folder_decode($folder)
    {
        $formatFolder = function($folder){
                    return str_pad($folder[0], 4, '0', STR_PAD_LEFT) . '/'
                    . str_pad($folder[1], 2, '0', STR_PAD_LEFT) . '/'
                    . str_pad($folder[2], 2, '0', STR_PAD_LEFT) . '/'
                    . str_pad($folder[3], 9, '0', STR_PAD_LEFT);
        };

        $arr        = explode('/', $folder);
        if (count($arr) == 1) {
            $folder     = hashids_decode($arr[0]);
            return    $formatFolder($folder);
        }

        if (count($arr) == 2) {
            $folder     = hashids_decode($arr[1]);
            return  $arr[0] . '/' . $formatFolder($folder);
        }

        $folder     = hashids_decode($arr[1]);
        return $arr[0] . '/' . $formatFolder($folder) . '/' . $arr[2];
    }
}