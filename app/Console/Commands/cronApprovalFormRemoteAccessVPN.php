<?php

namespace App\Console\Commands;

use App\FormOvertimes;
use App\Mail\Form\OvertimeHoldingCoordinator;
use App\Mail\Form\OvertimeUnverified;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;

class cronApprovalFormRemoteAccessVPN extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'onetime:remoteaccessvpn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'automatic approval form remote access vpn above 23:00';

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
        $ghea = User::find(69);

        if (date('D') !== 'Sat' or date('D') !== 'Sun') {
            $formovertimes = FormOvertimes::where('app_coor', false)->get();

            $data = [
                'app_coor' => true,
            ];

            foreach ($formovertimes as $form) {
                FormOvertimes::where('id', $form->id)->update($data);
            }

            if ($formovertimes !== 0) {
                Mail::to($dede->email)->send(new OvertimeHoldingCoordinator($formovertimes));
                Mail::to($ghea->email)->send(new OvertimeHoldingCoordinator($formovertimes));
            }
        }
    }
}