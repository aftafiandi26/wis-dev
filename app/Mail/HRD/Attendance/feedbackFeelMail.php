<?php

namespace App\Mail\HRD\Attendance;

use App\Attendance_Questions;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use function PHPSTORM_META\map;

class feedbackFeelMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void     */


    public function __construct()
    { }

    private function feel($id)
    {
        $array = [
            1 => "Distressed",
            2 => "Unhappy",
            3 => "Neutral",
            4 => "Happy",
            5 => "Very Happy"
        ];

        return $array[$id];
    }

    private function health($id)
    {
        $array = [
            1 => "Severely  Unhealthy",
            2 => "not feeling well",
            3 => "Healthy"
        ];

        return $array[$id];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = Attendance_Questions::where('user_id', auth()->user()->id)->latest()->limit(3)->get();
        $user = User::find(auth()->user()->id);
        $pasData = [];

        foreach ($data as $key => $value) {

            $pasData[] = [
                'no'        => $key + 1,
                'nik'       => $user->nik,
                'fullname'  => $user->getFullName(),
                'position'  => $user->position,
                'feel'      => $this->feel($value->Q1),
                'health'    => $this->health($value->Q2),
                'why'       => $value->will_do,
            ];
        }

        return $this->view('all_employee.Absensi.sentFeedbackFeelMail', compact('pasData'));
    }
}