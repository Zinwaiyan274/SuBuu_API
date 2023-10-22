<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CurrencySeeder::class,
            SettingsSeeder::class,
            AdnetworkSeeder::class,
            UserTableSeeder::class,
            Rewards::class,
            // CurrencyConverts::class,
            // DailyRewardsSeeder::class,
            // QuizCategories::class,
            // Quizzes::class,
            // Questions::class,
            // UserGains::class,
            // UserQuizzes::class,
            // WithdrawRequests::class,
        ]);
    }
}
