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
use App\Ws_Availability;
use App\Exports\UserReport;
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


class PipeLineTechnical extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'pipelineTechnical']);
    }

    public function indexApproval()
    {
    	return view('production.Pipeline.indexPipelineTechnicalApproval');
    }

    public function GetApproval()
    {
       $select = NewUser::JoinLeave()
       				->where('user_id', 1300)
       				->where('ap_spv', '=', 0)
       				->where('ap_koor', '=', 1)
       				->where('ap_pm', '=', 1)
       				->where('ap_pipeline', '=', 0) 				
       				->get();

        return Datatables::of($select)
        		->addIndexColumn()        	
        		->addColumn('fullName', function(NewUser $NewUser){
        			return $NewUser->first_name.' '.$NewUser->last_name;
        		})
        		->addColumn('leave_category_name', function(NewUser $newUser){
        			$leave_name = Leave_Category::find($newUser->leave_category_id);
        			return $leave_name->leave_category_name;
        		})
        		->addColumn('dept_category_name', function(NewUser $newUser){
        			$dept_name = Dept_Category::find($newUser->dept_category_id);
        			return $dept_name->dept_category_name;
        		})
        		->addColumn('actions',  Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'detailLeavePipelineTechnical\', [$id]) }}', 'class' => 'file']))
        		->make(true);
    } 

     public function detailLeavePipelineTechnical($id)
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
                    <h4><strong><u>Approval	Supervisor</u></strong></h4>
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
               	<a class='btn btn-primary' href='".URL::route('approveLeavePipelineTechnical', [$id])."'>Approve</a>
                <a class='btn btn-primary' href='".URL::route('disapproveLeavePipelineTechnical', [$id])."'>Disapprove</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

    public function approveLeavePipelineTechnical(Request $request, $id)
    {
        $email      = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);
        $ap_pipeline      = 1;
        $ap_spv           = 1;
        $ap_pm			  = 1;
       
        $date_ap_pipeline = date("Y-m-d");
        $ricky   = DB::table('users')
                            ->select(DB::raw('email'))
                            ->where('dept_category_id', '=', 6)
                            ->where('hd', 1)
                            ->first();
                  
        $data    = [
            'ap_pipeline'      => $ap_pipeline,
            'ap_spv'           => $ap_spv,
            'ap_pm'			   => $ap_pm,	
            'date_ap_spv'      => $date_ap_pipeline,          
            'date_ap_pipeline' => $date_ap_pipeline
        ];
    
        Leave::where('id', $id)->update($data);               
        Mail::send('email.verMail', ['email' => $email], function($message) use ($email, $anggarda)
                {
                    $message->to($ricky->email, 'WIS')->subject('[Approved] Leave Application - '.$email->request_by.'');
                    $message->from('wis_system@infinitestudios.id', 'WIS');
                });
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));     
        return back();
    }

    public function disapproveLeavePipelineTechnical(Request $request, $id)
    {
        $email  = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);
                $ap_pipeline = 2;
                $date_ap_pipeline = date("Y-m-d");
                $ap_spv = 2;
                $date_ap_spv = date("Y-m-d");
                $ap_koor = 2;
                $date_ap_koor = date("Y-m-d");
                $ap_pm = 2;
                $date_ap_pm = date("Y-m-d");
                $ap_producer = 2;
                $date_producer  = date("Y-m-d");              

         $data    = [
            'ap_pipeline'      => $ap_pipeline, 
            'ap_spv'           => $ap_spv,
            'ap_koor'          => $ap_koor,
            'ap_pm'            => $ap_pm,
            'ap_producer'      => $ap_producer,
            'date_ap_pipeline' => $date_ap_pipeline,
            'date_ap_spv'      => $date_ap_pipeline,
            'date_ap_koor'     => $date_ap_pipeline,
            'date_ap_pm'       => $date_ap_pipeline,
            'date_producer'       => $date_ap_pipeline,
        ];
    
        Leave::where('id', $id)->update($data);
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
        Mail::send('email.disapproveMail', ['email' => $email], function($message) use ($email)
            {
                $message->to($email->email, 'WIS')->subject('[Disapproved] Leave Application - WIS');
                $message->from('wis_system@infinitestudios.id', 'WIS');
            });
         return back();
        
    }

}