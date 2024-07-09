<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Telegram\Bot\Laravel\Facades\Telegram;

class testCronjob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command testing';

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
        // $user = User::find(226);

        // Mail::send('email.birthdayMail', ['user' => $user], function ($message) use ($user) {
        //     $message->to($user->email)->subject('[Happy Birthday] Reminder - WIS');

        //     $message->from('wis_system@infinitestudios.id', 'WIS');
        // });       

        // $chatId = '943233089';
        // $pesan = 'Halo, ini pesan dari Laravel ke Telegram!';

        // Telegram::sendMessage([
        //     'chat_id' => $chatId,
        //     'text' => $pesan,
        // ]);

        // return "Pesan telah terkirim!";

        $response = Telegram::getMe();
    }
}