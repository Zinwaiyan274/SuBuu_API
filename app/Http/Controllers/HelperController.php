<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperController extends Controller
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
}
