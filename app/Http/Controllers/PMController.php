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



class PMController extends Controller
{
   public function __construct()
    {
        $this->middleware(['auth', 'active', 'pm']);
        
    }
    	public function indexPMApproval()
    {
    	
    	return View::make('production.indexPMApproval');
    }

   public function getindexPMApproval()
    {
        $select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([
            'leave_transaction.id',
            'leave_transaction.leave_date',
            'leave_transaction.request_nik',
            'leave_transaction.request_by',
            'leave_category.leave_category_name',
            'dept_category.dept_category_name',
            'leave_transaction.total_day',          
            'leave_transaction.ap_koor',
            'leave_transaction.ap_pm',
            'leave_transaction.ap_hd',
            'leave_transaction.req_advance'
        ])
        ->where('users.dept_category_id', '=', Auth::user()->dept_category_id)     
        ->where('leave_transaction.email_pm', '=', auth::user()->email)    
        ->where('leave_transaction.ap_koor', '=', 1)
        ->where('leave_transaction.ap_spv', '=', 1)
        ->where('leave_transaction.ap_pm', '=', 0)
        ->get();

        return Datatables::of($select)
        ->edit_column('ap_koor', '@if ($ap_koor === 1){{ "APPROVED" }} @elseif ($ap_koor === 2) {{"DISAPPROVED"}} @else {{"PENDING"}} @endif') 
        ->edit_column('ap_pm', '@if ($ap_pm === 0){{"PENDING"}} @endif')
        ->edit_column('ap_hd', '@if($ap_pm === 0){{"WAITTING PM"}} @else {{"PENDING"}} @endif')
         ->setRowClass('@if ($req_advance === 1){{ "danger" }}@endif')
        ->add_column('actions',             
            Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'ap_pm/detail\', [$id]) }}', 'class' => 'check-square'])            
            )
        ->make();
    }
    public function getindexPMApproval2()
    {
        $select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([
            'leave_transaction.id',
            'leave_transaction.leave_date',
            'leave_transaction.request_nik',
            'leave_transaction.request_by',
            'leave_category.leave_category_name',
            'dept_category.dept_category_name',
            'leave_transaction.total_day',          
            'leave_transaction.ap_spv',
            'leave_transaction.ap_pm',
            'leave_transaction.ap_producer'
        ])
        ->where('users.dept_category_id', '=', Auth::user()->dept_category_id)      
        ->where('users.project_category_id_1', '=', Auth::user()->project_category_id_2)      
        ->where('leave_transaction.ap_koor', '=', 1)
        ->where('leave_transaction.ap_spv', '=', 1)
        ->where('leave_transaction.ap_pm', '=', 0)
        ->get();

        return Datatables::of($select)
        ->edit_column('ap_spv', '@if ($ap_spv === 1){{ "APPROVED" }} @elseif ($ap_spv === 2) {{"DISAPPROVED"}} @else {{"PENDING"}} @endif') 
        ->edit_column('ap_pm', '@if ($ap_pm === 0){{"PENDING"}} @endif')
        ->edit_column('ap_producer', '@if ($ap_producer === 0){{"WAITING PM"}} @endif')
        ->add_column('actions',             
            Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'ap_pm/detail2\', [$id]) }}', 'class' => 'check-square'])            
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
                <h4 class='modal-title' id='showModalLabel'>Detail</h4>
            </div>
            <div class='modal-body'>
                <div class='well'>
                    <h4><strong><u>Approval Project Manager </u></strong></h4>
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
                    <strong>Total Day :</strong> $leave->total_day <br>
                    <strong>Balance :</strong> $leave->pending <br>
                    <strong>Remain :</strong> $leave->remain <br>
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
                <a class='btn btn-primary' href='".URL::route('ap_pm/approve', [$id])."'>Approve</a>
                <a class='btn btn-primary' href='".URL::route('ap_pm/disapprove', [$id])."'>Disapprove</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

     public function detailLeave2($id)
    {
        $leave = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);
        $return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'>Detail  </h4>
            </div>
            <div class='modal-body'>
                <div class='well'>
                    <h4><strong><u>Approval Project Manager </u></strong></h4>
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
                </div>
            </div>
            <div class='modal-footer'>
                <a class='btn btn-primary' href='".URL::route('ap_pm/approve', [$id])."'>Approve</a>
                <a class='btn btn-primary' href='".URL::route('ap_pm/disapprove', [$id])."'>Disapprove</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

     public function approveLeave(Request $request, $id)
    {
        $email       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->joinProjectCategory()->find($id);
        $ap_pm      = 1;
        $date_ap_pm  = date("Y-m-d");
      
        if ($email->spv === 1) {
             $ap_producer = 0;
        } else {
            $ap_producer  = 1;
        }
        
        $date_ap_producer  = date("Y-m-d");

        if ($email->resendmail === 2) {
           $counterMail = $email->resendmail;
        }elseif($email->resendmail === 1){
           $counterMail = $email->resendmail + 1;
        }elseif($email->resendmail === 0){
            $counterMail = $email->resendmail + 2;
        }
              
        $data        = [
            'ap_pm'         => $ap_pm,
            'pm_id'         => auth::user()->id,
            'date_ap_pm'    => $date_ap_pm,
            'ap_producer'   => $ap_producer,
            'date_producer' => $date_ap_producer,
            'resendmail'    => $counterMail,
        ];   
    
        Leave::where('id', $id)->update($data);

        if ($email->spv === 1) {
            $this->sendVerEmail($email); 
        } else {
            $this->sendVerEmails($email); 
        }
        
        $this->sendVerEmails($email);     
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
        return Redirect::route('ProjectManager/indexApproval');        
    }

    public function sendVerEmail($email)
    {        
        $koor_email    = DB::table('users')
                            ->select(DB::raw('email'))
                            ->where('dept_category_id', '=', $email->dept_category_id)
                            ->where('email', '=', $email->email_producer)
                            ->where('producer', '=', 1)
                            ->first();        

            Mail::send('email.appMailProduction', ['email' => $email], function($message) use ($koor_email, $email)
            {
                $message->to($koor_email->email)->subject('Approval Request Leave Application - '.$email->request_by.'');

                $message->from('wis_system@infinitestudios.id', 'WIS');
            });  
    }

    public function sendVerEmails($email)
    {
         $koor_email    = DB::table('users')
                            ->select(DB::raw('email'))
                            ->where('dept_category_id', '=', 6)
                            ->where('hd', '=', 1)
                            ->first();        
            
            Mail::send('email.appMailProduction', ['email' => $email], function($message) use ($koor_email, $email)
            {
                $message->to($koor_email->email)->subject('Approval Request Leave Application - '.$email->request_by.'');               
                $message->from('wis_system@infinitestudios.id', 'WIS');
            });  
    }

    public function disapproveLeave(Request $request, $id)
    {
        $email       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);
        $ap_koor      = 2;
        $date_ap_koor  = date("Y-m-d");

        if ($email->resendmail === 2) {
           $counterMail = $email->resendmail - 2;
        }elseif($email->resendmail === 1){
           $counterMail = $email->resendmail - 1;
        }elseif($email->resendmail === 0){
            $counterMail = $email->resendmail;
        }
        
        $data        = [
            'ap_pm'         => $ap_koor,
            'ap_producer'   => $ap_koor,
            'date_ap_pm' => $date_ap_koor,
            'date_producer' => $date_ap_koor,
            'resendmail'  => $counterMail,
            'ap_hd'        => 2,
            'ver_hr'       => 2,
            'ap_hrd'       => 5,
            'resendmail'   => $counterMail, 
        ];
         // dd($data);
        Leave::where('id', $id)->update($data);
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
        Mail::send('email.disapproveMail', ['email' => $email], function($message) use ($email)
            {
                $message->to($email->email)->subject('[DISAPPROVED] Leave Application - WIS');
                $message->from('wis_system@infinitestudios.id', 'WIS');
            });
        return Redirect::route('ProjectManager/indexApproval');    
    }
   
    public function list76()
    {
        return View::make('production.listMember');
    }

    public function getlist76()
    {
        $select = DB::table('users')->select([
           'users.id',
           'users.nik',
           'users.username',
           'users.first_name',
           'users.last_name'
           
        ])
        
         ->orWhere(function($query)
            {
                $query ->where('users.project_category_id_1', '=', auth::user()->project_category_id_1)
                      ->orWhere('users.project_category_id_2', '=', auth::user()->project_category_id_1)
                       ->orWhere('users.project_category_id_3', '=', auth::user()->project_category_id_1)
                        ->orWhere('users.project_category_id_4', '=', auth::user()->project_category_id_1)
                         ->orWhere('users.project_category_id_5', '=', auth::user()->project_category_id_1);
            })
        ->where('users.active', '=', 1)
        ->get();

        return Datatables::of($select) 
        ->make();
    }

    public function getlist2()
    {
        $select = DB::table('users')->select([
           'users.id',
           'users.nik',
           'users.username',
           'users.first_name',
           'users.last_name'
           
        ])
         ->orWhere(function($query)
            {
                $query ->where('users.project_category_id_1', '=', auth::user()->project_category_id_2)
                      ->orWhere('users.project_category_id_2', '=', auth::user()->project_category_id_2)
                       ->orWhere('users.project_category_id_3', '=', auth::user()->project_category_id_2)
                        ->orWhere('users.project_category_id_4', '=', auth::user()->project_category_id_2)
                         ->orWhere('users.project_category_id_5', '=', auth::user()->project_category_id_2);
            })
       
        ->where('users.active', '=', 1)
        ->get();

        return Datatables::of($select) 
        ->make();
    }

    public function getlist3()
    {
        $select = DB::table('users')->select([
           'users.id',
           'users.nik',
           'users.username',
           'users.first_name',
           'users.last_name'
           
        ])
         ->orWhere(function($query)
            {
                $query ->where('users.project_category_id_1', '=', auth::user()->project_category_id_3)
                      ->orWhere('users.project_category_id_2', '=', auth::user()->project_category_id_3)
                       ->orWhere('users.project_category_id_3', '=', auth::user()->project_category_id_3)
                        ->orWhere('users.project_category_id_4', '=', auth::user()->project_category_id_3)
                         ->orWhere('users.project_category_id_5', '=', auth::user()->project_category_id_3);
            })
       
        ->where('users.active', '=', 1)
        ->get();

        return Datatables::of($select) 
        ->make();
    }

    public function getlist4()
    {
        $select = DB::table('users')->select([
           'users.id',
           'users.nik',
           'users.username',
           'users.first_name',
           'users.last_name'
           
        ])
         ->orWhere(function($query)
            {
                $query ->where('users.project_category_id_1', '=', auth::user()->project_category_id_4)
                      ->orWhere('users.project_category_id_2', '=', auth::user()->project_category_id_4)
                       ->orWhere('users.project_category_id_3', '=', auth::user()->project_category_id_4)
                        ->orWhere('users.project_category_id_4', '=', auth::user()->project_category_id_4)
                         ->orWhere('users.project_category_id_5', '=', auth::user()->project_category_id_4);
            })
       
        ->where('users.active', '=', 1)
        ->get();

        return Datatables::of($select) 
        ->make();
    }

     public function getlist5()
    {
        $select = DB::table('users')->select([
           'users.id',
           'users.nik',
           'users.username',
           'users.first_name',
           'users.last_name'
           
        ])
         ->orWhere(function($query)
            {
                $query ->where('users.project_category_id_1', '=', auth::user()->project_category_id_5)
                      ->orWhere('users.project_category_id_2', '=', auth::user()->project_category_id_5)
                       ->orWhere('users.project_category_id_3', '=', auth::user()->project_category_id_5)
                        ->orWhere('users.project_category_id_4', '=', auth::user()->project_category_id_5)
                         ->orWhere('users.project_category_id_5', '=', auth::user()->project_category_id_5);
            })
       
        ->where('users.active', '=', 1)
        ->get();

        return Datatables::of($select) 
        ->make();
    }

    public function indexSummaryApprovedPM()
    {
        return view('leave.NewAnnual.historiLeaveingPM');
    }

    public function getDataSummaryApprovedPM()
    {
        $model = Leave::where('email_pm', auth::user()->email)
                    ->where('ap_koor', 1)
                    ->where('ap_spv', 1)
                    ->where('ap_pm', 1)
                    ->orderBy('id', 'desc')
                    ->get();

        return Datatables::of($model)
                    ->addIndexColumn()
                    ->editColumn('ap_koor', function(Leave $leave){
                        $user = NewUser::where('email', $leave->email_koor)->first();
                       
                        if ($leave->ap_koor === 1) {
                            $return = $user->first_name.' '.$user->last_name.' Approved';
                        }
                        if ($leave->ap_koor === 2) {
                            $return = $user->first_name.' '.$user->last_name.' Disapproved';
                        }

                        return $return; 
                    })
                    ->editColumn('ap_pm', function(Leave $leave){
                        $user = NewUser::where('email', $leave->email_pm)->first();

                        if ($leave->ap_pm === 1) {
                            $return = $user->first_name.' '.$user->last_name.' Approved';
                        }
                        if ($leave->ap_pm === 0) {
                            $return = $user->first_name.' '.$user->last_name.' Please Approval';
                        }
                        if ($leave->ap_pm === 2) {
                            $return = $user->first_name.' '.$user->last_name.' Disapproved';
                        }

                        return $return;                     
                    })
                    ->editColumn('ap_hd', function(Leave $leave){
                        $user = NewUser::where('dept_category_id', 6)->where('hd', 1)->where('active', 1)->first();

                        if ($leave->ap_hd === 1) {
                            $return = $user->first_name.' '.$user->last_name.' Approved';
                        }
                        if ($leave->ap_hd === 0) {
                            if ($leave->ap_koor === 1 and $leave->ap_pm === 1) {
                            $return = 'Pending';
                            }
                            if ($leave->ap_koor === 1 and $leave->ap_pm === 0) {
                            $return = 'Waitting PM';
                            }
                        }
                        if ($leave->ap_hd === 2) {
                            $return = $user->first_name.' '.$user->last_name.' Disapproved';
                        }

                        return $return;
                    })
                    ->editColumn('ver_hr', function(Leave $leave){
                    
                        if ($leave->ver_hr === 1) {
                            $return = 'Verify Success';
                        } else {
                            $return = 'Waitting Form';                  
                        }

                        return $return;
                    })
                    ->editColumn('ap_hrd', function(leave $leave){

                        if ($leave->ap_hrd === 1) {
                            $return = 'Verify Success';
                        }                       
                        elseif ($leave->ap_hrd === 2) {
                            $return = 'Canceled';
                        }
                        else {
                            $return = 'Waitting Verify';
                        }

                        return $return;
                    })
                    ->editColumn('leave_category_id', function(Leave $leave){
                        $return = Leave_Category::findOrFail($leave->leave_category_id);

                        return $return->leave_category_name;
                    })
                    ->make(true);
    }

}

