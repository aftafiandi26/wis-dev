<?php

namespace App\Mail\Production\ExtendsExdo;

use App\Initial_Leave;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DisapprovalProducerMail extends Mailable
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

        $data = $this->data;

        $init = Initial_Leave::find($this->data['initial_leave_id']);

        $producer = User::find($this->data['producer_id']);
        $user = User::find($this->data['user_id']);
        $coor = User::find($this->data['create_by']);

        return $this->to('dede.aftafiandi@infinitestudios.id')->subject('Extended of Exdo')->view('production.extendsExdo.producers.mailDisapproved', compact(['data', 'init', 'producer', 'user', 'coor']));
    }
}