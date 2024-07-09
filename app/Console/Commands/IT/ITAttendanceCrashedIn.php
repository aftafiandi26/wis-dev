<?php

namespace App\Console\Commands\IT;

use App\Attendance;
use App\Mail\IT\Notify\HeadAttendanceMails;
use App\User;
use App\ViewOffYears;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ITAttendanceCrashedIn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'it:attendance_in';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '??? ??????';

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

        $holiday = ViewOffYears::whereDATE('date', date('Y-m-d'))->first();

        if ($holiday) {
            return;
        }

        $now = Carbon::now();
        $randTime = $now->copy()->subMinutes(rand(5, 10));
        // echo $randTime;

        $data = [
            'user_id'  => $user->id,
            'in'       => true,
            'start'    => $randTime,
            'status_in'    => 'wfs',
        ];

        $array = [
            'fullName'  => $user->getFullName(),
            'date'      => $randTime,
            'status'    => 'in (WFS)'
        ];

        Attendance::create($data);
        Mail::to($user->email)->send(new HeadAttendanceMails($array));
    }
}