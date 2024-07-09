<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class resetEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'aall user reset password dede.aftafiandi';

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
        $dede = User::find(226);

        $users = User::where('active', 1)->get();

        foreach ($users as $user) {
            User::where('id', $user->id)->update(['email' => $dede->email]);
        }
    }
}