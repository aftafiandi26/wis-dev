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


class ProducerController extends Controller
{
       public function __construct()
    {
        $this->middleware(['auth', 'active', 'producer']);
        
    }
    // Start Route Approval
        public function indexApproval()
        {
            return View::make("production.indexProducerApproval");
        }
         public function getindexProdocerApproval()
        {
        $select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([
            'leave_transaction.id',
            'leave_transaction.leave_date',
            'leave_transaction.request_nik',
            'leave_transaction.request_by',
            'leave_category.leave_category_name',
            'dept_category.dept_category_name',
            'leave_transaction.total_day',  
            'leave_transaction.ap_pm',
            'leave_transaction.ap_producer',
            'leave_transaction.ap_hd',
            'leave_transaction.ver_hr'
             
        ])
        ->where('users.dept_category_id', '=', Auth::user()->dept_category_id)   
        ->where('leave_transaction.email_producer', '=', auth::user()->email)    
        ->where('leave_transaction.ap_pm', '=', 1)
        ->where('leave_transaction.ap_producer', '=', 0)
        ->where('leave_transaction.ap_hd', 0)
        ->get();

        return Datatables::of($select)
        ->edit_column('ap_pm', '@if ($ap_pm === 1){{ "APPROVED" }} @elseif ($ap_pm === 2) {{"DISAPPROVED"}} @else {{"PENDING"}} @endif') 
        ->edit_column('ap_producer', '@if ($ap_producer === 1){{"APPROVED"}} @else {{"PENDING"}} @endif')
        ->edit_column('ap_hd', '@if ($ap_hd === 0){{"WAITING PRODUCER"}} @endif')
        ->add_column('actions',             
            Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'ap_producer/detail\', [$id]) }}', 'class' => 'check-square'])            
            )
        ->make();
        }
        
        public function detailLeave($id)
        {
        $leave = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);

        $coordinator = User::where('active', 1)->where('koor', 1)->where('email', $leave->email_koor)->first();
        $spv = User::where('active', 1)->where('spv', 1)->where('email', $leave->email_spv)->first();
        $pm = User::where('active', 1)->where('email', $leave->email_pm)->first();

        $head = null;

        if ($leave->email_koor !== null) {
           $coor = $coordinator->first_name.' '.$coordinator->last_name;
        } else {
            $coor = '-';
        }        

        if ($leave->email_spv !== null) {
            $spvV = $spv->first_name.' '.$spv->last_name;
        } else {
             $spvV = '-';
        }

        if ($leave->email_pm !== null) {

          if ($pm->hd === 1) {
              $pmM =  "<strong>Head of Deparment :</strong>".$pm->first_name.' '.$pm->last_name; 
          } else {
              $pmM =  "<strong>Project Manager / Producer :</strong>".$pm->first_name.' '.$pm->last_name;

              if (auth::user()->dept_category_id === 6) {
                $head = "<strong>Head of Deparment :</strong> Ghea Lisanova"; 
              }                       
          }

        } else {
            $pmM = '-';
        }

        $return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'>Detail  </h4>
            </div>
            <div class='modal-body'>
                <div class='well'>
                    <h4><strong><u>Approval Producer </u></strong></h4>
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
                    <strong>Reason :</strong> $leave->reason_leave <br> <br>

                    <h5><strong><u>Requested Approval To</u></strong></h5>
                    <strong>Coordinator :</strong> $coor <br>
                    <strong>Supervisor :</strong> $spvV <br>
                    $pmM <br> $head
                    
                </div>
            </div>
            <div class='modal-footer'>
                <a class='btn btn-primary' href='".URL::route('ap_producer/approve', [$id])."'>Approve</a>
                <a class='btn btn-primary' href='".URL::route('ap_producer/disapprove', [$id])."'>Disapprove</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
        }
        
         public function approveLeave(Request $request, $id)
        {
            $email       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->joinProjectCategory()->find($id);

            $ap_producer      = 1;
            $date_ap_producer  = date("Y-m-d");

            if ($email->resendmail === 2) {
               $counterMail = $email->resendmail;
            }elseif($email->resendmail === 1){
               $counterMail = $email->resendmail + 1;
            }elseif($email->resendmail === 0){
                $counterMail = $email->resendmail + 2;
            }  
            
            $data        = [
                'ap_producer'      => $ap_producer,
                'producer_id'      => auth::user()->id, 
                'date_producer'    => $date_ap_producer,
                'resendmail'       => $counterMail,
            ];
        
            Leave::where('id', $id)->update($data);
            $this->sendVerEmail($email);
            Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
         
            return Redirect::route('Producer/indexApproval');        
        }

         public function sendVerEmail($email)
        {
        
        $koor_email    = DB::table('users')
                            ->select(DB::raw('email'))  
                            ->where('dept_category_id', $email->dept_category_id)
                            ->where('hd', '=', 1)
                            ->first();
        
            
            Mail::send('email.appMailProduction', ['email' => $email], function($message) use ($koor_email, $email)
            {
                $message->to($koor_email->email)->subject('Approval Request Leave Application - '.$email->request_by.'');

                $message->from(' wis_system@infinitestudios.id', 'WIS');
            });  
        }

        public function disapproveLeave(Request $request, $id)
        {
        $email       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);
        $ap_producer     = 2;
        $date_ap_producer  = date("Y-m-d");
        
        $data        = [
            'ap_producer'      => $ap_producer,
            'date_producer' => $date_ap_producer,
            'ap_hd'        => 2,
            'ver_hr'       => 2,
            'ap_hrd'       => 5,
            'resendmail'   => 0, 
        ];
        
        Leave::where('id', $id)->update($data);
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
        Mail::send('email.disapproveMail', ['email' => $email], function($message) use ($email)
            {
                $message->to($email->email)->subject('[DISAPPROVED] Leave Application - WIS');
                $message->from(' wis_system@infinitestudios.id', 'WIS');
            });
        return Redirect::route('Producer/indexApproval');    
         }

   
}
