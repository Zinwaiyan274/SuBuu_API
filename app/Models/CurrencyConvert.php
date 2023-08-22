<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyConvert extends Model
{
    use HasFactory;
    protected $fillable = ['currency_id','par_currency','coin','status'] ;

    function currency(){
        return $this->belongsTo(Currency::class);
    }
}
