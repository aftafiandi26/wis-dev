<?php

namespace App\Console\Commands;

use App\Dept_Category;
use App\Initial_Leave;
use App\Jobs\cutExdoExpired;
use App\Jobs\ExpiredExdoJob;
use App\Jobs\test;
use App\Leave;
use App\User;
use Illuminate\Console\Command;

class cronCutExdoExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expired:exdo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cut count exdo expired';

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
        $users = User::where('active', 1)->where('nik', '!=', null)->where('nik', '!=', '123456789')->get();

        foreach ($users as $key => $user) {

            $totalExdo = Initial_Leave::where('user_id', $user->id)->pluck('initial')->sum();

            $exdoExpired = Initial_Leave::where('user_id', $user->id)->where('expired', '<', date('Y-m-d'))->pluck('initial')->sum();

            $taken = Leave::where('leave_category_id', 2)->where('user_id', $user->id)->where('ap_hrd', 1)->pluck('total_day')->sum();

            if ($exdoExpired <= $totalExdo) {
                if ($taken < $exdoExpired) {
                    $amount = $exdoExpired - $taken;

                    $data = [
                        'user_id'                    => $user->id,
                        'leave_category_id'          => '2',
                        'request_by'                 => $user->first_name . ' ' . $user->last_name,
                        'exdoExpired'                => 1,
                        'request_nik'                => $user->nik,
                        'request_position'           => $user->position,
                        'request_join_date'          => $user->join_date,
                        'request_dept_category_name' => Dept_Category::where(['id' => $user->dept_category_id])->value('dept_category_name'),
                        'period'                     => date('Y'),
                        'leave_date'                 => date('Y-m-d'),
                        'end_leave_date'             => date('Y-m-d'),
                        'back_work'                  => date('Y-m-d'),
                        'total_day'                  => $amount,
                        'taken'                      => $taken + $amount,
                        'entitlement'                => 0,
                        'pending'                    => 0,
                        'remain'                     => 0,
                        'ap_hd'                      => 1,
                        'ap_gm'                      => 1,
                        'date_ap_hd'                 => date('Y-m-d'),
                        'date_ap_gm'                 => date('Y-m-d'),
                        'ver_hr'                     => '0',
                        'ap_koor'                    => 1,
                        'ap_spv'                     => 1,
                        'ap_pm'                     => 1,
                        'ap_producer'               => 1,
                        'ap_pipeline'               => 1,
                        'ap_Infinite'               => 0,
                        'ver_hr'                    => 1,
                        'ap_hrd'                    => 1,
                        'date_ap_Infinite'          => date('Y-m-d'),
                        'date_ap_koor'              => date('Y-m-d'),
                        'date_ap_spv'               => date('Y-m-d'),
                        'date_ap_pm'                => date('Y-m-d'),
                        'date_ap_pipeline'          => date('Y-m-d'),
                        'email_koor'                => null,
                        'email_spv'                 => null,
                        'email_pm'                  => null,
                        'email_producer'            => null,
                        'reason_leave'              => "Exdo cut expiration",
                        'r_departure'               => null,
                        'r_after_leaving'           => null,
                        'plan_leave'                => null,
                        'agreement'                 => null,
                        'resendmail'                => 0,
                    ];

                    // dispatch(new test($data));

                    $job = (new ExpiredExdoJob($data))->onConnection('database');

                    dispatch($job);
                }
            }
        }
    }
}