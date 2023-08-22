<?php

namespace App\Models;

use App\Helper\CustomHelper;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use function Symfony\Component\String\Slugger\slug;

class ProductType extends Model
{
    use HasFactory;
    protected $guarded = [];
    use Sluggable;
    protected static $type;
    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public static function addType($request)

    {
        self::$type = new ProductType();
        self::$type->name       = $request->name;
        self::$type->slug       = Str::slug($request->name);
        self::$type->image       = CustomHelper::imageUpload($request->file('image'),'back-end/img/product_image/');
        self::$type->status     = $request->status;
        self::$type->save();
    }
    public static function updateType ($request, $id)
    {
        self::$type = ProductType::find($id);
        self::$type->name      = $request->name;
        self::$type->slug      = Str::slug($request->name);
        self::$type->image       = CustomHelper::imageUpload($request->file('image'),'back-end/img/product_image/',self::$type->image);
        self::$type->status    = $request->status;
        self::$type->save();
    }
    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }

}
