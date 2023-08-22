<?php

namespace App\Models;

use App\Helper\CustomHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static $gallery;

    public static function addGallery($request)
    {

        self::$gallery = new Gallery();
        self::$gallery->image          = CustomHelper::imageUpload($request->file('image'),'back-end/img/gallery_image/');
        self::$gallery->status         = $request->status;
        self::$gallery->save();

    }
    public static function updateGallery($request, $id)
    {
        self::$gallery = Gallery::find($id);
        self::$gallery->image          = CustomHelper::imageUpload($request->file('image'),'back-end/img/gallery_image/', self::$gallery->image);
        self::$gallery->status         = $request->status;
        self::$gallery->save();
    }
}
