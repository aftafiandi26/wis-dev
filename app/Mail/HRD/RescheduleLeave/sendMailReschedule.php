<?php

namespace App\Mail\HRD\RescheduleLeave;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendMailReschedule extends Mailable
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
        $data = $this->data;

        $coordinator = User::find($data->coordinator_id);
        if ($coordinator) {
            $coordinator = $coordinator->getFullName();
        }

        $spv = User::find($data->spv_id);
        if ($spv) {
            $spv = $spv->getFullName();
        }

        $projectManager = User::find($data->pm_id);
        if ($projectManager) {
            $projectManager = $projectManager->getFullName();
        }

        $producer = User::find($data->producer_id);
        if ($producer) {
            $producer = $producer->getFullName();
        }

        return $this->subject('Reschedule of leave')->view('HRDLevelAcces.leave.reschedule.sendNotifikasiReschedule', compact(['data', 'coordinator', 'spv', 'projectManager', 'producer']));
    }
}