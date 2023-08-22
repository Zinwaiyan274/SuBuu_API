<?php

namespace Database\Seeders;

use App\Models\Reward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Rewards extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rewards = array(
            array('name' => 'Refer','reward_point' => '2000','status' => '1','created_at' => now(),'updated_at' => now()),
            array('name' => 'Login','reward_point' => '100','status' => '1','created_at' => now(),'updated_at' => now())
          );

        Reward::insert($rewards);
    }
}
