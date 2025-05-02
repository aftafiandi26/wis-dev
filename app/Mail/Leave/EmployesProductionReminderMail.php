<?php

namespace App\Mail\Leave;

use App\Leave;
use App\Leave_Category;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class EmployesProductionReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $data;

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
        $data = $this->data;

        $leave = Leave::find($data['id']);

        $category = Leave_Category::find($leave->leave_category_id);

        return $this->from(auth()->user()->email)->to($data['to'])->view('all_employee.leave.employes.productions.message', compact('data', 'leave', 'category'));
    }
}