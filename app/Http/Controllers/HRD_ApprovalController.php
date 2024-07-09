<?php

namespace App\Http\Controllers;

use App\Dept_Category;
use App\Entitled_leave_view;
use App\Events\LeaveVerificatedByHr;
use App\Http\Controllers\Controller;
use App\Initial_Leave;
use App\JobFunction_Category;
use App\Leave;
use App\ForfeitedCounts;
use App\Leave_Category;
use App\Log_User;
use App\NewUser;
use App\Project_Category;
use App\User;
use App\User_project;
use App\Forfeited;
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


class HRD_ApprovalController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hrd']);
    }

    // Start Route Approval
    public function indexLeaveApproval()
    {
        return View::make('leave.indexHRDApproval');
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
            'leave_transaction.ver_hr',
            'leave_transaction.ap_hrd',
            'leave_transaction.req_advance',

        ])
            ->where('users.hd', 1)
            ->where('leave_transaction.ver_hr', '=', 1)
            ->where('leave_transaction.ap_Infinite', 0)
            ->where('leave_transaction.ap_hd', '=', 1)
            ->where('leave_transaction.ap_hrd', '=', 0)
            ->get();

        return Datatables::of($select)
            ->edit_column('ver_hr', '@if ($ver_hr === 1){{ "VERIFIED" }}@else{{ "PENDING" }}@endif')
            ->edit_column('ap_hrd', '@if ($ap_hrd === 1){{ "APPROVED" }} @elseif ($ap_hrd === 2){{"DISAPPROVED"}} @elseif ($ver_hr === 0){{ "WAITING HR MANAGER" }} @elseif ($ver_hr === 1){{ "PENDING" }}@endif')
            ->setRowClass('@if ($req_advance === 1){{ "danger" }}@endif')
            ->add_column(
                'actions',
                '@if ($ap_hrd === 0)' .
                    Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'ap_hrd/detail\', [$id]) }}', 'class' => 'check-square'])
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
            $coor = User::where('email', $leave->email_koor)->first();
            $coor = $coor->first_name . ' ' . $coor->last_name;
        }

        if (!empty($leave->email_spv)) {
            $spv = User::where('email', $leave->email_spv)->first();
            $spvV = $spv->first_name . ' ' . $spv->last_name;
        }

        if (!empty($leave->email_pm)) {
            $pm = User::where('email', $leave->email_pm)->first();

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
                    <h4><strong><u>Approval HRD </u></strong></h4>
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
                <a class='btn btn-primary' href='" . URL::route('ap_hrd/approve', [$id]) . "'>Approve</a>
                <a class='btn btn-primary' href='" . URL::route('ap_hrd/disapprove', [$id]) . "'>Disapprove</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

    public function approveLeave(Request $request, $id)
    {
        $email        = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);

        $ap_hrd       = 1;
        $ap_gm        = 1;
        $date_ap_hrd  = date("Y-m-d");


        $data        = [
            'ap_hrd'      => $ap_hrd,
            'ap_gm'       => $ap_gm,
            'date_ap_hrd' => $date_ap_hrd,
            'resendmail'  => 0,
        ];

        Leave::where('id', $id)->update($data);

        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));

        Mail::send('email.approvedMail', ['email' => $email], function ($message) use ($email) {
            $message->to($email->email)->subject('[Notification] Leave Application - WIS');
            $message->from('wis_system@infinitestudios.id', 'WIS');
        });
        return Redirect::route('leave/HRD_approval');
    }

    public function disapproveLeave(Request $request, $id)
    {
        $email       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);
        $ap_hrd       = 2;
        $ap_gm       = 2;
        $date_ap_hrd  = date("Y-m-d");


        $data        = [
            'ap_hrd'      => $ap_hrd,
            'ap_gm'      => $ap_gm,
            'date_ap_hrd' => $date_ap_hrd,
            'resendmail'  => 0
        ];

        Leave::where('id', $id)->update($data);
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
        Mail::send('email.disapproveMail', ['email' => $email], function ($message) use ($email) {
            $message->to($email->email)->subject('[Disapproved] Leave Application - WIS');
            $message->from('wis_system@infinitestudios.id', 'WIS');;
        });
        return Redirect::route('leave/HRD_approval');
    }

    // End Route Approval
    ////////////////////////////////////////////////////////////////////////////
    //start leave report
    public function indexLeaveReport()
    {
        return View::make('leave_report_HRD.indexLeaveReport');
    }

    public function indexLeaveEntitledReport()
    {
        return View::make('leave_report_HRD.preview_LeaveReport');
    }


    public function getIndexLeaveEntitled()
    {
        $select = Entitled_leave_view::joinDeptCategory()->select([
            'all_leave_entitled.nik',
            'all_leave_entitled.name',
            'all_leave_entitled.emp_status',
            'dept_category.dept_category_name',
            'all_leave_entitled.end_date',
            'all_leave_entitled.entitled_leave',
            'all_leave_entitled.entitled_day_off',
            'all_leave_entitled.total_leave_and_day_off',
            'all_leave_entitled.leave_taken',
            'all_leave_entitled.day_off_taken',
            'all_leave_entitled.total_leave_and_day_off_taken',
            'all_leave_entitled.annual_leave_balance',
            'all_leave_entitled.day_off_balance',
            'all_leave_entitled.total_leave_and_day_off_balance'
        ])
            ->where('all_leave_entitled.nik', '!=', null);
        return Datatables::of($select)
            ->make();
    }
    public function indexhistorical()
    {
        return View::make('leave_report_HRD.indexHistoricalTransactionReport');
    }
    public function getindexhistorical(Request $id)
    {
        $select = Leave::joinLeaveCategory()->joinUsers()->joinDeptCategory()->select([
            'leave_transaction.id',
            'users.nik',

            'leave_transaction.request_by',
            'leave_category.leave_category_name',
            'leave_transaction.leave_date',
            'leave_transaction.total_day',
            'leave_transaction.ap_hd',
            'leave_transaction.ver_hr',
            'leave_transaction.ap_hrd',
            // 'users.sp',
            'leave_transaction.leave_cancel'

        ])
            ->where('leave_transaction.request_nik', '!=', null);

        return Datatables::of($select)
            ->edit_column('ver_hr', '@if ($ver_hr === 1){{ "VERIFIED" }} @elseif ($ver_hr === 2){{"UNVERIFIED"}} @elseif ($ver_hr === 0){{ "WAITING HD" }} @elseif ($ap_hd === 1){{ "PENDING" }}@endif')
            ->edit_column('ap_hrd', '@if ($ap_hrd === 1){{ "APPROVED" }} @elseif ($ap_hrd === 2){{"DISAPPROVED"}} @elseif ($ver_hr === 0 and $ap_hd === 0){{ "WAITING HD" }} @elseif ($ver_hr === 0 and $ap_hd === 1){{ "WAITING HR" }} @elseif ($ap_hd === 1 and $ver_hr === 1 and $ap_hrd === 0){{ "PENDING" }} @elseif ($ap_hrd === 5){{"--"}} @endif')
            //->edit_column('sp', '@if ($sp === 0){{"KARYAWAN"}} @else {{"MANAGER"}} @endif')
            ->edit_column('ap_hd', '@if ($ap_hd === 1){{ "APPROVED" }} @elseif ($ap_hd === 0){{ "PENDING" }} @elseif ($ap_hd === 2){{ "DISAPPROVED" }} @else {{"--"}} @endif')
            /* ->edit_column('ver_hr', '@if ($ver_hr === 1){{ "VERIFIED" }} @elseif ($ver_hr === 0){{ "PENDING" }} @elseif ($ver_hr === 2){{ "UNVERIFIED" }} @elseif ($ver_hr === 3){{ "CANCEL" }} @endif')*/
            ->edit_column('leave_cancel', '@if ($ver_hr === 3){{"CANCEL"}} @elseif ($ver_hr === 1 and $ap_hd === 1 and $ap_hrd === 1 or $ap_hrd === 5  ) {{"COMPLETE"}} @elseif ($ver_hr === 1 and $ap_hd === 1 and $ap_hrd === 5 ) {{"COMPLETE"}} @elseif ($ver_hr === 3 or $ver_hr === 2) {{"COMPLETE"}} @elseif ($ver_hr === 0) {{"PROGRESS"}} @elseif ($ver_hr === 1 and $ap_hd === 0) {{"PROGRESS"}} @elseif ($ver_hr === 1 and $ap_hd === 1 and $ap_hrd === 0) {{"PROGRESS"}} @endif')
            //  ->edit_column('leave_cancel', '@if (@ver_hr === 0 and @ap_hd === 0 and $ap_hrd === 0){{"PROGRESS"}} @elseif (@ver_hr === 2){{"COMPLETED"}} @endif')

            ->edit_column('leave_date', '{!! date("M d, Y", strtotime($leave_date)) !!}')

            ->add_column(
                'actions',
                Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'leave/detail\', [$id]) }}', 'class' => 'file'])
                /*.Lang::get('messages.btn_warning', ['title' => 'Actived Transaction', 'url' => '{{ URL::route(\'hr_mgmt-data/leaveTransactionReport/uncancel\', [$id]) }}',  'class' => 'trash']).
            '@if ($ap_hd === 1 && $ap_hrd === 1 && $ver_hr === 1)'
            .Lang::get('messages.btn_print', ['title' => 'Print', 'url' => '{{ URL::route(\'leave/print1\', [$id]) }}', 'class' => 'print']).
            '@elseif ($ap_hd === 1 && $ap_hrd === 5 && $ver_hr === 1)'
            .Lang::get('messages.btn_print', ['title' => 'Print', 'url' => '{{ URL::route(\'leave/print\', [$id]) }}', 'class' => 'print'])
            .'@endif'*/
            )
            ->make();
    }

    public function indexGrafik()
    {
        return View::make('leave_report_HRD.indexGrafik');
    }

    /////////////////////////////

    public function indexEmployee()
    {
        return View::make('leave_report_HRD.employee_HRD.index');
    }

    public function getEmployee(Request $id)
    {
        $select = NewUser::joinDeptCategory()->JoinEntitled_leave_view()->select(['users.id', 'users.username', 'users.nik', 'users.first_name', 'users.last_name', 'dept_category.dept_category_name', 'users.sp', 'users.join_date', 'users.end_date', 'users.hd', 'users.hr', 'users.gm', 'users.active', 'all_leave_entitled.annual_leave_balance', 'all_leave_entitled.day_off_balance'])
            ->whereNotNull('users.nik')
            ->where('users.nik', '!=', 123456789)
            ->where('users.username', '!=', 'wis_system@infinitestudios.id')
            ->where('users.active', 1)
            ->get();

        return Datatables::of($select)
            ->edit_column('hr', '@if ($hr === 1){{ "Yes" }}@else{{ "No" }}@endif')
            ->edit_column('hd', '@if ($hd === 1){{ "Yes" }}@else{{ "No" }}@endif')
            ->edit_column('gm', '@if ($gm === 1){{ "Yes" }}@else{{ "No" }}@endif')
            ->edit_column('active', '@if ($active === 1){{ "Active" }}@else{{ "Suspend" }}@endif')
            ->edit_column('sp', '@if ($hd === 1){{"Manager"}} @elseif ($gm === 1){{"General Manager"}} @else {{"Employee"}} @endif')
            ->edit_column('end_date', '@if ($end_date === NUll){{"Permanent"}} @elseif ($end_date === "0000-00-00"){{"Permanent"}}  @else{{"$end_date"}} @endif')
            ->add_column(
                'actions',
                /*  Lang::get('messages.btn_warning', ['title' => 'Change Data', 'url' => '{{ URL::route(\'editEmployee/HRD\', [$id]) }}', 'class' => 'pencil'])
                .*/
                Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'detailEmployee/HRD\', [$id]) }}', 'class' => 'file'])
            )

            ->setRowClass('@if ($active === 0){{ "danger" }} @elseif (date("Y-m-d") > $end_date){{"warning"}} @endif')
            ->edit_column('join_date', '{!! date("d M, Y", strtotime($join_date)) !!}')
            ->edit_column('end_date', '{!! date("d M, Y", strtotime($end_date)) !!}')
            ->make();
    }

    public function detailEmployee($id)
    {
        $select = NewUser::joinDeptCategory()->find($id);
        if ($select->hd === 1) {
            $value = "Manager";
        } elseif ($select->gm === 1) {
            $value = "General Manager";
        } else {
            $value = "Employee";
        }
        $join_date = date("M, d Y", strtotime($select->join_date));
        if ($select->end_date === "0000-00-00") {
            $end_date = "";
        } elseif ($select->end_date === null) {
            $end_date = "";
        } else {
            $end_date = date("M, d Y", strtotime($select->end_date));
        }


        $return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title'>Detail Employee</h4>
            </div>
            <div class='modal-body'>
                <div class='well'>
                    <h4><strong><u>$select->first_name $select->last_name</u></strong></h4>
                    <table class='table table-striped table-bordered table-hover table-condensed'>
                       <tbody>
                           <tr>
                                <th>NIK</th>
                                <td>$select->nik</td>
                           </tr>
                           <tr>
                                <th>Department</th>
                                <td>$select->dept_category_name</td>
                           </tr>
                           <tr>
                                <th>Title</th>
                                <td>$value</td>
                           </tr>
                           <tr>
                                <th>Position</th>
                                <td>$select->position</td>
                           </tr>
                           <tr>
                                <th>Join Date</th>
                                <td>$join_date</td>
                           </tr>
                           <tr>
                                <th>End Date</th>
                                <td>$end_date</td>
                           </tr>
                       </tbody>
                    </table>                    
                </div>
            </div>
            <div class='modal-footer'>                
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

    public function editEmployee(Request $request, $id)
    {
        $dept       = dept_category::where(['id' => User::find($id)->dept_category_id])->value('dept_category_name');
        $department = [$dept => $dept];
        $list_dept  = Dept_Category::where('id', '!=', User::find($id)->dept_category_id)->orderBy('id', 'asc')->get();
        foreach ($list_dept as $value)
            $department[$value->dept_category_name] = $value->dept_category_name;

        $proj1    = Project_Category::where(['id' => User::find($id)->project_category_id_1])->value('project_name');
        $project1 = [$proj1 => $proj1];
        $list_proj1  = Project_Category::where('id', '!=', User::find($id)->project_category_id_1)->orderBy('id', 'asc')->get();
        foreach ($list_proj1 as $value)
            $project1[$value->project_name] = $value->project_name;

        $proj2    = Project_Category::where(['id' => User::find($id)->project_category_id_2])->value('project_name');
        $project2 = [$proj2 => $proj2];
        $list_proj2  = Project_Category::where('id', '!=', User::find($id)->project_category_id_2)->orderBy('id', 'asc')->get();
        foreach ($list_proj2 as $value)
            $project2[$value->project_name] = $value->project_name;

        $proj3    = Project_Category::where(['id' => User::find($id)->project_category_id_3])->value('project_name');
        $project3 = [$proj3 => $proj3];
        $list_proj3  = Project_Category::where('id', '!=', User::find($id)->project_category_id_3)->orderBy('id', 'asc')->get();
        foreach ($list_proj3 as $value)
            $project3[$value->project_name] = $value->project_name;

        $emp_status     = [User::find($id)->emp_status => User::find($id)->emp_status, 'Permanent' => 'Permanent', 'Contract' => 'Contract', 'PKL' => 'PKL'];
        $gender         = [User::find($id)->gender => User::find($id)->gender, 'Male' => 'Male', 'Female' => 'Female'];
        $marital_status = [User::find($id)->marital_status => User::find($id)->marital_status, 'Single' => 'Single', 'Married' => 'Married', 'Widowed' => 'Widowed [widowed because her husband passed away]', 'Widower' => 'Widower [widower because his wife passed away]', 'Divorced/Divorcee' => 'Divorced/Divorcee'];
        $rusun_stat     = [User::find($id)->rusun_stat => User::find($id)->rusun_stat, 'Sharing' => 'Sharing', 'Single Paid' => 'Single Paid', 'Single Free' => 'Single Free', 'None' => 'None'];

        $level          = ['USER' => 'User', 'HUMAN RESOURCE' => 'Human Resource', 'HEAD OF DEPARTMENT' => 'Head of Department', 'GENERAL MANAGER' => 'General Manager'];
        $access         = '';

        if (User::find($id)->user === 1) {
            $access = 'USER';
        }

        if (User::find($id)->admin === 1) {
            $access = 'Admin';
        }

        if (User::find($id)->hr === 1) {
            $access = 'HUMAN RESOURCE';
        }

        if (User::find($id)->hd === 1) {
            $access = 'HEAD OF DEPARTMENT';
        }

        if (User::find($id)->gm === 1) {
            $access = 'GENERAL MANAGER';
        }
        if (User::find($id)->username === 'admin') {
            return Redirect::route('employee');
        } else {
            return view::make('leave_report_HRD.employee_HRD.edit')
                ->with([
                    'dept'           => $dept,
                    'department'     => $department,
                    'emp_status'     => $emp_status,
                    'gender'         => $gender,
                    'marital_status' => $marital_status,
                    'rusun_stat'     => $rusun_stat,
                    'proj1'          => $proj1,
                    'project1'       => $project1,
                    'proj2'          => $proj2,
                    'project2'       => $project2,
                    'proj3'          => $proj3,
                    'project3'       => $project3,
                    'level'          => $level,
                    'access'         => $access,
                    'users'          => User::find($id)
                ]);
        }
    }

    public function updateEmployee(Request $request, $id)
    {
        $users          = User::find($id);
        $active         = 0;
        $sp             = 0;
        $ticket         = 0;
        $initial_annual = date_diff(date_create($request->input('join_date')), date_create($request->input('end_date'))->modify('+5 day'))->format('%m');
        $prof_pict      = $users->prof_pict;

        if ($users->emp_status === "Contract") {
            $initial_annual = date_diff(date_create($request->input('join_date')), date_create($request->input('end_date'))->modify('+5 day'))->format('%m') + (12 * date_diff(date_create($request->input('join_date')), date_create($request->input('end_date'))->modify('+5 day'))->format('%y'));
        } else {
            $initial_annual = $request->input('initial_annual');
        }

        if ($request->has('active') && $request->input('active') === "Active") {
            $active = 1;
        }

        if ($request->has('sp') && $request->input('sp') === "2nd Approval") {
            $sp = 1;
        }

        if ($request->has('ticket') && $request->input('ticket') === "Ticket Allowance") {
            $ticket = 1;
        }

        $rules = [
            'nik'              => 'required',
            'first_name'       => 'required',
            'position'         => 'required',
            'emp_status'       => 'required',
            'email'            => 'required|email',
            'dept_category_id' => 'required',
            'prof_pict'        => 'image|nullable|max:1024'
        ];

        if ($request->hasFile('prof_pict') && $request->file('prof_pict')->isValid()) {
            $file      =  $request->file('prof_pict');
            $prof_pict = time() . '_' . $file->getClientOriginalName();
            if ($users->prof_pict != 'no_avatar.jpg') {
                Storage::delete('prof_pict/' . $users->prof_pict);
            }
            $file->storeAs('prof_pict', $prof_pict);
        }

        $data = [
            'nik'                   => $request->input('nik'),
            'first_name'            => $request->input('first_name'),
            'last_name'             => $request->input('last_name'),
            'dept_category_id'      => Dept_Category::where('dept_category_name', $request->input('dept_category_id'))->value('id'),
            'position'              => $request->input('position'),
            'emp_status'            => $request->input('emp_status'),
            'nationality'           => $request->input('nationality'),
            'join_date'             => $request->input('join_date'),
            'end_date'              => $request->input('end_date'),
            'dob'                   => $request->input('dob'),
            'pob'                   => $request->input('pob'),
            'province'              => $request->input('province'),
            'maiden_name'           => $request->input('maiden_name'),
            'gender'                => $request->input('gender'),
            'id_card'               => $request->input('id_card'),
            'email'                 => $request->input('email'),
            'phone'                 => $request->input('phone'),
            'address'               => $request->input('address'),
            'area'                  => $request->input('area'),
            'city'                  => $request->input('city'),
            'education'             => $request->input('education'),
            'marital_status'        => $request->input('marital_status'),
            'npwp'                  => $request->input('npwp'),
            'kk'                    => $request->input('kk'),
            'religion'              => $request->input('religion'),
            'dependent'             => $request->input('dependent'),
            'bpjs_ketenagakerjaan'  => $request->input('bpjs_ketenagakerjaan'),
            'bpjs_kesehatan'        => $request->input('bpjs_kesehatan'),
            // 'bpjs_jht'           => $request->input('bpjs_jht'),
            'rusun'                 => $request->input('rusun'),
            'rusun_stat'            => $request->input('rusun_stat'),
            'race'                  => $request->input('race'),
            'source_company'        => $request->input('source_company'),
            'global_id'             => $request->input('global_id'),
            'init_date'             => $request->input('init_date'),
            'tax_cut_in'            => $request->input('tax_cut_in'),
            'tax_cut_off'           => $request->input('tax_cut_off'),
            'reason_off_leaving'    => $request->input('reason_off_leaving'),
            'reentry_to_company'    => $request->input('reentry_to_company'),
            'reentry_to_otherco'    => $request->input('reentry_to_otherco'),
            'remark'                => $request->input('remark'),
            'jpk'                   => $request->input('jpk'),
            'cob'                   => $request->input('cob'),
            'project_category_id_1' => Project_Category::where('project_name', $request->input('project_category_id_1'))->value('id'),
            'project_category_id_2' => Project_Category::where('project_name', $request->input('project_category_id_2'))->value('id'),
            'project_category_id_3' => Project_Category::where('project_name', $request->input('project_category_id_3'))->value('id'),
            'initial_annual'        => $initial_annual,
            'active'                => $active,
            'sp'                    => $sp,
            'spHRD'                    => $sp,
            'ticket'                => $ticket,
            'prof_pict'             => $prof_pict,
            'request_ip'            => request()->ip(),
            'created_by'            => Auth::user()->first_name . ' ' . Auth::user()->last_name
        ];

        $data_log = [
            'nik'                       => $users->nik,
            'first_name'                => $users->first_name,
            'last_name'                 => $users->last_name,
            'dept_category_id'          => $users->dept_category_id,
            'position'                  => $users->position,
            'emp_status'                => $users->emp_status,
            'join_date'                 => $users->join_date,
            'end_date'                  => $users->end_date,
            'dob'                       => $users->dob,
            'email'                     => $users->email,
            'rusun'                     => $users->rusun,
            'rusun_stat'                => $users->rusun_stat,
            'project_category_id_1'     => $users->project_category_id_1,
            'project_category_id_2'     => $users->project_category_id_2,
            'project_category_id_3'     => $users->project_category_id_3,
            'initial_annual'            => $users->initial_annual,
            'active'                    => $users->active,
            'sp'                        => $users->sp,
            'ticket'                    => $users->ticket,
            'nik_new'                   => $request->input('nik'),
            'first_name_new'            => $request->input('first_name'),
            'last_name_new'             => $request->input('last_name'),
            'dept_category_id_new'      => Dept_Category::where('dept_category_name', $request->input('dept_category_id'))->value('id'),
            'position_new'              => $request->input('position'),
            'emp_status_new'            => $request->input('emp_status'),
            'join_date_new'             => $request->input('join_date'),
            'end_date_new'              => $request->input('end_date'),
            'dob_new'                   => $request->input('dob'),
            'email_new'                 => $request->input('email'),
            'rusun_new'                 => $request->input('rusun'),
            'rusun_stat_new'            => $request->input('rusun_stat'),
            'project_category_id_1_new' => Project_Category::where('project_name', $request->input('project_category_id_1'))->value('id'),
            'project_category_id_2_new' => Project_Category::where('project_name', $request->input('project_category_id_2'))->value('id'),
            'project_category_id_3_new' => Project_Category::where('project_name', $request->input('project_category_id_3'))->value('id'),
            'initial_annual_new'        => $initial_annual,
            'active_new'                => $active,
            'sp_new'                    => $sp,
            'ticket_new'                => $ticket,
            'request_ip'                => request()->ip(),
            'created_by'                => Auth::user()->first_name . ' ' . Auth::user()->last_name
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('editEmployee/HRD', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        } else {
            if ($users->nik != $request->input('nik')) {
                User::where('id', $id)->update($data);
                Log_User::insert($data_log);
                Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
            } else {
                User::where('id', $id)->update($data);
                Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
            }


            return Redirect::route('Employee-HRD');
        }
    }

    public function indexRusunHRD()
    {
        return view::make('leave_report_HRD.rusun_HRD.index');
    }

    public function getRusunHRD(Request $id)
    {
        $select = User::select(['users.id', 'users.rusun', 'users.rusun_stat', 'users.first_name', 'users.last_name', 'users.nik', 'users.end_date'])
            ->where('users.username', '!=', 'admin')
            ->where('users.username', '!=', 'hr')
            ->where('users.username', '!=', 'wis_system@infinitestudios.id')
            ->where('users.nik', '!=', null)
            ->where('users.rusun', '!=', null)
            ->where('users.active', 1)
            ->get();
        return Datatables::of($select)
            ->add_column(
                'actions',
                Lang::get('messages.btn_warning', ['title' => 'Annual Transaction', 'class' => 'pencil', 'url' =>  '{{ URL::route(\'edit-rusun/HRD\', [$id]) }}'])
            )
            ->edit_column('end_date', '@if ($end_date === NUll){{"Permanent"}} @elseif ($end_date === "0000-00-00"){{"Permanent"}} @else{{"$end_date"}}  @endif')
            ->make();
    }

    public function editRusunRusun(Request $request, $id)
    {
        $dept   = dept_category::where(['id' => User::find($id)->dept_category_id])->value('dept_category_name');
        $rusun_stat     = [User::find($id)->rusun_stat => User::find($id)->rusun_stat, 'Sharing' => 'Sharing', 'Single Paid' => 'Single Paid', 'Single Free' => 'Single Free', 'None' => 'None'];

        return view::make('HRDLevelAcces.rusun.edit')->with(['dept' => $dept, 'rusun_stat' => $rusun_stat, 'users' => User::find($id)]);
    }

    public function postRusunHRD(Request $request, $id)
    {
        $rules = [
            'rusun'         => 'required',
            'rusun_stat'    => 'required'
        ];
        $data = [
            'rusun' => $request->input('rusun'),
            'rusun_stat' => $request->input('rusun_stat')
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('post', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        } else {
            User::where('id', $id)->update($data);
            Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
            return Redirect::route('rusun', ['id' => $id]);
        }
    }

    public function indexLeaveAllEmploye()
    {
        return view::make('leave_report_HRD.leave_of_all_employee.index');
    }

    public function getLeaveAllEmployee()
    {
        $select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([
            'leave_transaction.id',
            'leave_transaction.request_nik',
            'leave_transaction.request_by',
            'leave_category.leave_category_name',
            'leave_transaction.leave_date',
            'leave_transaction.total_day',
            'dept_category.dept_category_name',
            'leave_transaction.ap_hd',
            'leave_transaction.ver_hr',
            'leave_transaction.ap_hrd',
            'leave_transaction.req_advance'
        ])
            ->where('users.hd', 0)
            ->where('users.dept_category_id', '!=', 3)
            ->where('leave_transaction.ap_hd', '=', 1)
            ->where('leave_transaction.ver_hr', '=', 1)
            ->where('leave_transaction.ap_hrd', '=', 0)
            ->get();

        return Datatables::of($select)
            ->edit_column('ap_hd', '@if ($ap_hd === 1){{"APPROVED"}} @else {{"PENDING"}}  @endif')
            ->edit_column('ver_hr', '@if ($ver_hr === 1){{ "VERIFIED" }} @else{{ "PENDING" }}@endif')
            ->edit_column('ap_hrd', '@if ($ap_hrd === 1){{ "APPROVED" }} @elseif ($ap_hrd === 2){{"DISAPPROVED"}} @elseif ($ver_hr === 0){{ "WAITING HR" }} @else{{ "PENDING" }}@endif')
            ->setRowClass('@if ($req_advance === 1){{ "danger" }}@endif')
            ->add_column(
                'actions',
                '@if ($ap_hrd === 0)' .
                    Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'ap_hrd/detailLeaveStaff\', [$id]) }}', 'class' => 'check-square'])
                    . '@endif'
            )
            ->make();
    }

    public function detailLeaveStaff($id)
    {
        $leave = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);
        $return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'>Detail  </h4>
            </div>
            <div class='modal-body'>
                <div class='well'>
                    <h4><strong><u>Approval HRD </u></strong></h4>
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
                    <strong>Reason :</strong> $leave->reason_leave <br>
                </div>
            </div>
            <div class='modal-footer'>
                <a class='btn btn-primary' href='" . URL::route('ap_hrd/approveStaff', [$id]) . "'>Approve</a>
                <a class='btn btn-primary' href='" . URL::route('ap_hrd/disapproveStaff', [$id]) . "'>Disapprove</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

    public function approveLeaveStaff(Request $request, $id)
    {
        $email       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);

        $data        = [
            'ap_hrd'      => 1,
            'ap_gm'       => 1,
            'date_ap_hrd' => date("Y-m-d"),
            'resendmail'  => 0,
        ];

        if ($email->leave_category_id == 1) {
            $this->forfeited($id);
        }

        Mail::send('email.approvedMail', ['email' => $email], function ($message) use ($email) {
            $message->to($email->email)->subject('[Approved] Leave Application - WIS');
            $message->from('wis_system@infinitestudios.id', 'WIS');
        });

        Leave::where('id', $id)->update($data);
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
        return Redirect::route('indexAllEmployee');
    }

    public function disapproveLeaveStaff(Request $request, $id)
    {
        $email       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);

        $data        = [
            'ap_hrd'      => 1,
            'ap_gm'       => 1,
            'date_ap_hrd' => date("Y-m-d"),
            'resendmail'  => 0,
        ];

        Mail::send('email.disapproveMail', ['email' => $email], function ($message) use ($email) {
            $message->to($email->email)->subject('[Disapproved] Leave Application - WIS');
            $message->from('wis_system@infinitestudios.id', 'WIS');;
        });
        Leave::where('id', $id)->update($data);
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
        return Redirect::route('indexAllEmployee');
    }

    public function forfeitedOld($id)
    {
        $leave = Leave::find($id);

        $forfeited = Forfeited::where('user_id', $leave->user_id)->pluck('countAnnual')->sum();

        $forfeitedCounts = ForfeitedCounts::where('user_id', $leave->user_id)->pluck('amount')->sum();

        $amount = $forfeited - $forfeitedCounts;

        if ($leave->total_day > $amount) {
            $count = $amount;
        } else {
            $count = $leave->total_day;
        }

        $data = [
            'user_id'   => $leave->user_id,
            'leave_id'  => $id,
            'amount'    => $count,
            'status'    => 1
        ];

        if ($forfeited !== 0) {
            ForfeitedCounts::insert($data);
        }
    }
    
    public function forfeited($id)
    {
        $forfeitedCounts = ForfeitedCounts::where('leave_id', $id)->first();

        if ($forfeitedCounts) {
            ForfeitedCounts::where('leave_id', $id)->update(['status' => 1]);
        }
    }
}

