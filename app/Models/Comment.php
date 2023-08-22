<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static $comment;

    public static function addComment($request)
    {
        self::$comment = new Comment();
        self::$comment->news_id    = $request->news_id;
        self::$comment->message    = strip_tags($request->message);
        self::$comment->name       = $request->name;
        self::$comment->email      = $request->email;
        self::$comment->save();
    }
}
