<?php

namespace Database\Seeders;

use App\Models\CurrencyConvert;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencyConverts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency_converts = array(
            array('currency_id' => '9','par_currency' => '1','coin' => '100','status' => '1','created_at' => now(),'updated_at' => now()),
            array('currency_id' => '4','par_currency' => '1','coin' => '200','status' => '1','created_at' => now(),'updated_at' => now()),
            array('currency_id' => '72','par_currency' => '1','coin' => '500','status' => '1','created_at' => now(),'updated_at' => now())
          );

        CurrencyConvert::insert($currency_converts);
    }
}
