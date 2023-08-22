<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static $userType;

    public static function addUserType($request)

    {
        self::$userType = new UserType();
        self::$userType->name       = $request->name;
        self::$userType->status     = $request->status;
        self::$userType->save();
    }
    public static function updateUserType ($request, $id)
    {
        self::$userType = UserType::find($id);
        self::$userType->name       = $request->name;
        self::$userType->status     = $request->status;
        self::$userType->save();
    }
}
