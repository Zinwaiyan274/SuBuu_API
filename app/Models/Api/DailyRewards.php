<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyRewards extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','description','amount','gain_status','status'];
}
