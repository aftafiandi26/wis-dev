<?php

namespace App\Mail\Software;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\AssetSoftware;

class RemindersSoftware10 extends Mailable
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
        $getData = AssetSoftware::whereDate('expiring_date', '<=', date('Y-m-d', strtotime("+10 days")))->where('expiring_date', '>=', date('Y-m-d'))->get();
        $id = 10;

        return $this
        ->to('support@infinitestudios.id')
        // ->cc('oskim@infinitestudios.com.sg')
        // ->cc('chailing@infinitestudios.com.sg') 
        // // ->cc('sean@infinitestudios.com.sg')   
        // ->cc('choonmeng@infinitestudios.com.sg')
        // ->cc('production_pipeline@frameworks-studios.com')
        // ->cc('finance@frameworks-studios.com')  
        ->view('email.Reminders.software')
        ->with([
            'getData' => $getData,
            'id'    => $id
        ]);
    }
}
