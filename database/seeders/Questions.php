<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Questions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = array(
            array('quiz_id' => '1','question' => 'When did FIFA started?','option_a' => '1910','option_b' => '1920','option_c' => '1930','option_d' => '1940','answer' => 'C','image' => 'back-end/img/Question_image/1677926410732.png','status' => '1','created_at' => '2022-11-09 09:44:05','updated_at' => '2023-03-04 16:40:10'),
            array('quiz_id' => '2','question' => 'Who is the current president of FIFA?','option_a' => 'Robert Guérin','option_b' => 'Sepp Blatter','option_c' => 'Issa Hayatou','option_d' => 'Gianni Infantino','answer' => 'D','image' => 'back-end/img/Question_image/16779264253877.jpg','status' => '1','created_at' => '2022-11-09 09:45:39','updated_at' => '2023-03-04 16:40:25'),
            array('quiz_id' => '3','question' => 'What is the name of this player?','option_a' => 'Maradona','option_b' => 'Pele','option_c' => 'Kaka','option_d' => 'Messi','answer' => 'B','image' => 'back-end/img/Question_image/16679692149653.jpg','status' => '0','created_at' => '2022-11-09 09:46:54','updated_at' => '2023-01-19 13:25:52'),
            array('quiz_id' => '4','question' => 'What is the Full Form of FIFA?','option_a' => 'International Federation of Association Football','option_b' => 'Federation of International Football Association','option_c' => 'Football of International Federation Association','option_d' => 'None of the Above','answer' => 'A','image' => 'back-end/img/Question_image/16779263947732.jpg','status' => '1','created_at' => '2022-11-09 09:49:00','updated_at' => '2023-03-04 16:39:54'),
            array('quiz_id' => '5','question' => 'In which country FIFA Headquarter is situated?','option_a' => 'Switzerland','option_b' => 'Canada','option_c' => 'Australia','option_d' => 'Pakistan','answer' => 'A','image' => 'back-end/img/Question_image/16779236034792.jpg','status' => '1','created_at' => '2022-11-09 09:50:12','updated_at' => '2023-03-04 15:53:23'),
            array('quiz_id' => '1','question' => 'What is the name of this player?','option_a' => 'Lionel Messi','option_b' => 'Erling Haaland','option_c' => 'Kylian Mbappé','option_d' => 'Robert Lewandowski','answer' => 'B','image' => 'back-end/img/Question_image/16679696784910.jpg','status' => '1','created_at' => '2022-11-09 09:54:38','updated_at' => '2022-11-09 09:54:38'),
            array('quiz_id' => '2','question' => 'What is the name of this player?','option_a' => 'Lionel Messi','option_b' => 'Erling Haaland','option_c' => 'Kylian Mbappé','option_d' => 'Robert Lewandowski','answer' => 'D','image' => 'back-end/img/Question_image/16679697257002.png','status' => '1','created_at' => '2022-11-09 09:55:25','updated_at' => '2022-11-09 09:55:25'),
            array('quiz_id' => '3','question' => 'What is the name of this player?','option_a' => 'Robert Guérin','option_b' => 'Sepp Blatter','option_c' => 'Kylian Mbappé','option_d' => 'Christopher Nkunku','answer' => 'D','image' => 'back-end/img/Question_image/16679697988295.png','status' => '1','created_at' => '2022-11-09 09:56:38','updated_at' => '2022-11-26 11:27:52'),
            array('quiz_id' => '4','question' => 'Who will win the match?','option_a' => 'Switzerland','option_b' => 'Canada','option_c' => 'Australia','option_d' => 'Pakistan','answer' => 'B','image' => 'back-end/img/Question_image/16789461899519.png','status' => '1','created_at' => '2023-03-14 21:48:59','updated_at' => '2023-03-16 05:56:29'),
            array('quiz_id' => '5','question' => 'What is the name of this player?','option_a' => 'Robert Guérin','option_b' => 'Erling Haaland','option_c' => 'Issa Hayatou','option_d' => 'Robert Lewandowski','answer' => 'B','image' => 'back-end/img/Question_image/16789461406015.png','status' => '1','created_at' => '2023-03-14 21:49:28','updated_at' => '2023-03-16 05:55:40'),
            array('quiz_id' => '4','question' => 'Will I get the source code?','option_a' => 'Maradona','option_b' => 'Pele','option_c' => 'Issa Hayatou','option_d' => 'Gianni Infantino','answer' => 'A','image' => 'back-end/img/Question_image/16789461735002.png','status' => '1','created_at' => '2023-03-14 21:49:49','updated_at' => '2023-03-16 05:56:13')
          );

        Question::insert($questions);
    }
}
