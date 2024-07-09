<?php

namespace App\Console\Commands;

use App\FormOvertimes;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\Form\OvertimeITApprove;

class cronAllowOvertimesRemoteAcces19 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'onetime:approveremotevpn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'automatic IT approval form remote access vpn';

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
        $dede = User::find(226);

        $formovertimes = FormOvertimes::whereDATE('startovertime', '<', date('Y-m-d'))->where('app_coor', true)->where('app_gm', true)->where('verify_it', false)->get();

        $data = [
            'it_id' => 226,
            'verify_it' => true
        ];

        foreach ($formovertimes as $form) {
            FormOvertimes::where('id', $form->id)->update($data);
        }

        Mail::to($dede->email)->send(new OvertimeITApprove($formovertimes));
    }
}