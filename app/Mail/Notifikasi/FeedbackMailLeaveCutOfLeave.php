<?php

namespace App\Mail\Notifikasi;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FeedbackMailLeaveCutOfLeave extends Mailable
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
        $user = User::find($data['user_id']);

        return $this->subject('carry over by HR Verification')->view('HRDLevelAcces.leave.history.feedbackMailLeave', compact(['data', 'user']));
    }
}