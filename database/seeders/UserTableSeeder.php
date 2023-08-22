<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            array('name' => 'Admin','email' => 'admin@admin.com','password' => bcrypt('admin'),'phone' => '01767432559','image' => 'uploads//23/03/1677930002.jpg','user_type' => 'Admin','refer' => NULL,'refer_code' => 'RF8524','facebook_token' => NULL,'google_token' => NULL,'status' => 1,'email_verified_at' => NULL,'access_date' => now(),'remember_token' => NULL,'created_at' => now(),'updated_at' => now()),
        );

        User::insert($users);

        $wallets = array(
            array('user_id' => 1,'balance' => 0,'status' => 1,'created_at' => now(),'updated_at' => now()),
          );

        Wallet::insert($wallets);
    }
}
