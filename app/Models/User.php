<?php

namespace App\Models;

use App\Helper\CustomHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'email', 'password', 'phone', 'image', 'refer', 'user_type', 'refer_code', 'facebook_token', 'google_token', 'status', 'email_verified_at', 'access_date',
    ];

    protected static $users;


    public static function addUsers($request)
    {
        self::$users = new User();
        self::$users->name             = $request->name;
        self::$users->email            = $request->email;
        self::$users->password         = Hash::make($request->password);
        self::$users->phone            = $request->phone;
        self::$users->image            = CustomHelper::imageUpload($request->file('image'), 'back-end/img/users_image/');
        self::$users->user_type        = $request->user_type;
        self::$users->refer            = $request->refer;
        self::$users->refer_code       = 'RF' . random_int(0000, 9999);
        self::$users->status           = $request->status;
        self::$users->save();
        //balance ...
        if ($request->balance == '') {
            $balance = 0;
        } else {
            $balance = $request->balance;
        }
        self::balanceAdd(self::$users->id, $balance);
        if ($request->refer != '') {
            self::referBalanceAdd(self::$users->id, $request->refer);
        }
    }

    public static function balanceAdd($user_id, $balance = 0)
    {
        if (Wallet::where('user_id', $user_id)->exists()) {
            $wallet = Wallet::where('user_id', $user_id)->first();
        } else {
            $wallet = new Wallet();
        }

        $wallet->user_id = $user_id;
        $wallet->balance = $balance;
        $wallet->save();
    }

    public static function referBalanceAdd($user_id, $refer_code)
    {
        $referReward = Reward::where('name', 'Refer')->where('status', 1)->value('reward_point');
        $data = [
            ['user_id' => $user_id],
            ['user_id' => User::where('refer_code', $refer_code)->value('id')]
        ];
        $wallets = Wallet::whereIn('user_id', $data)->get();

        foreach ($wallets as $wallet) {
            $dataUp['balance'] = $wallet->balance + $referReward;
            $wallet->update($dataUp);
            $passdata = ['user_id' => $wallet->user_id, 'amount' => $referReward ?? 0, 'description' => 'Gain by using refer code', 'gain_status' => 'Gain'];
            UserGain::addGainLoss($passdata);
        }
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
}
