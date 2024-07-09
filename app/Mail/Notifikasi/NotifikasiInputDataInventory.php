<?php

namespace App\Mail\Notifikasi;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Asset_Tracking;

class NotifikasiInputDataInventory extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $getData = Asset_Tracking::latest()->first();
        return $this->to('dede.aftafiandi@infinitestudios.id')
        ->view('email.Notifikasi.IT.hardware')
         ->with([
            'getData' => $getData
        ]);
    }
}
