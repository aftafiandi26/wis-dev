<?php

namespace App\Mail\HRD\ExtendExdo;

use App\Initial_Extends;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Reminders extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $param = $this->id;

        $extended = Initial_Extends::find($param['id']);

        if ($extended->ap_producer == 0 and $extended->ap_gm == 0) {
            $dear = $extended->getUser($extended->producer_id)->getFullName();
        }

        if ($extended->ap_producer == 1 and $extended->ap_gm == 0) {
            $dear = $extended->getUser($extended->gm_id)->getFullName();
        }

        if ($extended->ap_producer == 1 and $extended->ap_gm == 1) {
            $dear = "HRD";
        }

        return $this->to('dede.aftafiandi@infinitestudios.id')->subject('Extended of Exdo')->view('HRDLevelAcces.hr_admin.extend_exdo.mailsReminder', compact(['extended', 'param'], 'dear'));
    }
}