<?php

namespace App\Console\Commands;

use App\FormOvertimes;
use DateTime;
use Illuminate\Console\Command;

class setDurationForRemoteAccessVpn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:durationVPN';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update duration time remote access overtime vpn';

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
        $form = FormOvertimes::whereDate('startovertime', date('Y-m-d', strtotime('-1 day')))->where('app_coor', 1)->get();

        foreach ($form as $value) {
            $start = new DateTime($value->startovertime);
            $end = new DateTime($value->endovertime);
            $hitung = date_diff($end, $start);
            $day = $hitung->d * 24;
            $count = $hitung->h + $day;

            $value->update(['hours' => $count, 'seconds' => $hitung->i]);
        }
    }
}