<?php

namespace Database\Seeders;

use App\Models\UserGain;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserGains extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_gains = array(
            array('user_id' => '1','description' => 'Spin Wheel Video Ads','amount' => '50','gain_status' => 'Gain','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '2','description' => 'Spin Wheel Video Ads','amount' => '70','gain_status' => 'Gain','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '3','description' => 'Daily Reward','amount' => '100','gain_status' => 'Gain','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '4','description' => 'Paid For Quiz Retake','amount' => '200','gain_status' => 'Loss','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '5','description' => 'Applovin Video Ads','amount' => '10','gain_status' => 'Gain','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '6','description' => 'Spin Wheel Video Ads','amount' => '60','gain_status' => 'Gain','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '7','description' => 'Spin Wheel Video Ads','amount' => '20','gain_status' => 'Gain','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '8','description' => 'Spin Wheel Video Ads','amount' => '100','gain_status' => 'Gain','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '9','description' => 'Spin Wheel Video Ads','amount' => '30','gain_status' => 'Gain','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '10','description' => 'Gain by using refer code','amount' => '2000','gain_status' => 'Gain','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '11','description' => 'Gain by using refer code','amount' => '2000','gain_status' => 'Gain','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '12','description' => 'Gain by using refer code','amount' => '2000','gain_status' => 'Gain','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '13','description' => 'Admob Video Ads','amount' => '10','gain_status' => 'Gain','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '14','description' => 'Admob Video Ads','amount' => '10','gain_status' => 'Gain','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '15','description' => 'Spin Wheel Video Ads','amount' => '50','gain_status' => 'Gain','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '16','description' => 'Spin Wheel Video Ads','amount' => '20','gain_status' => 'Gain','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '17','description' => 'Spin Wheel Video Ads','amount' => '60','gain_status' => 'Gain','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '18','description' => 'Spin Wheel Video Ads','amount' => '60','gain_status' => 'Gain','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '19','description' => 'Spin Wheel Video Ads','amount' => '10','gain_status' => 'Gain','status' => '1','created_at' => now(),'updated_at' => now()),
          );

        UserGain::insert($user_gains);
    }
}
