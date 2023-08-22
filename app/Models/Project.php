<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\CustomHelper;
use Cviebrock\EloquentSluggable\Sluggable;

class Project extends Model
{
    use HasFactory;
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

    public static function addProject($request)
    {

        self::$project = new Project();
        self::$project->project_type_id    = $request->project_type_id;
        self::$project->service_type_id    = $request->service_type_id;
        self::$project->clients_name       = $request->clients_name;
        self::$project->title              = $request->title;
        self::$project->description        = $request->description;
        self::$project->image              = CustomHelper::imageUpload($request->file('image'),'back-end/img/project_image/');
        self::$project->date               = $request->date;
        self::$project->location           = $request->location;
        self::$project->status             = $request->status;
        self::$project->save();

    }
    public static function updateProject($request, $id)
    {
        self::$project = Project::find($id);
        self::$project->project_type_id    = $request->project_type_id;
        self::$project->service_type_id    = $request->service_type_id;
        self::$project->clients_name       = $request->clients_name;
        self::$project->title              = $request->title;
        self::$project->description        = $request->description;
        self::$project->image              = CustomHelper::imageUpload($request->file('image'),'back-end/img/project_image/', self::$project->image);
        self::$project->date               = $request->date;
        self::$project->location           = $request->location;
        self::$project->slug               = $request->slug;
        self::$project->status             = $request->status;
        self::$project->save();
    }
    public function projectType()
    {
        return $this->belongsTo(ProductType::class,'project_type_id');
    }
    public function serviceType()
    {
        return $this->belongsTo(ServiceCategory::class,'service_type_id');
    }
}
