<?php

namespace Database\Seeders;

use App\Models\QuizCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizCategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quiz_categories = array(
            array('name' => 'Football','description' => 'Quiz About Football','image' => 'back-end/img/users_image/16779263454588.jpg','status' => '1','created_at' => now(),'updated_at' => now()),
            array('name' => 'Cricket','description' => 'Quizzes about cricket','image' => 'back-end/img/users_image/16779262106794.jpg','status' => '1','created_at' => now(),'updated_at' => now()),
            array('name' => 'Basketball','description' => 'Quizzes about basketball','image' => 'back-end/img/users_image/16779261832755.jpg','status' => '1','created_at' => now(),'updated_at' => now()),
            array('name' => 'Baseball','description' => 'Quzzes about baseball','image' => 'back-end/img/users_image/16779261524139.jpg','status' => '1','created_at' => now(),'updated_at' => now()),
            array('name' => 'Racing Car','description' => 'Racing cars','image' => 'back-end/img/users_image/16779261256034.jpg','status' => '1','created_at' => now(),'updated_at' => now()),
            array('name' => 'Adminrsfee','description' => 'egtvtrg','image' => 'back-end/img/users_image/1677923727715.jpg','status' => '1','created_at' => now(),'updated_at' => now())
          );

        QuizCategory::insert($quiz_categories);
    }
}
