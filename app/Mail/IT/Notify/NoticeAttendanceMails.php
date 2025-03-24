<?php

namespace App\Mail\IT\Notify;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NoticeAttendanceMails extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $attendance = $this->data;
        $user = User::find($attendance['user_id']);

        return $this->subject('Notice Attendance ' . $user->getFullName())->view('all_employee.Absensi.sentMailAttendance', compact(['attendance', 'user']));
    }
}