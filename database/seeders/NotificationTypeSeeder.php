<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NotificationType;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NotificationType::create([
            "name" => "Point",
            "description" => "Point notification"
        ]);

        NotificationType::create([
            "name" => "Balance",
            "description" => "Balance notification"
        ]);

        NotificationType::create([
            "name" => "Other",
            "description" => "Others notification"
        ]);
    }
}
