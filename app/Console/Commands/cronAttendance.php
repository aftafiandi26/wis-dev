<?php

namespace App\Console\Commands;

use App\Absences;
use App\Attendance;
use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Command;

class cronAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'push table absences to table attendance_new';

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
        $absences = Absences::whereYear('date_check_in', date('Y'))->whereMonth('date_check_in', date('m'))->get();

        foreach ($absences as $value) {
            $end = $value->date_check_out . " " . $value->timeOUT;

            if ($value->check_out === 0) {
                $end = null;
            }

            $data = [
                'user_id' => $value->id_user,
                'in'    => $value->check_in,
                'out'   => $value->check_out,
                'start' => $value->date_check_in . " " . $value->timeIN,
                'end'   => $end,
                'remarks' => $value->remarks
            ];

            Attendance::create($data);
        }
    }
}