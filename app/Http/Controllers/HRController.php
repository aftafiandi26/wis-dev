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
use App\Forfeited;
use App\ForfeitedCounts;
use App\Mail\Notifikasi\FeedbackMailCutOfExdoMail;
use App\Mail\Notifikasi\FeedbackMailLeaveCutOfLeave;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use Storage;
use Yajra\Datatables\Facades\Datatables;


class HRController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    private function dataProvinsi()
    {
        $data = asset('response/js/provinsi.js');

        try {
            $response = file_get_contents($data);
            $response = json_decode($response, true);
            $return = $response;
        } catch (\Exception $error) {
            $return = null;
        }

        return $return;
    }

    private function namaPronvisi($id)
    {
        $prov = $this->dataProvinsi();

        foreach ($prov as $provin) {
            if ($provin['id'] === $id) {
                $nama_provins = title_case($provin['name']);
                break;
            } else {
                $nama_provins = null;
            }
        }

        return $nama_provins;
    }



    // Start Route Management Data > Data User
    public function indexUser()
    {
        return View::make('mgmt-data.user.indexHR');
    }

    public function getIndexUser()
    {
        $select = NewUser::joinDeptCategory()->select(['users.id', 'users.username', 'users.nik', 'users.first_name', 'users.last_name', 'dept_category.dept_category_name', 'users.admin', 'users.hr', 'users.hd', 'users.gm', 'users.active'])
            ->where('users.username', '!=', 'admin')
            ->where('users.username', '!=', 'hr')
            ->where('users.nik', '!=', 123456789)
            ->get();

        return Datatables::of($select)
            ->edit_column('hr', '@if ($hr === 1){{ "Yes" }}@else{{ "No" }}@endif')
            ->edit_column('hd', '@if ($hd === 1){{ "Yes" }}@else{{ "No" }}@endif')
            ->edit_column('gm', '@if ($gm === 1){{ "Yes" }}@else{{ "No" }}@endif')
            ->edit_column('active', '@if ($active === 1){{ "Active" }}@else{{ "Suspend" }}@endif')
            ->add_column(
                'actions',
                '@if ($admin !== 1)' .
                    Lang::get('messages.btn_warning', ['title' => 'Change Data', 'url' => '{{ URL::route(\'hr_mgmt-data/user/edit-data\', [$id]) }}', 'class' => 'pencil'])
                    . Lang::get('messages.btn_reset', ['title' => 'Reset Password', 'url' => '{{ URL::route(\'hr_mgmt-data/user/passReset\', [$id]) }}', 'class' => 'refresh'])
                    . '@endif'
            )
            ->setRowClass('@if ($active === 0){{ "danger" }}@endif')
            ->make();
    }

    public function detailUser($id)
    {
        $select = NewUser::joinDeptCategory()->find($id);
        $return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'>Detail	</h4>
            </div>
            <div class='modal-body'>
                <div class='well'>
                    <h4><strong><u>User Detail	</u></strong></h4>
                    <strong>First Name :</strong> $select->first_name <br>

                </div>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

    public function passResetUser($id)
    {
        $select = NewUser::joinDeptCategory()->find($id);
        $return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
            </div>
            <div class='modal-body'>
                <div class='well'>
                    <h4>Are you sure want to reset <strong>$select->first_name $select->last_name</strong> password?</h4>
                </div>
            </div>
            <div class='modal-footer'>
            	<a class='btn btn-primary' href='" . URL::route('hr_mgmt-data/user/ActionPassReset', [$id]) . "'>Yes</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

    public function actionPassResetUser(Request $request, $id)
    {
        $block =  0;
        $data = [
            'password' => Hash::make('Batam' . Date('Y')),
            'block_stat' => $block
        ];
        User::where('id', $id)->update($data);
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
        return Redirect::route('hr_mgmt-data/user');
    }

    public function createUser()
    {
        $department = ['' => '-Select-'];
        $list_dept  = Dept_Category::orderBy('id', 'asc')->get();
        foreach ($list_dept as $value)
            $department[$value->dept_category_name] = $value->dept_category_name;

        $project1      = ['' => '-Select-'];
        $list_proj1 = Project_Category::orderBy('id', 'asc')->get();
        foreach ($list_proj1 as $value)
            $project1[$value->project_name] = $value->project_name;

        $project2      = ['' => '-Select-'];
        $list_proj2 = Project_Category::orderBy('id', 'asc')->get();
        foreach ($list_proj2 as $value)
            $project2[$value->project_name] = $value->project_name;

        $project3      = ['' => '-Select-'];
        $list_proj3 = Project_Category::orderBy('id', 'asc')->get();
        foreach ($list_proj3 as $value)
            $project3[$value->project_name] = $value->project_name;

        $level          = ['' => '-Select-', 'USER' => 'User', 'HUMAN RESOURCE' => 'Human Resource', 'HEAD OF DEPARTMENT' => 'Head of Department', 'GENERAL MANAGER' => 'General Manager'];
        $gender         = ['' => '-Select-', 'Male' => 'Male', 'Female' => 'Female'];
        $emp_status     = ['' => '-Select-', 'Permanent' => 'Permanent', 'Contract' => 'Contract', 'PKL' => 'PKL'];
        $marital_status = ['' => '-Select-', 'Single' => 'Single', 'Married' => 'Married', 'Widowed' => 'Widowed [widowed because her husband passed away]', 'Widower' => 'Widower [widower because his wife passed away]', 'Divorced/Divorcee' => 'Divorced/Divorcee'];
        $rusun_stat     = ['' => '-Select-', 'Sharing' => 'Sharing', 'Single Paid' => 'Single Paid', 'Single Free' => 'Single Free', 'None' => 'None'];

        return View::make('mgmt-data.user.createHR')
            ->with([
                'level' => $level,
                'gender' => $gender,
                'department' => $department,
                'project1' => $project1,
                'project2' => $project2,
                'project3' => $project3,
                'emp_status' => $emp_status,
                'marital_status' => $marital_status,
                'rusun_stat' => $rusun_stat
            ]);
    }

    public function storeUser(Request $request)
    {
        $active    = 0;
        $admin     = 0;
        $user      = 1;
        $hr        = 0;
        $hd        = 0;
        $gm        = 0;
        $sp        = 0;
        $ticket       = 0;
        $prof_pict = 'no_avatar.jpg';

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
            'username'         => 'required|unique:users,username',
            'nik'              => 'required',
            'first_name'       => 'required',
            'position'         => 'required',
            'emp_status'       => 'required',
            'email'              => 'required|email',
            'dept_category_id' => 'required',
            'prof_pict'        => 'image|nullable|max:1024'
        ];

        if ($request->hasFile('prof_pict') && $request->file('prof_pict')->isValid()) {
            $file      =  $request->file('prof_pict');
            $prof_pict = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('prof_pict', $prof_pict);
        } else {
            $prof_pict = 'no_avatar.jpg';
        }

        // date_diff(date_create($request->input('join_date')), date_create($request->input('end_date'))->modify('+5 day'))->format('%m')+(12*date_diff(date_create($request->input('join_date')), date_create($request->input('end_date'))->modify('+5 day'))->format('%y'))

        $interval = date_diff(date_create($request->input('join_date')),  date_create(date($request->input('end_date'))));
        $pass = $interval->y * 12;
        $passs = $pass + $interval->m;

        $data = [
            'username'              => $request->input('username'),
            'password'              => Hash::make('Batam' . Date('Y')),
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
            'initial_annual'        => $passs,
            'active'                => $active,
            'admin'                 => $admin,
            'hr'                    => $hr,
            'hd'                    => $hd,
            'gm'                    => $gm,
            'user'                  => $user,
            'sp'                    => $sp,
            'ticket'                => $ticket,
            'prof_pict'             => $prof_pict,
            'request_ip'            => request()->ip(),
            'created_by'            => Auth::user()->first_name . ' ' . Auth::user()->last_name,
            'remember_token'        => Hash::make($request->input('password'))
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('hr_mgmt-data/user/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            User::insert($data);
            Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data User']));
            return Redirect::route('hr_mgmt-data/user');
        }
    }

    public function editDataUser($id)
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
            return Redirect::route('hr_mgmt-data/user');
        } else {
            return View::make('mgmt-data.user.edit-dataHR')
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

    public function editPasswordUser($id)
    {
        return View::make('mgmt-data.user.edit-passwordHR')->with(['users' => User::find($id)]);
    }

    public function saveDataUser($id)
    {
        $select = NewUser::joinDeptCategory()->find($id);
        $return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
            </div>
            <div class='modal-body'>
                <div class='well'>
                    <h4>Are you sure want to update data ?</h4>
                </div>
            </div>
            <div class='modal-footer'>
            	<a type='button' class='btn btn-primary' href='" . URL::route('hr_mgmt-data/user', [$id]) . "'>Yes</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }
    public function updateDataUser(Request $request, $id)
    {
        $users          = User::find($id);
        $active         = 0;
        // $admin          = 0;
        // $user           = 0;
        // $hr             = 0;
        // $hd             = 0;
        // $gm             = 0;
        $sp             = 0;
        $ticket         = 0;
        $initial_annual = date_diff(date_create($request->input('join_date')), date_create($request->input('end_date'))->modify('+5 day'))->format('%m');
        $prof_pict      = $users->prof_pict;

        //return $users->prof_pict;

        if ($users->emp_status === "Contract") {
            $initial_annual = date_diff(date_create($request->input('join_date')), date_create($request->input('end_date'))->modify('+5 day'))->format('%m') + (12 * date_diff(date_create($request->input('join_date')), date_create($request->input('end_date'))->modify('+5 day'))->format('%y'));
        } else {
            $initial_annual = $request->input('initial_annual');
        }

        ////////////////////////////////////////////
        $date1 = $request->input('join_date');
        $date2 = $request->input('end_date');

        $ts1 = strtotime($date1);
        $ts2 = strtotime($date2);

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);

        $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
        ///////////////////////////////////////////////


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
            'email'              => 'required|email',
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
            // 'project'            => $request->input('project'),
            'project_category_id_1' => Project_Category::where('project_name', $request->input('project_category_id_1'))->value('id'),
            'project_category_id_2' => Project_Category::where('project_name', $request->input('project_category_id_2'))->value('id'),
            'project_category_id_3' => Project_Category::where('project_name', $request->input('project_category_id_3'))->value('id'),
            // 'initial_annual'     => date_diff(date_create($request->input('join_date')), date_create($request->input('end_date')))->format('%m'),
            'initial_annual'        => $initial_annual,
            'active'                => $active,
            // 'admin'              => $admin,
            // 'hr'                 => $hr,
            // 'hd'                 => $hd,
            // 'gm'                 => $gm,
            // 'user'               => $user,
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
            return Redirect::route('hr_mgmt-data/user/edit-data', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        } else {
            User::where('id', $id)->update($data);
            Log_User::insert($data_log);
            // User::where('id', $id)->update($data);
            Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
            // return Redirect::route('hr_mgmt-data/user');
            return Redirect::route('hr_mgmt-data/user', ['id' => $id]);
        }
    }

    public function updatePasswordUser(Request $request, $id)
    {
        $rules = [
            'newpassword'      => 'required|alpha_dash|min:5',
            'confnewpassword' => 'required|alpha_dash|min:5|same:newpassword'
        ];
        $data = [
            'password' => Hash::make($request->input('newpassword'))
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('hr_mgmt-data/user/edit-password', ['id' => $id])
                ->withErrors($validator);
        } else {
            User::where('id', $id)->update($data);
            Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
            return Redirect::route('hr_mgmt-data/user/getIndexUser', ['id' => $id]);
        }
    }
    // End Route Management Data > Data User


    // Start Route Management Data > Previlege
    public function indexPrevilege()
    {
        return View::make('mgmt-data.previlege.indexPrevilege');
    }

    public function getIndexPrevilege()
    {
        $select = NewUser::joinDeptCategory()->select(['users.id', 'users.nik', 'users.first_name', 'users.last_name', 'dept_category.dept_category_name', 'users.admin', 'users.hr', 'users.hd', 'users.gm', 'users.user', 'users.active'])
            ->where('users.username', '!=', 'admin')
            ->where('users.username', '!=', 'hr')
            ->where('users.nik', '!=', null)
            ->where('users.nik', '!=', 123456789)
            ->get();

        return Datatables::of($select)
            ->edit_column('active', '@if ($active === 1){{ "Active" }}@else{{ "Suspend" }}@endif')
            ->edit_column('admin', '@if ($admin === 1){{ "ADMIN" }} @elseif ($hr === 1){{ "HUMAN RESOURCE" }} @elseif ($hd === 1){{ "HEAD DEPARTMENT" }} @elseif ($gm === 1){{ "GENERAL MANAGER" }} @else{{ "USER" }} @endif')
            ->add_column(
                'actions',
                '@if ($admin !== 1)' .
                    Lang::get('messages.btn_warning', ['title' => 'Change Previlege', 'url' => '{{ URL::route(\'hr_mgmt-data/previlege/edit-previlege\', [$id]) }}', 'class' => 'pencil'])
                    . '@endif'
            )
            ->setRowClass('@if ($active === 0){{ "danger" }}@endif')
            ->make();
    }

    public function editPrevilege($id)
    {
        $dept   = dept_category::where(['id' => User::find($id)->dept_category_id])->value('dept_category_name');
        $level  = ['USER' => 'User', 'HUMAN RESOURCE' => 'Human Resource', 'HEAD OF DEPARTMENT' => 'Head of Department', 'GENERAL MANAGER' => 'General Manager'];
        $access = '';

        if (User::find($id)->user === 1) {
            $access = 'USER';
        } else if (User::find($id)->hr === 1) {
            $access = 'HUMAN RESOURCE';
        } else if (User::find($id)->hd === 1) {
            $access = 'HEAD OF DEPARTMENT';
        } else if (User::find($id)->hrd === 1) {
            $access = 'HR HEAD OF DEPARTMENT';
        } else if (User::find($id)->koor === 1) {
            $access = 'Koordinator';
        } else if (User::find($id)->spv === 1) {
            $access = 'Supervisor';
        } else if (User::find($id)->pm === 1) {
            $access = 'Project Manager';
        } else if (User::find($id)->producer === 1) {
            $access = 'Producer';
        } else $access = 'GENERAL MANAGER';

        return View::make('mgmt-data.previlege.edit-previlege')->with(['dept' => $dept, 'level' => $level, 'access' => $access, 'users' => User::find($id)]);
    }

    public function updatePrevilege(Request $request, $id)
    {
        $users          = User::find($id);
        // $active         = 0;

        // $user           = 0;
        $hr             = 0;
        $hrd            = 0;
        $koor           = 0;
        $spv            = 0;
        $pm             = 0;
        $producer       = 0;
        $hd             = 0;
        $gm             = 0;
        $sp             = 0;


        if ($request->has('active') && $request->input('active') === "Active") {
            $active = 1;
        }

        if ($request->has('sp') && $request->input('sp') === "GM Approval") {
            $sp = 1;
        }

        if ($request->has('hr') && $request->input('hr') === "Human Resource") {
            $hr = 1;
        }

        if ($request->has('hd') && $request->input('hd') === "Head of Department") {
            $hd = 1;
            $sp = 1;
        }
        if ($request->has('hrd') && $request->input('hrd') === "HR Head of Department") {
            $hrd = 1;
            $sp = 1;
        }

        if ($request->has('gm') && $request->input('gm') === "General Manager") {
            $gm = 1;
        }
        if ($request->has('koor') && $request->input('koor') === "Koordinator") {
            $koor = 1;
        }
        if ($request->has('spv') && $request->input('spv') === "Supervisor") {
            $spv = 1;
        }
        if ($request->has('pm') && $request->input('pm') === "Project Manager") {
            $pm = 1;
        }
        if ($request->has('producer') && $request->input('producer') === "Producer") {
            $producer = 1;
        }

        $rules = [];

        $data = [


            'hr'                   => $hr,
            'hd'                   => $hd,
            'hrd'                  => $hrd,
            'gm'                   => $gm,
            'koor'                   => $koor,
            'spv'                   => $spv,
            'pm'                   => $pm,
            'producer'               => $producer,
            'sp'                   => $sp
        ];
        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return Redirect::route('hr_mgmt-data/previlege/edit-previlege', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        } else {
            User::where('id', $id)->update($data);
            Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
            return Redirect::route('hr_mgmt-data/previlege', ['id' => $id]);
        }
    }
    // End Route Management Data > Previlege

    // Start Route Management Data > Initial Leave
    public function indexInitial()
    {
        return View::make('mgmt-data.initial.indexHR');
    }

    public function getIndexInitial()
    {
        $select =  User::select([
            'id', 'first_name', 'last_name', 'nik', 'dept_category_id', 'position',
        ])
            ->orderBy('first_name', 'asc')
            ->where('users.username', '!=', 'admin')
            ->where('users.username', '!=', 'hr')
            ->where('active', 1)
            ->where('users.nik', '!=', null)
            ->where('users.nik', '!=', 123456789)
            ->where('users.emp_status', '!=', 'Outsource')
            ->get();

        return Datatables::of($select)
            ->addIndexColumn()
            ->addColumn('exdo', function (User $user) {
                $exdo = Initial_leave::where('user_id', $user->id)->pluck('initial');
                $taken = Leave::where('leave_category_id', 2)->where('user_id', $user->id)->where('ap_hrd', 1)->pluck('total_day');

                $return = $exdo->sum() - $taken->sum();

                return $return;
            })
            ->add_column(
                'actions',
                Lang::get('messages.btn_primary', ['title' => 'Add Leave', 'url' => '{{ URL::route(\'hr_mgmt-data/initial/create\', [$id]) }}', 'class' => 'pencil'])
            )
            ->editColumn('first_name', function (User $user) {
                return $user->first_name . ' ' . $user->last_name;
            })
            ->editColumn('dept_category_id', function (User $user) {
                $department = Dept_Category::find($user->dept_category_id);

                return $department->dept_category_name;
            })
            ->make(true);
    }

    /*public function getIndexInitial()
	{
		$select =  NewUser::joinDeptCategory()->JoinLeaveView()->select(['users.id', 'users.nik', 'users.first_name', 'users.last_name', 'dept_category.dept_category_name', 'all_leave_entitled.day_off_balance',])
		->where('users.username', '!=', 'admin')
		->where('users.username', '!=', 'hr')
		->where('active', 1)
		->where('users.nik', '!=', null)
		->where('users.nik', '!=', 123456789)
		->get();

		return Datatables::of($select)
			->add_column('actions',
				Lang::get('messages.btn_primary', ['title' => 'Add Leave', 'url' => '{{ URL::route(\'hr_mgmt-data/initial/create\', [$id]) }}', 'class' => 'pencil'])
			    )
			->make();
	}*/

    public function getIndexInitial2()
    {

        $select = Initial_leave::JoinUsers()->JoinDeptCategory()->select([
            'initial_leave.id', 'initial_leave.leave_category_id', 'initial_leave.input_date', 'initial_leave.expired', 'initial_leave.note', 'initial_leave.initial', 'initial_leave.note2',
            'users.nik', 'users.first_name', 'users.last_name', 'users.position', 'dept_category.dept_category_name'
        ])->orderBy('initial_leave.created_at', 'desc')
            ->whereYear('initial_leave.expired', date('Y'))
            ->where('users.active', 1)
            ->where('users.nik', '!=', null)
            ->where('users.nik', '!=', 123456789)
            ->get();

        return Datatables::of($select)
            ->addIndexColumn()
            ->addColumn('fullName', function (Initial_leave $initial) {
                return $initial['first_name'] . ' ' . $initial['last_name'];
            })
            ->add_column(
                'actions',
                Lang::get('messages.btn_danger', ['url' => '{{ URL::route(\'hr_mgmt-data/initial/delete\', [$id]) }}', 'data' => 'Initial data']) .
                    Lang::get('messages.btn_warning', ['url' => '{{ URL::route(\'hr_mgmt-data/initial/exdo/limit\', [$id]) }}', 'title' => 'Edit Initial EXdo data', 'class' => 'pencil'])
            )
            ->editColumn('leave_category_id', function (Initial_leave $initial) {
                $leave_Category = Leave_Category::find($initial->leave_category_id);

                return $leave_Category['leave_category_name'];
            })
            ->make(true);
    }

    public function indexExpiredExdo($id)
    {
        $data = Initial_leave::JoinUsers()->JoinDeptCategory()->findOrfail($id);

        return view('mgmt-data.initial.editExdoLimit', compact(['data', 'id']));
    }

    public function storeExpiredExdo(Request $request, $id)
    {
        $rules = [
            'expired' => 'required|date',
            'initial' => 'required|numeric'
        ];

        $data = [
            'id'    => $id,
            'expired' => $request->input('expired'),
            'initial' => $request->input('initial'),
            'note'      => $request->input('note'),
            'note2'      => $request->input('note2'),
        ];

        $validator = Validator::make($request->all(), $rules);

        // dd($data);
        if ($validator->fails()) {
            return Redirect::route('hr_mgmt-data/initial/exdo/limit', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {
            Initial_Leave::where('id', $id)->update($data);
            Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data Initial']));
            return Redirect::route('hr_mgmt-data/initial');
        }
    }

    /*public function getIndexInitial2()
	{
		$select = Initial_leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select(['initial_leave.id', 'users.nik', 'users.first_name', 'users.last_name', 'dept_category.dept_category_name', 'initial_leave.initial', 'leave_category.leave_category_name', 'initial_leave.input_date',  'initial_leave.exp_date', 'initial_leave.note'])
			->where('users.username', '!=', 'admin')
		    ->where('users.username', '!=', 'hr')
		    ->get();

		return Datatables::of($select)
			->add_column('actions',
				Lang::get('messages.btn_danger', ['url' => '{{ URL::route(\'hr_mgmt-data/initial/delete\', [$id]) }}', 'data' => 'Initial data'])
			    )
			->make();
	}*/



    public function createInitial($id)
    {
        $department   = dept_category::where(['id' => User::find($id)->dept_category_id])->value('dept_category_name');
        $leave        = [];
        //$list_leave = Leave_Category::where('id', '<', '3')->orderBy('id','asc')->get();
        $list_leave   = Leave_Category::where('id', '=', '2')->orderBy('id', 'asc')->get();
        foreach ($list_leave as $value)
            $leave[$value->leave_category_name] = $value->leave_category_name;

        return View::make('mgmt-data.initial.createHR')->with(['leave' => $leave, 'department' => $department, 'users' => User::find($id)]);
    }

    public function createdLimit()
    {
        echo '<a href="' . route('hr_mgmt-data/initial/storeLimit') . '" class="btn btn-sm btn-info">2021-12-31</a>';
    }

    public function storeLimit()
    {
        $limit = '2021-12-31';

        Initial_Leave::select('*')->update([
            'expired' => $limit
        ]);

        return Redirect::route('hr_mgmt-data/initial');
    }

    public function storeInitial(Request $request, $id)
    {
        $rules = [
            // 'input_date' => 'required',
            //'exp_date' => 'required',
            'initial'  => 'required|numeric'
        ];

        $inputDate = $request->input('input_date');

        $monthDate = date('Y-m-d', strtotime('+1 month', strtotime($inputDate)));

        $expDate = date('Y-m-d', strtotime('+14 days', strtotime($monthDate)));

        if ($inputDate === null) {
            $limit = '2021-12-31';
        } else {
            $limit = $inputDate;
        }

        $data = [
            'leave_category_id' => leave_Category::where('leave_category_name', $request->input('leave_category_id'))->value('id'),
            'user_id'           => User::find($id)->id,
            'initial'           => $request->input('initial'),
            'input_date'        => $inputDate,
            'expired'           => $limit,
            'note'              => $request->input('note'),
            'created_by'        => Auth::user()->first_name . ' ' . Auth::user()->last_name
        ];
        $validator = Validator::make($request->all(), $rules);
        // dd($data);
        if ($validator->fails()) {
            return Redirect::route('hr_mgmt-data/initial/create', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {
            Initial_Leave::insert($data);
            Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data Initial']));
            return Redirect::route('hr_mgmt-data/initial');
        }
    }

    public function destroyInitial($id)
    {
        $initial = Initial_leave::find($id);

        $initial->delete();
        Session::flash('message', Lang::get('messages.data_deleted', ['data' => 'Initial Data']));
        return Redirect::route('hr_mgmt-data/initial');
    }
    // End Route Management Data > Initial Leave


    // Start HR Verification
    public function indexLeaveApproval()
    {
        return View::make('leave.indexHR_Ver');
    }

    public function getIndexLeaveHR_Ver()
    {
        $select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([
            'leave_transaction.id',
            'leave_transaction.ver_hr',
            'leave_transaction.ap_hrd',
            'leave_transaction.request_nik',
            'leave_transaction.request_by',
            'leave_transaction.leave_date',
            'leave_category.leave_category_name',
            'users.sp',
            'dept_category.dept_category_name',
            'leave_transaction.total_day',
            'leave_transaction.req_advance'
        ])
            ->where('leave_transaction.ap_producer', 1)
            ->where('leave_transaction.ver_hr', 0)
            ->where('leave_transaction.ap_hd', '=', 1)
            ->get();

        return Datatables::of($select)
            ->edit_column('ap_hrd', '@if ($ap_hrd === 1){{ "WAITING HR" }} @elseif ($ap_hrd === 2){{"DISAPPROVED"}} @elseif ($ver_hr === 0){{ "WAITING HR" }} @elseif ($ver_hr === 1){{ "PENDING" }}@endif')
            ->edit_column('ver_hr', '@if ($ver_hr === 1){{ "VERIFIED" }}@else{{ "PENDING" }}@endif')
            ->edit_column('leave_date', '{!! date("M d, Y", strtotime($leave_date)) !!}')
            ->edit_column('sp', '@if ($sp === 0){{"Staff"}} @else {{"HOD"}} @endif')
            ->edit_column('req_advance', '@if($req_advance === 1){{"urgent"}} @else {{" "}} @endif')
            ->setRowClass('@if ($req_advance === 1){{ "danger" }}@endif')
            ->add_column(
                'actions',
                '@if ($ver_hr === 0)' .
                    Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'ver_hr/detail\', [$id]) }}', 'class' => 'check-square'])
                    . '@endif'
            )
            ->make();
    }

    public function detailLeaveHR($id)
    {

        $leave = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);

        $coor = null;
        $spv = null;
        $spvV = null;
        $pm = null;
        $pmM = null;
        $head = null;
        $req_advance = null;

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

        if ($leave->req_advance == 1) {
            $req_advance = "- (Advance)";
        }

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
                    <strong>Leave Category :</strong> $leave->leave_category_name $req_advance <br>
                    <strong>Start Leave :</strong> $leave->leave_date <br>
                    <strong>End Leave :</strong> $leave->end_leave_date <br>
                    <strong>Back to Work:</strong> $leave->back_work <br>
                    <strong>Total Day :</strong> $leave->total_day <br>
                    <strong>Remain :</strong> $leave->remain <br>
                    <strong>Total Annual :</strong> $leave->pending <br>
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
            <a class='btn btn-primary' href='" . URL::route('ver_hr/ver', [$id]) . "'>Verify</a>
            <a class='btn btn-primary' href='" . URL::route('ver_hr/unver', [$id]) . "'>Unverify</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

    public function verLeave(Request $request, $id)
    {
        $email       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);

        // tambahan forfeitedCounts nya dengan status 1

        $ver_hr      = 1;

        if ($email->resendmail === 2) {
            $counterMail = $email->resendmail;
        } elseif ($email->resendmail === 1) {
            $counterMail = $email->resendmail + 1;
        } elseif ($email->resendmail === 0) {
            $counterMail = $email->resendmail + 2;
        }

        $date_ver_hr = date("Y-m-d");

        $data        = [
            'ver_hr'      => $ver_hr,
            'ap_hd'       => 1,
            'ap_hrd'      => 1,
            'ap_gm'       => 1,
            'ver_hr_by'   => Auth::user()->first_name . ' ' . Auth::user()->last_name,
            'date_ver_hr' => $date_ver_hr,
            'date_ap_hrd' => $date_ver_hr,
            'resendmail'  => 0
        ];

        if ($email->gm === 1) {
            $data = [
                'ver_hr'      => $ver_hr,
                'ap_hd'       => 1,
                'ap_spv'      => 1,
                'ap_infinite' => 0,
                'ap_gm'       => 1,
                'ver_hr_by'   => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                'date_ver_hr' => $date_ver_hr,
                'resendmail'  => 0
            ];
        }


        Leave::where('id', $id)->update($data);

        $leaveForfeited = ForfeitedCounts::where('leave_id', $id)->first();

        if ($leaveForfeited) {
            $leaveForfeited->update(['status' => 1]);
        }

        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));

        // event(new LeaveVerificatedByHr($email));

        // $this->sendVerEmail($email);
        FacadesMail::send('email.apprvedMail', ['email' => $email], function ($message) use ($email) {
            $message->to($email->email)->subject('[Notification] Leave Application - WIS');
            $message->from('wis_system@infinitestudios.id', 'WIS');
        });

        return Redirect::route('leave/HR_ver');
    }

    public function sendVerEmail($email)
    {
        $hrd_email  = DB::table('users')
            ->select(DB::raw('email'))
            ->where('hrd', '=', 1)
            ->value('email');

        $deptHead = User::find(auth::user()->id);

        Mail::send('email.Notifikasi.Leave.verByMail', ['email' => $email, 'deptHead' => $deptHead], function ($message) use ($hrd_email, $email) {
            $message->to($hrd_email, 'WIS')->subject('[Approved] Leave Application - ' . $email->request_by . '');
            $message->from('wis_system@frameworks-studios.com', 'WIS');
        });
    }

    public function unVerLeave(Request $request, $id)
    {
        $email       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);

        if ($email->resendmail === 2) {
            $counterMail = $email->resendmail - 2;
        } elseif ($email->resendmail === 1) {
            $counterMail = $email->resendmail - 1;
        } elseif ($email->resendmail === 0) {
            $counterMail = $email->resendmail;
        }

        $ver_hr      = 2;

        $date_ver_hr = date("Y-m-d");
        $data        = [
            'ver_hr'      => $ver_hr,
            'ap_hrd'      => 5,
            'ap_gm'          => 1,
            'ver_hr_by'   => Auth::user()->first_name . ' ' . Auth::user()->last_name,
            'date_ver_hr' => $date_ver_hr,
            'resendmail'  => $counterMail
        ];

        Leave::where('id', $id)->update($data);

        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));

        $email2       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);
        Mail::send('email.unVerMail', ['email2' => $email2], function ($message) use ($email2) {
            $message->to($email2->email)->subject('[Unverified] Leave Application - WIS');
            $message->from('wis_system@frameworks-studios.com', 'WIS');
        });

        return Redirect::route('leave/HR_ver');
    }
    // End HR Verification

    // Start Department
    public function indexDepartment()
    {
        return View::make('mgmt-data.department.indexDepartmentHR');
    }

    public function getIndexDepartment()
    {
        $select = Dept_Category::select(['id', 'dept_category_name']);

        return Datatables::of($select)
            ->make();
    }

    public function createDepartment()
    {
        return View::make('mgmt-data.department.createDepartmentHR');
    }

    public function storeDepartment(Request $request)
    {
        $rules = [
            'department' => 'required|unique:dept_category,dept_category_name'
        ];
        $data = [
            'dept_category_name' => $request->input('department'),
            'created_by'   => Auth::user()->first_name . ' ' . Auth::user()->last_name
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('hr_mgmt-data/department/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            Dept_Category::insert($data);
            Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data Department']));
            return Redirect::route('hr_mgmt-data/department');
        }
    }
    // End Department

    // Start Job Function
    public function indexJobFunction()
    {
        return View::make('mgmt-data.jobFunction.indexJobFunctionHR');
    }

    public function getIndexJobFunction()
    {
        $select = JobFunction_Category::select(['id', 'jobFunction_name']);

        return Datatables::of($select)
            ->make();
    }

    public function createJobFunction()
    {
        return View::make('mgmt-data.jobFunction.createJobFunctionHR');
    }

    public function storeJobFunction(Request $request)
    {
        $rules = [
            'jobFunction' => 'required|unique:jobFunction_category,jobFunction_name'
        ];
        $data = [
            'jobFunction_name' => $request->input('jobFunction'),
            'created_by'         => Auth::user()->first_name . ' ' . Auth::user()->last_name
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('hr_mgmt-data/jobFunction/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            JobFunction_Category::insert($data);
            Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data Job Function']));
            return Redirect::route('hr_mgmt-data/jobFunction');
        }
    }
    // End Job Function

    // Start Project
    public function indexProject()
    {
        return View::make('mgmt-data.project.indexProjectHR');
    }

    public function getIndexProject()
    {
        $select = Project_Category::select(['id', 'project_name']);

        return Datatables::of($select)
            ->make();
    }

    public function createProject()
    {
        return View::make('mgmt-data.project.createProjectHR');
    }

    public function storeProject(Request $request)
    {
        $rules = [
            'project' => 'required|unique:project_category,project_name'
        ];
        $data = [
            'project_name' => $request->input('project'),
            'created_by'   => Auth::user()->first_name . ' ' . Auth::user()->last_name
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('hr_mgmt-data/project/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            Project_Category::insert($data);
            Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data project']));
            return Redirect::route('hr_mgmt-data/project');
        }
    }
    // End Project

    // Start User Project
    public function indexUserProject()
    {
        return View::make('mgmt-data.userProject.indexUserProjectHR');
    }

    public function getIndexUserProject()
    {
        // $select = User_project::joinUsers()->joinProjCategory1()->select(['user_project.id', 'users.nik', 'users.first_name', 'users.last_name', 'project_category.project_name', 'user_project.proj2', 'user_project.proj3']);

        $select = DB::select('select
							 `user_project`.`id`,
							 `users`.`nik`,
							 `users`.`first_name`,
							 `users`.`last_name`,
							 `p1`.`project_name` AS po1,
							 `p2`.`project_name` AS po2,
							 `p3`.`project_name` AS po3
							 from `user_project`
							 left join `users` on `users`.`id` = `user_project`.`user_id`
							 left join `project_category` p1 on `user_project`.`proj1` = p1.`id`
							 left join `project_category` p2 on `user_project`.`proj2` = p2.`id`
							 left join `project_category` p3 on `user_project`.`proj3` = p3.`id`');

        return Datatables::of($select)
            ->add_column(
                'actions',
                Lang::get('messages.btn_warning', ['title' => 'Change Project', 'url' => '{{ URL::route(\'hr_mgmt-data/userProject/edit-data\', [$id]) }}', 'class' => 'pencil'])
            )
            ->make();
    }

    public function createUserProject()
    {
        $project = ['' => '-Select-'];
        $list_proj  = Project_Category::orderBy('id', 'asc')->get();
        foreach ($list_proj as $value)
            $project[$value->project_name] = $value->project_name;

        $user = ['' => '-Select-'];
        $list_user  = User::orderBy('nik', 'asc')->where('nik', '!=', null)->get();
        foreach ($list_user as $value)
            $user[$value->nik] = $value->nik;

        return View::make('mgmt-data.userProject.createUserProjectHR')->with(['project' => $project, 'user' => $user]);
    }

    public function storeUserProject(Request $request)
    {
        $rules = [
            'project' => 'required|unique:project_category,project_name'
        ];
        $data = [
            'project_name' => $request->input('project'),
            'created_by'   => Auth::user()->first_name . ' ' . Auth::user()->last_name
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('hr_mgmt-data/project/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            Project_Category::insert($data);
            Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data project']));
            return Redirect::route('hr_mgmt-data/project');
        }
    }
    // End Project

    // Start Leave Report
    public function indexLeaveReport()
    {
        return View::make('leave_report.indexLeaveReport');
    }

    public function indexLeaveEntitledReport()
    {
        return View::make('leave_report.preview_LeaveReport');
    }

    public function indexLeaveTransactionReport()
    {
        return View::make('leave_report.preview_LeaveTransactionReport');
    }

    public function indexHistoricalTransactionReport()
    {
        return View::make('leave_report.indexHistoricalTransactionReport');
    }

    public function getIndexLeaveEntitled()
    {
        $select = Entitled_leave_view::joinDeptCategory()->joinUsers()->select([
            'all_leave_entitled.nik',
            'all_leave_entitled.name',
            'all_leave_entitled.emp_status',
            'dept_category.dept_category_name',
            'users.join_date',
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
            ->where('users.active', 1)
            ->whereNotIn('users.nik', ["", "123456789"])
            ->get();

        return Datatables::of($select)
            ->make();
    }

    public function getIndexLeaveTransactionReport(Request $id)
    {

        $select = Leave::joinLeaveCategory()->joinUsers()->joinDeptCategory()->select([
            'leave_transaction.id',
            'leave_transaction.request_nik',
            'leave_transaction.request_by',
            'leave_transaction.request_dept_category_name',
            // 'dept_category.dept_category_name',
            'leave_transaction.request_position',
            'leave_category.leave_category_name',
            'leave_transaction.period',

            'leave_transaction.leave_date',
            'leave_transaction.total_day',

        ])
            ->where('leave_transaction.ver_hr', '=', 1)
            ->where('leave_transaction.ap_hd', '=', 1)
            // ->where('leave_transaction.ap_gm', '=', 0)
            ->where('leave_transaction.request_nik', '!=', null);

        return Datatables::of($select)

            ->add_column(
                'actions',
                Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'hr_mgmt-data/leaveTransactionReport/cdetail\', [$id]) }}', 'class' => 'trash'])

                //.Lang::get('messages.btn_warning', ['title' => 'Actived Transaction', 'url' => '{{ URL::route(\'hr_mgmt-data/leaveTransactionReport/uncancel\', [$id]) }}',  'class' => 'trash'])
            )

            ->make();
    }

    public function detailTransaction($id)
    {
        $select = Leave::joinLeaveCategory()->joinUsers()->joinDeptCategory()->find($id);
        $return   = "
             <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'>Cancel Leave Transaction</h4>
            </div>
            <div class='modal-body'>
                <div class='well'>
                    <h4>Are you sure want to Canceled<strong>
                    </h4>
                </div>
            </div>
            <div class='modal-footer'>
            	<a type='button' class='btn btn-primary' href='" . URL::route('hr_mgmt-data/leaveTransactionReport/cancel', [$id]) . "'>Canceled</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

    public function getIndexHistoricalTransactionReport(Request $id)
    {
        $select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([

            'leave_transaction.id',
            'users.nik',

            'leave_transaction.request_by',
            'leave_category.leave_category_name',
            'leave_transaction.leave_date',
            'leave_transaction.total_day',
            'leave_transaction.ver_hr',
            'leave_transaction.ap_hd',
            'leave_transaction.ap_hrd',
            // 'users.sp',
            'leave_transaction.leave_cancel'
        ]);

        return Datatables::of($select)
            ->edit_column('ap_hd', '@if ($ap_hd === 1){{ "APPROVED" }} @elseif ($ap_hd === 2){{"DISAPPROVED"}} @elseif ($ver_hr === 0){{ "WAITING HR" }} @elseif ($ver_hr === 1){{ "PENDING" }}@endif')
            ->edit_column('ap_hrd', '@if ($ap_hrd === 1){{ "APPROVED" }} @elseif ($ap_hrd === 2){{"DISAPPROVED"}} @elseif ($ver_hr === 1 and $ap_hd === 0){{ "WAITING HD" }} @elseif ($ver_hr === 0 and $ap_hd === 0){{ "WAITING HR" }} @elseif ($ver_hr === 0 and $ap_hd === 1){{ "WAITING HR" }} @elseif ($ap_hd === 1 and $ver_hr === 1 and $ap_hrd === 0){{ "PENDING" }} @elseif ($ap_hrd === 5){{"--"}} @endif')
            //->edit_column('sp', '@if ($sp === 0){{"KARYAWAN"}} @else {{"MANAGER"}} @endif')
            ->edit_column('ver_hr', '@if ($ver_hr === 1){{ "VERIFIED" }} @elseif ($ver_hr === 0){{ "PENDING" }} @elseif ($ver_hr === 2){{ "UNVERIFIED" }} @elseif ($ver_hr === 3){{ "CANCEL" }} @endif')

            ->edit_column('leave_cancel', '@if ($ver_hr === 3){{"CANCEL"}} @elseif ($ver_hr === 1 and $ap_hd === 1 and $ap_hrd === 1 or $ap_hrd === 5  ) {{"COMPLETE"}} @elseif ($ver_hr === 1 and $ap_hd === 1 and $ap_hrd === 5 ) {{"COMPLETE"}} @elseif ($ver_hr === 3 or $ver_hr === 2) {{"COMPLETE"}} @elseif ($ver_hr === 0) {{"PROGRESS"}} @elseif ($ver_hr === 1 and $ap_hd === 0) {{"PROGRESS"}} @elseif ($ver_hr === 1 and $ap_hd === 1 and $ap_hrd === 0) {{"PROGRESS"}} @endif')
            //  ->edit_column('leave_cancel', '@if (@ver_hr === 0 and @ap_hd === 0 and $ap_hrd === 0){{"PROGRESS"}} @elseif (@ver_hr === 2){{"COMPLETED"}} @endif')

            ->edit_column('leave_date', '{!! date("M d, Y", strtotime($leave_date)) !!}')

            ->add_column(
                'actions',
                Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'leave/detail\', [$id]) }}', 'class' => 'file'])
                    . Lang::get('messages.btn_warning', ['title' => 'Actived Transaction', 'url' => '{{ URL::route(\'hr_mgmt-data/leaveTransactionReport/uncancel\', [$id]) }}',  'class' => 'trash'])/*.
            '@if ($ap_hd === 1 && $ap_hrd === 1 && $ver_hr === 1)'
            .Lang::get('messages.btn_print', ['title' => 'Print', 'url' => '{{ URL::route(\'leave/print1\', [$id]) }}', 'class' => 'print']).
            '@elseif ($ap_hd === 1 && $ap_hrd === 5 && $ver_hr === 1)'
            .Lang::get('messages.btn_print', ['title' => 'Print', 'url' => '{{ URL::route(\'leave/print\', [$id]) }}', 'class' => 'print'])
            .'@endif'*/
            )
            ->make();
    }

    public function cancelLeaveTransaction(Request $request, $id)
    {
        $cancel       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);

        $leave_cancel     = 1;
        $ver_hr      = 3;
        $date_cancel = date("Y-m-d");
        $data        = [
            'leave_cancel'      => $leave_cancel,
            'ver_hr'      => $ver_hr,
            'cancel_date' => $date_cancel
        ];

        Leave::where('id', $id)->update($data);
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave Transaction Report']));

        // event(new LeaveVerificatedByHr($email));


        return Redirect::route('hr_mgmt-data/leaveTransactionReport');
    }

    public function uncancelLeaveTransaction(Request $request, $id)
    {
        $cancel       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);

        $leave_cancel     = 0;
        $ver_hr      = 1;
        $date_cancel = date("Y-m-d");
        $data        = [
            'leave_cancel'      => $leave_cancel + 1,
            'ver_hr'      => $ver_hr,
            'uncancel_date' => $date_cancel
        ];

        Leave::where('id', $id)->update($data);
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave Transaction Report']));

        return Redirect::route('hr_mgmt-data/leaveTransactionReport');
    }

    public function destroyLeave($id)
    {
        $initial = leave::find($id);

        $initial->delete();
        Session::flash('message', Lang::get('messages.data_deleted', ['data' => 'Data Leave Transaction']));
        return Redirect::route('hr_mgmt-data/leaveTransactionReport');
    }

    // public function previewLeaveReport()
    // {
    //     $leave_data = Entitled_leave_view::select(['*'])->get();

    // 	return View::make('leave_report.previewLeaveReport')->with(['leave_data' => $leave_data]);;
    // }

    // public function printLeaveReport(Request $request)
    // {
    // 	$leave_data = Entitled_leave_view::select(['*'])->get();

    // 	Excel::create('Leave Report', function($excel) use($leave_data) {
    //         	$excel->sheet('ALL', function($sheet) use($leave_data) {
    //             $sheet->loadView('leave_report.printLeaveReport', ['leave_data' => $leave_data]);
    //             $sheet->setFreeze('A4');
    //             $sheet->mergeCells('A1:D1');
    //         });
    //     })->export('xls')->download('xls');

    // }
    // End Leave Report

    // Start Rusun Report
    public function indexRusunReport()
    {
        return View::make('rusun_report.indexRusunReport');
    }

    public function getIndexRusunReport()
    {
        $select = NewUser::joinDeptCategory()->select(['users.rusun', 'users.rusun_stat', 'users.first_name', 'users.last_name', 'users.nik', 'users.end_date'])
            ->where('users.username', '!=', 'admin')
            ->where('users.rusun', '!=', null)
            ->where('users.nik', '!=', 123456789)
            ->get();

        return Datatables::of($select)
            ->make();
    }
    // End Rusun Report

    // Start temporary initial annual leave
    public function indexTempInitialLeave()
    {
        return View::make('leave.indexTempInitialLeave');
    }

    public function getIndexTempInitialLeave()
    {
        // $select = NewUser::joinDeptCategory()->select(['users.id', 'users.nik', 'users.first_name', 'users.last_name', 'users.initial_annual'])
        // ->where('users.username', '!=', 'admin');
        $select = Entitled_leave_view::JoinUsers()->joinDeptCategory()->select([
            'all_leave_entitled.id',
            'users.nik',
            'all_leave_entitled.name',
            'dept_category.dept_category_name',
            'users.join_date',
            'all_leave_entitled.end_date',
            'all_leave_entitled.entitled_leave',
            'all_leave_entitled.annual_leave_balance',
            'all_leave_entitled.day_off_balance'
        ])
            ->whereNotNull('users.nik')
            ->where('users.nik', '!=', 123456789)
            ->where('users.username', '!=', 'wis_system')
            ->where('users.active', 1)
            ->get();
        return Datatables::of($select)
            ->addIndexColumn()
            ->edit_column('join_date', '{{date("M, d Y", strtotime($join_date))}}')
            ->edit_column('end_date', '{{date("M, d Y", strtotime($end_date))}}')
            ->add_column('totalBalance', '{{ $annual_leave_balance + $day_off_balance }}')
            ->add_column(
                'actions',
                Lang::get('messages.btn_primary', ['title' => 'Annual Transaction', 'url' => '{{ URL::route(\'hr_mgmt-data/leave/tempCreateInitialLeave\', [$id]) }}', 'class' => 'pencil'])
            )
            ->make();
    }

    public function tempCreateInitialExdo($id)
    {
        $department   = dept_category::where(['id' => User::find($id)->dept_category_id])->value('dept_category_name');
        $initial_leave = initial_leave::where('user_id', '=', $id)->value('initial');
        $leave        = [];
        //$list_leave = Leave_Category::where('id', '<', '3')->orderBy('id','asc')->get();
        $list_leave   = Leave_Category::where('id', '=', '2')->orderBy('id', 'asc')->get();
        foreach ($list_leave as $value)
            $leave[$value->leave_category_name] = $value->leave_category_name;
        //dd($initial_leave);
        return View::make('leave.tempCreateInitialExdo')->with(['leave' => $leave, 'department' => $department, 'initial_leave' => $initial_leave, 'users' => User::find($id)]);
    }

    public function tempStoreInitialExdo(Request $request, $id)
    {
        $rules = [
            // 'input_date' => 'required',
            // 'exp_date' => 'required',
            'initial_transaction'  => 'required|numeric'
        ];
        $data = [
            'user_id'                    => User::find($id)->id,
            'leave_category_id'          => '1',
            'request_by'                 => User::find($id)->first_name . ' ' . User::find($id)->last_name . ' (carry over by ' . Auth::user()->first_name . ' ' . Auth::user()->last_name . ' (HR))',
            'request_nik'                => User::find($id)->nik,
            'request_position'           => User::find($id)->position,
            'request_join_date'          => User::find($id)->join_date,
            'request_dept_category_name' => dept_category::where(['id' => User::find($id)->dept_category_id])->value('dept_category_name'),
            'period'                     => date("Y"),
            'leave_date'                 => date("Y-m-d"),
            'end_leave_date'             => date("Y-m-d"),
            'back_work'                  => date("Y-m-d"),
            'total_day'                  => $request->input('initial_transaction'),
            'taken'                      => null,
            'entitlement'                => null,
            'pending'                    => null,
            'remain'                     => null,
            'date_ver_hr'                => date("Y-m-d"),
            'date_ap_hd'                 => date("Y-m-d"),
            'date_ap_gm'                 => date("Y-m-d"),
            'ver_hr'                     => '1',
            'ap_hd'                      => '1',
            'ap_gm'                      => '1',
            'ap_hrd'                     => '1'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('hr_mgmt-data/leave/tempCreateInitialLeave', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {
            Leave::insert($data);
            Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data Initial']));
            return Redirect::route('hr_mgmt-data/leave/tempInitialLeave');
        }
    }

    // pantek

    public function tempCreateInitialLeave($id)
    {
        $data = NewUser::JoinDeptCategory()->where('users.id', $id)->first();

        $category = Leave_Category::all();

        $provinsi = file_get_contents('http://dev.farizdotid.com/api/daerahindonesia/provinsi');
        $provinsi = json_decode($provinsi, true);
        $provinsi = $provinsi['provinsi'];


        // $provinsi = $this->dataProvinsi();

        // dd($provinsi);
        $takenLeave = $this->takenAnnual($id);

        $advanceAnnual = $data->initial_annual - $takenLeave;

        $availableLeave = $this->annualLeave($id);

        $advanceAnnual = $advanceAnnual - $availableLeave;

        $exdo = $this->exdoLeave($id);


        return View::make('leave.tempCreateInitialLeave', compact(['data', 'category', 'provinsi', 'availableLeave', 'advanceAnnual', 'exdo', 'id']));
    }

    public function exdoLeave($id)
    {
        $taken = Leave::where('user_id', $id)->where('leave_category_id', 2)->where('ap_hd', 1)->where('ver_hr', 1)->where('ap_hrd', 1)->pluck('total_day')->sum();

        $exdo = Initial_Leave::where('user_id', $id)->pluck('initial')->sum();

        $return = $exdo - $taken;

        return $return;
    }

    public function takenAnnual($id)
    {
        $return = Leave::where('user_id', $id)->where('leave_category_id', 1)->where('ap_hd', 1)->where('ver_hr', 1)->where('ap_hrd', 1)->pluck('total_day')->sum();

        return $return;
    }

    public function annualLeave($id)
    {
        $user = NewUser::findOrFail($id);

        $annual = $this->takenAnnual($id);

        $startDate = date_create($user->join_date);
        $endDate = date_create($user->end_date);

        $startYear = date('Y', strtotime($user->join_date));
        $endYear = date('Y', strtotime($user->end_date));

        if ($user->emp_status === "Permanent") {
            $yearEnd = date('Y');
        } else {
            $yearEnd = $endYear;
        }

        $now = date_create();
        $now1 = date_create(date('Y') . '-01-01');
        $now2 = date_create(date('Y') . '-12-31');

        // date_create('2021-05-15') penambahan bulan terjadi
        // dd($now);

        if ($now <= $endDate) {
            $sekarang = $now;
        } else {
            $sekarang = $endDate;
        }

        $interval = date_diff(date_create($user->join_date),  date_create(date('Y-m-d')));

        $pass = $interval->y * 12;

        $passs = $pass + $interval->m;

        $daffPermanent = date_diff($now1, $now)->format('%m') + (12 * date_diff($now1, $now->modify('+5 day'))->format('%y'));

        $daffPermanent2 = date_diff($now1, $now2)->format('%m') + (12 * date_diff($now1, $now2->modify('+5 day'))->format('%y'));

        $daffPermanent1 = 12 - $daffPermanent;

        if ($passs <= $annual) {
            $newAnnual =  $annual;
        } else {
            $newAnnual = $passs;
        }

        $totalAnnual = $newAnnual - $annual;

        $totalAnnualPermanent = $user->initial_annual - $annual;

        $totalAnnualPermanent1 = $totalAnnualPermanent - $daffPermanent1;

        if ($user->emp_status === "Permanent") {
            $return = $totalAnnualPermanent1;
        } else {
            $return = $totalAnnual;
        }

        return $return;
    }

    public function storeTempCreateInitialLeave(Request $request, $id)
    {
        $findLeave = Leave::where('user_id', $id)->where('period', date('Y'))->whereBETWEEN('leave_date', [$request->input('startLeaveDate'), $request->input('endLeaveDate')])->orderBy('id', 'desc')->first();

        $findLeave1 = Leave::where('user_id', $id)->where('period', date('Y'))->whereBETWEEN('end_leave_date', [$request->input('startLeaveDate'), $request->input('endLeaveDate')])->orderBy('id', 'desc')->first();

        if ($findLeave !== null || $findLeave1 !== null) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'sorry, you cannot input, it because there are some forms running on the date you specified!']));
            Session::flash('message', Lang::get('messages.data_custom', ['data' => 'You can change form on the date specified!']));
            return Redirect::route('hr_mgmt-data/leave/tempCreateInitialLeave', [$id]);
        }

        $rule = [
            'startLeaveDate'     => 'required',
            'endLeaveDate'         => 'required',
            'backWork'            => 'required',
            'request_day'        => 'required|numeric|min:0',
            'destination'        => 'required',
            'city'                => 'required',
            'reason'            => 'required'
        ];


        $id = $request->input('id');
        $availableLeave = $request->input('availableLeave');
        $advanceAnnual = $request->input('advanceAnnual');
        $remainsAnnual = $advanceAnnual + $availableLeave;

        $exdo = $request->input('exdo');
        $getIp = $request->input('destination');

        $user = User::find($id);
        $leave = Leave::where('user_id', $id)->where('leave_category_id', $request->input('category'))->where('ap_hrd', 1)->get();
        $exdoOld = Initial_Leave::where('user_id', $id)->get();

        $entitlement = null;
        $taken = null;
        $totalDay = null;

        if ($request->input('category') == 1) {
            $entitlement = $user->initial_annual;
            $taken = $leave->pluck('total_day')->sum();
            $totalDay = $request->input('request_day');
        }

        if ($request->input('category') == 2) {
            $entitlement = $exdoOld->pluck('initial')->sum();
            $taken = $leave->pluck('total_day')->sum();
            $totalDay = $request->input('request_day');
        }

        if ($user->nationality != "Indonesia") {
            $destination = [
                'nama' => $request->input('destination')
            ];
        } else {
            $gotIp = file_get_contents('http://dev.farizdotid.com/api/daerahindonesia/provinsi/' . $getIp);
            $destination = json_decode($gotIp, true);
        }

        $data = [
            'user_id'                => $id,
            'leave_category_id'        => $request->input('category'),
            'request_by'            => $request->input('request_by') . ' (carry over by ' . auth::user()->first_name . ' ' . auth::user()->last_name . ')',
            'request_nik'            => $request->input('nik'),
            'request_position'        => $request->input('position'),
            'request_join_date'        => $request->input('joindDate'),
            'request_dept_category_name' => $request->input('dept'),
            'period'                => date('Y'),
            'leave_date'            => $request->input('startLeaveDate'),
            'end_leave_date'        => $request->input('endLeaveDate'),
            'back_work'                => $request->input('backWork'),
            'total_day'                => $request->input('request_day'),
            'taken'                      => $taken,
            'entitlement'                => $entitlement,
            'pending'                    => $entitlement - $taken,
            'remain'                     => $entitlement - $taken - $totalDay,
            'date_ver_hr'                => date("Y-m-d"),
            'date_ap_hd'                 => date("Y-m-d"),
            'date_ap_gm'                 => date("Y-m-d"),
            'date_ap_gm'                 => date("Y-m-d"),
            'ver_hr'                     => '1',
            'ap_hd'                      => '1',
            'ap_gm'                      => '1',
            'ap_hrd'                     => '1',
            'ap_koor'                     => '1',
            'ap_spv'                     => '1',
            'ap_pm'                         => '1',
            'ap_producer'                 => '1',
            'reason_leave'                 => $request->input('reason'),
            'r_departure'                 => $destination['nama'],
            'r_after_leaving'             => $request->input('city')
        ];

        $validator = Validator::make($request->all(), $rule);

        if ($validator->fails()) {
            return Redirect::route('hr_mgmt-data/leave/tempCreateInitialLeave', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {

            if ($request->input('category') == 2) {
                if ($exdo < $request->input('request_day')) {
                    Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, exdo not enough!']));
                    return Redirect::route('hr_mgmt-data/leave/tempCreateInitialLeave', [$id]);
                }
            }

            if ($request->input('category') == 1) {
                if ($remainsAnnual > $request->input('request_day')) {
                    Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, annual not enough!']));
                    return Redirect::route('hr_mgmt-data/leave/tempCreateInitialLeave', [$id]);
                }
            }

            Leave::insert($data);

            if ($request->input('category') == 1) {
                $ke = Forfeited::where('user_id', $id)->pluck('countAnnual')->sum();
                if ($ke > 0) {
                    // $this->insertForfeitedCounts($id);
                }
            }

            // $this->feedbackMailCutOfLeave($id, $request->input('category'));

            Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data Initial']));
            return Redirect::route('hr_mgmt-data/leave/tempInitialLeave');
        }
    }

    public function feedbackMailCutOfLeave($id, $leaveId)
    {
        $array = [$id, $leaveId];
        $data = Leave::where('user_id', $id)->where('leave_category_id', $leaveId)->latest()->first();
        $user = User::find($id);

        if ($data->ap_hrd === 1) {
            if ($data->leave_category_id === 1) {
                Mail::to($user->email)->send(new FeedbackMailLeaveCutOfLeave($data));
            } elseif ($data->leave_category_id === 2) {
                Mail::to($user->email)->send(new FeedbackMailLeaveCutOfLeave($data));
            } else {
                Mail::to($user->email)->send(new FeedbackMailCutOfExdoMail($data));
            }
        }
    }

    public function insertForfeitedCounts($id)
    {
        $leave = Leave::where('user_id', $id)->latest()->first();

        $forfeited = Forfeited::where('user_id', $id)->pluck('countAnnual')->sum();
        $forfeitedCounts = ForfeitedCounts::where('user_id', $id)->pluck('amount')->sum();

        if ($forfeited > $forfeitedCounts) {

            $remainsForfeited = $forfeited - $forfeitedCounts;

            $rangeForfeited = $remainsForfeited - $leave->total_day;
            $rangeForfeited = $leave->total_day + $rangeForfeited;

            if ($rangeForfeited >= $leave->total_day) {
                $rangeForfeited = $leave->total_day;
            } else {
                $rangeForfeited = $rangeForfeited;
            }

            $forfeiteds = [
                'user_id'   => $leave->user_id,
                'leave_id'  => $leave->id,
                'amount'    => $rangeForfeited,
                'status'    => 1,
            ];

            ForfeitedCounts::insert($forfeiteds);
        }
    }


    public function tempStoreInitialLeave(Request $request, $id)
    {
        $rules = [
            // 'input_date' => 'required',
            // 'exp_date' => 'required',
            'initial_transaction'  => 'required|numeric',
            'leave_category' => 'required',
            'leave_date'        => 'required',
            'end_leave_date'    => 'required'
        ];
        $data = [
            'user_id'                    => User::find($id)->id,
            'leave_category_id'          => $request->input('leave_category'),
            'request_by'                 => User::find($id)->first_name . ' ' . User::find($id)->last_name . ' (carry over by ' . Auth::user()->first_name . ' ' . Auth::user()->last_name . ' (HR))',
            'request_nik'                => User::find($id)->nik,
            'request_position'           => User::find($id)->position,
            'request_join_date'          => User::find($id)->join_date,
            'request_dept_category_name' => dept_category::where(['id' => User::find($id)->dept_category_id])->value('dept_category_name'),
            'period'                     => date('Y'),
            'leave_date'                 => $request->input('leave_date'),
            'end_leave_date'             => $request->input('end_leave_date'),
            'back_work'                  => date("Y-m-d"),
            'total_day'                  => $request->input('initial_transaction'),
            'taken'                      => null,
            'entitlement'                => null,
            'pending'                    => null,
            'remain'                     => null,
            'date_ver_hr'                => date("Y-m-d"),
            'date_ap_hd'                 => date("Y-m-d"),
            'date_ap_gm'                 => date("Y-m-d"),
            'date_ap_gm'                 => date("Y-m-d"),
            'ver_hr'                     => '1',
            'ap_hd'                      => '1',
            'ap_gm'                      => '1',
            'ap_hrd'                     => '1',
            'ap_koor'                     => '1',
            'ap_spv'                     => '1',
            'ap_pm'                         => '1',
            'ap_producer'                 => '1',
            'reason_leave'                 => $request->input('reason')
        ];

        $forAda = Forfeited::where('user_id', $id)->get();
        $forTidak = ForfeitedCounts::where('user_id', $id)->get();

        $countAda = $forAda->pluck('countAnnual')->sum();
        $countTidak = $forTidak->pluck('amount')->sum();

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('hr_mgmt-data/leave/tempCreateInitialLeave', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {
            Leave::insert($data);
            $lastLeave = Leave::where('user_id', $id)->orderby('id', 'desc')->latest()->first();

            if ($countAda > 0) {
                // isi disini jika forfeited nya ada
                if ($countAda >= $countTidak) {
                    if ($request->input('leave_category') === "1") {
                        ForfeitedCounts::insert([
                            'user_id'    => User::find($id)->id,
                            'leave_id'  => $lastLeave->id,
                            'amount'    => $request->input('initial_transaction'),
                            'status'    => 1,
                        ]);
                    }
                }
            }
            Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data Initial']));
            return Redirect::route('hr_mgmt-data/leave/tempInitialLeave');
        }
    }

    public function getIndexTempInitialAnnualLeave()
    {
        $select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([
            'leave_transaction.id',
            'leave_transaction.request_nik',
            'leave_transaction.request_by',
            'leave_transaction.leave_date',
            'leave_transaction.end_leave_date',
            'leave_transaction.total_day',
            'leave_transaction.leave_category_id'
        ])
            ->where('leave_transaction.request_by', 'like', '%carry over%');

        return Datatables::of($select)
            ->edit_column('leave_category_id', '@if ($leave_category_id === 1){{ "Annual" }} @elseif ($leave_category_id === 2){{ "Exdo" }} @elseif ($leave_category_id === 3) {{"Sick"}} @elseif ($leave_category_id === 4) {{"Wedding"}} @elseif ($leave_category_id === 5) {{"Birth of child"}} @elseif  ($leave_category_id === 6) {{"Unpaid"}} @elseif ($leave_category_id === 7) {{"Son circumcision/baptism"}} @elseif  ($leave_category_id === 8) {{"Death of family"}} @elseif  ($leave_category_id === 9) {{"Death of family law"}} @elseif  ($leave_category_id === 10) {{"Maternity"}} @elseif ($leave_category_id === 11) {{"Other"}} @else {{"??"}}  @endif')
            ->edit_column('leave_date', '{{date("M, d Y", strtotime($leave_date))}}')
            ->edit_column('end_leave_date', '{{date("M, d Y", strtotime($end_leave_date))}}')
            ->add_column(
                'actions',
                Lang::get('messages.btn_danger', ['url' => '{{ URL::route(\'hr_mgmt-data/initialAnnualLeave/delete\', [$id]) }}', 'data' => 'Carry Over Data'])
            )
            /*    ->edit_column('end_date', '{!! date("M d, Y", strtotime(end_date)) !!}')
*/
            ->make();
    }

    public function destroyInitialAnnualLeave($id)
    {
        $initial = leave::find($id);

        $initial->delete();
        Session::flash('message', Lang::get('messages.data_deleted', ['data' => 'Carry Over Annual Leave Data']));
        return Redirect::route('hr_mgmt-data/leave/tempInitialLeave');
    }
    // End temporary initial annual leave
    //start Grafik Tabel
    public function indexGrafik()
    {
        return View::make('leave_report.indexGrafik');
    }
    public function indexContract()
    {
        return View::make('mgmt-data.contract.indexContract');
    }
    public function getindexContract(Request $id)
    {
        $select = NewUser::joinDeptCategory()->select([
            'users.id',
            'users.nik',
            'users.first_name',
            'users.last_name',
            'dept_category.dept_category_name',
            'users.join_date',
            'users.end_date',
            'users.active'
        ])
            ->where('username', '!=', 'admin')
            ->where('username', '!=', 'hr')
            ->where('users.emp_status', '!=', 'Permanent')
            ->where('users.end_date', '!=', 0000 - 00 - 00)
            ->where('users.end_date', '<',  date('Y-m-d'))
            ->where('users.active', '!=', 0)
            ->where('users.nik', '!=', 123456789)
            ->get();

        return Datatables::of($select)
            ->edit_column('active', '@if ($active === 1) {{"Active"}} @else {{"Suspend"}} @endif ')
            ->add_column(
                'actions',
                Lang::get('messages.btn_warning', ['title' => 'Change Data', 'url' => '{{ URL::route(\'Contract/Edit\', [$id]) }}', 'class' => 'pencil'])
            )
            ->make();
    }
    public function editContract(Request $request, $id)
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
            return Redirect::route('End-Contract-Staff');
        } else {
            return View::make('mgmt-data.contract.edit-dataHR')
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
    public function storeContract(Request $request, $id)
    {
        $users          = User::find($id);
        $active         = 0;
        // $admin          = 0;
        // $user           = 0;
        // $hr             = 0;
        // $hd             = 0;
        // $gm             = 0;
        $sp             = 0;
        $ticket         = 0;
        $initial_annual = date_diff(date_create($request->input('join_date')), date_create($request->input('end_date'))->modify('+5 day'))->format('%m');
        $prof_pict      = $users->prof_pict;

        //return $users->prof_pict;

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
            'email'              => 'required|email',
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
            // 'project'            => $request->input('project'),
            'project_category_id_1' => Project_Category::where('project_name', $request->input('project_category_id_1'))->value('id'),
            'project_category_id_2' => Project_Category::where('project_name', $request->input('project_category_id_2'))->value('id'),
            'project_category_id_3' => Project_Category::where('project_name', $request->input('project_category_id_3'))->value('id'),
            // 'initial_annual'     => date_diff(date_create($request->input('join_date')), date_create($request->input('end_date')))->format('%m'),
            'initial_annual'        => $initial_annual,
            'active'                => $active,
            // 'admin'              => $admin,
            // 'hr'                 => $hr,
            // 'hd'                 => $hd,
            // 'gm'                 => $gm,
            // 'user'               => $user,
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
        /*	dd($data);*/

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('Contract/Edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        } else {
            User::where('id', $id)->update($data);
            Log_User::insert($data_log);
            // User::where('id', $id)->update($data);
            Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
            // return Redirect::route('hr_mgmt-data/user');
            return Redirect::route('End-Contract-Staff', ['id' => $id]);
        }
    }
    public function saveContract($id)
    {
        $select = NewUser::joinDeptCategory()->find($id);
        $return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
            </div>
            <div class='modal-body'>
                <div class='well'>
                    <h4>Are you sure want tou data ?</h4>
                </div>
            </div>
            <div class='modal-footer'>
            	<a type='button' class='btn btn-primary' href='" . URL::route('Contract/Save', [$id]) . "'>Yes</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

    public function storeGetleaveEntitledReport(Request $request)
    {
        $rules = [
            'tahun'    => 'required',
            'bulan' => 'required'
        ];

        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $getData = Leave::whereYear('leave_date', $tahun)->whereMonth('leave_date', $bulan)->where('ap_hrd', 1)->where('ver_hr', 1)->get();

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('hr_mgmt-data/leaveEntitledReport')
                ->withErrors($validator)
                ->withInput();
        } else {
            Excel::create('Leave Report Monthly', function ($excel) use ($getData) {
                $excel->sheet('Leave Report Monthly', function ($sheet) use ($getData) {

                    $sheet->setAutoSize(true);
                    $sheet->loadView(
                        'HRDLevelAcces.frontedesk.account_hr.excel.leave_report_monthly',
                        ['getData' => $getData]
                    );
                });
            })->export('xls');
            Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
            return back();
        }
    }

    public function storeGetleaveEntitledReportDaily(Request $request)
    {
        $rules = [
            'awal'    => 'required',
            'akhir' => 'required'
        ];

        $awal = $request->input('awal');
        $akhir = $request->input('akhir');

        $getData = Leave::whereBetween('leave_date', [$awal, $akhir])->where('ap_hrd', 1)->where('ver_hr', 1)->get();

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('hr_mgmt-data/leaveEntitledReport')
                ->withErrors($validator)
                ->withInput();
        } else {
            Excel::create('Leave Report', function ($excel) use ($getData) {
                $excel->sheet('Leave Report', function ($sheet) use ($getData) {

                    $sheet->setAutoSize(true);
                    $sheet->loadView(
                        'HRDLevelAcces.frontedesk.account_hr.excel.leave_report_daily',
                        ['getData' => $getData]
                    );
                });
            })->export('xls');
            Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
            return back();
        }
    }
}