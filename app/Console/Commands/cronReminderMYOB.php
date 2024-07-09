<?php

namespace App\Console\Commands;

use App\Mail\ReminderMYOB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;


class cronReminderMYOB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:myob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder backup MYOB database';

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
        Mail::to('dede.aftafiandi@frameworks-studios.com')->send(new ReminderMYOB);
    }
}
