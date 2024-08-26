<?php

use App\Attendance;
use App\Attendance_Questions;
use App\User;
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
        $users = User::where('active', 1)->where('dept_category_id', 6)->get();

        foreach ($users as $user) {

            $quest = [
                'user_id'   => $user->id,
                'Q1'        => rand(1, 5),
                'Q2'        => rand(1, 4),
            ];

            Attendance_Questions::create($quest);

            $QA = Attendance_Questions::where('user_id', $user->id)->latest()->first();

            $startTime = Carbon::now();
            $endTime = $startTime->addHours(4);

            $data = [
                'start' => Carbon::now()->addDay(),
                'end'   => Carbon::now()->addDay()->addHours(4),
                'in' => true,
                'out' => true,
                'status_in' => 'wfh',
                'status_out' => 'wfh',
                'remarks'   => "faker",
                'durations' => rand(622, 680),
                'user_id'   => $user->id,
                'quest_id'  => $QA->id,
            ];

            Attendance::create($data);
        }
    }
}