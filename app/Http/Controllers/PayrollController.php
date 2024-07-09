<?php

namespace App\Http\Controllers;

use App\Dept_Category;
use App\Entitled_leave_view;
use App\Events\LeaveVerificatedByHr;
use App\Http\Controllers\Controller;
use App\Initial_Leave;
use App\JobFunction_Category;
use App\Leave;
use App\Leave_Category;
use App\Log_User;
use App\NewUser;
use App\Project_Category;
use App\User;
use App\User_project;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

use Maatwebsite\Excel\Facades\Excel;
use Mail;
use Storage;
use Yajra\Datatables\Facades\Datatables;

class PayrollController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'payroll']);
        
    }

    public function indexUnpaidLeave()
    {
    	return View::make('HRDLevelAcces.Payroll.index');
    }

	public function getUnpaidLeave()
    {
    	$select = Leave::JoinUsers()->JoinDeptCategory()->JoinLeaveCategory()->select(['leave_transaction.id', 'users.nik', 'users.first_name', 'users.last_name', 'dept_category.dept_category_name', 'users.position', 'leave_transaction.back_work'])
    	->where('leave_transaction.leave_category_id', 6)
        ->get();
        return Datatables::of($select)
            
            ->make();
    }
}
