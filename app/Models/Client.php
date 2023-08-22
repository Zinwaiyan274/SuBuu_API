<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helper\CustomHelper;

class Client extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static $client;

    public static function addClient($request)

    {
        self::$client = new Client();
        self::$client->name          = $request->name;
        self::$client->company       = $request->company;
        self::$client->title         = $request->title;
        self::$client->description   = $request->description;
        self::$client->image         = CustomHelper::imageUpload($request->file('image'),'back-end/img/client_image/');;
        self::$client->rating        = $request->rating;
        self::$client->status        = $request->status;
        self::$client->save();
    }
    public static function updateClient ($request, $id)
    {
        self::$client = Client::find($id);
        self::$client->name          = $request->name;
        self::$client->company       = $request->company;
        self::$client->title         = $request->title;
        self::$client->description   = $request->description;
        self::$client->image         = CustomHelper::imageUpload($request->file('image'),'back-end/img/client_image/', self::$client->image);
        self::$client->rating        = $request->rating;
        self::$client->status        = $request->status;
        self::$client->save();
    }
}
