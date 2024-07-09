<?php

namespace App\Mail\Form;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OvertimeITApprove extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $formovertimes;

    public function __construct($formovertimes)
    {
        $this->formovertimes = $formovertimes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Approval Form Remote Access Request Above 23:00')->view('IT.Registration_Form.Overtimes.mails.overtimeForIT');
    }
}