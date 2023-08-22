<?php

namespace Database\Seeders;

use App\Models\WithdrawMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WithdrawMethods extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $withdraw_methods = array(
            array('name' => 'Paypal','minimum_amount' => '1000','image' => 'back-end/img/Withdraw_method_image/16673803342924.png','status' => '1','created_at' => now(),'updated_at' => now()),
            array('name' => 'Bkash','minimum_amount' => '2000','image' => 'back-end/img/Withdraw_method_image/16673803874118.png','status' => '1','created_at' => now(),'updated_at' => now()),
            array('name' => 'Google Pay','minimum_amount' => '3000','image' => 'back-end/img/Withdraw_method_image/16673805628743.png','status' => '1','created_at' => now(),'updated_at' => now()),
            array('name' => 'Amazon Gift Card','minimum_amount' => '2000','image' => 'back-end/img/Withdraw_method_image/16673807202689.png','status' => '1','created_at' => now(),'updated_at' => now()),
            array('name' => 'cash','minimum_amount' => '1000','image' => 'back-end/img/Withdraw_method_image/16740381724274.jpg','status' => '1','created_at' => now(),'updated_at' => now())
          );

        WithdrawMethod::insert($withdraw_methods);
    }
}
