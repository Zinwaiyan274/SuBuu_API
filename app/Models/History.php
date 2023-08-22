<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static $contact;

    public static function addHistory($request)
    {
        self::$contact = new History();
        self::$contact->message    = $request->message;
        self::$contact->name       = $request->name;
        self::$contact->email      = $request->email;
        self::$contact->phone      = $request->phone;
        self::$contact->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
