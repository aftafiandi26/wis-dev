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



class SPVController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'active', 'spv']);
    }
    // Start Route Approval
    public function indexSPVApproval()
    {

        return View::make('production.indexSPVApproval');
    }

    public function getindexSPV_Approval()
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
            'leave_transaction.ap_pm',
        ])
            // ->where('users.dept_category_id', '=', Auth::user()->dept_category_id)
            ->where('email_spv', auth::user()->email)
            ->where('ap_spv', '=', 0)
            ->where('ap_koor', '=', 1)
            ->get();

        return Datatables::of($select)
            ->edit_column('ap_koor', '@if ($ap_koor === 1){{"APPROVED"}} @else{{"--"}}  @endif')
            ->edit_column('ap_spv', '@if ($ap_spv === 0){{"PENDING"}} @else{{"--"}}   @endif')
            ->edit_column('ap_pm', '@if ($ap_pm === 0){{"WAITING SPV"}} @else {{"--"}} @endif')
            ->add_column(
                'actions',
                Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'ap_spv/detail\', [$id]) }}', 'class' => 'check-square'])
            )
            ->make();
    }

    public function getindexSPV_Approval2()
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
            'leave_transaction.ap_koor'
            // 'leave_transaction.ap_gm',

        ])
            ->where('users.dept_category_id', '=', Auth::user()->dept_category_id)
            ->where('users.project_category_id_1', '=', Auth::user()->project_category_id_2)
            ->where('ap_spv', '=', 0)
            ->get();

        return Datatables::of($select)
            /*->edit_column('ap_koor', '@if ($ap_koor === 1){{ "APPROVED" }} @elseif ($ap_koor === 2) {{"DISAPPROVED"}} @else {{"PENDING"}} @endif')
      ->edit_column('ap_spv', '@if ($ap_spv === 1){{ "APPROVED" }} @elseif ($ap_koor === 0) {{"WAITING COORDINATOR"}} @else {{"PENDING"}} @endif')*/
            ->edit_column('ap_spv', '@if ($ap_spv === 0){{"PENDING"}} @else{{"--"}}   @endif')
            ->edit_column('ap_koor', '@if ($ap_koor === 0){{"WAITING SPV"}} @else{{"--"}}  @endif')
            ->add_column(
                'actions',
                Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'ap_spv/detail2\', [$id]) }}', 'class' => 'check-square'])
            )
            ->make();
    }

    public function getindexSPV_Approval3()
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
            'leave_transaction.ap_koor'
            // 'leave_transaction.ap_gm',

        ])
            ->where('users.dept_category_id', '=', Auth::user()->dept_category_id)
            ->where('users.project_category_id_1', '=', Auth::user()->project_category_id_3)
            ->where('ap_spv', '=', 0)
            ->get();

        return Datatables::of($select)
            /*->edit_column('ap_koor', '@if ($ap_koor === 1){{ "APPROVED" }} @elseif ($ap_koor === 2) {{"DISAPPROVED"}} @else {{"PENDING"}} @endif')
      ->edit_column('ap_spv', '@if ($ap_spv === 1){{ "APPROVED" }} @elseif ($ap_koor === 0) {{"WAITING COORDINATOR"}} @else {{"PENDING"}} @endif')*/
            ->edit_column('ap_spv', '@if ($ap_spv === 0){{"PENDING"}} @else{{"--"}}   @endif')
            ->edit_column('ap_koor', '@if ($ap_koor === 0){{"WAITING SPV"}} @else{{"--"}}  @endif')
            ->add_column(
                'actions',
                Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'ap_spv/detail3\', [$id]) }}', 'class' => 'check-square'])
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
                    <h4><strong><u>Approval Supervisor </u></strong></h4>
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
                <a class='btn btn-primary' href='" . URL::route('ap_spv/approve', [$id]) . "'>Approve</a>
                <a class='btn btn-primary' href='" . URL::route('ap_spv/disapprove', [$id]) . "'>Disapprove</a>
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
                    <h4><strong><u>Approval Supervisor </u></strong></h4>
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
            </div>
            <div class='modal-footer'>
                <a class='btn btn-primary' href='" . URL::route('ap_spv/approve', [$id]) . "'>Approve</a>
                <a class='btn btn-primary' href='" . URL::route('ap_spv/disapprove', [$id]) . "'>Disapprove</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

    public function detailLeave3($id)
    {
        $leave = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);
        $return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'>Detail  </h4>
            </div>
            <div class='modal-body'>
                <div class='well'>
                    <h4><strong><u>Approval Supervisor </u></strong></h4>
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
            </div>
            <div class='modal-footer'>
                <a class='btn btn-primary' href='" . URL::route('ap_spv/approve', [$id]) . "'>Approve</a>
                <a class='btn btn-primary' href='" . URL::route('ap_spv/disapprove', [$id]) . "'>Disapprove</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

    public function approveLeave(Request $request, $id)
    {
        $email       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->joinProjectCategory()->find($id);

        $ap_spv      = 1;
        $date_ap_spv  = date("Y-m-d");

        if ($email->resendmail === 2) {
            $counterMail = $email->resendmail;
        } elseif ($email->resendmail === 1) {
            $counterMail = $email->resendmail + 1;
        } elseif ($email->resendmail === 0) {
            $counterMail = $email->resendmail + 2;
        }

        $data = [];

        if ($email->lineGM === 1) {

            if ($email->email_spv === null) {
                $data        = [
                    'ap_koor'           => 1,
                    'spv_id'    => auth::user()->id,
                    'ap_pm'             => 1,
                    'ap_spv'            => 1,
                    'ap_producer'       => 1,
                    'date_ap_pm'        => date('Y-m-d'),
                    'date_ap_spv'       => date('Y-m-d'),
                    'resendmail'        => $counterMail,
                ];
            } else {
                $data        = [
                    'ap_koor'           => 1,
                    'spv_id'            => auth::user()->id,
                    'ap_spv'            => 1,
                    'ap_pm'             => 1,
                    'ap_producer'       => 1,
                    'date_ap_pm'        => date('Y-m-d'),
                    'date_ap_spv'       => date('Y-m-d'),
                    'resendmail'        => $counterMail,
                ];
            }
        } else {

            if ($email->email_spv === null) {
                $data = [
                    'ap_koor'           => 1,
                    'ap_spv'            => 1,
                    'date_ap_spv'       => date('Y-m-d'),
                    'spv_id'            => auth::user()->id,
                    'resendmail'        => $counterMail,
                ];
            } else {
                $data = [
                    'ap_koor'           => 1,
                    'ap_spv'      => 1,
                    'spv_id'    => auth::user()->id,
                    'date_ap_spv' => date('Y-m-d'),
                    'resendmail'   => $counterMail,
                ];
            }
        }

        Leave::where('id', $id)->update($data);
        $this->sendVerEmail($email);
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
        return Redirect::route('Supervisor/indexApproval');
    }

    public function sendVerEmail($email)
    {
        $koor_email = NewUser::where('email', $email->email_pm)
            ->where('dept_category_id', $email->dept_category_id)
            ->first();

        Mail::send('email.appMailProduction', ['email' => $email], function ($message) use ($koor_email, $email) {
            $message->to($koor_email->email)->subject('Approval Request Leave Application - ' . $email->request_by . '');

            $message->from('wis_system@infinitestudios.id', 'WIS');
        });
    }

    public function sendVerEmail2($email)
    {
        $koor_email    = DB::table('users')
            ->select(DB::raw('*'))
            ->where('dept_category_id', '=', $email->dept_category_id)
            ->where('koor', '=', 1)
            ->where('project_category_id_2', '=', $email->project_category_id_1)
            ->pluck('email');
        /*  return dd($koor_email);*/

        Mail::send('email.appMailProduction', ['email' => $email], function ($message) use ($koor_email, $email) {
            foreach ($koor_email as $e) {
                $message->to($e)->subject('Approval Request Leave Application - ' . $email->request_by . '');
            }
            $message->from('wis_system@infinitestudios.id', 'WIS');
        });
    }

    public function sendVerEmail3($email)
    {
        $koor_email    = DB::table('users')
            ->select(DB::raw('*'))
            ->where('dept_category_id', '=', $email->dept_category_id)
            ->where('koor', '=', 1)
            ->where('project_category_id_3', '=', $email->project_category_id_1)
            ->pluck('email');
        /*  return dd($koor_email);*/

        Mail::send('email.appMailProduction', ['email' => $email], function ($message) use ($koor_email, $email) {
            foreach ($koor_email as $e) {
                $message->to($e)->subject('Approval Request Leave Application - ' . $email->request_by . '');
            }
            $message->from('wis_system@infinitestudios.id', 'WIS');
        });
    }

    public function sendVerEmail4($email)
    {
        $koor_email    = DB::table('users')
            ->select(DB::raw('*'))
            ->where('dept_category_id', '=', $email->dept_category_id)
            ->where('koor', '=', 1)
            ->where('project_category_id_4', '=', $email->project_category_id_1)
            ->pluck('email');
        /*  return dd($koor_email);*/

        Mail::send('email.appMailProduction', ['email' => $email], function ($message) use ($koor_email, $email) {
            foreach ($koor_email as $e) {
                $message->to($e)->subject('Approval Request Leave Application - ' . $email->request_by . '');
            }
            $message->from('wis_system@infinitestudios.id', 'WIS');
        });
    }

    public function sendVerEmail5($email)
    {
        $koor_email    = DB::table('users')
            ->select(DB::raw('*'))
            ->where('dept_category_id', '=', $email->dept_category_id)
            ->where('koor', '=', 1)
            ->where('project_category_id_5', '=', $email->project_category_id_1)
            ->pluck('email');
        /*  return dd($koor_email);*/

        Mail::send('email.appMailProduction', ['email' => $email], function ($message) use ($koor_email, $email) {
            foreach ($koor_email as $e) {
                $message->to($e)->subject('Approval Request Leave Application - ' . $email->request_by . '');
            }
            $message->from('wis_system@infinitestudios.id', 'WIS');
        });
    }


    public function disapproveLeave(Request $request, $id)
    {
        $email       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);
        $ap_spv      = 2;
        $date_ap_spv  = date("Y-m-d");

        if ($email->resendmail === 2) {
            $counterMail = $email->resendmail - 2;
        } elseif ($email->resendmail === 1) {
            $counterMail = $email->resendmail - 1;
        } elseif ($email->resendmail === 0) {
            $counterMail = $email->resendmail;
        }

        $data        = [
            'ap_spv'      =>  $ap_spv,
            'ap_pm'       => 2,
            'ap_producer' => 2,
            'ap_hd'        => 2,
            'ver_hr'       => 2,
            'ap_hrd'       => 5,
            'date_ap_spv' => $date_ap_spv,
            'resendmail'   => $counterMail,
        ];

        Leave::where('id', $id)->update($data);
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
        Mail::send('email.disapproveMail', ['email' => $email], function ($message) use ($email) {
            $message->to($email->email)->subject('[DISAPPROVED] Leave Application - WIS');
            $message->from('wis_system@infinitestudios.id', 'WIS');
        });
        return Redirect::route('Supervisor/indexApproval');
    }
    public function indexHistoriSPV()
    {
        return View::make('production.indexHistoriSPV');
    }

    public function getHistoriSPV()
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
            ->where('dept_category_id', '=', auth::user()->dept_category_id)
            ->get();

        return Datatables::of($select)
            ->edit_column('ap_koor', '@if ($ap_koor === 1) {{"APPROVED"}} @elseif ($ap_koor === 2) {{"DISAPPROVED"}} @else {{"PENDING"}} @endif ')
            ->edit_column('ap_spv', '@if ($ap_spv === 1){{"APPROVED"}} @elseif ($ap_spv ===2){{"DISAPPROVED"}} @elseif ($ap_koor === 1 and $ap_spv === 0){{"PENDING"}} @elseif ($ap_koor === 0){{"WAITING COORDINATOR"}} @else {{"-"}} @endif')
            ->edit_column('ap_pm', '@if ($ap_pm === 1){{"APPROVED"}} @elseif ($ap_pm === 2){{"DISAPPROVED"}} @elseif ($ap_koor === 0){{"WAITING COORDINATOR"}} @elseif ($ap_spv === 0 and $ap_koor === 1){{"WAITING SPV"}} @elseif ($ap_spv === 1){{"PENDING"}} @else {{"-"}} @endif ')
            ->edit_column('ap_producer', '@if ($ap_producer === 1){{"APPROVED"}} @elseif ($ap_producer === 2){{"DISAPPROVED"}} @elseif ($ap_koor === 0){{"WAITING COORDINATOR"}} @elseif ($ap_spv === 0 and $ap_koor === 1){{"WAITING SPV"}} @elseif ($ap_pm === 0 and $ap_spv === 1){{"WAITING PM"}} @elseif ($ap_pm === 1 and $ap_producer === 0){{"PENDING"}} @else {{"-"}} @endif')
            ->edit_column('ap_hd', '@if ($ap_hd === 1){{"APPROVED"}} @elseif ($ap_hd === 2){{"DISAPPROVED"}} @elseif ($ap_koor === 0){{"WAITING COORDINATOR"}} @elseif ($ap_spv === 0 and $ap_koor === 1){{"WAITING SPV"}} @elseif ($ap_pm === 0 and $ap_spv === 1){{"WAITING PM"}} @elseif ($ap_pm === 1 and $ap_producer === 0){{"WAITING PRODUCER"}} @elseif ($ap_producer === 1 and $ap_hd === 0){{"PENDING"}} @else {{"-"}} @endif')

            ->edit_column('ver_hr', '@if ($ver_hr === 1){{"VERIFICATION"}} @elseif ($ver_hr === 2){{"UNVERIFICATION"}} @elseif ($ap_koor === 0){{"WAITING COORDINATOR"}} @elseif ($ap_spv === 0 and $ap_koor === 1){{"WAITING SPV"}} @elseif ($ap_pm === 0 and $ap_spv === 1){{"WAITING PM"}} @elseif ($ap_pm === 1 and $ap_producer === 0){{"WAITING PRODUCER"}} @elseif ($ap_producer === 1 and $ap_hd === 0){{"WAITING HD"}} @elseif ($ap_hd === 1 and ver_hr === 0) {{"PENDING"}} @else {{"-"}} @endif')
            ->edit_column('leave_cancel', '@if ($ap_koor === 1 and $ap_spv === 1 and $ap_pm === 1 and $ap_producer === 1 and $ver_hr === 1 and $ap_hd === 1){{"COMPLETE"}} @elseif ($ap_koor === 2 || $ap_spv === 2 || $ap_pm === 2 || $ap_producer === 2 || $ver_hr === 2 || $ap_hd === 2){{"REJECTED"}} @elseif ($ap_koor === 0 || $ap_spv === 0 || $ap_pm === 0 || $ap_producer === 0 || $ver_hr === 0 || $ap_hd === 0){{"PROGRESS"}} @endif')
            ->add_column(
                'actions',
                Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'leave/detail\', [$id]) }}', 'class' => 'file'])
                /*.Lang::get('messages.btn_warning', ['title' => 'Actived Transaction', 'url' => '{{ URL::route(\'hr_mgmt-data/leaveTransactionReport/uncancel\', [$id]) }}',  'class' => 'trash'])*/
            )
            ->make();
    }

    public function indexSummaryApprovedSPV()
    {
        return view('leave.NewAnnual.historiLeaveingSPV');
    }

    public function getDataSummaryApprovedSPV()
    {
        $model = Leave::where('email_spv', auth::user()->email)
            ->where('ap_koor', 1)
            ->where('ap_spv', 1)
            ->orderBy('id', 'desc')
            ->get();

        return Datatables::of($model)
            ->addIndexColumn()
            ->editColumn('ap_koor', function (Leave $leave) {
                $user = NewUser::where('email', $leave->email_koor)->first();

                if ($leave['ap_koor'] === 1) {
                    $return = $user['first_name'] . ' ' . $user['last_name'] . ' (Approved)';
                }
                if ($leave['ap_koor'] === 2) {
                    $return = $user['first_name'] . ' ' . $user['last_name'] . ' (Disapproved)';
                }

                return $return;
            })
            ->editColumn('ap_spv', function (Leave $leave) {
                $user = NewUser::where('email', $leave->email_spv)->first();

                if ($leave['ap_spv'] === 1) {
                    $return = $user['first_name'] . ' ' . $user['last_name'] . ' (Approved)';
                }
                if ($leave['ap_spv'] === 0) {
                    $return = $user['first_name'] . ' ' . $user['last_name'] . ' (Please Approval)';
                }
                if ($leave['ap_spv'] === 2) {
                    $return = $user['first_name'] . ' ' . $user['last_name'] . ' (Disapproved)';
                }

                return $return;
            })
            ->editColumn('leave_category_id', function (Leave $leave) {
                $return = Leave_Category::findOrFail($leave['leave_category_id']);

                return $return['leave_category_name'];
            })
            ->make(true);
    }
}