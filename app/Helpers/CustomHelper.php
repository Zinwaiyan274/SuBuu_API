<?php


namespace App\Helper;

class CustomHelper
{
    protected static $fileName;
    protected static $fileUrl;

    public static function imageUpload ($image, $imageDirectory, $existFileUrl=null)
    {
        if ($image)
        {
            if (file_exists($existFileUrl))
            {
                unlink($existFileUrl);
            }
            self::$fileName = time().rand(10,10000).'.'.$image->getClientOriginalExtension();
            $image->move($imageDirectory, self::$fileName);
            self::$fileUrl = $imageDirectory.self::$fileName;
        } else {
            if (isset($existFileUrl))
            {
                self::$fileUrl = $existFileUrl;
            } else {
                self::$fileUrl = '';
            }
        }
        return self::$fileUrl;
    }
    public static function imageUploadApi ($image, $imageDirectory, $existFileUrl=null)
    {
        if ($image)
        {
            if (file_exists($existFileUrl))
            {
                unlink($existFileUrl);
            }
            self::$fileName = time().rand(10,10000).'.'.$image->getClientOriginalExtension();
            $image->move($imageDirectory, self::$fileName);
            self::$fileUrl = $imageDirectory.self::$fileName;
        } else {
            if (isset($existFileUrl))
            {
                $existUrl = parse_url($existFileUrl);
                self::$fileUrl = ltrim($existUrl['path'], "/");  //remove base url & slash..

            } else {
                self::$fileUrl = '';
            }
        }
        return self::$fileUrl;
    }
}

