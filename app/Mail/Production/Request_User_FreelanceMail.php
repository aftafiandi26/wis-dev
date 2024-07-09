<?php

namespace App\Mail\Production;

use App\User_Freelance;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Request_User_FreelanceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $formData;

    public function __construct($formData)
    {
        $this->formData = $formData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $freelance = User_Freelance::find($this->formData['id']);

        return $this->to('dede.aftafiandi@infinitestudios.id')
            ->subject($this->formData['subject'])
            ->view('production.freelance.request_username_mail')
            ->with([
                'data' => $this->formData,
                'freelance' => $freelance
            ]);
    }
}