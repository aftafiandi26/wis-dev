<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\NewUser;
use DB;
use Mail;

class cronBirthdayEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'birthday:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send birthday email everydays';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $select = DB::select('SELECT first_name, last_name, position FROM users WHERE MONTH(dob) = MONTH(CURRENT_DATE) AND DAY(dob) = DAY(CURRENT_DATE)');

       $coba =  DB::table('users')
                         ->whereMONTH('dob', '=', date('m'))
                         ->whereDAY('dob', '=', date('d'))
                         ->where('active', 1)
                         ->get();

        if(!empty($select)){        
            Mail::send('email.birthdayMail', ['select' => $select], function($message) use ($coba)
        {
            foreach ($coba as $email) {             
                 $message->to($email->email)->subject('[Happy Birthday] Reminder - WIS');
                 // $message->to('dede.aftafiandi@frameworks-studios.com')->subject('[Happy Birthday] Reminder - WIS');
            }
         
            $message->from('wis_system@frameworks-studios.com', 'WIS');
        });
        }
    }
}
