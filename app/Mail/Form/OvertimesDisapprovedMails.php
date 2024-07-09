<?php

namespace App\Mail\Form;

use App\FormOvertimes;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OvertimesDisapprovedMails extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $id;

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
        $formOvertime = FormOvertimes::with(['user', 'coordinator', 'generalManager'])->find($this->id);

        return $this->subject('Disapporval Form Remote Access Request VPN')->view('all_employee.Form.Overtime.mailDisapproved', compact('formOvertime'));
    }
}