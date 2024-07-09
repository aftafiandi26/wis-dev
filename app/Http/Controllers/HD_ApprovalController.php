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

class HD_ApprovalController extends Controller {

    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hd']);
    }

    // Start Route Approval
		public function indexLeaveApproval()
    {
    	return View::make('leave.indexApproval');
    }

    public function getIndexLeaveApproval()
    {
        if (auth::user()->dept_category_id === 6) {
          $select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([
            'leave_transaction.id',
            'leave_transaction.leave_date',
            'leave_transaction.request_nik',
            'leave_transaction.request_by',
            'leave_category.leave_category_name',
            'dept_category.dept_category_name',
            'leave_transaction.total_day',           
            'leave_transaction.ap_hd',
            'leave_transaction.ver_hr',
            'leave_transaction.req_advance'
        ])       
        ->whereIn('users.dept_category_id', [6, 4])
        ->where('leave_transaction.ap_pm', 1)
        ->where('leave_transaction.ap_koor', 1)
        ->where('leave_transaction.ap_producer', 1) 
        ->where('leave_transaction.ap_hd', '=', 0)
        ->where('leave_transaction.ap_spv', 1)        
        ->get();

        return Datatables::of($select)
        ->edit_column('ap_hd', '@if ($ap_hd === 1){{ "APPROVED" }} @elseif ($ap_hd === 2){{"DISAPPROVED"}} @else {{ "PENDING" }} @endif')     
        ->edit_column('ver_hr', '@if ($ap_hd === 0){{ "WAITING HD" }}@else{{ "PENDING" }}@endif')
        ->setRowClass('@if ($req_advance === 1){{ "danger" }}@endif')
        ->add_column('actions',
            '@if ($ap_hd === 0)'.
            Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'ap_hd/detail\', [$id]) }}', 'class' => 'check-square'])
            .'@endif'
            )
        ->make();
        } else {
          $select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([
            'leave_transaction.id',
            'leave_transaction.leave_date',
            'leave_transaction.request_nik',
            'leave_transaction.request_by',
            'leave_category.leave_category_name',
            'dept_category.dept_category_name',
            'leave_transaction.total_day',           
            'leave_transaction.ap_hd',
            'leave_transaction.ver_hr',
            'leave_transaction.req_advance'
        ])
        ->whereNotIn('users.id', [1175])
        ->where('users.dept_category_id', '=', Auth::user()->dept_category_id)
        ->where('leave_transaction.ap_pm', '=', 1)          
        ->where('leave_transaction.ap_hd', '=', 0);

        return Datatables::of($select)
        ->edit_column('ap_hd', '@if ($ap_hd === 1){{ "APPROVED" }} @elseif ($ap_hd === 2){{"DISAPPROVED"}} @else {{ "PENDING" }} @endif')  
        ->edit_column('ver_hr', '@if ($ap_hd === 0){{ "WAITING HD" }}@else{{ "PENDING" }}@endif')
        ->setRowClass('@if ($req_advance === 1){{ "danger" }}@endif')
        ->add_column('actions',
            '@if ($ap_hd === 0)'.
            Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'ap_hd/detail\', [$id]) }}', 'class' => 'check-square'])
            .'@endif'
            )
        ->make();
        }       
    	 
    }

    public function getIndexLeaveApprovalForFacilities()
    {
        $select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([
            'leave_transaction.id',
            'leave_transaction.leave_date',
            'leave_transaction.request_nik',
            'leave_transaction.request_by',
            'leave_category.leave_category_name',
            'dept_category.dept_category_name',
            'leave_transaction.total_day',           
            'leave_transaction.ap_producer',
            'leave_transaction.ver_hr',
            'leave_transaction.req_advance'
        ])
        ->where('users.dept_category_id', '=', 5)
        ->where('leave_transaction.ap_pm', '=', 1)          
        ->where('leave_transaction.ap_hd', '=', 1)
        ->where('leave_transaction.ap_producer', '=', 0)
        ->where('leave_transaction.ap_Infinite', '=', 1)
        ->get();

        return Datatables::of($select)
        ->edit_column('ap_producer', '@if ($ap_producer === 1){{ "Approved" }} @elseif ($ap_producer === 2){{"Disapproved"}} @else {{ "Pending" }} @endif')  
        ->edit_column('ver_hr', '@if ($ap_producer === 0){{ "Waiting Head of Studio" }}@else{{ "PENDING" }}@endif')
         ->setRowClass('@if ($req_advance === 1){{ "danger" }}@endif')
        ->add_column('actions',
            '@if ($ap_producer === 0)'.
            Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'ap_hd/detail\', [$id]) }}', 'class' => 'check-square'])
            .'@endif'
            )
        ->make();
          
    }

     public function getIndexLeaveMiaSinaga()
    {
        $select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([
            'leave_transaction.id',
            'leave_transaction.leave_date',
            'leave_transaction.request_nik',
            'leave_transaction.request_by',
            'leave_category.leave_category_name',
            'dept_category.dept_category_name',
            'leave_transaction.total_day',           
            'leave_transaction.ap_hd',
            'leave_transaction.ver_hr',
            'leave_transaction.req_advance'
        ])
        ->whereIn('users.id', [1175])
        ->where('leave_transaction.ap_pm', '=', 1)          
        ->where('leave_transaction.ap_hd', '=', 0)
        ->get();

        return Datatables::of($select)
         ->edit_column('ap_hd', '@if ($ap_hd === 1){{ "APPROVED" }} @elseif ($ap_hd === 2){{"DISAPPROVED"}} @else {{ "PENDING" }} @endif')  
        ->edit_column('ver_hr', '@if ($ap_hd === 0){{ "WAITING HD" }}@else{{ "PENDING" }}@endif')
        ->setRowClass('@if ($req_advance === 1){{ "danger" }}@endif')
        ->add_column('actions',
            '@if ($ap_hd === 0)'.
            Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'ap_hd/detail\', [$id]) }}', 'class' => 'check-square'])
            .'@endif'
            )
        ->make();
    }

    public function getIndexLeaveHRD()
    {
        $select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([
            'leave_transaction.id',
            'leave_transaction.leave_date',
            'leave_transaction.request_nik',
            'leave_transaction.request_by',
            'leave_category.leave_category_name',
            'dept_category.dept_category_name',
            'leave_transaction.total_day', 
            'leave_transaction.ver_hr',
            'leave_transaction.ap_hrd',
            'leave_transaction.req_advance'
        ])
        ->where('users.dept_category_id', '=', 3)
        ->where('leave_transaction.ver_hr', '=', 1)  
        ->where('leave_transaction.ap_hrd', '=', 0)  
        ->get();

        return Datatables::of($select)
        ->edit_column('ver_hr', '@if($ver_hr === 1){{"Verified"}} @else {{"Pending"}} @endif')
        ->edit_column('ap_hrd', '@if($ap_hrd === 0){{"Pending"}} @endif')
        ->setRowClass('@if ($req_advance === 1){{ "danger" }}@endif')
        ->add_column('actions',
            '@if ($ap_hrd === 0)'.
            Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'ap_hrd/detail\', [$id]) }}', 'class' => 'check-square'])
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
            $coor = User::where('email', $leave->email_koor)->first();
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
        // dd($coor);
    	$return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'>Detail	</h4>
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
                    <strong>Reason :</strong> $leave->reason_leave <br> <br>

                    <h5><strong><u>Requested Approval To</u></strong></h5>
                    <strong>Coordinator :</strong> $coor <br>
                    <strong>Supervisor :</strong> $spvV <br>
                    $pmM 
                    <br> 
                    $head

                </div>
            </div>
            <div class='modal-footer'>
                <a class='btn btn-primary' href='".URL::route('ap_hd/approve', [$id])."'>Approve</a>
                <a class='btn btn-primary' href='".URL::route('ap_hd/disapprove', [$id])."'>Disapprove</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";
       
		return $return;
	}

    public function detailLeaveHRD($id)
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
                     <h5><u>Additional</u></h5>
                    <strong>Destination :</strong> $leave->r_departure - $leave->r_after_leaving <br>
                    <strong>Reason :</strong> $leave->reason_leave <br> <br>

                    <h5><strong><u>Requested Approval To</u></strong></h5>
                    <strong>Coordinator :</strong> $coor <br>
                    <strong>Supervisor :</strong> $spvV <br>
                    $pmM 
                    <br> 
                    $head

                </div>
            </div>
            <div class='modal-footer'>
                <a class='btn btn-primary' href='".URL::route('ap_hrd/approve', [$id])."'>Approve</a>
                <a class='btn btn-primary' href='".URL::route('ap_hrd/disapprove', [$id])."'>Disapprove</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";
       
        return $return;
    }

	public function approveLeave(Request $request, $id)
	{
        $email      = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);
        $ap_hd      = 1;                
        $date_ap_hd = date("Y-m-d");
        $gm_email   = DB::table('users')
                            ->select(DB::raw('email'))
                            ->where('gm', '=', 1)
                            ->where('sg', 1)
                            ->first();

        $hr_email   = DB::table('users')
                            ->select(DB::raw('email'))
                            ->where('hr', '=', 1)
                            ->first();


        if ($email->resendmail === 2) {
           $counterMail = $email->resendmail;
        }elseif($email->resendmail === 1){
           $counterMail = $email->resendmail + 1;
        }elseif($email->resendmail === 0){
            $counterMail = $email->resendmail + 2;
        }

        $user = user::find($email->user_id);

        $deptHead = user::where('dept_category_id', $user->dept_category_id)->where('hd', 1)->first(); 

        $john = user::find(10); 

        if(auth::user()->dept_category_id === 7 AND auth::user()->hd === 1){
            $data        = [
                'ap_hd'       => 1,
                'ap_pipeline' => 1,
                'ap_Infinite' => 0,
                'ap_producer' => 1,
                'ap_gm'       => 0, 
                'date_ap_Infinite' => $date_ap_hd,      
                'date_ap_hd'  => $date_ap_hd,
                'date_ap_pipeline'  => $date_ap_hd,
                'resendmail' => $counterMail
            ];  
        } else {
            $data        = [
                'ap_hd'       => 1,
                'ap_pipeline' => 1,
                'ap_Infinite' => 0,
                'ap_producer' => 1,
                'date_ap_Infinite' => $date_ap_hd,      
                'date_ap_hd'  => $date_ap_hd,
                'date_ap_pipeline'  => $date_ap_hd,
                'resendmail' => $counterMail
            ];     
        } 
	
		Leave::where('id', $id)->update($data);        
		Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));     

        if (auth::user()->dept_category_id === 7 AND auth::user()->hd === 1) {
           Mail::send('email.verMail', ['email' => $email], function($message) use ($email, $gm_email, $hr_email)
                {
                    $message->to($hr_email->email, 'WIS')->subject('[Verify] Leave Application - '.$email->request_by.'');
                    $message->from('wis_system@infinitestudios.id', 'WIS');
                });
        } else {

            Mail::send('email.verMail', ['email' => $email], function($message) use ($email, $hr_email)
                {
                    $message->to($hr_email->email, 'WIS')->subject('[Verify] Leave Application - '.$email->request_by.'');
                    $message->from('wis_system@infinitestudios.id', 'WIS');
                });
            Mail::send('email.Notifikasi.Leave.verByMail', ['email' => $email, 'deptHead' => $deptHead], function($message) use ($email, $deptHead)
                {
                    $message->to($email->email, 'WIS')->subject('[Approved] Leave Application - by '.$deptHead->first_name.''.$deptHead->last_name.'');
                    $message->from('wis_system@infinitestudios.id', 'WIS');
                });
            
        }            
       
	    return Redirect::route('leave/HD_approval');
	}

    public function approveLeaveHRD(Request $request, $id)
    {
       $email       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id); 

        $forfeited = ForfeitedCounts::where('leave_id', $id)->first();   
        
        $data        = [
            'ap_hrd'      => 1,
            'ap_hd'       => 1,
            'ap_gm'       => 1,
            'date_ap_hrd' => date("Y-m-d"),
            'resendmail'  => 0,
        ];

        if ($forfeited !== null ) {
              ForfeitedCounts::where('leave_id', $id)->update([
              'status' => 1
             ]);
        }              
        
        Leave::where('id', $id)->update($data);
      
        Mail::send('email.approvedMail', ['email' => $email], function($message) use ($email)
            {
                $message->to($email->email)->subject('[Approved] Leave Application - WIS');
                $message->from('wis_system@infinitestudios.id', 'WIS');
            });
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
       
        return Redirect::route('leave/HD_approval');
    }

    public function disapproveLeave(Request $request, $id)
    {
        $email  = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);

        if ($email->resendmail === 2) {
           $counterMail = $email->resendmail;
        }elseif($email->resendmail === 1){
           $counterMail = $email->resendmail - 1;
        }elseif($email->resendmail === 0){
            $counterMail = $email->resendmail;
        }

        $data   = [
            'ap_hd'             => 2,
            'ap_pipeline'       => 2,      
            'date_ap_hd'        => date("Y-m-d"),
            'date_ap_pipeline'  => date("Y-m-d"),
            'ap_hrd'            => 5,
            'date_ap_hrd'       => date("Y-m-d"),
            'resendmail'        => 0,
        ];
    
        Leave::where('id', $id)->update($data);
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
        Mail::send('email.disapproveMail', ['email' => $email], function($message) use ($email)
            {
                $message->to($email->email)->subject('[Disapproved] Leave Application - WIS');
                $message->from('wis_system@infinitestudios.id', 'WIS');
            });
        return Redirect::route('leave/HD_approval');
        
    }

    public function disapproveLeaveHRD(Request $request, $id)
    {
        $email       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);       
        
        $data        = [
            'ap_hd'             => 2,
            'ap_pipeline'       => 2,      
            'date_ap_hd'        => date("Y-m-d"),
            'date_ap_pipeline'  => date("Y-m-d"),
            'ap_hrd'            => 5,
            'date_ap_hrd'       => date("Y-m-d"),
            'resendmail'        => 0,
        ];
        
        Leave::where('id', $id)->update($data);
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
        Mail::send('email.disapproveMail', ['email' => $email], function($message) use ($email)
            {
                $message->to($email->email)->subject('[Disapproved] Leave Application - WIS');
                $message->from('wis_system@infinitestudios.id', 'WIS');;
            });
        return Redirect::route('leave/HD_approval');    
    }


	// End Route Approval
////////////////////////////////////
    // Histori
    public function indexHistorical()
    {
        return View::make('production.head_departement.indexGrafik');
    }

    public function indexHistori()
    {
        return View::make('production.head_departement.indexHistorical');
    }

    public function getHistory()
    {
        $select = Leave::joinLeaveCategory()->joinUsers()->joinDeptCategory()->joinProjectCategory()->select([
           'leave_transaction.id',
            'users.nik',
            'leave_transaction.request_by',
            'leave_category.leave_category_name',
            'leave_transaction.leave_date',
            'leave_transaction.back_work',
            'leave_transaction.total_day',
            'project_category.project_name',
            'leave_transaction.ap_spv',
            'leave_transaction.ap_koor',
            'leave_transaction.ap_pm',
            'leave_transaction.ap_hd',
            'leave_transaction.ap_producer',
            'leave_transaction.ver_hr',
            'leave_transaction.ap_hrd',
            'leave_transaction.leave_cancel'                
        ])
       ->where('leave_transaction.request_nik', '!=', null)
       ->where('dept_category.id', '=', Auth::user()->dept_category_id)
       ->where('users.hd', '!=', 1)
       ->where('users.hrd', '!=', 1)
       ->where('users.gm', '!=', 1);

        return Datatables::of($select)
        ->edit_column('ap_spv', '@if ($ap_spv === 1){{"Approved"}} @elseif ($ap_spv === 2){{"Disapproved"}} @else {{"Pending"}} @endif')
        ->edit_column('ap_koor', '@if ($ap_koor === 1) {{"Approved"}} @elseif ($ap_koor === 2) {{"Disapproved"}} @elseif ($ap_spv === 0) {{"Waiting SPV"}} @elseif ($ap_spv === 1) {{"Pending"}} @elseif ($ap_spv === 2) {{"--"}} @else {{"--"}} @endif')
        ->edit_column('ap_pm', '@if($ap_pm === 1){{"Approved"}} @elseif($ap_pm === 2){{"Disapproved"}} @elseif($ap_spv === 0){{"Waiting SPV"}} @elseif($ap_spv === 1 and $ap_koor === 0){{"Waiting Coordinator"}} @elseif($ap_koor === 1 and $ap_pm === 0){{"Pending"}} @else {{"--"}}  @endif')
        ->edit_column('ap_producer', '@if($ap_producer === 1){{"Approved"}} @elseif($ap_producer === 2){{"Disapproved"}} @else{{"--"}}) @endif')
        ->edit_column('ap_hd', '@if ($ap_hd === 1){{"Approved"}} @elseif($ap_hd === 2){{"Disapproved"}}  @elseif($ap_spv === 0){{"Waiting SPV"}} @elseif($ap_spv === 1 and $ap_koor === 0){{"Waiting Coordinator"}} @elseif($ap_koor === 1 and $ap_pm === 0){{"Waiting PM"}} @elseif($ap_pm === 1 and $ap_producer === 0){{"Waiting Producer"}} @elseif ($ap_producer === 1 and $ap_hd === 0){{"Pending"}} @else {{"---"}} @endif')
        ->edit_column('ver_hr', '@if($ver_hr === 1){{"Verified"}} @elseif($ver_hr === 2){{"Unverified"}} @else {{"--"}} @endif')
        ->edit_column('ap_hrd', '@if($ap_hrd === 1){{"Approved"}} @elseif($ap_hrd === 2){{"Disapproved"}} @elseif($ap_spv === 0){{"Waiting SPV"}} @elseif($ap_spv === 1 and $ap_koor === 0){{"Waiting Coordinator"}} @elseif($ap_koor === 1 and $ap_pm === 0){{"Waiting PM"}} @elseif ($ap_pm === 1 and $ap_producer === 1 and $ap_hd === 0){{"Waiting HD"}} @elseif ($ap_hd === 1 and $ver_hr === 0){{"Waiting Confirmation"}} @elseif($ver_hr === 1 and $ap_hrd === 0){{"Pending"}} @else {{"--"}}  @endif')
        ->edit_column('leave_cancel', '@if($ap_spv === 1 and $ap_koor === 1 and $ap_pm === 1 and $ap_producer === 1 and $ap_hd === 1 and $ver_hr === 1 and $ap_hrd === 1){{"SUCCESS"}} @elseif ($ap_spv === 2 or $ap_koor === 2 or $ap_pm === 2 or $ap_producer === 2 or $ap_hd === 2 or $ver_hr === 2 or $ap_hrd === 2){{"FAILED"}} @else {{"PROCESED"}} @endif')
        ->edit_column('leave_date', '{!! date("d M, Y", strtotime($leave_date)) !!}')
        ->edit_column('back_work', '{!! date("d M, Y", strtotime($back_work)) !!}')
        ->make();            
    }

     public function getHistory1()
    {
        $select = Leave::joinLeaveCategory()->joinUsers()->joinDeptCategory()->joinProjectCategory()->select([
           'leave_transaction.id',
            'users.nik',
            'leave_transaction.request_by',
            'leave_category.leave_category_name',
            'leave_transaction.leave_date',
            'leave_transaction.back_work',
            'leave_transaction.total_day',
            'leave_transaction.ap_hd',
            'leave_transaction.ver_hr',
            'leave_transaction.ap_hrd',
            'leave_transaction.leave_cancel'                
        ])
       ->where('leave_transaction.request_nik', '!=', null)
       ->where('dept_category.id', '=', Auth::user()->dept_category_id)
       ->where('users.hd', '!=', 1)
       ->where('users.hrd', '!=', 1)
       ->where('users.gm', '!=', 1);

        return Datatables::of($select)
        ->edit_column('ap_hd', '@if($ap_hd === 1){{"Approved"}} @elseif($ap_hd === 2){{"Disapproved"}} @else{{"Pending"}} @endif')
        ->edit_column('ver_hr', '@if($ver_hr === 1){{"Verified"}} @else{{"Unverified"}} @endif')
        ->edit_column('ap_hrd', '@if($ap_hrd === 1){{"Verified"}} @elseif($ap_hrd === 2){{"Unverified"}} @elseif($ap_hd === 0){{"Waiting HD"}} @elseif($ap_hd === 1 and $ver_hr === 0){{"Waiting Confirmation"}} @elseif($ver_hr === 1){{"Pending"}} @else{{"--"}} @endif')
        ->edit_column('leave_cancel', '@if($ap_hd === 1 and $ver_hr === 1 and $ap_hrd === 1){{"SUCCESS"}} @elseif ($ap_hd === 2 or $ver_hr === 2 or $ap_hrd === 2){{"FAILED"}} @else{{"PROCESED"}} @endif')
        ->edit_column('leave_date', '{!! date("d M, Y", strtotime($leave_date)) !!}')
        ->edit_column('back_work', '{!! date("d M, Y", strtotime($back_work)) !!}')
        ->make();            
    }

      public function indexWS_Availability()
    { 
        return view::make('Pipeline.Availability.index');
    }

    public function get_indexWS_Availability()
    {
        $select = Ws_Availability::select('*')
        ->where('user', '!=', 'SCRAPPED')
        ->get();
      
        return Datatables::of($select) 
            ->add_column('edit',
                Lang::get('messages.btn_warning', ['title' => 'Edit Workstation', 'url' => '{{ URL::route(\'edit-WS\', [$id]) }}', 'class' => 'pencil'])
                ) 
           ->setRowClass('notes', '@if ($notes === "SCRAPPED"){{ "danger" }}@endif')
           ->edit_column('updated_at', '{!! date("M, d Y - H:m", strtotime($updated_at)) !!} WIB')
            ->make();          
    }

    public function index_idle_Avability()
    {

        return view::make('Pipeline.Availability.index_WS_idle');
    }

    public function get_index_idle_Avability()
    {
        $select = Ws_Availability::select([
            'id', 'hostname', 'type', 'user', 'os', 'memory', 'vga', 'location', 'notes', 'update_by', 'updated_at'
        ])
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();
      
        return Datatables::of($select) 
            ->add_column('edit',
                Lang::get('messages.btn_warning', ['title' => 'Edit Workstation', 'url' => '{{ URL::route(\'edit-WS/Idle\', [$id]) }}', 'class' => 'fas fa-edit'])
            ) 
           ->setRowClass('notes', '@if ($notes === "SCRAPPED"){{ "danger" }}@endif')
           ->edit_column('updated_at', '{!! date("M, d Y - H:m", strtotime($updated_at)) !!} WIB')
            ->make();          
    }

    public function indexLegendAvailability()
    {
        $this->view_legend_z400_64gb();
        $this->view_legend_z400_48gb();
        $this->view_legend_z400_32gb();
        $this->view_legend_z400_24gb();
        $this->view_legend_z400_16gb();
        $this->view_legend_z400_12gb();
        $this->view_legend_z400_8gb();
        $this->view_legend_z400_6gb();
        $this->view_legend_z400_4gb();
        $this->view_legend_z400_0gb();

        $this->view_legend_z200i7_64gb();
        $this->view_legend_z200i7_48gb();
        $this->view_legend_z200i7_32gb();
        $this->view_legend_z200i7_24gb();
        $this->view_legend_z200i7_16gb();
        $this->view_legend_z200i7_12gb();
        $this->view_legend_z200i7_8gb();
        $this->view_legend_z200i7_6gb();
        $this->view_legend_z200i7_4gb();
        $this->view_legend_z200i7_0gb();

        $this->view_legend_z200i5_64gb();
        $this->view_legend_z200i5_48gb();
        $this->view_legend_z200i5_32gb();
        $this->view_legend_z200i5_24gb();
        $this->view_legend_z200i5_16gb();
        $this->view_legend_z200i5_12gb();
        $this->view_legend_z200i5_8gb();
        $this->view_legend_z200i5_6gb();
        $this->view_legend_z200i5_4gb();
        $this->view_legend_z200i5_0gb();

        $this->view_legend_z210_64gb();
        $this->view_legend_z210_48gb();
        $this->view_legend_z210_32gb();
        $this->view_legend_z210_24gb();
        $this->view_legend_z210_16gb();
        $this->view_legend_z210_12gb();
        $this->view_legend_z210_8gb();
        $this->view_legend_z210_6gb();
        $this->view_legend_z210_4gb();
        $this->view_legend_z210_0gb();

        $this->view_legend_z600_64gb();
        $this->view_legend_z600_48gb();
        $this->view_legend_z600_32gb();
        $this->view_legend_z600_24gb();
        $this->view_legend_z600_16gb();
        $this->view_legend_z600_12gb();
        $this->view_legend_z600_8gb();
        $this->view_legend_z600_6gb();
        $this->view_legend_z600_4gb();
        $this->view_legend_z600_0gb();

        $this->view_legend_z240_64gb();
        $this->view_legend_z240_48gb();
        $this->view_legend_z240_32gb();
        $this->view_legend_z240_24gb();
        $this->view_legend_z240_16gb();
        $this->view_legend_z240_12gb();
        $this->view_legend_z240_8gb();
        $this->view_legend_z240_6gb();
        $this->view_legend_z240_4gb();
        $this->view_legend_z240_0gb();

        $this->view_legend_z640_64gb();
        $this->view_legend_z640_48gb();
        $this->view_legend_z640_32gb();
        $this->view_legend_z640_24gb();
        $this->view_legend_z640_16gb();
        $this->view_legend_z640_12gb();
        $this->view_legend_z640_8gb();
        $this->view_legend_z640_6gb();
        $this->view_legend_z640_4gb();
        $this->view_legend_z640_0gb();

        $this->view_legend_T3620_64gb();
        $this->view_legend_T3620_48gb();
        $this->view_legend_T3620_32gb();
        $this->view_legend_T3620_24gb();
        $this->view_legend_T3620_16gb();
        $this->view_legend_T3620_12gb();
        $this->view_legend_T3620_8gb();
        $this->view_legend_T3620_6gb();
        $this->view_legend_T3620_4gb();
        $this->view_legend_T3620_0gb();

        $this->view_legend_T7910_64gb();
        $this->view_legend_T7910_48gb();
        $this->view_legend_T7910_32gb();
        $this->view_legend_T7910_24gb();
        $this->view_legend_T7910_16gb();
        $this->view_legend_T7910_12gb();
        $this->view_legend_T7910_8gb();
        $this->view_legend_T7910_6gb();
        $this->view_legend_T7910_4gb();
        $this->view_legend_T7910_0gb();

        $this->view_legend_generic_64gb();
        $this->view_legend_generic_48gb();
        $this->view_legend_generic_32gb();
        $this->view_legend_generic_24gb();
        $this->view_legend_generic_16gb();
        $this->view_legend_generic_12gb();
        $this->view_legend_generic_8gb();
        $this->view_legend_generic_6gb();
        $this->view_legend_generic_4gb();
        $this->view_legend_generic_0gb();
        return View::make('Pipeline.Availability.index_Legend');
    }

   public function view_legend_z400_64gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '64 GB')
        ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '64 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '64 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z400_64gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z400 RAM 64 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z400_48gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '48 GB')
        ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '48 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '48 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z400_48gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z400 RAM 48 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }  

    public function view_legend_z400_32gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '32 GB')
        ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '32 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '32 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z400_32gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z400 RAM 32 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z400_24gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '24 GB')
        ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '24 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '24 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z400_24gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z400 RAM 24 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    } 

    public function view_legend_z400_16gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '16 GB')
        ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '16 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '16 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z400_16gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z400 RAM 16 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z400_12gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '12 GB')
        ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '12 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '12 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z400_12gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z400 RAM 12 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }  

    public function view_legend_z400_8gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '8 GB')
        ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '8 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '8 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z400_8gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z400 RAM 8 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }  

    public function view_legend_z400_6gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '6 GB')
        ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '6 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '6 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z400_6gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z400 RAM 6 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    } 

    public function view_legend_z400_4gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '4 GB')
        ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '4 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '4 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z400_4gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z400 RAM 4 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }  

    public function view_legend_z400_0gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '0 GB')
        ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '0 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
        ->where('type', '=', 'HP z400')
        ->where('memory', '=', '0 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z400_0gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z400 RAM 0 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z200i7_64gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '64 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '64 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '64 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z200i7_64gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z200i7 RAM 64 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";

    }

    public function view_legend_z200i7_48gb()
    {

     $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '48 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '48 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '48 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z200i7_48gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z200i7 RAM 48 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z200i7_32gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '32 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '32 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '32 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z200i7_32gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z200i7 RAM 32 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z200i7_24gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '24 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '24 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '24 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z200i7_24gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z200i7 RAM 24 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z200i7_16gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '16 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '16 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '16 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z200i7_16gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z200i7 RAM 16 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z200i7_12gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '12 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '12 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '12 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z200i7_12gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z200i7 RAM 12 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z200i7_8gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '8 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '8 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '8 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z200i7_8gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z200i7 RAM 8 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z200i7_6gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '6 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '6 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '6 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z200i7_6gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z200i7 RAM 6 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z200i7_4gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '4 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '4 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '4 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z200i7_4gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z200i7 RAM 4 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z200i7_0gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '0 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '0 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP Z200 i7')
            ->where('memory', '=', '0 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z200i7_0gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z200i7 RAM 0 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z200i5_64gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '64 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '64 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '64 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z200i5_64gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z200i5 RAM 64 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";

    }

    public function view_legend_z200i5_48gb()
    {

     $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '48 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '48 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '48 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z200i5_48gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z200i5 RAM 48 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z200i5_32gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '32 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '32 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '32 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z200i5_32gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z200i5 RAM 32 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z200i5_24gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '24 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '24 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '24 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z200i5_24gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z200i5 RAM 24 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z200i5_16gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '16 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '16 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '16 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z200i5_16gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z200i5 RAM 16 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z200i5_12gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '12 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '12 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '12 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z200i5_12gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z200i5 RAM 12 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z200i5_8gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '8 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '8 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '8 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z200i5_8gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z200i5 RAM 8 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z200i5_6gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '6 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '6 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '6 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z200i5_6gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z200i5 RAM 6 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z200i5_4gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '4 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '4 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '4 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z200i5_4gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z200i5 RAM 4 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z200i5_0gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '0 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '0 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z200 i5')
            ->where('memory', '=', '0 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z200i5_0gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z200i5 RAM 0 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z210_64gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '64 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z210')
            ->where('memory', '=', '64 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z210')
            ->where('memory', '=', '64 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z210_64gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z210 RAM 64 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";

    }

    public function view_legend_z210_48gb()
    {

     $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '48 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z210')
            ->where('memory', '=', '48 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z210')
            ->where('memory', '=', '48 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z210_48gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z210 RAM 48 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z210_32gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '32 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z210')
            ->where('memory', '=', '32 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z210')
            ->where('memory', '=', '32 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z210_32gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z210 RAM 32 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z210_24gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '24 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z210')
            ->where('memory', '=', '24 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z210')
            ->where('memory', '=', '24 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z210_24gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z210 RAM 24 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z210_16gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '16 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z210')
            ->where('memory', '=', '16 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z210')
            ->where('memory', '=', '16 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z210_16gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z210 RAM 16 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z210_12gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '12 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z210')
            ->where('memory', '=', '12 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z210')
            ->where('memory', '=', '12 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z210_12gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z210 RAM 12 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z210_8gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '8 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z210')
            ->where('memory', '=', '8 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z210')
            ->where('memory', '=', '8 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z210_8gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z210 RAM 8 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z210_6gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '6 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z210')
            ->where('memory', '=', '6 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z210')
            ->where('memory', '=', '6 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z210_6gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z210 RAM 6 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z210_4gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '4 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z210')
            ->where('memory', '=', '4 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z210')
            ->where('memory', '=', '4 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z210_4gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z210 RAM 4 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z210_0gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z210')
            ->where('memory', '=', '0 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z210')
            ->where('memory', '=', '0 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z210')
            ->where('memory', '=', '0 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z210_0gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z210 RAM 0 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z600_64gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '64 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z600')
            ->where('memory', '=', '64 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z600')
            ->where('memory', '=', '64 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z600_64gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z600 RAM 64 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";

    }

    public function view_legend_z600_48gb()
    {

     $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '48 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z600')
            ->where('memory', '=', '48 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z600')
            ->where('memory', '=', '48 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z600_48gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z600 RAM 48 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z600_32gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '32 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z600')
            ->where('memory', '=', '32 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z600')
            ->where('memory', '=', '32 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z600_32gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z600 RAM 32 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z600_24gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '24 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z600')
            ->where('memory', '=', '24 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z600')
            ->where('memory', '=', '24 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z600_24gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z600 RAM 24 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z600_16gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '16 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z600')
            ->where('memory', '=', '16 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z600')
            ->where('memory', '=', '16 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z600_16gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z600 RAM 16 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }
    public function view_legend_z600_12gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '12 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z600')
            ->where('memory', '=', '12 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z600')
            ->where('memory', '=', '12 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z600_12gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z600 RAM 12 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z600_8gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '8 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z600')
            ->where('memory', '=', '8 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z600')
            ->where('memory', '=', '8 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z600_8gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z600 RAM 8 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z600_6gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '6 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z600')
            ->where('memory', '=', '6 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z600')
            ->where('memory', '=', '6 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z600_6gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z600 RAM 6 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z600_4gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '4 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z600')
            ->where('memory', '=', '4 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z600')
            ->where('memory', '=', '4 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z600_4gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z600 RAM 4 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z600_0gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z600')
            ->where('memory', '=', '0 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z600')
            ->where('memory', '=', '0 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z600')
            ->where('memory', '=', '0 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z600_0gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z600 RAM 0 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z240_64gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '64 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z240')
            ->where('memory', '=', '64 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z240')
            ->where('memory', '=', '64 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z240_64gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z240 RAM 64 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";

    }

    public function view_legend_z240_48gb()
    {

     $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '48 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z240')
            ->where('memory', '=', '48 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z240')
            ->where('memory', '=', '48 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z240_48gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z240 RAM 48 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z240_32gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '32 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z240')
            ->where('memory', '=', '32 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z240')
            ->where('memory', '=', '32 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z240_32gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z240 RAM 32 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z240_24gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '24 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z240')
            ->where('memory', '=', '24 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z240')
            ->where('memory', '=', '24 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z240_24gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z240 RAM 24 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z240_16gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '16 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z240')
            ->where('memory', '=', '16 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z240')
            ->where('memory', '=', '16 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z240_16gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z240 RAM 16 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z240_12gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '12 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z240')
            ->where('memory', '=', '12 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z240')
            ->where('memory', '=', '12 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z240_12gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z240 RAM 12 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z240_8gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '8 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z240')
            ->where('memory', '=', '8 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z240')
            ->where('memory', '=', '8 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z240_8gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z240 RAM 8 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z240_6gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '6 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z240')
            ->where('memory', '=', '6 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z240')
            ->where('memory', '=', '6 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z240_6gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z240 RAM 6 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z240_4gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '4 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z240')
            ->where('memory', '=', '4 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z240')
            ->where('memory', '=', '4 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z240_4gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z240 RAM 4 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z240_0gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z240')
            ->where('memory', '=', '0 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z240')
            ->where('memory', '=', '0 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z240')
            ->where('memory', '=', '0 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z240_0gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z240 RAM 0 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z640_64gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '64 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z640')
            ->where('memory', '=', '64 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z640')
            ->where('memory', '=', '64 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z640_64gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z640 RAM 64 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";

    }

    public function view_legend_z640_48gb()
    {

     $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '48 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z640')
            ->where('memory', '=', '48 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z640')
            ->where('memory', '=', '48 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z640_48gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z640 RAM 48 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z640_32gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '32 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z640')
            ->where('memory', '=', '32 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z640')
            ->where('memory', '=', '32 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z640_32gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z640 RAM 32 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z640_24gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '24 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z640')
            ->where('memory', '=', '24 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z640')
            ->where('memory', '=', '24 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z640_24gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z640 RAM 24 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z640_16gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '16 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z640')
            ->where('memory', '=', '16 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z640')
            ->where('memory', '=', '16 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z640_16gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z640 RAM 16 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z640_12gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '12 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z640')
            ->where('memory', '=', '12 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z640')
            ->where('memory', '=', '12 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z640_12gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z640 RAM 12 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z640_8gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '8 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z640')
            ->where('memory', '=', '8 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z640')
            ->where('memory', '=', '8 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z640_8gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z640 RAM 8 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z640_6gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '6 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z640')
            ->where('memory', '=', '6 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z640')
            ->where('memory', '=', '6 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z640_6gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z640 RAM 6 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z640_4gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '4 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z640')
            ->where('memory', '=', '4 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z640')
            ->where('memory', '=', '4 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z640_4gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z640 RAM 4 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_z640_0gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'HP z640')
            ->where('memory', '=', '0 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z640')
            ->where('memory', '=', '0 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'HP z640')
            ->where('memory', '=', '0 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='z640_0gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation z640 RAM 0 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_T3620_64gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '64 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '64 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '64 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='T3620_64gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation T3620 RAM 64 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";

    }

    public function view_legend_T3620_48gb()
    {

     $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '48 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '48 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '48 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='T3620_48gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation T3620 RAM 48 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_T3620_32gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '32 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '32 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '32 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='T3620_32gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation T3620 RAM 32 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_T3620_24gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '24 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '24 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '24 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='T3620_24gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation T3620 RAM 24 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_T3620_16gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '16 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '16 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '16 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='T3620_16gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation T3620 RAM 16 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_T3620_12gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '12 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '12 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '12 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='T3620_12gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation T3620 RAM 12 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_T3620_8gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '8 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '8 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '8 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='T3620_8gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation T3620 RAM 8 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_T3620_6gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '6 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '6 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '6 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='T3620_6gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation T3620 RAM 6 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_T3620_4gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '4 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '4 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '4 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='T3620_4gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation T3620 RAM 4 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_T3620_0gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '0 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '0 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T3620')
            ->where('memory', '=', '0 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='T3620_0gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation T3620 RAM 0 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_T7910_64gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '64 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '64 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '64 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='T7910_64gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation T7910 RAM 64 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";

    }

    public function view_legend_T7910_48gb()
    {

     $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '48 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '48 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '48 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='T7910_48gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation T7910 RAM 48 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_T7910_32gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '32 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '32 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '32 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='T7910_32gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation T7910 RAM 32 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_T7910_24gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '24 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '24 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '24 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='T7910_24gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation T7910 RAM 24 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_T7910_16gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '16 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '16 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '16 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='T7910_16gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation T7910 RAM 16 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_T7910_12gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '12 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '12 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '12 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='T7910_12gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation T7910 RAM 12 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_T7910_8gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '8 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '8 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '8 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='T7910_8gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation T7910 RAM 8 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_T7910_6gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '6 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '6 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '6 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='T7910_6gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation T7910 RAM 6 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_T7910_4gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '4 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '4 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '4 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='T7910_4gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation T7910 RAM 4 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_T7910_0gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '0 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '0 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Dell T7910')
            ->where('memory', '=', '0 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='T7910_0gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation T7910 RAM 0 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_generic_64gb()
    {
        $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '64 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '64 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '64 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='generic_64gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation generic RAM 64 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";

    }

    public function view_legend_generic_48gb()
    {

     $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '48 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '48 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '48 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='generic_48gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation generic RAM 48 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_generic_32gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '32 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '32 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '32 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='generic_32gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation generic RAM 32 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_generic_24gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '24 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '24 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '24 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='generic_24gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation generic RAM 24 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_generic_16gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '16 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '16 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '16 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='generic_16gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation generic RAM 16 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_generic_12gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '12 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '12 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '12 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='generic_12gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation generic RAM 12 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_generic_8gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '8 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '8 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '8 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='generic_8gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation generic RAM 8 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_generic_6gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '6 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '6 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '6 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='generic_6gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation generic RAM 6 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_generic_4gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '4 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '4 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '4 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='generic_4gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation generic RAM 4 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function view_legend_generic_0gb()
    {
         $select = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
            ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '0 GB')
            ->whereNotIn('user', ['WS Render', 'Idle', 'FAIL'])
        ->get();

        $select_idle = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '0 GB')
        ->whereIn('user', ['WS Render', 'Idle'])
        ->get();

        $select_fail = Ws_Availability::select(['ws_Availability.hostname', 'ws_Availability.user', 'ws_Availability.vga'])
       ->where('type', '=', 'Generic PC')
            ->where('memory', '=', '0 GB')
        ->where('user', '=', 'Fail')
        ->get();

        echo "        
        <div class='modal fade' id='generic_0gb' role='dialog'>
        <div class='modal-dialog'>   
      
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Workstation generic RAM 0 GB</h4>
                </div>
                <div class='modal-body scroll1'>  
                <h4>Workstation Used</h4>              
                <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
        foreach ($select as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }                  
        echo "</thead>
                </table>
                <h4>Workstation Idle</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_idle as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }  

        echo "</thead>
                </table>
                <h4>Workstation Fail</h4> 
                 <table class='uk-table uk-table-hover uk-table-striped' width='100%' id='tables'>
                <thead>
                    <tr>
                        <th>Hostname</th>
                        <th>User</th>
                        <th>VGA</th>                 
                    </tr>";
         foreach ($select_fail as $s ) {
        echo "          <tr>
                        <td>$s->hostname</td> 
                        <td>$s->user</td>
                        <td>$s->vga</td>                                          
                        </tr>
        ";
        }          
                
        echo "</thead>
                </table>
                </div>                
                <div class='modal-footer'>
                  <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                </div>
              </div>
              /div>
            </div>
          </div>";
    }

    public function index_Scrapped()
    {
        return view::make('Pipeline.Availability.index_scrap');
    }

    public function get_index_Scrapped()
    {
         $select = Ws_Availability::select([
            'id', 'hostname', 'type', 'user', 'os', 'memory', 'vga', 'location', 'notes', 'updated_at'
         ]) 
            ->where('user', '=', "SCRAPPED")
            ->get();
      
        return Datatables::of($select) 
            ->add_column('action',
                Lang::get('messages.btn_warning', ['title' => 'Edit Workstation', 'url' => '{{ URL::route(\'editSracped\', [$id]) }}', 'class' => 'pencil'])             
            ) 
            ->edit_column('updated_at', '{!! date("M, d Y - H:m", strtotime($updated_at)) !!} WIB')
            ->make();         
    }
}