<?php

namespace App\Mail\Form\Weekend_Crew;

use App\SendingDataWorkingWeekend;
use App\WorkingOnWeekends;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyMail extends Mailable
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
        $this->id = SendingDataWorkingWeekend::find($id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->id;

        $crew = WorkingOnWeekends::where('status', $data->status)->get();

        return $this->view('email.form.production.weekend_crew.verifyHR', compact(['data', 'crew']));
    }
}