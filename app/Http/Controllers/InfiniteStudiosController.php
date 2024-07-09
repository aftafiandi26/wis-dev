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

class InfiniteStudiosController extends Controller
{
   public function __construct()
    {
        $this->middleware(['auth', 'active', 'infiniteStudios']);
    }

    public function indexApproval()
    {
        return view('leave.ApprovalInfinite.indexApprovalInfinite');
    }

    public function getIndexApproval()
    {
        $select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([
            'leave_transaction.id',
            'leave_transaction.leave_date',
            'leave_transaction.request_nik',
            'leave_transaction.request_by',
            'leave_category.leave_category_name',
            'dept_category.dept_category_name',
            'leave_transaction.total_day',
            'leave_transaction.ap_Infinite',   
            'leave_transaction.ver_hr',          
        ])       
        ->where('users.dept_category_id', 2) 
        ->where('users.hd', 1) 
        ->where('leave_transaction.ap_Infinite', 1)
        ->get();

        return Datatables::of($select)
        ->edit_column('ap_Infinite', '@if($ap_Infinite === 0){{"Approved"}} @else {{"Pending"}} @endif')
        ->edit_column('ver_hr', '@if($ver_hr === 1){{"Verified"}} @else {{"Waitting Approval Infinite Studio"}} @endif')
        ->add_column('actions',
            '@if ($ap_Infinite === 1)'.
            Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'detailLeaveApprovalInfinite\', [$id]) }}', 'class' => 'check-square'])
            .'@endif'
            )
        ->make();

        
    }

    public function getIndexApprovalProduction()
    {
        $select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([
            'leave_transaction.id',
            'leave_transaction.leave_date',
            'leave_transaction.request_nik',
            'leave_transaction.request_by',
            'leave_category.leave_category_name',
            'dept_category.dept_category_name',
            'leave_transaction.total_day',
            'leave_transaction.ap_Infinite',   
            'leave_transaction.ver_hr',          
        ])       
        ->where('users.dept_category_id', 6) 
        ->where('users.hd', 1) 
        ->where('leave_transaction.ap_Infinite', 1)
        ->get();

        return Datatables::of($select)
        ->edit_column('ap_Infinite', '@if($ap_Infinite === 0){{"Approved"}} @else {{"Pending"}} @endif')
        ->edit_column('ver_hr', '@if($ver_hr === 1){{"Verified"}} @else {{"Waitting Approval Infinite Studio"}} @endif')
        ->add_column('actions',
            '@if ($ap_Infinite === 1)'.
            Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'detailLeaveApprovalInfinite\', [$id]) }}', 'class' => 'check-square'])
            .'@endif'
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
            $coor = $coor->first_name.' '.$coor->last_name;           
        }

        if (!empty($leave->email_spv)) {
           $spv = User::where('active', 1)->where('email', $leave->email_spv)->first();
           $spvV = $spv->first_name.' '.$spv->last_name;
        }

        if (!empty($leave->email_pm)) {
            $pm = User::where('active', 1)->where('email', $leave->email_pm)->first();

            if ($pm->hd === 1) {
                $pmM =  "<strong>Head of Deparment :</strong>".$pm->first_name.' '.$pm->last_name;
                  
           } else {
                 $pmM =  "<strong>Project Manager / Producer :</strong>".$pm->first_name.' '.$pm->last_name;
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
                <a class='btn btn-primary' href='".URL::route('approvalInfinite', [$id])."'>Approve</a>
                <a class='btn btn-primary' href='".URL::route('disapproveLeaveInfinite', [$id])."'>Disapprove</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

    public function approveLeave(Request $request, $id)
    {
        $email      = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);
        $ap_infinite      = 0;                
        $date_ap_infinite = date("Y-m-d");
        $gm_email   = DB::table('users')
                            ->select(DB::raw('email'))
                            ->where('hr', '=', 1)
                            ->first();

        $data        = [
            'ap_infinite'       => $ap_infinite,                
            'date_ap_infinite'  => $date_ap_infinite
        ];
    
        Leave::where('id', $id)->update($data);        
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));       
            Mail::send('email.verMail', ['email' => $email], function($message) use ($email, $gm_email)
                {
                    $message->to($gm_email->email, 'WIS')->subject('[Verified] Leave Application - '.$email->request_by.'');
                    $message->from('wis_system@frameworks-studios.com', 'WIS');
                });
            Mail::send('email.Notifikasi.Leave.verByMail', ['email' => $email], function($message) use ($email)
                {
                    $message->to($email->email, 'WIS')->subject('[Approved] Leave Application - by '.auth::user()->first_name.' '.auth::user()->last_name.'');
                    $message->from('wis_system@frameworks-studios.com', 'WIS');
                });
       
        return Redirect::route('indexApprovalInfinite');
    }

    public function disapproveLeave(Request $request, $id)
    {
        $email  = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);
        $ap_hd  = 2;
        $ap_hrd = 5;
        $data   = [
            'ap_infinite'             => 2,
            'ap_pipeline'             => 2,      
            'date_ap_infinite'        => date("Y-m-d"),
            'date_ap_pipeline'  => date("Y-m-d"),
            'ap_hrd'            => 5,
            'date_ap_hrd'       => date("Y-m-d"),
        ];
    
        Leave::where('id', $id)->update($data);
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
        Mail::send('email.disapproveMail', ['email' => $email], function($message) use ($email)
            {
                $message->to($email->email, 'WIS')->subject('[Disapproved] Leave Application - WIS');
                $message->from('wis_system@frameworks-studios.com', 'WIS');
            });
        return Redirect::route('indexApprovalInfinite');
        
    }
}
