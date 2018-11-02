<?php
/**
 * Created by PhpStorm.
 * User: Jonathan
 * Date: 02/11/2018
 * Time: 05:08
 */

namespace App\Utils;


class ImageContent
{
    public static function saveImageFromBase64($path, $data, $filename = '')
    {
        list($type, $imageData) = explode(';', $data);
        list(,$extension) = explode('/',$type);
        list(,$imageData)      = explode(',', $imageData);
        $fileN = ($filename != '' ? $filename : uniqid()) .'.'. $extension;

        $fileOrigName = $path . $fileN;

        $imageData = base64_decode($imageData);
        file_put_contents($fileOrigName, $imageData);
        return $fileOrigName;
    }

    public static function imageToBase64($data, $mine)
    {
        if ($data != '')
            return 'data:'.$mine.';base64, ' .  base64_encode(file_get_contents($data));

        return '';
    }
}
