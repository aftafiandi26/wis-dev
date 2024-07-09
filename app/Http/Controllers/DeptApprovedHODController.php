<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\NewUser;
use App\Dept_Category;
use App\Leave;
use App\Leave_Category;
use App\Initial_Leave;
use Mail;
use DB;

class DeptApprovedHODController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'deptApprovedHOD']);
    }

    public function index()
    {
        return view('HeadOfDepartment.DeptApprovedHod.index');
    }

    public function dataIndex()
    {
        $data = Leave::JoinUsers()->JoinLeaveCategory()->select(['leave_transaction.*', 'users.active', 'users.hd', 'leave_category.leave_category_name'])
            ->where('users.hd', 1)
            ->where('users.active', 1)
            ->where('leave_transaction.ap_producer', 0)
            ->where('leave_transaction.ap_hd', 1)
            ->orderBy('updated_at', 'desc')
            ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('ap_producer', '@if ($ap_producer == 0) {{ "Pending" }} @else {{ "--" }} @endif')
            ->editColumn('ap_gm', '@if ($ap_producer == 0 && $ap_gm == 0) {{ "Waiting FA Manager" }} @else {{ "--" }} @endif')
            ->addColumn('action', function (Leave $leave) {
                $approve = '<a class="btn btn-xs btn-success" title="Approved" data-toggle="modal" data-target="#showModal" data-role="' . route('head-of-approval/approval', $leave->id) . '"><span class="fa fa-check-square"></span></a> ';

                return $approve;
            })
            ->make(true);
    }

    public function approval($id)
    {
        $leave = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);

        $return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'>Form Approval $id </h4>
            </div>
            <div class='modal-body'>
                <div class='well'>
                    <h4><strong><u>Approval	</u></strong></h4>
                    <strong>Request by :</strong> $leave->first_name $leave->last_name<br>
                    <strong>Period :</strong> $leave->period <br>
                    <strong>Join Date :</strong> $leave->join_date <br>
                    <strong>NIK :</strong> $leave->nik <br>
                    <strong>Position :</strong> $leave->position <br>
                    <strong>Department :</strong> $leave->dept_category_name <br>
                    <strong>Contact Address :</strong> $leave->address <br>
                    <strong>Leave Category :</strong> $leave->leave_category_name <br>
                    <strong>Start Leave :</strong> $leave->leave_date <br>
                    <strong>End Leave :</strong> $leave->end_leave_date <br>
                    <strong>Back to Work:</strong> $leave->back_work <br>
                    <strong>Total Annual :</strong> $leave->pending <br>
                    <strong>Request Day :</strong> $leave->total_day <br>
                    <strong>Total Balance :</strong> $leave->remain <br>
                </div>
                <div class='well'>
                    <h5><u>Additional</u></h5>
                    <strong>Destination :</strong> $leave->r_departure - $leave->r_after_leaving <br>
                    <strong>Reason :</strong> $leave->reason_leave
                </div>
            </div>
            <div class='modal-footer'>
                <a class='btn btn-primary' href='" . route('head-of-approval/approval/post', [$id]) . "'>Approve</a>
                <a class='btn btn-primary' href='" . route('head-of-approval/disapproval/post', [$id]) . "'>Disapprove</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

    public function approvalPost($id)
    {
        $email = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);

        $user = User::find(auth::user()->id);

        $hr = User::select(['email', 'first_name', 'last_name'])->where('hr', 1)->first();

        if ($email->resendmail === 2) {
            $counterMail = $email->resendmail;
        } elseif ($email->resendmail === 1) {
            $counterMail = $email->resendmail + 1;
        } elseif ($email->resendmail === 0) {
            $counterMail = $email->resendmail + 2;
        }
        $data = [
            'ap_producer' => 1,
            'resendmail'    => $counterMail
        ];

        Leave::where('id', $id)->update($data);

        Mail::send('email.verMail', ['email' => $email], function ($message) use ($email, $hr) {
            $message->to($hr->email)->subject('[Approved] Leave Application - WIS');
            $message->from('wis_system@frameworks-studios.com', 'WIS');
        });

        Mail::send('email.callBackMail', ['email' => $email, 'user' => $user, 'hr' => $hr], function ($message) use ($email, $user) {
            $message->to($user->email)->subject('[Approved] Leave Application - WIS');
            $message->from('wis_system@frameworks-studios.com', 'WIS');
        });

        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
        return Redirect::route('head-of-approval/index');
    }

    public function disapprovalPost($id)
    {
        $email = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);

        $user = User::find(auth::user()->id);

        $hr = User::select(['email', 'first_name', 'last_name'])->where('hr', 1)->first();

        if ($email->resendmail === 2) {
            $counterMail = $email->resendmail;
        } elseif ($email->resendmail === 1) {
            $counterMail = $email->resendmail + 1;
        } elseif ($email->resendmail === 0) {
            $counterMail = $email->resendmail + 2;
        }
        $data = [
            'ap_producer' => 2,
            'ver_hr' => 2,
            'ap_hrd' => 2,
            'ap_gm' => 2,
            'resendmail' => 0
        ];
        Leave::where('id', $id)->update($data);

        Mail::send('email.disapproveMail', ['email' => $email], function ($message) use ($email) {
            $message->to('dede.aftafiandi@frameworks-studios.com')->subject('[Disaproved] Leave Application - WIS');
            $message->from('wis_system@frameworks-studios.com', 'WIS');
        });

        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
        return Redirect::route('head-of-approval/index');
    }
}
