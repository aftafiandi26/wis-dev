<?php

namespace App\Mail\Form;

use App\SendingDataWorkingWeekend;
use App\User;
use App\WorkingOnWeekends;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Weekend_Crew_Mail extends Mailable
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
        $this->id = SendingDataWorkingWeekend::where('status', $id)->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->id;

        $producer = User::find($data->producer_id);
        $coordinator = User::find($data->coor_id);
        $crew = WorkingOnWeekends::where('status', $data->status)->get();

        return $this->subject('[Approval] Weekend Crew By ' . $coordinator->getFullName())
            ->view('email.form.production.weekend_crew.coordinatorMails', compact(['data', 'producer', 'coordinator', 'crew']));
    }
}