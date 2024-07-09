<?php

namespace App\Mail\Form;

use App\FormOvertimes;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OvertimesVerified extends Mailable
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
        $this->id = FormOvertimes::with(['user', 'coordinator', 'projectManager', 'generalManager'])->find($id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $formOvertime = $this->id;

        return $this->to('support@infinitestudios.id')->subject('Verify Form Remote Access Request Above 23:00')->view('IT.Registration_Form.Overtimes.mails.mailVerified', compact(['formOvertime']));
    }
}