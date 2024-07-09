<?php

namespace App\Mail\Form;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OvertimesMails extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $formOvertime;

    public function __construct($formOvertime)
    {
        $this->formOvertime = $formOvertime;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Approval Form Remote Access Request Above 23:00')->view('all_employee.Form.Overtime.mail');
    }
}