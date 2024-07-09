<?php

namespace App\Console\Commands\IT;

use App\Absences;
use App\Attendance;
use App\Mail\IT\Notify\HeadAttendanceMails;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ITAttendnaceCrashedOut extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'it:attendance_out';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '???? ???????';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = User::find(3);

        $datetime = Carbon::now();
        $datetime = $datetime->copy()->addMinutes(rand(10, 15));

        $getAttendance = Attendance::where('user_id', $user->id)->whereDATE('start', date('Y-m-d'))->where('in', true)->where('out', false)->latest()->first();

        if (empty($getAttendance)) {
            return;
        }

        $startTime = new DateTime($getAttendance->start);
        $endTime = new DateTime($datetime);

        $interval = $startTime->diff($endTime);

        $convertDay = $interval->format('%d');
        $convertHours = $interval->format('%h');
        $convertMinutes = $interval->format('%i');

        $convertDay = $convertDay * 24;
        $convertHours = $convertDay + $convertHours;
        $convertHours = $convertHours * 60;
        $convertMinutes = $convertHours + $convertMinutes;

        $data = [
            'user_id'   => 3,
            'Out'        => true,
            'end'        => $datetime,
            'durations'  => $convertMinutes,
            'status_out'    => 'wfs',
        ];

        $array = [
            'fullName'  => $user->getFullName(),
            'date'      => $datetime,
            'status'    => 'out {WFS)'
        ];

        $getAttendance->update($data);
        Mail::to($user->email)->send(new HeadAttendanceMails($array));
    }
}