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
use App\Exports\UserReport;
use App\ViewOffYears;
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
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Facades\Datatables;


class HRDLevelAccess extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }
    // Rusun
    public function indexRusun()
    {
        return view::make('HRDLevelAcces.rusun.index');
    }

    public function getRusun(Request $id)
    {
        $select = User::select(['users.id', 'users.rusun', 'users.rusun_stat', 'users.first_name', 'users.last_name', 'users.nik', 'users.end_date'])
            ->where('users.username', '!=', 'admin')
            ->where('users.username', '!=', 'hr')
            ->where('users.username', '!=', 'wis_system')
            ->where('users.rusun', '!=', null)
            ->get();
        return Datatables::of($select)
            ->add_column(
                'actions',
                Lang::get('messages.btn_warning', ['title' => 'Annual Transaction', 'class' => 'pencil', 'url' =>  '{{ URL::route(\'edit\', [$id]) }}'])
            )
            ->make();
    }

    public function editRusun(Request $request, $id)
    {
        $dept   = dept_category::where(['id' => User::find($id)->dept_category_id])->value('dept_category_name');
        $rusun_stat     = [User::find($id)->rusun_stat => User::find($id)->rusun_stat, 'Sharing' => 'Sharing', 'Single Paid' => 'Single Paid', 'Single Free' => 'Single Free', 'None' => 'None'];

        return view::make('HRDLevelAcces.rusun.edit')->with(['dept' => $dept, 'rusun_stat' => $rusun_stat, 'users' => User::find($id)]);
    }

    public function postRusun(Request $request, $id)
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

    // Staff
    public function indexStaff()
    {
        return view::make('HRDLevelAcces.staff.index');
    }

    public function getStaff(Request $request)
    {
        $select = NewUser::joinDeptCategory()->JoinLeaveView()->select(['users.id', 'users.join_date', 'users.end_date', 'users.nik', 'users.first_name', 'users.last_name', 'users.gender', 'dept_category.dept_category_name', 'users.pob', 'users.dob', 'users.position', 'users.education', 'users.education_institution', 'users.emp_status', 'users.id_card', 'users.phone', 'users.religion', 'all_leave_entitled.annual_leave_balance', 'all_leave_entitled.day_off_balance', 'users.active', 'users.address', 'users.area', 'users.city'])
            ->where('users.username', '!=', 'admin')
            ->where('users.username', '!=', 'hr')
            ->where('users.username', '!=', 'wis_system')
            ->where('users.nik', '!=', null)
            ->where('users.nik', '!=', 12345678)
            ->where('users.active', 1)
            ->get();

        return Datatables::of($select)
            ->edit_column('dob', '{!! date("M d, Y", strtotime($dob)) !!}')
            ->edit_column('active', '@if ($active === 1){{ "Active" }}@else{{ "Suspend" }}@endif')
            // ->edit_column('education_institution', '@if (empty($education_insitution)) {{ "--" }} @else {{ $education_insitution }} @endif')
            ->add_column(
                'actions',
                Lang::get('messages.btn_warning', ['title' => 'Change Data', 'url' => '{{ URL::route(\'editEmployee\', [$id]) }}', 'class' => 'pencil'])
                    . Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'detail/Employee\', [$id]) }}', 'class' => 'file'])
            )
            ->setRowClass('@if ($active === 0){{ "danger" }}@endif')

            ->make();
    }

    public function detailEmployee($id)
    {
        $user = NewUser::joinDeptCategory()->joinProjectCategory1()->find($id);
        $return = "
          <div class='modal-header'>
            <h3 class='modal-title' id='exampleModalLabel'>$user->first_name $user->last_name</h3>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          <div class='modal-body'>
            <h5>
            <b>NIK</b> : $user->nik
            <br>
            <b>Username</b> : $user->username
            <br>
            <b>Department</b> : $user->dept_category_name
            <br>
            <b>Position</b> : $user->position
            <br>
            <b>Employee Status</b> : $user->emp_status
            <br>
            <b>Nationality</b> : $user->nationality
            <br>
            <b>Join Date</b> : $user->join_date
            <br>
            <b>End Date</b> : $user->end_date
            <br>
            <b>Place & Date of Birth</b> : $user->pob, $user->dob
            <br>
            <b>Province</b> : $user->province
            <br>
            <b>Maiden Name</b> : $user->maiden_name
            <br>
            <b>Gender</b> : $user->gender
            <br>
            <b>ID Card</b> : $user->id_card
            <br>
            <b>Email</b> : $user->email
            <br>
            <b>Phone</b> : $user->phone
            <br>
            <b>Address</b> : $user->address, $user->area - $user->city
            <br>
            <b>Education</b> : $user->education
            <br>
            <b>Education Institution</b> : $user->education_institution
            <br>
            <b>Marital Status</b> : $user->marital_status
            <br>
            <b>NPWP</b> : $user->npwp
            <br>
            <b>KK</b> : $user->kk
            <br>
            <b>Religion</b> : $user->religion
            <br>
            <b>BPJS Ketenagakerjaan</b> : $user->bpjs_ketenagakerjaan
            <br>
            <b>BPJS Kesehatan</b> : $user->bpjs_kesehatan
            <br>
            <b>Rusun Status</b> : $user->rusun_stat, $user->rusun
            <br>
            <b>Project</b> : $user->project_name
           </h5>
          </div>
          <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
          </div>
        ";
        return $return;
    }

    public function addStaff()
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
        $emp_status     = ['' => '-Select-', 'Permanent' => 'Permanent', 'Contract' => 'Contract', 'Outsource' => 'Outsource', 'PKL' => 'PKL'];
        $marital_status = ['' => '-Select-', 'Single' => 'Single', 'Married' => 'Married', 'Widowed' => 'Widowed [widowed because her husband passed away]', 'Widower' => 'Widower [widower because his wife passed away]', 'Divorced/Divorcee' => 'Divorced/Divorcee'];
        $rusun_stat     = ['' => '-Select-', 'Sharing' => 'Sharing', 'Single Paid' => 'Single Paid', 'Single Free' => 'Single Free', 'None' => 'None'];

        $Province = ['' => '-Select-', 'Aceh' => 'Aceh', 'Sumatera Utara' => 'Sumatera Utara', 'Sumatera Barat' => 'Sumatera Barat', 'Riau' => 'Riau', 'Kepulauan Riau' => 'Kepulauan Riau', 'Jambi' => 'Jambi', 'Bengkulu' => 'Bengkulu', 'Sumatera Selatan' => 'Sumatera Selatan', 'Kepulauan Bangka Belitung' => 'Kepulauan Bangka Belitung', 'Lampung' => 'Lampung', 'Banten' => 'Banten', 'Jawa Barat' => 'Jawa Barat', 'DKI Jakarta' => 'DKI Jakarta', 'Jawa Tengah' => 'Jawa Tengah', 'DI Yogyakarta' => 'DI Yogyakarta', 'Jawa Timur' => 'Jawa Timur', 'Bali' => 'Bali', 'Nusa Tenggara Barat' => 'Nusa Tenggara Barat', 'Nusa Tenggara Timur' => 'Nusa Tenggara Timur', 'Kalimantan Utara' => 'Kalimantan Utara', 'Kalimantan Barat' => 'Kalimantan Barat', 'Kalimantan Tengah' => 'Kalimantan Tengah', 'Kalimantan Selatan' => 'Kalimantan Selatan', 'Kalimantan Timur' => 'Kalimantan Timur', 'Gorontalo' => 'Gorontalo', 'Sulawesi Utara' => 'Sulawesi Utara', 'Sulawesi Barat' => 'Sulawesi Barat', 'Sulawesi Tengah' => 'Sulawesi Tengah', 'Sulawesi Selatan' => 'Sulawesi Selatan', 'Sulawesi Tenggara' => 'Sulawesi Tenggara', 'Maluku Utara' => 'Maluku Utara', 'Maluku' => 'Maluku', 'Papua Barat' => 'Papua Barat', 'Papua' => 'Papua'];

        $religion = ['' => '-Select-', 'Islam' => 'Islam', 'Protestan' => 'Protestan', 'Katolik' => 'Katolik', 'Hindu' => 'Hindu', 'Buddha' => 'Buddha', 'Khonghucu' => 'Khonghucu'];

        $education = ['' => '-Select-', 'SD' => 'SD', 'SMP' => 'SMP', 'SLTA' => 'SLTA', 'SMK' => 'SMK', 'Diploma 1' => 'Diploma 1', 'Diploma 2' => 'Diploma 2', 'Diploma 3' => 'Diploma 3', 'Diploma 4' => 'Diploma 4', 'Strata 1' => 'Strata 1', 'Strata 2' => 'Strata 2', 'Strata 3' => 'Strata 3'];

        $wfh = [
            ' ' => '-Select-',
            'WFS'   => 'Work From Studio (WFS)',
            'WFHB'  => 'Work From Home Batam (WFHB)',
            'WFR'   => 'Work From Rusun (WFR)',
            'WFHT'  => 'Work From Home Town (WFHT)'
        ];

        return view::make('HRDLevelAcces.staff.add')
            ->with([
                'level' => $level,
                'gender' => $gender,
                'department' => $department,
                'project1' => $project1,
                'project2' => $project2,
                'project3' => $project3,
                'emp_status' => $emp_status,
                'marital_status' => $marital_status,
                'rusun_stat' => $rusun_stat,
                'Province' => $Province,
                'religion'  => $religion,
                'education' => $education,
                'wfh'       => $wfh
            ]);
    }

    public function saveStaff(Request $request)
    {
        $active    = 0;
        $admin     = 0;
        $user      = 1;
        $hr        = 0;
        $hd        = 0;
        $gm        = 0;
        $sp        = 0;
        $ticket    = 0;
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

            'nik'              => 'required',
            'first_name'       => 'required',
            'position'         => 'required',
            'emp_status'       => 'required',

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
        $passs = $pass + $interval->m + 1;

        if ($request->input('emp_status') === "PKL") {
            $passs = 0;
        }

        $data = [

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
            'remember_token'        => Hash::make($request->input('password')),
            'wfh'                   => $request->input('wfh'),
            'stat_wfh'              => $request->input('statWfh'),
            'education_institution' => $request->input('education_institution')
        ];

        // dd($data);

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('addEmployee')
                ->withErrors($validator)
                ->withInput();
        } else {
            User::insert($data);
            Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data User']));
            return Redirect::route('employee');
        }
    }

    public function editStaff(Request $request, $id)
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

        $emp_status     = [User::find($id)->emp_status => User::find($id)->emp_status, 'Permanent' => 'Permanent', 'Contract' => 'Contract', 'Outsource' => 'Outsource', 'PKL' => 'PKL'];
        $gender         = [User::find($id)->gender => User::find($id)->gender, 'Male' => 'Male', 'Female' => 'Female'];
        $marital_status = [User::find($id)->marital_status => User::find($id)->marital_status, 'Single' => 'Single', 'Married' => 'Married', 'Widowed' => 'Widowed [widowed because her husband passed away]', 'Widower' => 'Widower [widower because his wife passed away]', 'Divorced/Divorcee' => 'Divorced/Divorcee'];

        $rusun_stat     = [User::find($id)->rusun_stat => User::find($id)->rusun_stat, 'Sharing' => 'Sharing', 'Single Paid' => 'Single Paid', 'Single Free' => 'Single Free', 'None' => 'None'];

        $level          = ['USER' => 'User', 'HUMAN RESOURCE' => 'Human Resource', 'HEAD OF DEPARTMENT' => 'Head of Department', 'GENERAL MANAGER' => 'General Manager'];
        $access         = '';

        $Province = ['' => '-Select-', 'Aceh' => 'Aceh', 'Sumatera Utara' => 'Sumatera Utara', 'Sumatera Barat' => 'Sumatera Barat', 'Riau' => 'Riau', 'Kepulauan Riau' => 'Kepulauan Riau', 'Jambi' => 'Jambi', 'Bengkulu' => 'Bengkulu', 'Sumatera Selatan' => 'Sumatera Selatan', 'Kepulauan Bangka Belitung' => 'Kepulauan Bangka Belitung', 'Lampung' => 'Lampung', 'Banten' => 'Banten', 'Jawa Barat' => 'Jawa Barat', 'DKI Jakarta' => 'DKI Jakarta', 'Jawa Tengah' => 'Jawa Tengah', 'DI Yogyakarta' => 'DI Yogyakarta', 'Jawa Timur' => 'Jawa Timur', 'Bali' => 'Bali', 'Nusa Tenggara Barat' => 'Nusa Tenggara Barat', 'Nusa Tenggara Timur' => 'Nusa Tenggara Timur', 'Kalimantan Utara' => 'Kalimantan Utara', 'Kalimantan Barat' => 'Kalimantan Barat', 'Kalimantan Tengah' => 'Kalimantan Tengah', 'Kalimantan Selatan' => 'Kalimantan Selatan', 'Kalimantan Timur' => 'Kalimantan Timur', 'Gorontalo' => 'Gorontalo', 'Sulawesi Utara' => 'Sulawesi Utara', 'Sulawesi Barat' => 'Sulawesi Barat', 'Sulawesi Tengah' => 'Sulawesi Tengah', 'Sulawesi Selatan' => 'Sulawesi Selatan', 'Sulawesi Tenggara' => 'Sulawesi Tenggara', 'Maluku Utara' => 'Maluku Utara', 'Maluku' => 'Maluku', 'Papua Barat' => 'Papua Barat', 'Papua' => 'Papua'];

        $religion = ['' => '-Select-', 'Islam' => 'Islam', 'Protestan' => 'Protestan', 'Katolik' => 'Katolik', 'Hindu' => 'Hindu', 'Buddha' => 'Buddha', 'Khonghucu' => 'Khonghucu'];

        $education = ['' => '-Select-', 'SLTA' => 'SLTA', 'SMK' => 'SMK', 'Diploma 3' => 'Diploma 3', 'Diploma 4' => 'Diploma 4', 'Strata 1' => 'Strata 1', 'Strata 2' => 'Strata 2', 'Strata 3' => 'Strata 3'];

        $wfh = [
            ' ' => '-Select-',
            'WFS'   => 'Work From Studio (WFS)',
            'WFHB'  => 'Work From Home Batam (WFHB)',
            'WFR'   => 'Work From Rusun (WFR)',
            'WFHT'  => 'Work From Home Town (WFHT)'
        ];


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
            return view::make('HRDLevelAcces.staff.edit')
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
                    'users'          => User::find($id),
                    'Province'       => $Province,
                    'religion'      => $religion,
                    'education'     => $education,
                    'wfh'           => $wfh
                ]);
        }
    }

    public function updateStaff(Request $request, $id)
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
            'spHRD'                 => $sp,
            'ticket'                => $ticket,
            'prof_pict'             => $prof_pict,
            'request_ip'            => request()->ip(),
            'created_by'            => Auth::user()->first_name . ' ' . Auth::user()->last_name,
            'wfh'                   => $request->input('wfh'),
            'stat_wfh'              => $request->input('statWfh'),
            'education_institution' => $request->input('education_institution')
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
            'created_by'                => Auth::user()->first_name . ' ' . Auth::user()->last_name,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('editEmployee', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        } else {
            User::where('id', $id)->update($data);
            Log_User::insert($data_log);
            Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));

            return Redirect::route('employee', ['id' => $id]);
        }
    }

    public function indexContract()
    {
        return view::make('HRDLevelAcces.contract.index');
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
            ->get();

        return Datatables::of($select)
            ->edit_column('active', '@if ($active === 1) {{"Active"}} @else {{"Suspend"}} @endif ')
            ->add_column(
                'actions',
                Lang::get('messages.btn_warning', ['title' => 'Change Data', 'url' => '{{ URL::route(\'editContract/Employee\', [$id]) }}', 'class' => 'pencil'])
            )
            ->make();
    }

    public function ExcelDataStaffIndex()
    {
        return view::make('HRDLevelAcces.staff.uploadExcel');
    }

    public function editContract(Request $request, $id)
    {
        $dept       = dept_category::where(['id' => User::find($id)->dept_category_id])->value('dept_category_name');

        $users = User::find($id);

        $annual = DB::table('users')
            ->leftJoin('initial_leave', 'initial_leave.user_id', '=', 'users.id')
            ->leftJoin('leave_category', 'leave_category.id', '=', 'initial_leave.leave_category_id')
            ->leftJoin('leave_transaction', 'leave_transaction.user_id', '=', 'users.id')

            ->select([
                DB::raw('
            (
                select (
                    select initial_annual from users where id=' . $users->id . '
                ) - (
                    select COALESCE(sum(total_day), 0) from leave_transaction where user_id=' . $users->id . ' and leave_category_id=1
                    and ap_hd  = 1
                    and ap_gm  = 1
                    and ver_hr = 1
                    and ap_hrd = 1
                )
            ) as remainannual')
            ])
            ->first();

        $exdo = DB::table('users')
            ->leftJoin('initial_leave', 'initial_leave.user_id', '=', 'users.id')
            ->leftJoin('leave_category', 'leave_category.id', '=', 'initial_leave.leave_category_id')
            ->leftJoin('leave_transaction', 'leave_transaction.user_id', '=', 'users.id')
            ->select([
                DB::raw('
            (
                select (
                    select COALESCE(sum(initial), 0) from initial_leave where user_id=' . $users->id . ' and leave_category_id=2
                ) - (
                    select COALESCE(sum(total_day), 0) from leave_transaction where user_id=' . $users->id . ' and leave_category_id=2
                    and ap_hd  = 1
                    and ap_gm  = 1
                    and ver_hr = 1
                    and ap_hrd = 1
                )
            ) as remainexdo')
            ])
            ->first();


        return view::make('HRDLevelAcces.contract.edit')
            ->with([
                'dept'           => $dept,
                'users'          => User::find($id),
                'annual'         => $annual,
                'exdo'           => $exdo
            ]);
    }

    public function storeContract(Request $request, $id)
    {
        $users = User::find($id);

        $select = DB::table('users')
            ->leftJoin('initial_leave', 'initial_leave.user_id', '=', 'users.id')
            ->leftJoin('leave_category', 'leave_category.id', '=', 'initial_leave.leave_category_id')
            ->leftJoin('leave_transaction', 'leave_transaction.user_id', '=', 'users.id')

            ->select([
                DB::raw('
            (
                select (
                    select initial_annual from users where id=' . Auth::user()->id . '
                ) - (
                    select COALESCE(sum(total_day), 0) from leave_transaction where user_id=' . $users->id . ' and leave_category_id=1
                    and ap_hd  = 1
                    and ap_gm  = 1
                    and ver_hr = 1
                    and ap_hrd = 1
                )
            ) as remainannual')
            ])
            ->first();

        $initial_annual = date_diff(date_create($request->input('join_date')), date_create($request->input('end_date'))->modify('+5 day'))->format('%m') + (12 * date_diff(date_create($request->input('join_date')), date_create($request->input('end_date'))->modify('+5 day'))->format('%y'));

        $rules = [
            'join_date' => 'required',
            'end_date'  => 'required',
            'example1'    => 'required'
        ];

        $data = [
            'join_date'         => $request->input('join_date'),
            'end_date'          => $request->input('end_date'),
            'active'            => $request->input('example1'),
            'initial_annual'    => $initial_annual

        ];

        /* dd($users->emp_status);*/

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('editContract/Employee', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        } else {
            User::where('id', $id)->update($data);
            Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));

            return Redirect::route('contract-employee', ['id' => $id]);
        }
    }
    /// technical Access Production
    public function indexApprovalTechnicalProduction()
    {
        return view::make('production.indexTechnicalApproval');
    }

    public function getApprovalTechnicalProduction()
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
            'leave_transaction.ap_hd'
            // 'leave_transaction.ap_gm',

        ])
            ->where('users.dept_category_id', '=', Auth::user()->dept_category_id)
            ->where('users.project_category_id_1', '=', Auth::user()->project_category_id_1)
            ->where('users.level_hrd', '!=', Auth::user()->level_hrd)
            ->where('leave_transaction.ap_spv', '=', 0)
            ->get();

        return Datatables::of($select)
            ->edit_column('ap_spv', '@if ($ap_spv === 0){{"PENDING"}} @else{{"--"}}   @endif')
            ->edit_column('ap_hd', '@if($ap_hd === 0){{"WAITING SPV
        "}} @endif')
            ->add_column(
                'actions',
                Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'detailOperation\', [$id]) }}', 'class' => 'check-square'])
            )
            ->make();
    }

    public function detailLeaveProduction($id)
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
                <a class='btn btn-primary' href='" . URL::route('approve/Operations', [$id]) . "'>Approve</a>
                <a class='btn btn-primary' href='" . URL::route('disapprove/Operations', [$id]) . "'>Disapprove</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

    public function approveLeave(Request $request, $id)
    {
        $email       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->joinProjectCategory()->find($id);

        $ap_spv       = 1;
        $date_ap_spv  = date("Y-m-d");

        $data        = [
            'ap_spv'      => $ap_spv,
            'ap_koor'     => 1,
            'ap_pm'       => 1,
            'ap_producer' => 1,
            'date_ap_spv' => $date_ap_spv,
            'date_ap_koor' => $date_ap_spv,
            'date_ap_pm'  => $date_ap_spv,
            'date_producer' => $date_ap_spv
        ];

        Leave::where('id', $id)->update($data);
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));

        $this->sendVerEmail($email);

        return Redirect::route('indexApprovalOperations');
    }

    public function sendVerEmail($email)
    {
        $koor_email   = DB::table('users')
            ->select(DB::raw('email'))
            ->where('dept_category_id', '=', $email->dept_category_id)
            ->where('hd', '=', 1)
            ->first();

        Mail::send('email.appMail', ['email' => $email], function ($message) use ($koor_email, $email) {
            $message->to($koor_email->email, 'WIS')->subject('Approval Request Leave Application - ' . $email->request_by . '');

            $message->from('wis_system@infinitestudios.id', 'WIS');
        });
    }



    public function disapproveLeave(Request $request, $id)
    {
        $email       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);
        $ap_spv      = 2;
        $date_ap_spv  = date("Y-m-d");

        $data        = [
            'ap_spv'      =>  $ap_spv,
            'ap_koor'     => 2,
            'ap_pm'       => 2,
            'ap_producer' => 2,
            'date_ap_spv' => $date_ap_spv,
            'date_ap_koor' => $date_ap_spv,
            'date_ap_pm'  => $date_ap_spv,
            'date_producer' => $date_ap_spv
        ];

        Leave::where('id', $id)->update($data);
        Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));
        Mail::send('email.disapproveMail', ['email' => $email], function ($message) use ($email) {
            $message->to($email->email)->subject('[DISAPPROVED] Leave Application - WIS');
            $message->from('wis_system@infinitestudios.id', 'WIS');
        });
        return Redirect::route('indexApprovalOperations');
    }

    public function importExcel(Request $request)
    {
        $rule = ['photo' => 'required|mimes:xlsx, xls'];

        if ($request->file('photo') === NULL) {

            return Redirect::route('employee')->with('getError', Lang::get('messages.upload_nothing'));
        } else {
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->getRealPath();
                $data = Excel::load($path)->get();
                if ($data->count()) {
                    foreach ($data as $key => $value) {

                        $arr[] = [
                            'nik' => $value->nik,
                            'first_name' => $value->first_name,
                            'last_name' => $value->last_name,
                            'dept_category_id' => $value->dept_category_id,
                            'position' => $value->position,
                            'emp_status' => $value->emp_status,
                            'nationality' => $value->nationality,
                            'join_date'  => date('Ymd', strtotime($value->join_date)),
                            'end_date' => date('Ymd', strtotime($value->end_date)),
                            'dob' => date('Ymd', strtotime($value->date_of_birth)),
                            'pob' => $value->place_of_birth,
                            'province' => $value->province,
                            'maiden_name' => $value->maiden_name,
                            'gender' => $value->gender,
                            'id_card' => $value->id_card,
                            'phone' => $value->phone,
                            'address' => $value->address,
                            'area' => $value->area,
                            'city' => $value->city,
                            'education' => $value->education,
                            'marital_status' => $value->marital_status,
                            'npwp' => $value->npwp,
                            'kk' => $value->kk,
                            'religion' => $value->religion,
                            'bpjs_ketenagakerjaan' => $value->bpjs_ketenagakerjaan,
                            'bpjs_kesehatan' => $value->bpjs_kesehatan,
                            'rusun'     => $value->rusun,
                            'rusun_stat'     => $value->rusun_stat,
                            'active' => 1,
                            'user' => 1,
                            'ticket' => 1,
                            'block_stat' => 0,
                            'admin'     => 0,
                            'hr'        => 0,
                            'koor'      => 0,
                            'pm'        => 0,
                            'spv'       => 0,
                            'producer'  => 0,
                            'hd'        => 0,
                            'hrd'       => 0,
                            'gm'        => 0,
                            'sp'        => 0,
                            'spHRD'     => 0,
                            'created_by'    => auth::user()->first_name . ' ' . auth::user()->last_name,
                            'prof_pict' => 'no_avatar.jpg',
                            'initial_annual'   => date_diff(date_create($value->join_date), date_create($value->end_date)->modify('+5 day'))->format('%m') + (12 * date_diff(date_create($value->join_date), date_create($value->end_date)->modify('+5 day'))->format('%y')),
                            'project_category_id_1' => $value->code_main_project,
                            'password'              => Hash::make('Batam' . Date('Y')),
                        ];
                    }
                    if (!empty($arr)) {
                        NewUser::insert($arr);
                        /* Log_User::insert($arr);*/
                        $file = $request->file('photo');
                        $name = 'Data-Employee-' . \Carbon\Carbon::now()->format('Y-m-d H:i:s') . '.' . $file->getClientOriginalExtension();
                        $path = $file->storeAs('uploads', $name);
                        Session::flash('message', Lang::get('messages.data_upload', ['data' => 'Data Employee']));
                        return Redirect::route('employee');
                    }
                }
            }
            return Redirect::route('employee')->with('getError', Lang::get('messages.data_problem'));;
        }
    }

    public function importExcelUpdate(Request $request)
    {

        if ($request->file('photo') === NULL) {

            return Redirect::route('employee')->with('getError', Lang::get('messages.upload_nothing'));
        } else {
            if ($request->hasFile('photo')) {

                $this->validate($request, [
                    'photo' => 'required'
                ]);

                $path = $request->file('photo')->getRealPath();
                $data = Excel::load($path)->get();
                if ($data->first()) {

                    foreach ($data as $key => $value) {

                        $arr[] = array(
                            'id'    => $value->id,
                            'join_date' => date('Y-m-d', strtotime($value->join_date)),
                            'end_date' =>  date('Y-m-d', strtotime($value->end_date)),
                            'nik' => $value->nik,
                            'first_name'        => $value->first_name,
                            'last_name'         => $value->last_name,

                        );
                        $v = "kebab";

                        $init =   date_diff(date_create($value->join_date), date_create($value->end_date)->modify('+5 day'))->format('%m') + (12 * date_diff(date_create($value->join_date), date_create($value->end_date)->modify('+5 day'))->format('%y'));
                    }

                    /*return dd($value->id);*/

                    if (!empty($arr)) {

                        DB::select(DB::raw('UPDATE `users` SET
                `nik` = ' . $value->nik . ',
                `join_date` = ' . date('Ymd', strtotime($value->join_date)) . ',
                `end_date` = ' . date('Ymd', strtotime($value->end_date)) . ',
                `initial_annual` = ' . $init . ',
                `first_name` = "' . $value->first_name . '",
                `last_name` = "' . $value->last_name . '"
                WHERE `users`.`id` = ' . $value->id . ''));

                        Session::flash('message', Lang::get('messages.data_upload_updated', ['data' => 'Data Employee']));
                        return Redirect::route('employee');
                    }
                }
            }
            return Redirect::route('employee')->with('getError', Lang::get('messages.data_problem'));;
        }
    }


    public function privilege()
    {
        return view::make('HRDLevelAcces.privellage.index');
    }

    public function getIndexPrivellage()
    {
        $select = NewUser::joinDeptCategory()->select(['users.id', 'users.nik', 'users.first_name', 'users.last_name', 'dept_category.dept_category_name', 'users.koor', 'users.pm', 'users.spv', 'users.producer', 'users.hd', 'users.hrd', 'users.gm', 'users.active'])
            ->where('username', '!=', "admin")
            ->where('username', '!=', "hr")
            ->where('username', '!=', "wis_system")
            ->where('active', '=', 1)
            ->get();

        return Datatables::of($select)

            ->edit_column('active', '@if($active === 1){{"Active"}} @else {{"Suspend"}} @endif')

            ->add_column('status', '@if($koor === 1){{"Coordiantor"}} @elseif($pm === 1){{"PM"}} @elseif($spv === 1){{"Supervisor"}} @elseif($producer === 1){{"Producer"}} @elseif($hd === 1){{"Head of Department"}} @elseif($gm === 1){{"General Manager"}} @else {{"Employee"}} @endif')
            ->add_column(
                'actions',
                Lang::get('messages.btn_warning', ['title' => 'Edit', 'url' => '{{ URL::route(\'Editprivellage\', [$id]) }}', 'class' => 'pencil'])
            )

            ->make();
    }

    public function Editprivellage($id)
    {
        $select = User::find($id);

        $dept = NewUser::joinDeptCategory()->find($id);

        return view::make('HRDLevelAcces.privellage.edit', ['users' => $select, 'dept' => $dept]);
    }

    public function postEditprivellage(Request $request, $id)
    {
        $users          = User::find($id);
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
            'koor'                 => $koor,
            'spv'                  => $spv,
            'pm'                   => $pm,
            'producer'             => $producer,
            'sp'                   => $sp
        ];

        $validator = Validator::make($request->all(), $rules);

        /*  return dd($data);*/

        if ($validator->fails()) {
            return Redirect::route('Editprivellage', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        } else {
            User::where('id', '=', $id)->update($data);
            Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
            return Redirect::route('privilege');
        }
    }

    public function projectHRD()
    {
        return view::make('HRDLevelAcces.project.index');
    }

    public function getprojectHRD()
    {

        $select = Project_Category::select(['id', 'project_name'])->get();

        return Datatables::of($select)
            ->add_column(
                'actions',
                Lang::get('messages.btn_warning', ['title' => 'Edit', 'url' => '{{ URL::route(\'EditprojectHRD\', [$id]) }}', 'class' => 'pencil'])
            )
            ->make();
    }

    public function EditprojectHRD($id)
    {
        $select = Project_Category::find($id);


        return view::make('HRDLevelAcces.project.edit', ['project' => $select]);
    }

    public function postEditprojectHRD(Request $request, $id)
    {

        $project = Project_Category::find($id);

        $rules = [
            'name' => 'required'
        ];

        $data = [
            'project_name' => $request->input('name'),
            'created_by'   => auth::user()->first_name . ' ' . auth::user()->last_name,
        ];

        $validator = Validator::make($request->all(), $rules);

        /*    return dd($data);*/

        if ($validator->fails()) {
            return Redirect::route('EditprojectHRD', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        } else {
            Project_Category::where('id', '=', $id)->update($data);
            Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
            return Redirect::route('projectHRD');
        }
    }

    public function AddNewPrivilege()
    {
        return view::make('HRDLevelAcces.project.add');
    }

    public function postNewPrivilege(Request $request)
    {
        $rules = [
            'name' => 'required'
        ];

        $data = [
            'project_name' => $request->input('name')
        ];

        $validator = Validator::make($request->all(), $rules);

        /*     return dd($data);*/

        if ($validator->fails()) {
            return Redirect::route('Editprivellage', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        } else {
            Project_Category::insert($data);
            Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
            return Redirect::route('projectHRD');
        }
    }

    public function exportProject()
    {
        NewUser::all()->export('Data Employee');

        return back();
    }

    public function importExcelUpdateAlamat(Request $request)
    {

        if ($request->file('photo') === NULL) {

            return Redirect::route('employee')->with('getError', Lang::get('messages.upload_nothing'));
        } else {
            if ($request->hasFile('photo')) {

                $this->validate($request, [
                    'photo' => 'required'
                ]);
                $no = 0;
                $path = $request->file('photo')->getRealPath();
                $data = Excel::load($path)->get();
                if ($data->first()) {

                    foreach ($data as $key => $value) {

                        $arr[] = array(
                            'id'                => $value->id,
                            'nik'               => $value->nik,
                            'first_name'        => $value->first_name,
                            'last_name'         => $value->last_name,
                            'address'          => $value->address,
                            'area'             => $value->area,
                            'city'             => $value->city,
                            'bpjs_ketenagakerjaan' => $value->bpjs_ketenagakerjaan,
                            'bpjs_kesehatan'    => $value->bpjs_kesehatan,
                            'npwp'              => $value->npwp,
                        );
                        $no++;
                        $users = NewUser::find($value->id);

                        $arr2[] = array(
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
                            'nik_new'                   => $value->nik,
                            'first_name_new'            => $value->first_name,
                            'last_name_new'             => $value->last_name,
                            'dept_category_id_new'      => $users->dept_category_id,
                            'position_new'              => $users->position,
                            'emp_status_new'            => $users->dept_category_id,
                            'join_date_new'             => $users->join_date,
                            'end_date_new'              => $users->end_date,
                            'dob_new'                   => $users->dob,
                            'email_new'                 => $users->email,
                            'rusun_new'                 => $users->rusun,
                            'rusun_stat_new'            => $users->rusun_stat,
                            'project_category_id_1_new' => $users->project_category_id_1,
                            'project_category_id_2_new' => $users->project_category_id_2,
                            'project_category_id_3_new' => $users->project_category_id_3,
                            'initial_annual_new'        => $users->initial_annual,
                            'active_new'                => $users->active,
                            'sp_new'                    => $users->sp,
                            'ticket_new'                => $users->ticket,
                            'request_ip'                => request()->ip(),
                            'created_by'                => Auth::user()->first_name . ' ' . Auth::user()->last_name

                        );
                    }



                    if (!empty($arr)) {

                        DB::select(DB::raw('UPDATE `users` SET
                `nik` = ' . $value->nik . ',
                `first_name` = "' . $value->first_name . '",
                `last_name` = "' . $value->last_name . '",
                `address` = "' . $value->address . '",
                `area` = "' . $value->area . '",
                `city` = "' . $value->city . '",
                `bpjs_ketenagakerjaan` = ' . $value->bpjs_ketenagakerjaan . ',
                `bpjs_kesehatan` = ' . $value->bpjs_kesehatan . ',
                `npwp` = "' . $value->npwp . '"

                WHERE `users`.`id` = ' . $value->id . ''));

                        Log_User::insert($arr2);

                        Session::flash('message', Lang::get('messages.data_upload_updated', ['data' => 'Data Employee']));
                        return Redirect::route('employee');
                    }
                }
            }
            return Redirect::route('employee')->with('getError', Lang::get('messages.data_problem'));;
        }
    }

    public function UploadedGetDate()
    {
        $contents = storage_path("app/excel/upload_HR_employee/form_date.xlsx");

        return response()->download($contents);
    }

    public function UploadedGetDate2()
    {
        $contents = storage_path("app/excel/upload_HR_employee/form_addres_dkk.xlsx");

        return response()->download($contents);
    }

    public function UploadedFormInserEmployes()
    {
        $contents = storage_path("app/excel/upload_HR_employee/insert-data-new-employes.xlsx");

        return response()->download($contents);
    }

    public function indexAllSummary()
    {
        $total_user = NewUser::where('active', '=', 1)->whereNotIn('username', ['hr', 'admin.wisaftafiandi', 'wis_system'])->whereNotIn('nik', ['123456789'])->count();

        $total_permanent = db::table('users')->where('emp_status', '=', 'Permanent')->where('active', '=', 1)->whereNotIn('username', ['hr', 'admin.wisaftafiandi', 'wis_system'])->whereNotIn('nik', ['123456789'])->where('active', '=', 1)->count();
        $total_contract = db::table('users')->where('emp_status', '=', 'Contract')->where('active', '=', 1)->whereNotIn('username', ['hr', 'admin.wisaftafiandi', 'wis_system'])->whereNotIn('nik', ['123456789'])->where('active', '=', 1)->count();
        $total_PKL = db::table('users')->where('emp_status', '=', 'PKL')->where('active', '=', 1)->whereNotIn('username', ['hr', 'admin.wisaftafiandi', 'wis_system'])->whereNotIn('nik', ['123456789'])->where('active', '=', 1)->count();
        $total_Outsource = db::table('users')->where('emp_status', '=', 'Outsource')->where('active', '=', 1)->whereNotIn('username', ['hr', 'admin.wisaftafiandi', 'wis_system'])->whereNotIn('nik', ['123456789'])->where('active', '=', 1)->count();

        $total_it = DB::table('users')->where('dept_category_id', 1)->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $IT_Permanent = DB::table('users')->where('dept_category_id', 1)->where('emp_status', 'Permanent')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $IT_Contract = DB::table('users')->where('dept_category_id', 1)->where('emp_status', 'Contract')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $IT_PKL = DB::table('users')->where('dept_category_id', 1)->where('emp_status', 'PKL')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();

        $total_finance = DB::table('users')->where('dept_category_id', 2)->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $Finance_Permanent = DB::table('users')->where('dept_category_id', 2)->where('emp_status', 'Permanent')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $Finance_Contract = DB::table('users')->where('dept_category_id', 2)->where('emp_status', 'Contract')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $Finance_PKL = DB::table('users')->where('dept_category_id', 2)->where('emp_status', 'PKL')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();

        $total_hr =  DB::table('users')->where('dept_category_id', 3)->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $HR_Permanent =  DB::table('users')->where('dept_category_id', 3)->where('emp_status', 'Permanent')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $HR_Contract =  DB::table('users')->where('dept_category_id', 3)->where('emp_status', 'Contract')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $HR_PKL =  DB::table('users')->where('dept_category_id', 3)->where('emp_status', 'PKL')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();

        $total_Operation = DB::table('users')->where('dept_category_id', 4)->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $Operation_Permanent = DB::table('users')->where('dept_category_id', 4)->where('emp_status', 'Permanent')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $Operation_Contract = DB::table('users')->where('dept_category_id', 4)->where('emp_status', 'Contract')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $Operation_PKL = DB::table('users')->where('dept_category_id', 4)->where('emp_status', 'PKL')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();

        $total_Facility = DB::table('users')->where('dept_category_id', 5)->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $Facility_Permanent = DB::table('users')->where('dept_category_id', 5)->where('emp_status', 'Permanent')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $Facility_Contract = DB::table('users')->where('dept_category_id', 5)->where('emp_status', 'Contract')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $Facility_PKL = DB::table('users')->where('dept_category_id', 5)->where('emp_status', 'PKL')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $Facility_Outsource = DB::table('users')->where('dept_category_id', 5)->where('emp_status', 'Outsource')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();

        $total_Production = DB::table('users')->where('dept_category_id', 6)->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $Production_Permanent = DB::table('users')->where('dept_category_id', 6)->where('emp_status', 'Permanent')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $Production_Contract = DB::table('users')->where('dept_category_id', 6)->where('emp_status', 'Contract')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $Production_PKL = DB::table('users')->where('dept_category_id', 6)->where('emp_status', 'PKL')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();

        $total_LS = DB::table('users')->where('dept_category_id', 7)->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $LS_Permanent = DB::table('users')->where('dept_category_id', 7)->where('emp_status', 'Permanent')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $LS_Contract = DB::table('users')->where('dept_category_id', 7)->where('emp_status', 'Contract')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $LS_PKL = DB::table('users')->where('dept_category_id', 7)->where('emp_status', 'PKL')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();

        $total_General = DB::table('users')->where('dept_category_id', 8)->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $General_Permanent = DB::table('users')->where('dept_category_id', 8)->where('emp_status', 'Permanent')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $General_Contract = DB::table('users')->where('dept_category_id', 8)->where('emp_status', 'Contract')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $General_PKL = DB::table('users')->where('dept_category_id', 8)->where('emp_status', 'PKL')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();

        $total_Management = DB::table('users')->where('dept_category_id', 9)->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $Management_Permanent = DB::table('users')->where('dept_category_id', 9)->where('emp_status', 'Permanent')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $Management_Contract = DB::table('users')->where('dept_category_id', 9)->where('emp_status', 'Contract')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();
        $Management_PKL = DB::table('users')->where('dept_category_id', 9)->where('emp_status', 'PKL')->where('hr', '=', 0)->where('admin', '=', 0)->where('active', '=', 1)->count();

        /*  $department = [''];
        $list_dept  = Dept_Category::orderBy('id','asc')->get();
        foreach ($list_dept as $value)
            $department[$value->id] = $value->dept_category_name;
       */
        return view::make(
            'HRDLevelAcces.summary.allSummary.index',
            [
                'total_user' => $total_user,
                'total_permanent' => $total_permanent,
                'total_contract' => $total_contract,
                'total_PKL' => $total_PKL,
                'total_Outsource' => $total_Outsource,

                'total_it' => $total_it,
                'IT_Permanent' => $IT_Permanent,
                'IT_Contract' => $IT_Contract,
                'IT_PKL' => $IT_PKL,
                'total_finance' => $total_finance,
                'Finance_Permanent' => $Finance_Permanent,
                'Finance_Contract' => $Finance_Contract,
                'Finance_PKL' => $Finance_PKL,
                'total_hr' => $total_hr,
                'HR_Permanent' => $HR_Permanent,
                'HR_Contract' => $HR_Contract,
                'HR_PKL' => $HR_PKL,
                'total_Operation' => $total_Operation,
                'Operation_Permanent' => $Operation_Permanent,
                'Operation_Contract' => $Operation_Contract,
                'Operation_PKL' => $Operation_PKL,
                'total_Facility' => $total_Facility,
                'Facility_Permanent' => $Facility_Permanent,
                'Facility_Contract' => $Facility_Contract,
                'Facility_Outsource' => $Facility_Outsource,
                'total_Production' => $total_Production,
                'Production_Permanent' => $Production_Permanent,
                'Production_Contract' => $Production_Contract,
                'Production_PKL' => $Production_PKL,
                'total_LS' => $total_LS,
                'LS_Permanent' => $LS_Permanent,
                'LS_Contract' => $LS_Contract,
                'LS_PKL'    => $LS_PKL,
                'total_General' => $total_General,
                'General_Permanent' => $General_Permanent,
                'General_Contract' => $General_Contract,
                'General_PKL' => $General_PKL,
                'total_Management' => $total_Management,
                'Management_Permanent' => $Management_Permanent,
                'Management_Contract' => $Management_Contract,
                'Management_PKL' => $Management_PKL,

            ]
        );
    }

    public function indexEndEmployee()
    {
        return view::make('HRDLevelAcces.will_expires.index');
    }

    public function getEndEmployee()
    {
        $tgl2 = date('Y-m-d', strtotime('+1 month', strtotime('+15 days', strtotime(date('Y-m-d')))));

        $select = NewUser::joinDeptCategory()->JoinLeaveView()->select([
            'users.id', 'users.nik', 'users.end_date', 'users.join_date', DB::raw("CONCAT(users.first_name, ' ', users.last_name) as fullname"), 'users.position', 'dept_category.dept_category_name', 'all_leave_entitled.annual_leave_balance',
            'all_leave_entitled.day_off_balance',
        ])
            ->where('username', '!=', 'admin')
            ->where('username', '!=', 'hr')
            ->where('users.emp_status', '!=', 'Permanent')
            ->where('users.end_date', '!=', 0000 - 00 - 00)
            ->where('users.end_date', '<=', date('Y-m-d', strtotime('+1 month', strtotime('+15 days', strtotime(date('Y-m-d'))))))
            ->where('users.end_date', '>=', date('Y-m-d'))
            ->where('users.active', '!=', 0)
            ->get();

        return Datatables::of($select)

            ->make();
    }

    public function detailTotalEmployee()
    {
        return view::make('HRDLevelAcces.summary.allSummary.detailTotalEmployee');
    }

    public function getdetailTotalEmployee()
    {
        $select = NewUser::joinDeptCategory()->select(['users.id', 'users.nik', 'users.first_name', 'users.last_name', 'users.email', 'users.join_date', 'users.end_date', 'users.position', 'dept_category.dept_category_name', 'users.emp_status'])
            ->where('active', '=', 1)
            ->whereNotIn('username', ['hr', 'admin.wisaftafiandi', 'wis_system'])
            ->whereNotIn('nik', ['123456789'])
            ->get();

        return Datatables::of($select)
            ->edit_column('join_date', '{!! date("M d, Y", strtotime($join_date)) !!}')
            ->edit_column('end_date', '{!! date("M d, Y", strtotime($end_date)) !!}')
            ->add_column(
                'views',
                Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'detail/Employee\', [$id]) }}', 'class' => 'file'])
            )
            ->make();
    }

    public function detailTotalPermanent()
    {
        return view::make('HRDLevelAcces.summary.allSummary.detailTotalPermanent');
    }

    public function getdetailTotalPermanent()
    {
        $select = NewUser::joinDeptCategory()->select(['users.id', 'users.nik', 'users.first_name', 'users.last_name', 'users.join_date', 'users.position', 'dept_category.dept_category_name', 'users.emp_status'])
            ->where('active', '=', 1)
            ->where('emp_status', '=', 'Permanent')
            ->whereNotIn('username', ['hr', 'admin'])
            ->get();

        return Datatables::of($select)
            ->edit_column('join_date', '{!! date("M d, Y", strtotime($join_date)) !!}')

            ->add_column(
                'views',
                Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'detail/Employee\', [$id]) }}', 'class' => 'file'])
            )
            ->make();
    }

    public function detailTotalContract()
    {
        return view::make('HRDLevelAcces.summary.allSummary.detailTotalContract');
    }

    public function getdetailTotalContract()
    {
        $select = NewUser::joinDeptCategory()->select(['users.id', 'users.nik', 'users.first_name', 'users.last_name', 'users.join_date', 'users.position', 'dept_category.dept_category_name', 'users.emp_status'])
            ->where('active', '=', 1)
            ->where('emp_status', '=', 'Contract')
            ->whereNotIn('username', ['hr', 'admin'])
            ->get();

        return Datatables::of($select)
            ->edit_column('join_date', '{!! date("M d, Y", strtotime($join_date)) !!}')

            ->add_column(
                'views',
                Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'detail/Employee\', [$id]) }}', 'class' => 'file'])
            )
            ->make();
    }

    public function detailTotalPKL()
    {
        return view::make('HRDLevelAcces.summary.allSummary.detailTotalPKL');
    }

    public function getdetailTotalPKL()
    {
        $select = NewUser::joinDeptCategory()->select(['users.id', 'users.nik', 'users.first_name', 'users.last_name', 'users.join_date', 'users.position', 'dept_category.dept_category_name', 'users.emp_status'])
            ->where('active', '=', 1)
            ->where('emp_status', '=', 'PKL')
            ->whereNotIn('username', ['hr', 'admin'])
            ->get();

        return Datatables::of($select)
            ->edit_column('join_date', '{!! date("M d, Y", strtotime($join_date)) !!}')

            ->add_column(
                'views',
                Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'detail/Employee\', [$id]) }}', 'class' => 'file'])
            )
            ->make();
    }

    public function detailTotalOutsource()
    {
        return view::make('HRDLevelAcces.summary.allSummary.detailTotalOutsource');
    }

    public function getdetailTotalOutsource()
    {
        $select = NewUser::joinDeptCategory()->select(['users.id', 'users.nik', 'users.first_name', 'users.last_name', 'users.join_date', 'users.position', 'dept_category.dept_category_name', 'users.emp_status'])
            ->where('active', '=', 1)
            ->where('emp_status', '=', 'Outsource')
            ->whereNotIn('username', ['hr', 'admin'])
            ->get();

        return Datatables::of($select)
            ->edit_column('join_date', '{!! date("M d, Y", strtotime($join_date)) !!}')

            ->add_column(
                'views',
                Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'detail/Employee\', [$id]) }}', 'class' => 'file'])
            )
            ->make();
    }

    public function indexViewOffYears()
    {
        $ViewOffYears = ViewOffYears::orderBy('date', 'asc')->paginate(20);
        $no = 1;
        return view::make('HRDLevelAcces.summary.viewoffYears.index', [
            'no'        => $no,
            'ViewOffYears'  => $ViewOffYears,
        ]);
    }

    public function getDataViewOffYears()
    {
        $data = ViewOffYears::whereYear('date', '>=', date('Y'))->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('dated', function (ViewOffYears $viewoffYears) {
                $newDate = $viewoffYears->date;

                return date('M, d-Y', strtotime($newDate));
            })
            ->addColumn('actions', function (ViewOffYears $viewoffYears) {
                $return = "<a href=" . route('deleteViewOffYears', [$viewoffYears->id]) . " class='btn btn-sm btn-danger'><span class='fa fa-trash-o'></span></a></a>";

                return $return;
            })
            ->make(true);
    }

    public function addViewOffYears()
    {
        return view::make('HRDLevelAcces.summary.viewoffYears.add');
    }

    public function storeAddViewOffYears(Request $request)
    {
        $jenis  = $request->input('jenis_input');
        $jumlah     = $request->input('jumlah_input');

        foreach ($jenis as $key => $value) {
            $data = [
                'date'          => $value,
                'national_day'  => $jumlah[$key],
            ];
            ViewOffYears::insert($data);
        }
        Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data National Day']));
        return Redirect::route('indexViewOffYears');
    }

    public function deleteViewOffYears($id)
    {
        ViewOffYears::where('id', $id)->delete();
        Session::flash('getError', Lang::get('messages.data_deleted', ['data' => 'Data National Day']));
        return Redirect::route('indexViewOffYears');
    }

    ///end
}