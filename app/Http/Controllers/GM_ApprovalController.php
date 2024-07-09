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


class GM_ApprovalController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'active', 'gm']);
    }

    // Start Route Approval
    public function indexLeaveApproval()
    {

        return View::make('leave.indexGM_Approval');
    }

    public function getIndexLeaveApproval()
    {
        $select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([
            'leave_transaction.id',
            'leave_transaction.leave_date',
            'leave_transaction.request_nik',
            'leave_transaction.request_by',
            'leave_category.leave_category_name',
            'dept_category.dept_category_name',
            'leave_transaction.total_day',
            'leave_transaction.ap_gm',
            'leave_transaction.ver_hr',

        ])
            ->whereNotIn('users.id', [10, 20, 7, 1175])
            ->where('leave_transaction.ap_hd', 1)
            ->where('leave_transaction.ap_Infinite', 0)
            ->where('leave_transaction.ver_hr', 0)
            ->where('leave_transaction.ap_hrd', 0)
            ->where('leave_transaction.ap_gm', 0)
            ->get();

        return Datatables::of($select)
            ->edit_column('ap_gm', '@if($ap_gm === 1){{"APPROVED"}} @else {{"PENDING"}} @endif')
            ->edit_column('ver_hr', '@if($ver_hr === 1){{"APPROVED"}} @else{{ "WAITTING GM" }} @endif')
            ->add_column(
                'actions',
                '@if ($ap_gm === 0)' .
                    Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'ap_gm/detail\', [$id]) }}', 'class' => 'check-square'])
                    . '@endif'
            )
            ->make();
    }

    public function getIndexMikeApproval()
    {
        $select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([
            'leave_transaction.id',
            'leave_transaction.leave_date',
            'leave_transaction.request_nik',
            'leave_transaction.request_by',
            'leave_category.leave_category_name',
            'dept_category.dept_category_name',
            'leave_transaction.total_day',
            'leave_transaction.ap_gm',
            'leave_transaction.ver_hr',

        ])
            ->whereIn('users.id', [7, 10, 20, 1175])
            ->where('leave_transaction.ap_hd', 1)
            ->where('leave_transaction.ver_hr', 0)
            ->where('leave_transaction.ap_hrd', 0)
            ->where('leave_transaction.ap_gm', 0)
            ->get();

        return Datatables::of($select)
            ->edit_column('ap_gm', '@if($ap_gm === 1){{"APPROVED"}} @else {{"PENDING"}} @endif')
            ->edit_column('ver_hr', '@if($ver_hr === 1){{"APPROVED"}} @else{{ "WAITTING GM" }} @endif')
            ->add_column(
                'actions',
                '@if ($ap_gm === 0)' .
                    Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'ap_gm/detail\', [$id]) }}', 'class' => 'check-square'])
                    . '@endif'
            )
            ->make();
    }

    public function detailLeave($id)
    {
        $leave = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);

        $coor = null;
        $spv = null;
        $spvV = null;
        $pm = null;
        $pmM = null;
        $head = null;

        if (!empty($leave->email_koor)) {
            $coor = User::where('active', 1)->where('email', $leave->email_koor)->first();
            $coor = $coor->first_name . ' ' . $coor->last_name;
        }

        if (!empty($leave->email_spv)) {
            $spv = User::where('active', 1)->where('email', $leave->email_spv)->first();
            $spvV = $spv->first_name . ' ' . $spv->last_name;
        }

        if (!empty($leave->email_pm)) {
            $pm = User::where('active', 1)->where('email', $leave->email_pm)->first();

            if ($pm->hd === 1) {
                $pmM =  "<strong>Head of Deparment :</strong>" . $pm->first_name . ' ' . $pm->last_name;
            } else {
                $pmM =  "<strong>Project Manager / Producer :</strong>" . $pm->first_name . ' ' . $pm->last_name;
            }
        }

        if ($leave->dept_category_id === 6) {
            $head = "<strong>Head of Deparment :</strong> Ghea Lisanova";
        }

        $return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'>Detail  </h4>
            </div>
            <div class='modal-body'>
                <div class='well'>
                    <h4><strong><u>Approval </u></strong></h4>
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
                   
                    <h5><strong><u>Additional</u></strong></h5>
                    <strong>Destination :</strong> $leave->r_departure - $leave->r_after_leaving <br>
                    <strong>Reason :</strong> $leave->reason_leave <br> <br>

                    <h5><strong><u>Requested Approval To</u></strong></h5>
                    <strong>Coordinator :</strong> $coor <br>
                    <strong>Supervisor :</strong> $spvV <br>
                    $pmM <br> $head

                </div>
            </div>
            <div class='modal-footer'>
                <a class='btn btn-primary' href='" . URL::route('ap_gm/approve', [$id]) . "'>Approve</a>
                <a class='btn btn-primary' href='" . URL::route('ap_gm/disapprove', [$id]) . "'>Disapprove</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

    public function approveLeave(Request $request, $id)
    {
        $email       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);
        $ap_gm       = 1;
        $date_ap_gm  = date("Y-m-d");

        if ($email->resendmail === 2) {
            $counterMail = $email->resendmail;
        } elseif ($email->resendmail === 1) {
            $counterMail = $email->resendmail + 1;
        } elseif ($email->resendmail === 0) {
            $counterMail = $email->resendmail + 2;
        }

        $data        = [
            'ap_gm'      => $ap_gm,
            'date_ap_gm' => $date_ap_gm,
            'resendmail' => $counterMail,
        ];

        Leave::where('id', $id)->update($data);
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
        Mail::send('email.approvedMail', ['email' => $email], function ($message) use ($email) {
            $message->to('hr.verification@infinitestudios.id', 'WIS')->subject('[Approved] Leave Application - WIS');
            $message->from('wis_system@infinitestudios.id', 'WIS');
        });
        return Redirect::route('leave/GM_approval');
    }

    public function disapproveLeave(Request $request, $id)
    {
        $email  = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);
        $ap_gm  = 2;

        $data   = [
            'ap_producer' => 1,
            'ap_hd'       => 1,
            'ap_gm'      => $ap_gm,
            'date_ap_gm' => date('Y-m-d'),
            'resendmail' => 0
        ];

        Leave::where('id', $id)->update($data);
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
        Mail::send('email.disapproveMail', ['email' => $email], function ($message) use ($email) {
            $message->to($email->email)->subject('[Disapproved] Leave Application - WIS');
            $message->from('wis_system@infinitestudios.id', 'WIS');
        });
        return Redirect::route('leave/GM_approval');
    }

    // End Route Approval
}