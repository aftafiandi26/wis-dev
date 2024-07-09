<?php

namespace App\Mail\HRD\RescheduleLeave;

use App\Leave;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Approved extends Mailable
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
        $data = User::find($this->data['sun']);
        $leave = Leave::find($this->data['id']);

        return $this->subject('Approval Leave')->view('HRDLevelAcces.leave.reschedule.mailApproved', compact(['data', 'leave']));
    }
}