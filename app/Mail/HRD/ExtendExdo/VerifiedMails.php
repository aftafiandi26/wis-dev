<?php

namespace App\Mail\HRD\ExtendExdo;

use App\Initial_Extends;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifiedMails extends Mailable
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
        $extended = Initial_Extends::find($this->id);

        return $this->to('dede.aftafiandi@infinitestudios.id')->cc('wis_system@infinitestudios.id')->subject('Extended of Exdo')->view('HRDLevelAcces.hr_admin.extend_exdo.verified', compact(['extended']));
    }
}