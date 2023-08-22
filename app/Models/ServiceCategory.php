<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ServiceCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static $category;

    public static function addCategory($request)

    {
        self::$category = new ServiceCategory();
        self::$category->name       = $request->name;
        self::$category->name       = Str::slug($request->name);
        self::$category->status     = $request->status;
        self::$category->save();
    }
    public static function updateCategory ($request, $id)
    {
        self::$category = ServiceCategory::find($id);
        self::$category->name       = $request->name;
        self::$category->slug       = Str::slug($request->name);
        self::$category->status     = $request->status;
        self::$category->save();
    }
    public function ServiceCategory ()
    {
        return $this->belongsTo(Service::class,'service_category_id');
    }
}
