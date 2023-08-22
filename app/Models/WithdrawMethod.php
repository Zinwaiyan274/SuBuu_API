<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\CustomHelper;

class WithdrawMethod extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static $method;


    public static function addMethod($request)
    {
        self::$method = new WithdrawMethod();
        self::$method->name                = $request->name;
        self::$method->minimum_amount      = $request->minimum_amount;
        self::$method->image               = CustomHelper::imageUpload($request->file('image'),'back-end/img/Withdraw_method_image/');
        self::$method->status              = $request->status;
        self::$method->save();
    }
    public static function updatemethod ($request, $id)
    {
        self::$method = WithdrawMethod::find($id);
        self::$method->name                = $request->name;
        self::$method->minimum_amount      = $request->minimum_amount;
        self::$method->image               = CustomHelper::imageUpload($request->file('image'),'back-end/img/Withdraw_method_image/',self::$method->image);
        self::$method->status              = $request->status;
        self::$method->save();
    }
}
