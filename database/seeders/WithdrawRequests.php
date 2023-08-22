<?php

namespace Database\Seeders;

use App\Models\WithdrawMethod;
use App\Models\WithdrawRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WithdrawRequests extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $withdraw_requests = array(
            array('user_id' => '2','method_id' => '1','currency_convert_id' => '1','coins' => '2000','account' => '44564564564','amount' => '20','approve_status' => '3','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '3','method_id' => '1','currency_convert_id' => '1','coins' => '1000','account' => '026788888','amount' => '10','approve_status' => '1','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '4','method_id' => '1','currency_convert_id' => '1','coins' => '3000','account' => '09176446784','amount' => '30','approve_status' => '1','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '5','method_id' => '1','currency_convert_id' => '1','coins' => '1000','account' => '0654789','amount' => '10','approve_status' => '1','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '6','method_id' => '1','currency_convert_id' => '1','coins' => '1000','account' => '0186563232','amount' => '10','approve_status' => '1','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '7','method_id' => '1','currency_convert_id' => '1','coins' => '1000','account' => '0186563232','amount' => '10','approve_status' => '1','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '8','method_id' => '1','currency_convert_id' => '1','coins' => '8000','account' => '0182919','amount' => '80','approve_status' => '3','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '9','method_id' => '1','currency_convert_id' => '1','coins' => '1000','account' => '01827281973','amount' => '10','approve_status' => '3','status' => '1','created_at' => now(),'updated_at' => now())
          );

        WithdrawRequest::insert($withdraw_requests);
    }
}
