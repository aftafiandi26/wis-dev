<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\NewUser;
use DB;
use Mail;

class cronEntitlementAnnualPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entitlement:annual';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add 12 Annual entitlement for Permanent User';

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
        //
        DB::update('update users SET initial_annual = initial_annual + 12 WHERE emp_status = "Permanent"');
    }
}
