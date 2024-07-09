<?php

namespace App\Http\Controllers;

use App\Dept_Category;
use App\Http\Controllers\Controller;
use App\Initial_Leave;
use App\Leave;
use App\Leave_Category;
use App\Log_Dept_Category;
use App\NewUser;
use App\User;
use App\User_Attemp;
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
use Mail;
use Storage;
use Yajra\Datatables\Facades\Datatables;


class ADMController extends Controller
{

	public function __construct()
	{
		$this->middleware(['auth', 'active', 'admin']);
	}

	// Start Route Management Data > Data User
	public function indexUser()
	{


		return View::make('mgmt-data.user.index');
	}

	public function getIndexUser()
	{
		$select = NewUser::joinDeptCategory()->select(['users.id', 'users.username', 'users.nik', 'users.first_name', 'users.last_name', 'dept_category.dept_category_name', 'users.admin', 'users.hr', 'users.hd', 'users.gm', 'users.active'])
			// ->where('users.active', 1)
			->where('users.username', '!=', 'admin')
			->get();

		return Datatables::of($select)
			->edit_column('hr', '@if ($hr === 1){{ "Yes" }}@else{{ "No" }}@endif')
			->edit_column('hd', '@if ($hd === 1){{ "Yes" }}@else{{ "No" }}@endif')
			->edit_column('gm', '@if ($gm === 1){{ "Yes" }}@else{{ "No" }}@endif')
			->edit_column('active', '@if ($active === 1){{ "Active" }}@else{{ "Suspend" }}@endif')
			->add_column(
				'actions',
				// Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'mgmt-data/user/detail\', [$id]) }}', 'class' => 'file'])
				'@if ($admin !== 1)'
					. Lang::get('messages.btn_warning', ['title' => 'Change Data ', 'url' => '{{ URL::route(\'mgmt-data/user/edit-data\', [$id]) }}', 'class' => 'pencil'])
					. Lang::get('messages.btn_reset', ['title' => 'Reset Password', 'url' => '{{ URL::route(\'mgmt-data/user/passReset\', [$id]) }}', 'class' => 'refresh'])
					. Lang::get('messages.btn_danger', ['url' => '{{ URL::route(\'mgmt-data/user/delete\', [$id]) }}', 'data' => 'Data User'])
					. '@endif'
				// .'@if ($first_name == "Administrator")'.
			)
			->setRowClass('@if ($active === 0){{ "danger" }}@endif')
			->make();
	}

	public function ResetAllPassword()
	{
		$data = [
			'password' => Hash::make('Batam' . Date('Y')),
			'block_stat' => 0,
		];
		User::where('active', 1)->update($data);
		Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
		return Redirect::back();
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
	            	<a class='btn btn-primary' href='" . URL::route('mgmt-data/user/ActionPassReset', [$id]) . "'>Yes</a>
	                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
	            </div>
	        ";

		return $return;
	}

	public function actionPassResetUser(Request $request, $id)
	{
		$data = [
			'password' => Hash::make('Batam' . Date('Y')),
			'block_stat' => 0,
		];
		User::where('id', $id)->update($data);
		Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
		return Redirect::route('mgmt-data/user');
	}

	public function createUser()
	{
		$department = ['' => '-Select-'];
		$list_dept  = Dept_Category::orderBy('id', 'asc')->get();
		foreach ($list_dept as $value)
			$department[$value->dept_category_name] = $value->dept_category_name;

		$level          = ['' => '-Select-', 'ADMIN' => 'Admin', 'USER' => 'User', 'HUMAN RESOURCE' => 'Human Resource', 'HEAD OF DEPARTMENT' => 'Head of Department', 'GENERAL MANAGER' => 'General Manager'];
		$gender         = ['' => '-Select-', 'Male' => 'Male', 'Female' => 'Female'];
		$emp_status     = ['' => '-Select-', 'Permanent' => 'Permanent', 'Contract' => 'Contract', 'PKL' => 'PKL'];
		$marital_status = ['' => '-Select-', 'Single' => 'Single', 'Married' => 'Married'];

		return View::make('mgmt-data.user.create')->with(['level' => $level, 'gender' => $gender, 'department' => $department, 'emp_status' => $emp_status, 'marital_status' => $marital_status]);
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
		$prof_pict = 'no_avatar.jpg';
		$initial_annual = date_diff(date_create($request->input('join_date')), date_create($request->input('end_date'))->modify('+5 day'))->format('%m') + (12 * date_diff(date_create($request->input('join_date')), date_create($request->input('end_date'))->modify('+5 day'))->format('%y'));


		if ($request->has('active') && $request->input('active') === "Active") {
			$active = 1;
		}

		if ($request->has('sp') && $request->input('sp') === "2nd Approval") {
			$sp = 1;
		}

		// if ($request->input('level') === "ADMIN") {
		// 	$admin = 1;
		// } 
		// else if ($request->input('level') === "USER") {
		// 	$user = 1;
		// }
		// else if ($request->input('level') === "HUMAN RESOURCE") {
		// 	$hr = 1;
		// }
		// else if ($request->input('level') === "HEAD OF DEPARTMENT") {
		// 	$hd = 1;
		// }
		// else {
		// 	$gm = 1;
		// }

		$rules = [
			// 'password'      => 'required|alpha_dash|min:5',
			// 'confpassword'  => 'required|alpha_dash|min:5|same:password',
			'username'         => 'required|alpha_dash|unique:users,username',
			'nik'              => 'required',
			'first_name'       => 'required',
			// 'level'            => 'required|in:ADMIN,USER,HUMAN RESOURCE,HEAD OF DEPARTMENT,GENERAL MANAGER',
			'position'         => 'required',
			'emp_status'       => 'required',
			'email'       	   => 'required|email',
			'dept_category_id' => 'required',
			'prof_pict' 	   => 'image|nullable|max:1024'
		];

		if ($request->hasFile('prof_pict') && $request->file('prof_pict')->isValid()) {
			$file      =  $request->file('prof_pict');
			$prof_pict = time() . '_' . $file->getClientOriginalName();
			$file->storeAs('prof_pict', $prof_pict);
		} else {
			$prof_pict = 'no_avatar.jpg';
		}

		if ($request->input('emp_status') === "Contract") {
			$initial_annual = $initial_annual;
		} else {
			$initial_annual = 0;
		}

		$data = [
			'username'             => $request->input('username'),
			'password'             => Hash::make('Batam' . Date('Y')),
			'nik'                  => $request->input('nik'),
			'first_name'           => $request->input('first_name'),
			'last_name'            => $request->input('last_name'),
			'dept_category_id'     => Dept_Category::where('dept_category_name', $request->input('dept_category_id'))->value('id'),
			'position'             => $request->input('position'),
			'emp_status'           => $request->input('emp_status'),
			'nationality'          => $request->input('nationality'),
			'join_date'            => $request->input('join_date'),
			'end_date'             => $request->input('end_date'),
			'dob'                  => $request->input('dob'),
			'pob'                  => $request->input('pob'),
			'province'             => $request->input('province'),
			'maiden_name'          => $request->input('maiden_name'),
			'gender'               => $request->input('gender'),
			'id_card'              => $request->input('id_card'),
			'email'                => $request->input('email'),
			'phone'                => $request->input('phone'),
			'address'              => $request->input('address'),
			'area'                 => $request->input('area'),
			'city'                 => $request->input('city'),
			'education'            => $request->input('education'),
			'marital_status'       => $request->input('marital_status'),
			'npwp'                 => $request->input('npwp'),
			'kk'                   => $request->input('kk'),
			'religion'             => $request->input('religion'),
			'dependent'            => $request->input('dependent'),
			'bpjs_ketenagakerjaan' => $request->input('bpjs_ketenagakerjaan'),
			'bpjs_kesehatan'       => $request->input('bpjs_kesehatan'),
			// 'bpjs_jht'             => $request->input('bpjs_jht'),
			'rusun'                => $request->input('rusun'),
			'race'                 => $request->input('race'),
			'source_company'       => $request->input('source_company'),
			'global_id'            => $request->input('global_id'),
			'init_date'            => $request->input('init_date'),
			'tax_cut_in'           => $request->input('tax_cut_in'),
			'tax_cut_off'          => $request->input('tax_cut_off'),
			'reason_off_leaving'   => $request->input('reason_off_leaving'),
			'reentry_to_company'   => $request->input('reentry_to_company'),
			'reentry_to_otherco'   => $request->input('reentry_to_otherco'),
			'remark'               => $request->input('remark'),
			'jpk'                  => $request->input('jpk'),
			'cob'                  => $request->input('cob'),

			// 'initial_annual'       => date_diff(date_create($request->input('join_date')), date_create($request->input('end_date')))->format('%m'),
			'initial_annual'       => $initial_annual,
			'active'               => $active,
			'admin'                => $admin,
			'hr'                   => $hr,
			'hd'                   => $hd,
			'gm'                   => $gm,
			'user'                 => $user,
			'sp'                   => $sp,
			'prof_pict' 		   => $prof_pict,
			'remember_token'       => Hash::make($request->input('password'))
		];
		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('mgmt-data/user/create')
				->withErrors($validator)
				->withInput();
		} else {
			User::insert($data);
			Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data User']));
			return Redirect::route('mgmt-data/user');
		}
	}

	public function editDataUser($id)
	{
		$dept       = dept_category::where(['id' => User::find($id)->dept_category_id])->value('dept_category_name');

		$department = [$dept => $dept];

		$list_dept  = Dept_Category::where('id', '!=', User::find($id)->dept_category_id)->orderBy('id', 'asc')->get();
		foreach ($list_dept as $value)
			$department[$value->dept_category_name] = $value->dept_category_name;

		$emp_status     = [User::find($id)->emp_status => User::find($id)->emp_status, 'Permanent' => 'Permanent', 'Contract' => 'Contract', 'PKL' => 'PKL'];
		$gender         = [User::find($id)->gender => User::find($id)->gender, 'Male' => 'Male', 'Female' => 'Female'];
		$marital_status = [User::find($id)->marital_status => User::find($id)->marital_status, 'Single' => 'Single', 'Married' => 'Married'];

		$level          = ['ADMIN' => 'Admin', 'USER' => 'User', 'HUMAN RESOURCE' => 'Human Resource', 'HEAD OF DEPARTMENT' => 'Head of Department', 'GENERAL MANAGER' => 'General Manager'];
		$access         = '';

		if (User::find($id)->admin === 1) {
			$access = 'ADMIN';
		} else if (User::find($id)->user === 1) {
			$access = 'USER';
		} else if (User::find($id)->hr === 1) {
			$access = 'HUMAN RESOURCE';
		} else if (User::find($id)->hd === 1) {
			$access = 'HEAD OF DEPARTMENT';
		} else $access = 'GENERAL MANAGER';

		if (User::find($id)->username === 'admin') {
			return Redirect::route('mgmt-data/user');
		} else {
			return View::make('mgmt-data.user.edit-data')->with(['dept' => $dept, 'department' => $department, 'emp_status' => $emp_status, 'gender' => $gender, 'marital_status' => $marital_status, 'level' => $level, 'access' => $access, 'users' => User::find($id)]);
		}

		// return View::make('mgmt-data.user.edit-data')->with(['dept' => $dept, 'department' => $department, 'emp_status' => $emp_status, 'gender'=> $gender, 'marital_status' => $marital_status, 'level' => $level, 'access' => $access, 'users' => User::find($id)]);
	}

	public function editPasswordUser($id)
	{
		return View::make('mgmt-data.user.edit-password')->with(['users' => User::find($id)]);
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

		// if ($request->input('level') === "ADMIN") {
		// 	$admin = 1;
		// } 
		// else if ($request->input('level') === "USER") {
		// 	$user = 1;
		// }
		// else if ($request->input('level') === "HUMAN RESOURCE") {
		// 	$hr = 1;
		// }
		// else if ($request->input('level') === "HEAD OF DEPARTMENT") {
		// 	$hd = 1;
		// }
		// else {
		// 	$gm = 1;
		// }

		$rules = [
			'nik'              => 'required',
			'first_name'       => 'required',
			// 'level'            => 'required|in:ADMIN,USER,HUMAN RESOURCE,HEAD OF DEPARTMENT,GENERAL MANAGER',
			'position'         => 'required',
			'emp_status'       => 'required',
			'email'       	   => 'required|email',
			'dept_category_id' => 'required',
			'prof_pict' 	   => 'image|nullable|max:1024'
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
			'username'			   => $request->input('username'),
			'nik'                  => $request->input('nik'),
			'first_name'           => $request->input('first_name'),
			'last_name'            => $request->input('last_name'),
			'dept_category_id'     => Dept_Category::where('dept_category_name', $request->input('dept_category_id'))->value('id'),
			'position'             => $request->input('position'),
			'emp_status'           => $request->input('emp_status'),
			'nationality'          => $request->input('nationality'),
			'join_date'            => $request->input('join_date'),
			'end_date'             => $request->input('end_date'),
			'dob'                  => $request->input('dob'),
			'pob'                  => $request->input('pob'),
			'province'             => $request->input('province'),
			'maiden_name'          => $request->input('maiden_name'),
			'gender'               => $request->input('gender'),
			'id_card'              => $request->input('id_card'),
			'email'                => $request->input('email'),
			'phone'                => $request->input('phone'),
			'address'              => $request->input('address'),
			'area'                 => $request->input('area'),
			'city'                 => $request->input('city'),
			'education'            => $request->input('education'),
			'marital_status'       => $request->input('marital_status'),
			'npwp'                 => $request->input('npwp'),
			'kk'                   => $request->input('kk'),
			'religion'             => $request->input('religion'),
			'dependent'            => $request->input('dependent'),
			'bpjs_ketenagakerjaan' => $request->input('bpjs_ketenagakerjaan'),
			'bpjs_kesehatan'       => $request->input('bpjs_kesehatan'),
			// 'bpjs_jht'             => $request->input('bpjs_jht'),
			'rusun'                => $request->input('rusun'),
			'race'                 => $request->input('race'),
			'source_company'       => $request->input('source_company'),
			'global_id'            => $request->input('global_id'),
			'init_date'            => $request->input('init_date'),
			'tax_cut_in'           => $request->input('tax_cut_in'),
			'tax_cut_off'          => $request->input('tax_cut_off'),
			'reason_off_leaving'   => $request->input('reason_off_leaving'),
			'reentry_to_company'   => $request->input('reentry_to_company'),
			'reentry_to_otherco'   => $request->input('reentry_to_otherco'),
			'remark'               => $request->input('remark'),
			'jpk'                  => $request->input('jpk'),
			'cob'                  => $request->input('cob'),

			// 'initial_annual'       => date_diff(date_create($request->input('join_date')), date_create($request->input('end_date')))->format('%m'),
			'initial_annual'       => $initial_annual,
			'active'               => $active,
			// 'admin'                => $admin,
			// 'hr'                   => $hr,
			// 'hd'                   => $hd,
			// 'gm'                   => $gm,
			// 'user'                 => $user,
			'sp'                   => $sp,
			'prof_pict' 		   => $prof_pict
		];
		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('mgmt-data/user/edit-data', ['id' => $id])
				->withErrors($validator)
				->withInput();
		} else {
			User::where('id', $id)->update($data);
			Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
			return Redirect::route('mgmt-data/user');
		}
	}

	public function updatePasswordUser(Request $request, $id)
	{
		$rules = [
			'newpassword'	  => 'required|min:5',
			'confnewpassword' => 'required|min:5|same:newpassword'
		];
		$data = [
			'password' => Hash::make($request->input('newpassword'))
		];
		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('mgmt-data/user/edit-password', ['id' => $id])
				->withErrors($validator);
		} else {
			User::where('id', $id)->update($data);
			Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
			return Redirect::route('mgmt-data/user');
		}
	}


	public function destroyUser($id)
	{
		$users = User::find($id);

		if ($users->username !== "admin") {
			$users->delete();
			Session::flash('message', Lang::get('messages.data_deleted', ['data' => 'Data User']));
			return Redirect::route('mgmt-data/user');
		} else {
			return Redirect::route('mgmt-data/user')->with('getError', Lang::get('messages.admin_unchanged', ['act' => 'Deleting']));
		}
	}
	// End Route Management Data > Data User

	// Start Route Management Data > Previlege
	public function indexPrevilege()
	{
		return View::make('mgmt-data.previlege.indexAdmPrevilege');
	}

	public function getIndexPrevilege()
	{
		$select = NewUser::joinDeptCategory()->select(['users.id', 'users.nik', 'users.username', 'users.first_name', 'dept_category.dept_category_name', 'users.spv', 'users.koor', 'users.pm', 'users.producer', 'users.hd', 'users.hr', 'users.hrd', 'users.gm', 'users.sp', 'users.active'])
			->where('users.username', '!=', 'admin');

		return Datatables::of($select)
			->edit_column('sp', '@if($sp === 1){{"Manager"}} @else{{"EMployee"}}  @endif')
			->edit_column('active', '@if ($active === 1){{ "Active" }}@else{{ "Suspend" }}@endif')
			->edit_column('spv', '@if ($spv === 1){{"SPV"}} @else {{"--"}}  @endif')
			->edit_column('koor', '@if ($koor === 1){{"Coordinator"}} @else {{"--"}}  @endif')
			->edit_column('pm', '@if ($pm === 1){{"PM"}} @else {{"--"}}  @endif')
			->edit_column('producer', '@if ($producer === 1){{"Producer"}} @else {{"--"}}  @endif')
			->edit_column('hd', '@if ($hd === 1){{"HD"}} @else {{"--"}}  @endif')
			->edit_column('hr', '@if ($hr === 1){{"HR"}} @else {{"--"}}  @endif')
			->edit_column('hrd', '@if ($hrd === 1){{"HRD"}} @else {{"--"}}  @endif')
			->edit_column('gm', '@if ($gm === 1){{"gm"}} @else {{"--"}}  @endif')
			->add_column(
				'actions',
				Lang::get('messages.btn_warning', ['title' => 'Change Previlege', 'url' => '{{ URL::route(\'mgmt-data/previlege/edit-previlege\', [$id]) }}', 'class' => 'pencil'])
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

		$user_attemp = User_Attemp::where('user_id', $id)->first();

		return View::make('mgmt-data.previlege.edit-Admprevilege')->with(['dept' => $dept, 'level' => $level, 'access' => $access, 'users' => User::find($id), 'attempt' => $user_attemp]);
	}

	public function updatePrevilege(Request $request, $id)
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
		$sp              = 0;
		$infiniteApprove = 0;
		$lineGM 		 = 0;
		$forfeitcase	 = 0;

		$skipCoordinator = false;
		$skipSupervisor = false;
		$skipPM	= false;
		$skipProducer = false;
		$skipHD = false;

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
		if ($request->has('hrd') && $request->input('hrd') === "HR Manager") {
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
		if ($request->has('infiniteApprove') && $request->input('infiniteApprove') === "infiniteApprove") {
			$infiniteApprove = 1;
		}
		if ($request->has('lineGM') && $request->input('lineGM') === "Line GM") {
			$lineGM = 1;
		}
		if ($request->has('forfeitcase') && $request->input('forfeitcase') === "Forfeit Case") {
			$forfeitcase = 1;
		}

		if ($request->has('skipCoordinator') && $request->input('skipCoordinator') === "Skip Coordinator") {
			$skipCoordinator = true;
		}

		if ($request->has('skipSupervisor') && $request->input('skipSupervisor') === 'Skip Supervisor') {
			$skipSupervisor = true;
		}

		if ($request->has('skipPM') && $request->input('skipPM') === "Skip Project Manager") {
			$skipPM = true;
		}

		if ($request->has('skipProducer') && $request->input('skipProducer') === "Skip Producer") {
			$skipProducer = true;
		}

		if ($request->has('skipHD') && $request->input('skipHD') === 'Skip HD') {
			$skipHD = true;
		}

		$rules = [];

		$data = [
			'hr'                   => $hr,
			'hd'                   => $hd,
			'hrd'                  => $hrd,
			'gm'                   => $gm,
			'koor'				   => $koor,
			'spv'				   => $spv,
			'pm'				   => $pm,
			'producer'			   => $producer,
			'sp'                   => $sp,
			'infiniteApprove'	   => $infiniteApprove,
			'lineGM'			   => $lineGM,
			'forfeitcase'		   => $forfeitcase
		];

		$user_attemp = User_Attemp::where('user_id', $id)->first();

		$attempArray = [
			'user_id' => $id,
			'coor'	  => $skipCoordinator,
			'spv'	  => $skipSupervisor,
			'pm'	  => $skipPM,
			'producer' => $skipProducer,
			'hd'	=> $skipHD
		];

		// dd($attempArray);

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('mgmt-data.previlege.edit-Admprevilege', ['id' => $id])
				->withErrors($validator)
				->withInput();
		} else {
			User::where('id', $id)->update($data);
			if ($user_attemp) {
				$user_attemp->update([
					'coor'	  => $skipCoordinator,
					'spv'	  => $skipSupervisor,
					'pm'	  => $skipPM,
					'producer' => $skipProducer,
					'hd'	=> $skipHD
				]);
			} else {
				User_Attemp::create($attempArray);
			}
			Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
			return Redirect::route('mgmt-data/previlege', ['id' => $id]);
		}
	}
	// End Route Management Data > Previlege


	// Start Route Management Data > Initial Leave
	public function indexInitial()
	{
		return View::make('mgmt-data.initial.index');
	}

	public function getIndexInitial()
	{
		$select = NewUser::joinDeptCategory()->select(['users.id', 'users.nik', 'users.first_name', 'users.last_name', 'dept_category.dept_category_name']);

		return Datatables::of($select)
			->add_column(
				'actions',
				Lang::get('messages.btn_primary', ['title' => 'Add Leave', 'url' => '{{ URL::route(\'mgmt-data/initial/create\', [$id]) }}', 'class' => 'pencil'])
			)
			->make();
	}

	public function getIndexInitial2()
	{
		$select = Initial_leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select(['initial_leave.id', 'users.nik', 'users.first_name', 'users.last_name', 'dept_category.dept_category_name', 'initial_leave.initial', 'leave_category.leave_category_name', 'initial_leave.exp_date', 'initial_leave.note']);

		return Datatables::of($select)
			->add_column(
				'actions',
				Lang::get('messages.btn_danger', ['url' => '{{ URL::route(\'mgmt-data/initial/delete\', [$id]) }}', 'data' => 'Initial data'])
			)
			->make();
	}

	// public function createInitial($id)
	// {
	// 	$department = dept_category::where(['id' => User::find($id)->dept_category_id])->value('dept_category_name');
	// 	$leave = [];
	// 	//$list_leave  = Leave_Category::where('id', '<', '3')->orderBy('id','asc')->get();
	// 	$list_leave  = Leave_Category::where('id', '=', '2')->orderBy('id','asc')->get();
	// 	foreach ($list_leave as $value)
	// 		$leave[$value->leave_category_name] = $value->leave_category_name;

	//        return View::make('mgmt-data.initial.create')->with(['leave' => $leave, 'department' => $department, 'users' => User::find($id)]);
	// }

	// public function storeInitial(Request $request, $id)
	// {
	// 	$rules = [
	// 		'input_date' => 'required',
	// 		'exp_date' => 'required',
	// 		'initial' => 'required|numeric'
	// 	];
	// 	$data = [
	// 		'leave_category_id' => leave_Category::where('leave_category_name', $request->input('leave_category_id'))->value('id'),
	// 		'user_id'           => User::find($id)->id,
	// 		'initial'           => $request->input('initial'),
	// 		'input_date'        => $request->input('input_date'),
	// 		'exp_date'          => $request->input('exp_date'),
	// 		'note'              => $request->input('note'),
	// 		'created_by'		=> Auth::user()->first_name.'_'.Auth::user()->last_name
	// 	];
	// 	$validator = Validator::make($request->all(), $rules);

	//     if ($validator->fails()) {
	//         return Redirect::route('mgmt-data/initial/create', [$id])
	//             ->withErrors($validator)
	//             ->withInput();
	//     } else {
	//     	Initial_Leave::insert($data);
	//         Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data Initial']));
	//         return Redirect::route('mgmt-data/initial');
	//     }
	// }

	public function destroyInitial($id)
	{
		$initial = Initial_leave::find($id);

		$initial->delete();
		Session::flash('message', Lang::get('messages.data_deleted', ['data' => 'Initial Data']));
		return Redirect::route('mgmt-data/initial');
	}
	// End Route Management Data > Initial Leave


	//Start Route HR Verification
	public function indexLeaveApproval()
	{

		return View::make('leave.indexHR_Ver');
	}

	public function getIndexLeaveHR_Ver()
	{
		$select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([
			'leave_transaction.id',
			'leave_transaction.ver_hr',
			'leave_transaction.ap_hd',
			'leave_transaction.ap_gm',
			'users.nik',
			'users.first_name',
			'users.last_name',
			'leave_category.leave_category_name',
			'dept_category.dept_category_name',
			'leave_transaction.total_day'
		])
			// ->where('users.dept_category_id', '=', Auth::user()->dept_category_id);
			->where('leave_transaction.ver_hr', '=', 0);

		return Datatables::of($select)
			->edit_column('ap_hd', '@if ($ap_hd === 1){{ "APPROVED" }} @elseif ($ap_hd === 2){{"DISAPPROVED"}} @else{{ "WAITING HR" }}@endif')
			->edit_column('ap_gm', '@if ($ap_gm === 1){{ "APPROVED" }} @elseif ($ap_gm === 2){{"DISAPPROVED"}} @else{{ "WAITING HD" }}@endif')
			->edit_column('ver_hr', '@if ($ver_hr === 1){{ "VERIFIED" }}@else{{ "PENDING" }}@endif')
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
		$return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'>Detail	</h4>
            </div>
            <div class='modal-body'>
                <div class='well'>
                    <h4><strong><u>Verification	</u></strong></h4>
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
                    <strong>Remain :</strong> $leave->remain <br>
                    
                </div>
            </div>
            <div class='modal-footer'>
            <a class='btn btn-primary' href='" . URL::route('ver_hr/ver', [$id]) . "'>Verify</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

		return $return;
	}

	public function verLeave(Request $request, $id)
	{

		$email       = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);

		//return dd($hd);

		$ver_hr      = 1;
		$date_ver_hr = date("Y-m-d");
		$hd_email    = DB::table('users')
			->select(DB::raw('email'))
			->where('dept_category_id', '=', $email->dept_category_id)
			->where('hd', '=', 1)
			->first();
		$gm_email 	 = DB::table('users')
			->select(DB::raw('email'))
			->where('gm', '=', 1)
			->first();

		//return dd($gm_email);

		$data        = [
			'ver_hr'      => $ver_hr,
			'date_ver_hr' => $date_ver_hr
		];

		Leave::where('id', $id)->update($data);
		Session::flash('message', Lang::get('messages.data_updated', ['data' => 'leave']));

		// $this->sendVerEmail($email);

		if ($email->sp === 0) {
			Mail::send('email.appMail', ['email' => $email], function ($message) use ($hd_email) {
				$message->to($hd_email->email)->subject('[Approval Request] Leave Application - WIS');
				$message->from('wis_system@frameworks-studios.com', 'WIS');
			});
		} else {
			Mail::send('email.appMail', ['email' => $email], function ($message) use ($gm_email) {
				$message->to($gm_email->email)->subject('[Approval Request] Leave Application - WIS');
				$message->from('wis_system@frameworks-studios.com', 'WIS');
			});
		}

		return Redirect::route('leave/HR_ver');
	}

	public function sendVerEmail($email)
	{
		//
		$ver_hr      = 1;
		$date_ver_hr = date("Y-m-d");
		$hd_email    = DB::table('users')
			->select(DB::raw('email'))
			->where('dept_category_id', '=', $email->dept_category_id)
			->where('hd', '=', 1)
			->first();
		$gm_email 	 = DB::table('users')
			->select(DB::raw('email'))
			->where('gm', '=', 1)
			->first();
		if ($email->sp === 0) {
			Mail::send('email.appMail', ['email' => $email], function ($message) use ($hd_email) {
				$message->to($hd_email->email)->subject('[Approval Request] Leave Application - WIS');
				$message->from('wis_system@frameworks-studios.com', 'WIS');
			});
		} else {
			Mail::send('email.appMail', ['email' => $email], function ($message) use ($gm_email) {
				$message->to($gm_email->email)->subject('[Approval Request] Leave Application - WIS');
				$message->from('wis_system@frameworks-studios.com', 'WIS');
			});
		}
	}

	public function indexDepartment()
	{
		return View::make('mgmt-data.department.indexDepartment');
	}

	public function getIndexDepartment()
	{
		$select = Dept_Category::select(['id', 'dept_category_name']);

		return Datatables::of($select)
			->add_column(
				'actions',
				Lang::get('messages.btn_warning', ['title' => 'Change Data ', 'url' => '{{ URL::route(\'mgmt-data/department/edit-data\', [$id]) }}', 'class' => 'pencil'])
					. Lang::get('messages.btn_danger', ['url' => '{{ URL::route(\'mgmt-data/department/delete\', [$id]) }}', 'data' => 'Data Department'])
			)
			->make();
	}

	public function createDepartment()
	{
		return View::make('mgmt-data.department.createDepartment');
	}

	public function storeDepartment(Request $request)
	{
		$rules = [
			'department' => 'required|unique:dept_category,dept_category_name'
		];

		$data = [
			'dept_category_name' => $request->input('department'),
			'created_by'         => Auth::user()->first_name . ' ' . Auth::user()->last_name
		];

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('mgmt-data/department/create')
				->withErrors($validator)
				->withInput();
		} else {
			var_dump($data);
			Dept_Category::insert($data);
			Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data Department']));
			return Redirect::route('mgmt-data/department');
		}
	}

	public function editDataDepartment($id)
	{
		return View::make('mgmt-data.department.editDepartment')->with(['dept' => dept_category::find($id)]);
	}

	public function updateDataDepartment(Request $request, $id)
	{
		$dept = dept_category::find($id);
		$rules = [
			'department' => 'required|unique:dept_category,dept_category_name'
		];

		$data = [
			'dept_category_name' => $request->input('department'),
			'created_by'         => Auth::user()->first_name . ' ' . Auth::user()->last_name
		];

		$data_log = [
			'kd_ruh'                 => 'u',
			'com_ruh'                => Auth::user()->first_name . ' ' . Auth::user()->last_name . ' ' . '|' . ' ' . request()->ip(),
			'id_dept_old'            => $dept->id,
			'id_dept_new'            => $dept->id,
			'dept_category_name_old' => $dept->dept_category_name,
			'dept_category_name_new' => $request->input('department')
		];

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('mgmt-data/department/edit-data', ['id' => $id])
				->withErrors($validator)
				->withInput();
		} else {
			Dept_Category::where('id', $id)->update($data);
			Log_Dept_Category::insert($data_log);
			Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
			return Redirect::route('mgmt-data/department');
		}
	}

	public function destroyDepartment($id)
	{
		$dept = Dept_Category::find($id);

		$dept->delete();
		Session::flash('message', Lang::get('messages.data_deleted', ['data' => 'Department Data']));
		return Redirect::route('mgmt-data/department');
	}

	public function grafic()
	{
		return View::make('leave_report.indexGrafik');
	}

	public function online()
	{
		return View::make('admin.online');
	}

	public function indexonline()
	{
		$select = DB::table('users')->select([
			'users.id',
			'users.request_ip',
			'users.username',
			'users.online'
		])
			->where('online', '=', 1)
			->where('username', '!=', 'admin')
			->get();

		return Datatables::of($select)
			->edit_column('online', '@if (1) {{"Online"}}@else {{"Offline"}} @endif')
			->make();
	}

	public function indexContract()
	{
		return View::make('admin.indexContract');
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
			->where('users.active', '=', 1)
			->get();

		return Datatables::of($select)
			->edit_column('active', '@if ($active === 1) {{"Active"}} @else {{"Suspend"}} @endif ')
			->add_column(
				'actions',
				Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'mgmt-data/user/detail\', [$id]) }}', 'class' => 'file'])
			)
			->make();
	}

	public function storeContract()
	{
		$active =  0;
		$b = ['active' => $active];

		$select = NewUser::where('username', '!=', 'admin')
			->where('username', '!=', 'hr')
			->where('emp_status', '!=', 'Permanent')
			->where('end_date', '!=', 0000 - 00 - 00)
			->where('end_date', '<',  date('Y-m-d'))
			->update($b);

		Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
		return Redirect::route('Contract-Staff');
	}

	public function indexBirhtday()
	{
		return View::make('admin.indexBirthday');
		/*return View::make('email.birthdayMail');*/
	}

	public function getindexBirhtday(Request $id)
	{
		$select = NewUser::joinDeptCategory()->select([
			'users.id',
			'users.nik',
			'users.first_name',
			'users.last_name',
			'dept_category.dept_category_name',
			'users.dob',
			'users.active'
		])
			->where('username', '!=', 'admin')
			->where('username', '!=', 'hr')
			->whereMONTH('dob', '=', date('m'))
			->whereDAY('dob', '=', date('d'))
			->get();

		return Datatables::of($select)
			->edit_column('active', '@if ($active === 1) {{"Active"}} @else {{"Suspend"}} @endif ')
			->add_column(
				'actions',
				Lang::get('messages.btn_warning', ['title' => 'Change Previlege', 'url' => '{{ URL::route(\'Birthday/Mail\', [$id]) }}', 'class' => 'pencil'])

			)
			->make();
	}

	public function mailBirthday(Request $id)
	{
		$select = NewUser::joinDeptCategory()

			->whereMONTH('dob', '=', date('m'))
			->whereDAY('dob', '=', date('d'))
			->first();


		$subject = '[Happy Birthday] Reminder - WIS';

		$email = DB::table('users')
			->select(DB::raw('id'))
			->whereMONTH('dob', '=', date('m'))
			->whereDAY('dob', '=', date('d'))
			->get();



		Mail::send('email.birthdayMail', ['email' => $select], function ($message) use ($select, $subject) {
			foreach ($select as $e) {
				$message->to($select->email)->subject($subject);
			}
			$message->from('wis_system@frameworks-studios.com', 'WIS');
		});

		Session::flash('message', Lang::get('messages.send_birthday', ['data' => 'Data User']));
		return Redirect::route('Birthday-Staff');
	}

	public function indexAccess()
	{
		return view::make('admin.HRD_Access.index');
	}

	public function getindexAccess(Request $id)
	{
		$select = NewUser::joinDeptCategory()->select([
			'users.id',
			'users.nik',
			'users.first_name',
			'users.last_name',
			'dept_category.dept_category_name',
			'users.position',
			'users.level_hrd',
			'users.sp',
			'users.active'
		])
			->where('users.dept_category_id', '=', 3)

			->get();

		return Datatables::of($select)

			->edit_column('sp', '@if ($sp === 1){{"HOD"}} @else {{"Staff"}}  @endif')
			->edit_column('active', '@if ($active === 1) {{"Active"}} @else {{"Suspend"}} @endif ')
			->edit_column('level_hrd', '@if ($sp === 1){{"Head Of Department"}} @else {{$level_hrd}}  @endif')

			->add_column(
				'actions',
				Lang::get('messages.btn_warning', ['title' => 'Change Previlege', 'url' => '{{ URL::route(\'hrd-access/change\', [$id]) }}', 'class' => 'pencil'])

			)
			->make();
	}

	public function editAccess($id)
	{
		$dept   = dept_category::where(['id' => User::find($id)->dept_category_id])->value('dept_category_name');
		$level  = ['USER' => 'User', 'HUMAN RESOURCE' => 'Human Resource', 'HEAD OF DEPARTMENT' => 'Head of Department', 'GENERAL MANAGER' => 'General Manager'];
		$leave_access     = ['' => '-Select-', 'Payroll' => 'Payroll Officer', 'HR_GA_Officer' => 'HR & GA Officer', 'GA' => 'General Affair Officer', '0' => 'Nothing'];

		return view::make('admin.HRD_Access.edit')->with(['dept' => $dept, 'level' => $level, 'leave_access' => $leave_access, 'users' => User::find($id)]);
	}

	public function storeAccess(Request $request, $id)
	{
		$rules = [
			'leave_access' => 'required',

		];
		$data = ['level_hrd' => $request->input('leave_access')];
		$validator = Validator::make($request->all(), $rules);
		/*dd($data);*/
		if ($validator->fails()) {
			return Redirect::route('hrd-access/change', [$id])
				->withErrors($validator)
				->withInput();
		} else {
			User::where('id', $id)->update($data);
			Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data Initial']));
			return Redirect::route('HRD-Access');
		}
	}

	public function indexProduction()
	{
		return view::make('admin.Production_Access.index');
	}

	public function getindexProductionAccess(Request $id)
	{
		$select = NewUser::joinDeptCategory()->select([
			'users.id',
			'users.nik',
			'users.first_name',
			'users.last_name',
			'dept_category.dept_category_name',
			'users.position',
			'users.level_hrd',
			'users.sp',
			'users.active'
		])
			->where('users.dept_category_id', '=', 6)
			->where('users.spv', '=', 0)
			->where('users.koor', '=', 0)
			->where('users.pm', '=', 0)
			->where('users.producer', '=', 0)
			->get();

		return Datatables::of($select)
			->edit_column('sp', '@if ($sp === 1){{"HOD"}} @else {{"Staff"}}  @endif')
			->edit_column('active', '@if ($active === 1) {{"Active"}} @else {{"Suspend"}} @endif ')
			->add_column(
				'actions',
				Lang::get('messages.btn_warning', ['title' => 'Change Previlege', 'url' => '{{ URL::route(\'editProduction\', [$id]) }}', 'class' => 'pencil'])

			)
			->make();
	}

	public function editProductionAccess($id)
	{
		$dept   = dept_category::where(['id' => User::find($id)->dept_category_id])->value('dept_category_name');
		$level  = ['USER' => 'User', 'HUMAN RESOURCE' => 'Human Resource', 'HEAD OF DEPARTMENT' => 'Head of Department', 'GENERAL MANAGER' => 'General Manager'];
		$leave_access     = ['0' => '-Select-', 'Junior Pipeline' => 'Junior Pipeline Production', 'Senior Pipeline' => 'Senior Pipeline Production', 'Senior Technical' => 'Senior Technical', 'Technical Director' => 'Supervisor Technical Director Production'];

		return view::make('admin.Production_Access.edit')->with(['dept' => $dept, 'level' => $level, 'leave_access' => $leave_access, 'users' => User::find($id)]);
	}

	public function storeProductionAccess(Request $request, $id)
	{
		$rules = [
			'leave_access' => 'required',

		];
		$data = ['level_hrd' => $request->input('leave_access')];
		$validator = Validator::make($request->all(), $rules);
		/*dd($data);*/
		if ($validator->fails()) {
			return Redirect::route('editProduction', [$id])
				->withErrors($validator)
				->withInput();
		} else {
			User::where('id', $id)->update($data);
			Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data Initial']));
			return Redirect::route('indexProduction');
		}
	}

	public function allUser()
	{
		return view::make('admin.All_User');
	}

	public function getallUser()
	{
		$select = NewUser::joinDeptCategory()->select([
			'users.id',
			'users.username',

			'users.nik',
			'users.first_name',
			'users.last_name',
			'dept_category.dept_category_name',
			'users.position',
			'users.level_hrd',
			'users.emp_status',

			'users.nationality',
			'users.join_date',
			'users.end_date',
			'users.dob',
			'users.pob',
			'users.province',
			'users.maiden_name',
			'users.gender',
			'users.id_card',
			'users.email',

			'users.phone',
			'users.address',
			'users.area',
			'users.city',
			'users.education',
			'users.marital_status',
			'users.npwp',
			'users.kk',
			'users.religion',
			'users.dependent',

			'users.bpjs_ketenagakerjaan',
			'users.bpjs_kesehatan',
			'users.rusun',
			'users.rusun_stat',
			'users.race',
			'users.source_company',
			'users.global_id',
			'users.init_date',
			'users.tax_cut_in',
			'users.tax_cut_off',

			'users.reason_off_leaving',
			'users.reentry_to_company',
			'users.reentry_to_otherco',
			'users.remark',
			'users.jpk',
			'users.cob',
			'users.project_category_id_1',
			'users.project_category_id_2',
			'users.project_category_id_3',
			'users.initial_annual',

			'users.active',
			'users.admin',
			'users.hr',
			'users.koor',
			'users.pm',
			'users.spv',
			'users.producer',
			'users.hd',
			'users.hrd',
			'users.gm',

			'users.user',
			'users.sp',
			'users.spHRD',
			'users.ticket',
			'users.block_stat',
			'users.prof_pict',
			'users.request_ip',
			'users.online'

		])

			->get();

		return Datatables::of($select)

			->make();
	}
}