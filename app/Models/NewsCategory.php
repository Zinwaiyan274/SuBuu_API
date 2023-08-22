<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsCategory extends Model
{
    use Sluggable;
    use HasFactory;
    protected $guarded = [];
    protected static $category;
    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public static function addCategory($request)

    {
        self::$category = new NewsCategory();
        self::$category->name       = $request->name;
        self::$category->slug       = Str::slug($request->name);
        self::$category->status     = $request->status;
        self::$category->save();
    }
    public static function updateCategory ($request, $id)
    {
        self::$category = NewsCategory::find($id);
        self::$category->name      = $request->name;
        self::$category->slug       = Str::slug($request->name);
        self::$category->status    = $request->status;
        self::$category->save();
    }
    public function categoryCount()
    {
        return $this->hasMany(News::class,'category_id');
    }
    public function blogCategory()
    {
        return $this->hasMany(News::class,'category_id');
    }
}
