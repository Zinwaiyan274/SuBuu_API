<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = array(
            array('title' => 'Cash Rocket','name' => 'Reward App Admin Panel','favicon' => 'back-end/img/settings_image/16692748917099.svg','header_logo' => 'back-end/img/settings_image/16692760025645.svg','footer_logo' => 'back-end/img/settings_image/1669281951983.png','content' => 'Demo content','status' => 1,'created_at' => now(),'updated_at' => now())
          );
        Settings::insert($settings);
    }
}
