<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\CustomHelper;

class Banner extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static $banner;

    public static function addBanner($request)

    {
        self::$banner = new Banner();
        self::$banner->sub_title     = $request->sub_title;
        self::$banner->title         = $request->title;
        self::$banner->description   = $request->description;
        self::$banner->image         = CustomHelper::imageUpload($request->file('image'),'back-end/img/banner_image/');;
        self::$banner->video         = $request->video;
        self::$banner->status        = $request->status;
        self::$banner->save();
    }
    public static function updateBanner ($request, $id)
    {
        self::$banner = Banner::find($id);
        self::$banner->sub_title     = $request->sub_title;
        self::$banner->title         = $request->title;
        self::$banner->description   = $request->description;
        self::$banner->image         = CustomHelper::imageUpload($request->file('image'),'back-end/img/banner_image/', self::$banner->image);
        self::$banner->video         = $request->video;
        self::$banner->status        = $request->status;
        self::$banner->save();
    }
}
