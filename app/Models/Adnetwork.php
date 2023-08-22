<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adnetwork extends Model
{
    use HasFactory;

    protected $fillable = ['admob_interstitial_android','admob_interstitial_ios','admob_rewarded_android','admob_rewarded_ad_ios','applovin_rewarded_ad_android','applovin_rewarded_ad_ios','audience_network_rewarded_ad_android','audience_network_ad_ios','audience_network_interstitial_android','audience_network_interstitial_ios','offertoro_publisher_id','offertoro_app_id','offertoro_secret_key'];
}
