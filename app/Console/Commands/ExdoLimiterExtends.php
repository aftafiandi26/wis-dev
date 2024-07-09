<?php

namespace App\Console\Commands;

use App\Initial_Leave;
use App\Leave;
use App\User;
use Illuminate\Console\Command;

class ExdoLimiterExtends extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exdo:extends';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'extends exdo monthly';

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
        $users = User::select(['id', 'nik', 'active'])->where('active', 1)->whereNotIn('nik', ["", "123456789"])->get();

        $arrayLeave = [];

        foreach ($users as $user) {
            $leave = Leave::where('leave_category_id', 2)->where('user_id', $user->id)->where('ap_hrd', 1)->where('ap_hd', 1)->where('ver_hr', 1)->pluck('total_day')->sum();

            if ($leave > 0) {
                $countExdo = Initial_Leave::where('user_id', $user->id)->where('leave_category_id', 2)->orderBy('id', 'desc')->pluck('initial');
                $arrayLeave[] = [
                    'id'       => $user->id,
                    'totalDay'  => $leave,
                    'countExdo' => $countExdo->sum()
                ];
                // dd($leave);
            }
        }

        $conLeave = json_encode($arrayLeave);

        printf($conLeave);
    }
}