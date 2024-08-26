<?php

namespace App\Mail\Production\ExtendsExdo;

use App\Initial_Extends;
use App\Initial_Leave;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApprovalProducerMail extends Mailable
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

        $extended = Initial_Extends::find($this->data['id']);

        return $this->to('dede.aftafiandi@infinitestudios.id')->subject('Extended of Exdo')->view('production.extendsExdo.producers.mailApproval', compact(['extended']));
    }
}