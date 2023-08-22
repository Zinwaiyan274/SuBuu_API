<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\CustomHelper;

class Skill extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static $skill;

    public static function addSkill($request)

    {
        self::$skill                  = new Skill();
        self::$skill->title           = $request->title;
        self::$skill->description     = $request->description;
        self::$skill->bigimage        = CustomHelper::imageUpload($request->file('bigimage'),'back-end/img/skill_image/');
        self::$skill->smallimage      = CustomHelper::imageUpload($request->file('smallimage'),'back-end/img/skill_image/');
        self::$skill->status          = $request->status;
        self::$skill->save();
    }
    public static function updateSkill ($request, $id)
    {
        self::$skill = Skill::find($id);
        self::$skill->title           = $request->title;
        self::$skill->description     = $request->description;
        self::$skill->bigimage        = CustomHelper::imageUpload($request->file('bigimage'),'back-end/img/skill_image/', self::$skill->bigimage);
        self::$skill->smallimage      = CustomHelper::imageUpload($request->file('smallimage'),'back-end/img/skill_image/', self::$skill->smallimage);
        self::$skill->status          = $request->status;
        self::$skill->save();

    }
}
