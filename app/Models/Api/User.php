<?php

namespace App\Models\Api;
use App\Models\Wallet;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory,Notifiable,HasApiTokens;

    protected $fillable = ['name','email','password','phone','image','user_type','refer','refer_code','facebook_token','google_token','status','email_verified_at','remember_token','access_date'];

    public function getImageAttribute(): string
    {

        return URL::to('/'). '/' . $this->attributes['image'];
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class,'user_id');
    }

    public static function userCountByRefer($refer_code)
    {
        if ($refer_code!='') {
            return User::where('refer',$refer_code)->count();
        }else {
            return 0 ;
        }
    }

    public static function updateAccessDate($user_id)
    {
        return User::where('id' , $user_id)->update(['access_date'=>now()->format('Y-m-d H:i:s')]);
    }
}
