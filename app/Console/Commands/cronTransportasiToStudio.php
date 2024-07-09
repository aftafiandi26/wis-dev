<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Bus_Transportation;
use App\Mail\TransportationStudioMail;
use Illuminate\Support\Facades\Mail;

class cronTransportasiToStudio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transportasi:tostudio';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send transportasi email with departure dormitory to studio';

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
        Mail::send(new TransportationStudioMail());

    }
}
