<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\CustomHelper;

class AdminUser extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static $users;
    use Sluggable;
    protected static $project;

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'username'
            ]
        ];
    }


    public static function addUsers($request)
    {
        self::$users = new AdminUser();
        self::$users->user_type_id   = $request->user_type_id;
        self::$users->username       = $request->username;
        self::$users->phone          = $request->phone;
        self::$users->dob            = $request->dob;
        self::$users->age            = $request->age;
        self::$users->email          = $request->email;
        self::$users->join           = $request->join;
        self::$users->address        = $request->address;
        self::$users->description    = $request->description;
        self::$users->image          = CustomHelper::imageUpload($request->file('image'),'back-end/img/users_image/');
        self::$users->facebook       = $request->facebook;
        self::$users->twitter        = $request->twitter;
        self::$users->linkedin       = $request->linkedin;
        self::$users->instagram      = $request->instagram;
        self::$users->status         = $request->status;
        self::$users->save();
    }
    public static function updateUser ($request, $id)
    {
        self::$users = AdminUser::find($id);
        self::$users->user_type_id   = $request->user_type_id;
        self::$users->username       = $request->username;
        self::$users->phone          = $request->phone;
        self::$users->dob            = $request->dob;
        self::$users->age            = $request->age;
        self::$users->email          = $request->email;
        self::$users->join           = $request->join;
        self::$users->address        = $request->address;
        self::$users->description    = $request->description;
        self::$users->image          = CustomHelper::imageUpload($request->file('image'),'back-end/img/users_image/', self::$users->image);
        self::$users->facebook       = $request->facebook;
        self::$users->twitter        = $request->twitter;
        self::$users->linkedin       = $request->linkedin;
        self::$users->instagram      = $request->instagram;
        self::$users->slug           = $request->slug;
        self::$users->status         = $request->status;
        self::$users->save();
    }
    public function userType()
    {
        return $this->belongsTo(UserType::class,'user_type_id');
    }

}
