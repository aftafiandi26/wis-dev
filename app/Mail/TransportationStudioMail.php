<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Bus_Transportation;

class TransportationStudioMail extends Mailable
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
        $d  = Bus_Transportation::where('date_booking', date('Y-m-d'))->where('lockey', 1)->get(); 

         $O800 = Bus_Transportation::where('date_booking',date('Y-m-d'))->where('time_booking', '08:00:00')->where('lockey', 1)->count(); 
         $O820 = Bus_Transportation::where('date_booking',date('Y-m-d'))->where('time_booking', '08:20:00')->where('lockey', 1)->count(); 
         $O840 = Bus_Transportation::where('date_booking',date('Y-m-d'))->where('time_booking', '08:40:00')->where('lockey', 1)->count();  
         $O900 = Bus_Transportation::where('date_booking',date('Y-m-d'))->where('time_booking', '09:00:00')->where('lockey', 1)->count();
         $O920 = Bus_Transportation::where('date_booking',date('Y-m-d'))->where('time_booking', '09:20:00')->where('lockey', 1)->count();  
         $O940 = Bus_Transportation::where('date_booking',date('Y-m-d'))->where('time_booking', '09:40:00')->where('lockey', 1)->count();  

         $I700 = Bus_Transportation::where('date_booking',date('Y-m-d'))->where('time_booking', '17:00:00')->where('lockey', 1)->count();
         $I900 = Bus_Transportation::where('date_booking',date('Y-m-d'))->where('time_booking', '19:00:00')->where('lockey', 1)->count();  
         $Z100 = Bus_Transportation::where('date_booking',date('Y-m-d'))->where('time_booking', '21:00:00')->where('lockey', 1)->count();
         $Z300 = Bus_Transportation::where('date_booking',date('Y-m-d'))->where('time_booking', '23:00:00')->where('lockey', 1)->count();   
      
       return $this->to('dede.aftafiandi@infinitestudios.id')
       ->from('wis_system@infinitestudios.id')      
       ->view('email.Transportation.bus')
       ->with([
            'nama'  => $d,
            'dated' =>date('Y-m-d'),
            'key'   => "1",
            'time_0800' => $O800,
            'time_0820' => $O820,
            'time_0840' => $O840,
            'time_0900' => $O900,
            'time_0920' => $O920,
            'time_0940' => $O940,
            'time_I700' => $I700,
            'time_I900' => $I900,
            'time_Z100' => $Z100,
            'time_Z300' => $Z300,
        ]);
    }
}
