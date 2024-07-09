<?php

namespace App\Listeners;

use App\Events\LeaveVerificatedByHr;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\send;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

// class SendVerificationEmail implements ShouldQueue
class SendVerificationEmail 
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LeaveVerificatedByHr  $event
     * @return void
     */
    public function handle(LeaveVerificatedByHr $event)
    {
        //
        $ver_hr      = 1;
        $date_ver_hr = date("Y-m-d");       
        $hd_email    = DB::table('users')
                            ->select(DB::raw('email'))
                            ->where('dept_category_id', '=', $event->email->dept_category_id)
                            ->where('hd', '=', 1)
                            ->first();
        $gm_email    = DB::table('users')
                            ->select(DB::raw('email'))
                            ->where('gm', '=', 1)
                            ->first();
        if($event->email->gm === 1){
            Mail::send('email.approvedMail', ['email' => $event->email], function($message) use ($email)
                {
                    $message->to($event->email->email)->subject('[Approved] Leave Application - WIS');
                    $message->from('wis_system@frameworks-studios.com', 'WIS');
                });

        }

        else if($event->email->sp === 0){
            Mail::send('email.appMail', ['email' => $event->email], function($message) use ($hd_email)
                {
                    $message->to($hd_email->email)->subject('[Approval Request] Leave Application - WIS');
                    $message->from('wis_system@frameworks-studios.com', 'WIS');
                });
        }   

        else{
            Mail::send('email.appMail', ['email' => $event->email], function($message) use ($gm_email)
                {
                    $message->to($gm_email->email)->subject('[Approval Request] Leave Application - WIS');
                    $message->from('wis_system@frameworks-studios.com', 'WIS');
                });
        }       
    }

    
}
