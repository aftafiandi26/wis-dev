<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\Software\ReminderSoftwareMail;
use App\Mail\Software\ReminderSoftware60;
use App\Mail\Software\RemindersSoftware10;
use App\Mail\Software\RemindersSoftware5;
use App\Mail\Software\RemindersSoftware0;
use App\AssetSoftware;

class cronReminderSotfware extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:software';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email for expiring date software';

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
        $getData = AssetSoftware::whereDate('expiring_date', '=', date('Y-m-d', strtotime("+30 days")))->latest()->first();        
        if(!empty($getData)){
            Mail::send(new ReminderSoftwareMail());
        }   
        $software60hari = AssetSoftware::whereDate('expiring_date', '=', date('Y-m-d', strtotime("+60 days")))->latest()->first();        
        if(!empty($software60hari)){
            Mail::send(new ReminderSoftware60());
        } 
        $software10hari = AssetSoftware::whereDate('expiring_date', '=', date('Y-m-d', strtotime("+10 days")))->latest()->first();        
        if(!empty($software10hari)){
            Mail::send(new RemindersSoftware10());
        } 
        $software5hari = AssetSoftware::whereDate('expiring_date', '=', date('Y-m-d', strtotime("+5 days")))->latest()->first();        
        if(!empty($software5hari)){
            Mail::send(new RemindersSoftware5());
        }             
    }
}
