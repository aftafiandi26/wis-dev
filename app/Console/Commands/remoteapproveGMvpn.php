<?php

namespace App\Console\Commands;

use App\FormOvertimes;
use App\User;
use App\Mail\Form\AllowOvertimesHoldingCor;
use App\Mail\Form\OvertimeHoldingCoordinator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class remoteapproveGMvpn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'onetime:approvegmremote';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'automatic approval form remote access vpn above 22:00';

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

        $formovertimes = FormOvertimes::where('app_coor', true)->where('app_gm', false)->get();

        $data = [
            'app_gm' => true,
        ];

        foreach ($formovertimes as $form) {
            FormOvertimes::where('id', $form->id)->update($data);
        }
        if (!empty($formovertimes)) {
            Mail::to($dede->email)->send(new OvertimeHoldingCoordinator($formovertimes));
        }
    }
}