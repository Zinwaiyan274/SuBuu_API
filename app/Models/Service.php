<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\CustomHelper;

class Service extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static $service;
    use Sluggable;
    protected static $project;

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function addServices($request)
    {
        self::$service = new Service();
        self::$service->service_category_id    = $request->service_category_id;
        self::$service->title                  = $request->title;
        self::$service->description            = $request->description;
        self::$service->image                  = CustomHelper::imageUpload($request->file('image'),'back-end/img/service_image/');
        self::$service->status                 = $request->status;
        self::$service->save();
    }
    public static function updateServices ($request, $id)
    {
        self::$service = Service::find($id);
        self::$service->service_category_id    = $request->service_category_id;
        self::$service->title                  = $request->title;
        self::$service->description            = $request->description;
        self::$service->image                  = CustomHelper::imageUpload($request->file('image'),'back-end/img/service_image/', self::$service->image);
        self::$service->slug                   = $request->slug;
        self::$service->status                 = $request->status;
        self::$service->save();
    }

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class,'service_category_id');
    }

}
