<?php

namespace Database\Seeders;

use App\Models\Adnetwork;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdnetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adnetworks = array(
            array('admob_interstitial_android' => 'ca-app-pub-3940256099942544/8691691433','admob_interstitial_ios' => 'ca-app-pub-3940256099942544/8691691433','admob_rewarded_android' => 'ca-app-pub-3940256099942544/5224354917','admob_rewarded_ad_ios' => 'ca-app-pub-3940256099942544/1712485313','applovin_rewarded_ad_android' => '6d4421fd379b387e','applovin_rewarded_ad_ios' => 'test6','audience_network_rewarded_ad_android' => 'test7','audience_network_ad_ios' => 'test8','audience_network_interstitial_android' => 'test9','audience_network_interstitial_ios' => 'test10','offertoro_publisher_id' => '15768','offertoro_app_id' => '14507','offertoro_secret_key' => '33ae40dc7b63c3cb6c3adac396bc4dc7','created_at' => NULL,'updated_at' => '2023-03-13 23:07:39')
        );
        Adnetwork::insert($adnetworks);
    }
}
