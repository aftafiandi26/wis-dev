<?php

namespace App\Mail\GeneralManager\ExtendExdo;

use App\Initial_Extends;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DisapprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $extended = Initial_Extends::find($this->data);

        return $this->to('dede.aftafiandi@infinitestudios.id')->subject('Extended of Exdo')->view('GenaralManager.extend_exdo.mailDisapproved', compact(['extended']));
    }
}