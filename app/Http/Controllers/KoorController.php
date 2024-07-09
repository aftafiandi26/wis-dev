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


class KoorController extends Controller
{
       public function __construct()
    {
        $this->middleware(['auth', 'active', 'koor']);
        
    }
    // Start Route Approval
		public function indexKoorApproval()
    {
    	
    	return View::make('production.indexKoorApproval');
    }

   public function getindexKoor_Approval()
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
            'leave_transaction.ap_spv',
            'leave_transaction.req_advance'         
             
        ])
        ->where('users.dept_category_id', '=', Auth::user()->dept_category_id)   
        ->where('leave_transaction.email_koor', '=', auth::user()->email)
        ->where('leave_transaction.ap_koor', '=', 0)
        ->get();

        return Datatables::of($select)        
        ->edit_column('ap_koor', '@if ($ap_koor === 1){{ "APPROVED" }} @else {{"PENDING"}} @endif')
        ->edit_column('ap_spv', '@if ($ap_spv === 1){{ "--" }} @else {{"WAITING COORDINATOR"}} @endif')
        ->setRowClass('@if ($req_advance === 1){{ "danger" }}@endif')
        ->add_column('actions',             
            Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'ap_koor/detail\', [$id]) }}', 'class' => 'check-square'])            
            )
        ->make();
    }

    public function getIndexKoorIT()
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
            'leave_transaction.ap_hd',
            'leave_transaction.req_advance'         
             
        ])
        ->where('users.dept_category_id', '=', Auth::user()->dept_category_id)   
        ->where('leave_transaction.email_koor', '=', auth::user()->email)
        ->where('leave_transaction.ap_koor', '=', 0)
        ->where('leave_transaction.ap_spv', 1)        
        ->get();

        return Datatables::of($select)        
        ->edit_column('ap_koor', '@if ($ap_koor === 1){{ "APPROVED" }} @else {{"PENDING"}} @endif')
        ->edit_column('ap_hd', '@if ($ap_hd === 1){{ "--" }} @else {{"WAITING COORDINATOR"}} @endif')
        ->setRowClass('@if ($req_advance === 1){{ "danger" }}@endif')
         ->add_column('actions',             
            Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'ap_koor/detail/it\', [$id]) }}', 'class' => 'check-square'])            
            )
        ->make();
    }

    public function detailLeaveIT($id)
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
                    <h4><strong><u>Approval Coordinator </u></strong></h4>
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
                <a class='btn btn-primary' href='".URL::route('ap_koor/approve', [$id])."'>Approve</a>
                <a class='btn btn-primary' href='".URL::route('ap_koor/disapprove', [$id])."'>Disapprove</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
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
                    <h4><strong><u>Approval Coordinator </u></strong></h4>
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
                <a class='btn btn-primary' href='".URL::route('ap_koor/approve', [$id])."'>Approve</a>
                <a class='btn btn-primary' href='".URL::route('ap_koor/disapprove', [$id])."'>Disapprove</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

    public function approveLeave(Request $request, $id)
    {
        $email       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->joinProjectCategory()->find($id);     

        $ap_koor      = 1;
        $date_ap_koor  = date("Y-m-d");

        if ($email->resendmail === 2) {
           $counterMail = $email->resendmail;
        }elseif($email->resendmail === 1){
           $counterMail = $email->resendmail + 1;
        }elseif($email->resendmail === 0){
            $counterMail = $email->resendmail + 2;
        }       
        //Line GM adalah special case 1 untuk staff production yang tidak memiliki PM yang langsung di direct ke producer
        if ($email->lineGM === 1) {

            if ($email->email_spv === null) {
                $data        = [
                'ap_koor'           => $ap_koor,
                'coordinator_id'    => auth::user()->id,
                'ap_pm'             => 1,
                'ap_spv'            => 1,
                'ap_producer'       => 1,
                'date_ap_pm'        => date('Y-m-d'),
                'date_ap_spv'       => date('Y-m-d'),
                'date_ap_koor'      => $date_ap_koor,
                'resendmail'        => $counterMail,
                ]; 

            } else {
               $data        = [
                'ap_koor'           => $ap_koor,
                'coordinator_id'    => auth::user()->id,
                'ap_pm'             => 1,                
                'ap_producer'       => 1,
                'date_ap_pm'        => date('Y-m-d'),
                'date_ap_koor'      => $date_ap_koor,
                'resendmail'        => $counterMail,
                ];  
            }        

        } else {

            if ($email->email_spv === null) {
                $data = [
                    'ap_koor'           => 1,
                    'ap_spv'            => 1,
                    'date_ap_spv'       => date('Y-m-d'),
                    'coordinator_id'    => auth::user()->id,
                    'date_ap_koor'      => $date_ap_koor,
                    'resendmail'        => $counterMail,
                ];
            } else {
                $data = [
                    'ap_koor'      => $ap_koor,
                    'coordinator_id'    => auth::user()->id,
                    'date_ap_koor' => $date_ap_koor,
                    'resendmail'   => $counterMail,
                ];
            }

        }  

        // dd($data);      
    
         Leave::where('id', $id)->update($data);

         $this->sendemail($email);   

        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
        return Redirect::route('Koordinator/indexApproval');        
    }

    public function sendemail($email)
    {
        $pm = NewUser::joinDeptCategory()
                ->where('users.pm', '=', 1)
                ->where('users.dept_category_id', '=', $email->dept_category_id)
                ->where('users.email', '=', $email->email_pm)
                ->first();

        if ($email->email_spv != null) {
            Mail::send('email.appMailProduction', ['email' => $email], function($message) use ($email)
            {          
             $message->to($email->email_spv)->subject('Approval Request Leave Application - '.$email->request_by.'');
                      
             $message->from(' wis_system@infinitestudios.id', 'WIS');
            });
        } else {
            Mail::send('email.appMailProduction', ['email' => $email], function($message) use ($email)
            {
          
             $message->to($email->email_pm)->subject('Approval Request Leave Application - '.$email->request_by.'');
                      
             $message->from(' wis_system@infinitestudios.id', 'WIS');
            });
        }
       
    }

   public function sendVerEmail($email)
    {  
        $koor_email    = DB::table('users')
                            ->select(DB::raw('*'))
                            ->where('dept_category_id', '=', $email->dept_category_id)
                            ->where('pm', '=', 1)
                            ->where('project_category_id_1', '=', $email->project_category_id_1)                           
                            ->pluck('email'); 
          /*  return dd($koor_email);*/
          
           Mail::send('email.appMailProduction', ['email' => $email], function($message) use ($koor_email, $email)
            {
            foreach ($koor_email as $e ) {
                $message->to($e)->subject('Approval Request Leave Application - '.$email->request_by.'');
            }             
             $message->from(' wis_system@infinitestudios.id', 'WIS');
            });
               
    }

    public function sendVerEmail2($email)
    {  
        $koor_email    = DB::table('users')
                            ->select(DB::raw('*'))
                            ->where('dept_category_id', '=', $email->dept_category_id)
                            ->where('pm', '=', 1)
                            ->where('project_category_id_2', '=', $email->project_category_id_1)                      
                            ->pluck('email'); 
          /*  return dd($koor_email);*/
          
           Mail::send('email.appMailProduction', ['email' => $email], function($message) use ($koor_email, $email)
            {
            foreach ($koor_email as $e ) {
                $message->to($e)->subject('Approval Request Leave Application - '.$email->request_by.'');
            }             
             $message->from(' wis_system@infinitestudios.id', 'WIS');
            });
               
    }

    public function sendVerEmail3($email)
    {  
        $koor_email    = DB::table('users')
                            ->select(DB::raw('*'))
                            ->where('dept_category_id', '=', $email->dept_category_id)
                            ->where('pm', '=', 1)
                            ->where('project_category_id_3', '=', $email->project_category_id_1)                      
                            ->pluck('email'); 
          /*  return dd($koor_email);*/
          
           Mail::send('email.appMailProduction', ['email' => $email], function($message) use ($koor_email, $email)
            {
            foreach ($koor_email as $e ) {
                $message->to($e)->subject('Approval Request Leave Application - '.$email->request_by.'');
            }             
             $message->from(' wis_system@infinitestudios.id', 'WIS');
            });
               
    }

    public function sendVerEmail4($email)
    {  
        $koor_email    = DB::table('users')
                            ->select(DB::raw('*'))
                            ->where('dept_category_id', '=', $email->dept_category_id)
                            ->where('pm', '=', 1)
                            ->where('project_category_id_4', '=', $email->project_category_id_1)                      
                            ->pluck('email'); 
          /*  return dd($koor_email);*/
          
           Mail::send('email.appMailProduction', ['email' => $email], function($message) use ($koor_email, $email)
            {
            foreach ($koor_email as $e ) {
                $message->to($e)->subject('Approval Request Leave Application - '.$email->request_by.'');
            }             
             $message->from(' wis_system@infinitestudios.id', 'WIS');
            });
               
    }

    public function sendVerEmail5($email)
    {  
        $koor_email    = DB::table('users')
                            ->select(DB::raw('*'))
                            ->where('dept_category_id', '=', $email->dept_category_id)
                            ->where('pm', '=', 1)
                            ->where('project_category_id_5', '=', $email->project_category_id_1)                      
                            ->pluck('email'); 
          /*  return dd($koor_email);*/
          
           Mail::send('email.appMailProduction', ['email' => $email], function($message) use ($koor_email, $email)
            {
            foreach ($koor_email as $e ) {
                $message->to($e)->subject('Approval Request Leave Application - '.$email->request_by.'');
            }             
             $message->from(' wis_system@infinitestudios.id', 'WIS');
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
            'ap_koor'      => $ap_koor,
            'ap_spv'       => $ap_koor,
            'ap_pm'        => 2,
            'ap_producer'  => 2,
            'ap_hd'        => 2,
            'ver_hr'       => 2,
            'ap_hrd'       => 5,
            'date_ap_koor' => $date_ap_koor,
            'resendmail'   => $counterMail, 
        ];
        
        Leave::where('id', $id)->update($data);
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
        Mail::send('email.disapproveMail', ['email' => $email], function($message) use ($email)
            {
                $message->to($email->email)->subject('[DISAPPROVED] Leave Application - WIS');
                $message->from(' wis_system@infinitestudios.id', 'WIS');
            });
        return Redirect::route('Koordinator/indexApproval');    
    }
    
     public function indexHistoriKoor()
    {
        return View::make('production.indexHistoriKoor');
    }

    public function getHistoriKoor()
    {
         $select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([
            'leave_transaction.id',
            'users.nik',
            'leave_transaction.request_by',
            'leave_category.leave_category_name',
            'leave_transaction.leave_date',
            'leave_transaction.total_day',
            'leave_transaction.ap_koor',
            'leave_transaction.ap_spv',
            'leave_transaction.ap_pm',
            'leave_transaction.ap_producer',           
            'leave_transaction.ap_hd',
             'leave_transaction.ver_hr',
            'leave_transaction.leave_cancel'
        ])
           ->where('users.project_category_id_1', '=', Auth::user()->project_category_id_1)
         ->get();

        return Datatables::of($select)
          ->edit_column('ap_koor', '@if ($ap_koor === 1) {{"APPROVED"}} @elseif ($ap_koor === 2) {{"DISAPPROVED"}} @else {{"PENDING"}} @endif ')
         ->edit_column('ap_spv', '@if ($ap_spv === 1){{"APPROVED"}} @elseif ($ap_spv ===2){{"DISAPPROVED"}} @elseif ($ap_koor === 1 and $ap_spv === 0){{"PENDING"}} @elseif ($ap_koor === 0){{"WAITING COORDINATOR"}} @else {{"-"}} @endif')
          ->edit_column('ap_pm', '@if ($ap_pm === 1){{"APPROVED"}} @elseif ($ap_pm === 2){{"DISAPPROVED"}} @elseif ($ap_koor === 0){{"WAITING COORDINATOR"}} @elseif ($ap_spv === 0 and $ap_koor === 1){{"WAITING SPV"}} @elseif ($ap_spv === 1){{"PENDING"}} @else {{"-"}} @endif ')
          ->edit_column('ap_producer', '@if ($ap_producer === 1){{"APPROVED"}} @elseif ($ap_producer === 2){{"DISAPPROVED"}} @elseif ($ap_koor === 0){{"WAITING COORDINATOR"}} @elseif ($ap_spv === 0 and $ap_koor === 1){{"WAITING SPV"}} @elseif ($ap_pm === 0 and $ap_spv === 1){{"WAITING PM"}} @elseif ($ap_pm === 1 and $ap_producer === 0){{"PENDING"}} @else {{"-"}} @endif')
         

          ->edit_column('ap_hd', '@if ($ap_hd === 1){{"APPROVED"}} @elseif ($ap_hd === 2){{"DISAPPROVED"}} @elseif ($ap_koor === 0){{"WAITING COORDINATOR"}} @elseif ($ap_spv === 0 and $ap_koor === 1){{"WAITING SPV"}} @elseif ($ap_pm === 0 and $ap_spv === 1){{"WAITING PM"}} @elseif ($ap_pm === 1 and $ap_producer === 0){{"WAITING PRODUCER"}} @elseif ($ap_producer === 1 and $ap_hd === 0){{"PENDING"}} @else {{"-"}} @endif')

           ->edit_column('ver_hr', '@if ($ver_hr === 1){{"VERIFICATION"}} @elseif ($ver_hr === 2){{"UNVERIFICATION"}} @elseif ($ap_koor === 0){{"WAITING COORDINATOR"}} @elseif ($ap_spv === 0 and $ap_koor === 1){{"WAITING SPV"}} @elseif ($ap_pm === 0 and $ap_spv === 1){{"WAITING PM"}} @elseif ($ap_pm === 1 and $ap_producer === 0){{"WAITING PRODUCER"}} @elseif ($ap_producer === 1 and $ap_hd === 0){{"WAITING HD"}} @elseif ($ap_hd === 1 and ver_hr === 0) {{"PENDING"}} @else {{"-"}} @endif')

          ->edit_column('leave_cancel', '@if ($ap_koor === 1 and $ap_spv === 1 and $ap_pm === 1 and $ap_producer === 1 and $ver_hr === 1 and $ap_hd === 1){{"COMPLETE"}} @elseif ($ap_koor === 2 || $ap_spv === 2 || $ap_pm === 2 || $ap_producer === 2 || $ver_hr === 2 || $ap_hd === 2){{"REJECTED"}} @elseif ($ap_koor === 0 || $ap_spv === 0 || $ap_pm === 0 || $ap_producer === 0 || $ver_hr === 0 || $ap_hd === 0){{"PROGRESS"}} @endif')
          ->add_column('actions',
            Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'leave/detail\', [$id]) }}', 'class' => 'file'])     
            /*.Lang::get('messages.btn_warning', ['title' => 'Actived Transaction', 'url' => '{{ URL::route(\'hr_mgmt-data/leaveTransactionReport/uncancel\', [$id]) }}',  'class' => 'trash'])*/)           
        ->make();
    }

    /*public function tambah(Request $id)
    {
        $ap_spv = 1;
        $ap_koor = 1;
        $ap_pm = 1;
        $ap_producer = 1;

        $data =['ap_koor' => $ap_koor, 'ap_spv' => $ap_spv, 'ap_pm' => $ap_pm, 'ap_producer' => $ap_];
        return dd($data);
        Leave::select('id')->update($data);
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
         return Redirect::route('Koordinator/indexApproval');  

    }*/

    public function list76()
    {
        return View::make('production.listMemberKoor');
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

    public function indexSummaryApprovedCoordinator()
    {
        return view('leave.NewAnnual.historiLeaveing');
    }

    public function getDataSummaryApprovedCoordinator()
    {
        $model = Leave::where('email_koor', auth::user()->email)
                    ->where('ap_koor', 1)
                    ->orderBy('id', 'desc')
                    ->get();

        return Datatables::of($model)
                    ->addIndexColumn()
                    ->editColumn('ap_koor', function(Leave $leave){
                        $user = NewUser::where('email', $leave->email_koor)->first();

                        if ($leave->ap_koor === 1) {
                            $ap_koor = $user->first_name.' '.$user->last_name.' Approved';
                        }
                        if ($leave->ap_koor === 2) {
                            $ap_koor = $user->first_name.' '.$user->last_name.' Disapproved';
                        }

                        return $ap_koor; 
                    })
                    ->editColumn('ap_pm', function(Leave $leave){
                        $user = NewUser::where('email', $leave->email_pm)->first();

                        if ($leave->ap_pm === 1) {
                            $ap_pm = $user->first_name.' '.$user->last_name.' Approved';
                        }
                        if ($leave->ap_pm === 0) {
                            $ap_pm = $user->first_name.' '.$user->last_name.' Please Approval';
                        }
                        if ($leave->ap_pm === 2) {
                            $ap_pm = $user->first_name.' '.$user->last_name.' Disapproved';
                        }

                        return $ap_pm;                     
                    })
                    ->editColumn('ap_hd', function(Leave $leave){
                        $user = NewUser::where('dept_category_id', auth::user()->dept_category_id)->where('hd', 1)->where('active', 1)->first();

                        if ($leave->ap_hd === 1) {
                            $ap_hd = $user->first_name.' '.$user->last_name.' Approved';
                        }
                        if ($leave->ap_hd === 0) {
                            if ($leave->ap_koor === 1 and $leave->ap_pm === 1) {
                            $ap_hd = 'Pending';
                            }
                            if ($leave->ap_koor === 1 and $leave->ap_pm === 0) {
                            $ap_hd = 'Waitting PM';
                            }
                        }
                        if ($leave->ap_hd === 2) {
                            $ap_hd = $user->first_name.' '.$user->last_name.' Disapproved';
                        }

                        return $ap_hd;
                    })
                    ->editColumn('ver_hr', function(Leave $leave){
                    
                        if ($leave->ver_hr === 1) {
                            $ver_hr = 'Verify Success';
                        } else {
                            $ver_hr = 'Waitting Form';                  
                        }

                        return $ver_hr;
                    })
                    ->editColumn('ap_hrd', function(leave $leave){

                        if ($leave->ap_hrd === 1) {
                            $ap_hrd = 'Verify Success';
                        }elseif ($leave->ap_hrd === 2) {
                            $ap_hrd = 'Canceled';
                        }else {
                            $ap_hrd = 'Waitting Verify';
                        }

                        return $ap_hrd;
                    })
                    ->editColumn('leave_category_id', function(Leave $leave){
                        $leave_category_id = Leave_Category::findOrFail($leave->leave_category_id);

                        return $leave_category_id->leave_category_name;
                    })
                    ->make(true);
    }
}
