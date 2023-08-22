<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static $contact;

    public static function addContact($request)


    {
        self::$contact = new Contact();
        self::$contact->message    = strip_tags($request->message);
        self::$contact->name       = $request->name;
        self::$contact->email      = $request->email;
        self::$contact->phone      = $request->phone;
        self::$contact->save();
    }
}
