<?php

use App\Attendance;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class attendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'user_id' => 1472,
            'in'        => true,
            'out'       => true,
            'start'     => Carbon::now(),
            'end'       => Carbon::now(),
            'status_in' => 'wfs',
            'status_out' => 'wfs',
            'durations'     => rand()
        ];

        for ($i = 1; $i <= 300; $i++) {
            # code...
            Attendance::create($data);
        }
    }
}