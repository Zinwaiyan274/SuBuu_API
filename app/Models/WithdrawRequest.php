<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'coins',
        'notes',
        'status',
        'amount',
        'user_id',
        'real_name',
        'township',
        'division',
        'profession',
        'approve_status',
        'currency_convert_id',
        'invoice_number',
        'qr_image',
        'phone',
    ];

    protected static $requests;

    public static function addRequest($request)
    {
        self::$requests = new WithdrawRequest();
        self::$requests->method_id         = $request->method_id;
        self::$requests->name              = $request->name;
        self::$requests->points            = $request->points;
        self::$requests->account           = $request->account;
        self::$requests->amount            = $request->amount;
        self::$requests->status            = $request->status;
        self::$requests->save();
    }
    public static function updateRequest ($request, $id)
    {
        self::$requests = WithdrawRequest::find($id);
        self::$requests->method_id         = $request->method_id;
        self::$requests->name              = $request->name;
        self::$requests->points            = $request->points;
        self::$requests->account           = $request->account;
        self::$requests->amount            = $request->amount;
        self::$requests->status            = $request->status;
        self::$requests->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function convert()
    {
        return $this->belongsTo(CurrencyConvert::class, 'currency_convert_id');
    }
}
