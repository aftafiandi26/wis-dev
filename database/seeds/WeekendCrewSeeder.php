<?php

use App\Log_WorkingWeekends;
use Illuminate\Database\Seeder;

class WeekendCrewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i <= 5; $i++) {
            $data = [
                'coor_id' => 1379,
                'user_id' => rand(1472, 1475),
                'project' => 'Cocomelon Short 2',
                'start'   =>  '2024-02-10 15:32:00',
                'end'   =>  '2024-02-10 15:32:00',
                'hourly' => rand(8, 10),
            ];

            Log_WorkingWeekends::create($data);
        }
    }
}