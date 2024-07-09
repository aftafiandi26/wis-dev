<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class resetPasswordAllUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:password-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'reset all password is Batam2023';

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
        $users = User::where('active', 1)->get();
        $password = Hash::make("Batam2023");

        foreach ($users as $user) {
            User::where('id', $user->id)->update(['password' => $password]);
        }
        printf("Done");
    }
}
