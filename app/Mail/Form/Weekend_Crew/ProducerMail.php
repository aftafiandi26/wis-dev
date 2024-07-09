<?php

namespace App\Mail\Form\Weekend_Crew;

use App\SendingDataWorkingWeekend;
use App\User;
use App\WorkingOnWeekends;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProducerMail extends Mailable
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

        $gm = User::where('gm', 1)->where('dept_category_id', 6)->first();
        $crew = WorkingOnWeekends::where('status', $data->status)->get();

        return $this->subject('[Approval] Weekend Crew By ' . $data->coordinator()->getFullName())
            ->view('email.form.production.weekend_crew.producerMails', compact(['data', 'crew', 'gm']));
    }
}