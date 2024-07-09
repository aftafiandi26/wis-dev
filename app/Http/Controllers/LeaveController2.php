<?php

namespace App\Http\Controllers;

use App;
use App\Dept_Category;
use App\Http\Controllers\Controller;
use App\Initial_Leave;
use App\Leave;
use App\Meeting;
use App\Leave_backup;
use App\Leave_Category;
use App\NewUser;
use App\Project_Category;
use App\User;
use App\Forfeited;
use App\ForfeitedCounts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Storage;

class LeaveController2 extends Controller
{
   public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function deleteFormLeaveOfficer($id)
    {
        $leave = Leave::findOrFail($id);
        $forfeitedCount = ForfeitedCounts::where('leave_id', $id)->where('user_id', $leave->user_id)->first();
        if (!empty($forfeitedCount)) {
            $forfeitedCount->delete();
        }

        $leave->delete();
        Session::flash('info', Lang::get('messages.data_custom', ['data' => "The form has been successfully deleted"]));
        return back();        
    }
//end
}
