<?php

namespace App\Models;

use App\Helper\CustomHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static $company;

    public static function addCompany($request)

    {
        self::$company = new Company();
        self::$company->name       = $request->name;
        self::$company->address    = $request->address;
        self::$company->phone      = $request->phone;
        self::$company->email      = $request->email;
        self::$company->location   = $request->location;
        self::$company->open       = $request->open;
        self::$company->close      = $request->close;
        self::$company->facebook   = $request->facebook;
        self::$company->twitter    = $request->twitter;
        self::$company->linkedin   = $request->linkedin;
        self::$company->instagram  = $request->instagram;
        self::$company->image      = CustomHelper::imageUpload($request->file('image'),'back-end/img/brochure/');;
        self::$company->status     = $request->status;
        self::$company->save();
    }

    public static function updateCompany ($request, $id)
    {
        self::$company = Company::find($id);
        self::$company->name       = $request->name;
        self::$company->address    = $request->address;
        self::$company->phone      = $request->phone;
        self::$company->email      = $request->email;
        self::$company->location   = $request->location;
        self::$company->open       = $request->open;
        self::$company->close      = $request->close;
        self::$company->facebook   = $request->facebook;
        self::$company->twitter    = $request->twitter;
        self::$company->linkedin   = $request->linkedin;
        self::$company->instagram  = $request->instagram;
        self::$company->image      = CustomHelper::imageUpload($request->file('image'),'back-end/img/brochure/', self::$company->image);
        self::$company->status     = $request->status;
        self::$company->save();
    }
}
