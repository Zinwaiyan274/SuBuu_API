<?php

namespace App\Models;

use App\Helper\CustomHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = ['title','name','favicon','header_logo','footer_logo','content','status'];
    protected static $settings;

    public static function updateSettings ($request, $id)
    {
        self::$settings = Settings::find($id);
        self::$settings->title        = $request->title;
        self::$settings->name         = $request->name;
        self::$settings->favicon      = CustomHelper::imageUpload($request->file('favicon'),'back-end/img/settings_image/', self::$settings->favicon);
        self::$settings->header_logo  = CustomHelper::imageUpload($request->file('header_logo'),'back-end/img/settings_image/', self::$settings->header_logo);
        self::$settings->footer_logo  = CustomHelper::imageUpload($request->file('footer_logo'),'back-end/img/settings_image/', self::$settings->footer_logo);
        self::$settings->content      = $request->content;
        self::$settings->status       = 1;
        self::$settings->save();
    }
}
