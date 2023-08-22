<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\CustomHelper;

class QuizCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static $category;


    public static function addCategory($request)
    {
        self::$category = new QuizCategory();
        self::$category->name             = $request->name;
        self::$category->description      = $request->description;
        self::$category->image            = CustomHelper::imageUpload($request->file('image'),'back-end/img/users_image/');
        self::$category->status           = $request->status;
        self::$category->save();
    }
    public static function updateCategory ($request, $id)
    {
        self::$category = QuizCategory::find($id);
        self::$category->name             = $request->name;
        self::$category->description      = $request->description;
        self::$category->image            = CustomHelper::imageUpload($request->file('image'),'back-end/img/users_image/',self::$category->image);
        self::$category->status           = $request->status;
        self::$category->save();
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class,'category_id');
    }
}
