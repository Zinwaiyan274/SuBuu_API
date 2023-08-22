<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static $faq;

    public static function addFAQ($request)
    {
        self::$faq = new FAQ();
        self::$faq->question       = $request->question;
        self::$faq->answer         = $request->answer;
        self::$faq->status       = $request->status;
        self::$faq->save();
    }
    public static function updateFAQ ($request, $id)
    {
        self::$faq = FAQ::find($id);
        self::$faq->question       = $request->question;
        self::$faq->answer         = $request->answer;
        self::$faq->status       = $request->status;
        self::$faq->save();
    }
}
