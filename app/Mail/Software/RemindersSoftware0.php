<?php

namespace App\Mail\Software;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\AssetSoftware;

class RemindersSoftware0 extends Mailable
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
        $getData = AssetSoftware::whereDate('expiring_date', '<=', date('Y-m-d', strtotime("now")))->where('expiring_date', '>=', date('Y-m-d'))->get();

        return $this
        ->to('support@infinitestudios.id')    
        ->from('wis_system@infinitestudios.id')        
        ->view('email.Reminders.software')
        ->with([
            'getData' => $getData
        ]);
    }
}
