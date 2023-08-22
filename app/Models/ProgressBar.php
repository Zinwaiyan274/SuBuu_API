<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressBar extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static $progress;

    public static function addProgress($request)
    {
        self::$progress = new ProgressBar();
        self::$progress->name             = $request->name;
        self::$progress->color            = $request->color;
        self::$progress->percent          = $request->percent;
        self::$progress->status           = $request->status;
        self::$progress->save();
    }
    public static function updateProgress ($request, $id)
    {
        self::$progress = ProgressBar::find($id);
        self::$progress->name              = $request->name;
        self::$progress->color             = $request->color;
        self::$progress->percent           = $request->percent;
        self::$progress->status            = $request->status;
        self::$progress->save();
    }
}
