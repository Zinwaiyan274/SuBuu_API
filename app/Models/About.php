<?php

namespace App\Models;

use App\Helper\CustomHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static $about;

    public static function addAbout($request)

    {
        self::$about = new About();
        self::$about->title         = $request->title;
        self::$about->description   = $request->description;
        self::$about->years         = $request->years;
        self::$about->experience    = strip_tags($request->experience);
        self::$about->image         = CustomHelper::imageUpload($request->file('image'),'back-end/img/about_image/');;
        self::$about->video         = $request->video;
        self::$about->status        = $request->status;
        self::$about->save();
    }
    public static function updateAbout ($request, $id)
    {
        self::$about = About::find($id);
        self::$about->title         = $request->title;
        self::$about->description   = $request->description;
        self::$about->years         = $request->years;
        self::$about->experience    = strip_tags($request->experience);
        self::$about->image         = CustomHelper::imageUpload($request->file('image'),'back-end/img/about_image/', self::$about->image);
        self::$about->video         = $request->video;
        self::$about->status        = $request->status;
        self::$about->save();
    }
}
