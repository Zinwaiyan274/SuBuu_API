<?php

namespace App\Models;

use App\Helper\CustomHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static $quiz;


    public static function addQuiz($request)
    {
        self::$quiz = new Quiz();
        self::$quiz->category_id      = $request->category_id;
        self::$quiz->name             = $request->name;
        self::$quiz->image            = CustomHelper::imageUpload($request->file('image'),'back-end/img/Quiz_image/');
        self::$quiz->paid_status      = $request->paid_status;
        self::$quiz->free_or_paid     = $request->free_or_paid;
        self::$quiz->reward_point     = $request->reward_point;
        self::$quiz->retake_point     = $request->retake_point;
        self::$quiz->status           = $request->status;
        self::$quiz->save();
    }
    public static function updateQuiz ($request, $id)
    {
        self::$quiz = Quiz::find($id);
        self::$quiz->category_id      = $request->category_id;
        self::$quiz->name             = $request->name;
        self::$quiz->image            = CustomHelper::imageUpload($request->file('image'),'back-end/img/Quiz_image/',self::$quiz->image);
        self::$quiz->paid_status      = $request->paid_status;
        self::$quiz->free_or_paid     = $request->paid_status== 0 ? null :$request->free_or_paid;
        self::$quiz->reward_point     = $request->reward_point;
        self::$quiz->retake_point     = $request->retake_point;
        self::$quiz->status           = $request->status;
        self::$quiz->save();
    }
    public function quizCategory()
    {
        return $this->belongsTo(QuizCategory::class,'category_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class,'quiz_id');
    }
}
