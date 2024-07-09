<?php

namespace App\Mail\Form;

use App\FormOvertimes;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OvertimeFinished extends Mailable
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
        $this->id = FormOvertimes::with(['user', 'coordinator', 'projectManager', 'generalManager', 'itId'])->find($id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $formOvertime = $this->id;

        return $this->to($formOvertime->user->email)->subject('Verify Remote Access Request VPN')->view('IT.Registration_Form.Overtimes.mails.mailFinished', compact(['formOvertime']));
    }
}