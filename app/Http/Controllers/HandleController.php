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
use App\Ws_Map;
use App\PolingKantin;

use App\Asset_Tracking;
use App\FinanceTracking;
use APP\Asset_PO;

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

class HandleController extends Controller
{
    public function __construct()
	{
		$this->middleware(['auth', 'active', 'programmer']);
		
	}

	public function votingPolingKantin()
	{
		$score = PolingKantin::where('id_userss', auth::user()->id)->latest()->first();
		return view('IT.Handle.KomiteKantin.index', ['score' => $score]);
	}

	public function storePolingKantin(Request $request)
	{
		$score = PolingKantin::where('id_userss', auth::user()->id)->latest()->first();
		$rules = [
			'taste'    			=> 'required|numeric',
			'quantity' 			=> 'required|numeric',
			'nutritional'  		=> 'required|numeric', 
			'combination'  		=> 'required|numeric', 
			'freshness'  		=> 'required|numeric',
			'cleanliness'  		=> 'required|numeric',
			'service'  			=> 'required|numeric',          
		];

			if (auth::user()->last_name === null) {
				$name = auth::user()->first_name;
			}else{
				$name = auth::user()->first_name.' '.auth::user()->last_name;
			}

		$total_point =  $request->input('taste')+$request->input('quantity')+$request->input('nutritional')+$request->input('combination')+$request->input('freshness')+$request->input('cleanliness')+$request->input('service');
		$averange = $total_point/7;
		$data = [
			'id_userss'	=> auth::user()->id,
			'point_1'	=> $request->input('taste'),
			'point_2'	=> $request->input('quantity'),
			'point_3'	=> $request->input('nutritional'),
			'point_4'	=> $request->input('combination'),
			'point_5'	=> $request->input('freshness'),
			'point_6'	=> $request->input('cleanliness'),
			'point_7'	=> $request->input('service'),
			'total_point'	=> $total_point,
			'averange'		=> $averange,
			'name_employee'	=> $name,
			'comment'		=> $request->input('comment'),
			'status_voting'	=> 1,
			'date_entry'	=> date('Y-m-d')
		];
		
		 $validator = Validator::make($request->all(), $rules);
	
		 if ($validator->fails()) {            
			return Redirect::route('indexPolingKantin')
				->withErrors($validator)
				->withInput();
		} else {
			
			/*if ($score->date_entry === date('Y-m-d')) {
				Session::flash('message', Lang::get('messages.voting_sudah', ['data' => 'Data User']));
			}else
			{ */
				PolingKantin::insert($data);								
				Session::flash('message', Lang::get('messages.thankyou', ['data' => 'Data User']));
			/*}*/	
			
			return Redirect::route('indexPolingKantin');
		}
	}
///////////////////Asset Trackng Number

	
	
	///////////end Asset Tracking

//end
}
