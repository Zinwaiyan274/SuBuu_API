<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\CustomHelper;

class Question extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static $question;


    public static function addQuestion($request)
    {
        self::$question = new Question();
        self::$question->quiz_id      = $request->quiz_id;
        self::$question->question             = $request->question;
        self::$question->option_a             = $request->option_a;
        self::$question->option_b             = $request->option_b;
        self::$question->option_c             = $request->option_c;
        self::$question->option_d             = $request->option_d;
        self::$question->answer               = $request->answer;
        self::$question->image                = CustomHelper::imageUpload($request->file('image'),'back-end/img/Question_image/');
        self::$question->status               = $request->status;
        self::$question->save();
    }
    public static function updateQuestion ($request, $id)
    {
        self::$question = Question::find($id);
        self::$question->quiz_id      = $request->quiz_id;
        self::$question->question             = $request->question;
        self::$question->option_a             = $request->option_a;
        self::$question->option_b             = $request->option_b;
        self::$question->option_c             = $request->option_c;
        self::$question->option_d             = $request->option_d;
        self::$question->answer               = $request->answer;
        self::$question->image                = CustomHelper::imageUpload($request->file('image'),'back-end/img/Question_image/',self::$question->image);
        self::$question->status               = $request->status;
        self::$question->save();
    }
    public function questionCategory()
    {
        return $this->belongsTo(Quiz::class,'quiz_id');
    }
}
