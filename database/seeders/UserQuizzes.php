<?php

namespace Database\Seeders;

use App\Models\UserQuiz;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserQuizzes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_quizzes = array(
            array('user_id' => '2','quiz_id' => '1','amount' => '200','win_status' => '1','result_status' => '1','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '3','quiz_id' => '1','amount' => '0','win_status' => '0','result_status' => '3','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '4','quiz_id' => '1','amount' => '0','win_status' => '0','result_status' => '3','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '5','quiz_id' => '2','amount' => '0','win_status' => '0','result_status' => '3','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '6','quiz_id' => '2','amount' => '0','win_status' => '0','result_status' => '3','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '7','quiz_id' => '3','amount' => '0','win_status' => '0','result_status' => '3','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '8','quiz_id' => '3','amount' => '0','win_status' => '0','result_status' => '3','status' => '1','created_at' => now(),'updated_at' => now()),
            array('user_id' => '9','quiz_id' => '4','amount' => '0','win_status' => '0','result_status' => '3','status' => '1','created_at' => now(),'updated_at' => now())
          );

        UserQuiz::insert($user_quizzes);
    }
}
