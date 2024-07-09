<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderSoftware60;
use App\AssetSoftware;

class cronReminderSoftware60 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:software60';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email for expiring date software for 60 days';

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
        $getData = AssetSoftware::whereDate('expiring_date', '<=', date('Y-m-d', strtotime("+60 days")))->latest()->first();        
        if(!empty($getData)){
            Mail::send(new ReminderSoftware60());
        }  
    }
}
