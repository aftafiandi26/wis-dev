<?php

namespace App\Http\Controllers;

use App;
use App\Dept_Category;
use App\Entitled_leave_view;
use App\Events\LeaveVerificatedByHr;
use App\Http\Controllers\Controller;
use App\Initial_Leave;
use App\JobFunction_Category;
use App\Leave;
use App\Leave_Category;
use App\Log_User;
use App\Log_Ws_Availability;
use App\NewUser;
use App\Project_Category;
use App\User;
use App\User_project;
use App\Ws_Availability;
use App\Asseting_IT;
use App\Asseting_PS;
use App\Asset_Tracking;
use App\Asset_Cname;
use App\AssetSoftware;
use App\Ws_Map;
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
use Illuminate\Support\Facades\PDF;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use Storage;
use Yajra\Datatables\Facades\Datatables;
use Yajra\DataTables\Html\Builder;

use \Milon\Barcode\DNS2D;
use \Milon\Barcode\DNS1D;  
use SimpleSoftwareIO\QrCode; 

class ResetPasswordContorller extends Controller
{

	public function indexResetPasswordIT()
	{
		return view::make('IT.ResetPassword.index');
	}

	public function getIndexResetPassword()
	{
			$select = User::select(['users.id', 'users.nik', 'users.username', 'users.first_name', 'users.last_name', 'users.active'])
		    ->get();

			return Datatables::of($select)
				->edit_column('active', '@if ($active === 1){{ "Active" }}@else{{ "Suspend" }}@endif')
				->add_column('actions', 			
				Lang::get('messages.btn_reset', ['title' => 'Reset Password', 'url' => '{{ URL::route(\'passResetUserIT\', [$id]) }}', 'class' => 'refresh']))
				->make();
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
	            	<a class='btn btn-primary' href='".URL::route('actionResetIT', [$id])."'>Yes</a>
	                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
	            </div>
	        ";

			return $return;
	    }

	    public function actionPassResetUser(Request $request, $id)
	    {
	        $data = [
				'password' => Hash::make('Batam'.Date('Y')),
				'block_stat' => 0,
			];		
				User::where('id', $id)->update($data);
				Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data User']));
			    return Redirect::route('indexResetPassswordIT');
	    }
}