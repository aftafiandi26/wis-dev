<?php

namespace App\Mail\Form\Weekend_Crew;

use App\SendingDataWorkingWeekend;
use App\User;
use App\WorkingOnWeekends;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DisapprovedMail extends Mailable
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

        $gm = User::where('active', 1)->where('gm', 1)->where('dept_category_id', 6)->first();

        $crew = WorkingOnWeekends::where('status', $data->status)->get();



        $disapproved = null;

        if ($data->ap_producer == 2 and $data->approved == 2) {
            $disapproved = $data->producer()->getFullName();
        }

        if ($data->ap_producer == true and $data->approved == 2) {
            $disapproved = $gm->getFullName();
        }

        return $this->subject('[Disapproved] Weekend Crew By ' . $data->coordinator()->getFullName())
            ->view('email.form.production.weekend_crew.disapproved', compact(['data', 'crew', 'disapproved']));
    }
}