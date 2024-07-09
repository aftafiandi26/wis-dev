<?php

namespace App\Http\Controllers;

use App;
use App\Dept_Category;
use App\Http\Controllers\Controller;
use App\Initial_Leave;
use App\Leave;
use App\Meeting;
use App\Leave_backup;
use App\Leave_Category;
use App\NewUser;
use App\Project_Category;
use App\User;
use App\Ws_Map;
use App\PolingKantin;
use App\Bus_Transportation;
use App\Forfeited;
use App\ForfeitedCounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Storage;

class AllEmployee_2Controller extends Controller
{
   public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function votingPolingKantin()
	{
		$score = PolingKantin::where('id_userss', auth::user()->id)->latest()->first();	
		
		return view('all_employee.KomiteKantin.index', ['score' => $score]);
	}

	public function storePolingKantin(Request $request)
	{
		$score = PolingKantin::where('id_userss', auth::user()->id)->latest()->first();

		$rules = [
			'taste'    					=> 'required|numeric',
			'quantity' 					=> 'required|numeric',
			'quality'					=> 'required|numeric',				
			'combination'  				=> 'required|numeric', 
			'freshness'  				=> 'required|numeric',
			'cleanliness'  				=> 'required|numeric',
			'service'  					=> 'required|numeric',
			'lauk_utama_option1'   		=> 'required|string',
			'sayuran_option1'			=> 'required|string',
			'lauk_sampingan_option1'  	=> 'required|string',				
			'lauk_utama_option3'   		=> 'required|string',
			'sayuran_option3'			=> 'required|string',
			'lauk_sampingan_option3'  	=> 'required|string',				
		];

			if (auth::user()->last_name === null) {
				$name = auth::user()->first_name;
			}else{
				$name = auth::user()->first_name.' '.auth::user()->last_name;
			}

			if (auth::user()->dept_category_id === 6) {	
				if (auth::user()->level_hrd === "0") {
					$supper = $request->input('supper');			
					$total_point = $request->input('taste')+$request->input('quantity')+$request->input('quality')+$request->input('supper')+$request->input('combination')+$request->input('freshness')+$request->input('cleanliness')+$request->input('service');
					$averange = $total_point/8;
				} else {
					$supper		 = 0;
					$total_point = $request->input('taste')+$request->input('quantity')+$request->input('quality')+$request->input('combination')+$request->input('freshness')+$request->input('cleanliness')+$request->input('service');
					$averange = $total_point/7;
				}
			}else{				
				$supper		 = 0;
				$total_point = $request->input('taste')+$request->input('quantity')+$request->input('quality')+$request->input('combination')+$request->input('freshness')+$request->input('cleanliness')+$request->input('service');
				$averange = $total_point/7;
			}

		$data = [
			'id_userss'		=> auth::user()->id,
			'point_1'		=> $request->input('taste'),
			'point_2'		=> $request->input('quantity'),
			'point_3'		=> $request->input('quality'),
			'point_4'		=> $supper,
			'point_5'		=> $request->input('combination'),
			'point_6'		=> $request->input('freshness'),
			'point_7'		=> $request->input('cleanliness'),
			'point_8'		=> $request->input('service'),
			'total_point'	=> $total_point,
			'averange'		=> $averange,
			'name_employee'	=> $name,
			'comment'		=> $request->input('comment'),
	
			'main_dishes_1'			=> strtoupper($request->input('lauk_utama_option1')),
			'vegetables_1'			=> strtoupper($request->input('sayuran_option1')),
			'slide_of_dishes_1' 	=> strtoupper($request->input('lauk_sampingan_option1')),
			'main_dishes_3'			=> strtoupper($request->input('lauk_utama_option3')),
			'vegetables_3'			=> strtoupper($request->input('sayuran_option3')),
			'slide_of_dishes_3' 	=> strtoupper($request->input('lauk_sampingan_option3')),
			'status_voting'	=> 1,
			'date_entry'	=> date('Y-m-d'),
			'prefer'			=> $request->input('prefer'),
			'vegetarian'		=> $request->input('vegetarian'),
		];
		
		$cekTglAwal = '2020-11-16';
		$cekTglAkhir = '2020-11-21';

		$cekUser = PolingKantin::whereBetween('created_at', [$cekTglAwal, $cekTglAkhir])->where('id_userss', auth::user()->id)->first();	
		
		$validator = Validator::make($request->all(), $rules);
		
		 if ($validator->fails()) {            
			return Redirect::route('indexPolingKantinEmployee')
				->withErrors($validator)
				->withInput();
		} else {			
			/*if ($score === null) {
					PolingKantin::insert($data);								
					Session::flash('message', Lang::get('messages.thankyou', ['data' => 'Data User']));	
			}else{*/
				if ($cekUser != null) {
					Session::flash('message', Lang::get('messages.voting_sudah', ['data' => 'Data User']));
				}
				else
				{ 	
					PolingKantin::insert($data);								
					Session::flash('message', Lang::get('messages.thankyou', ['data' => 'Data User']));	
				}
			/*}*/
			return Redirect::route('indexPolingKantinEmployee');
		}
	}

	public function inputDataBookingTransportation()
	{
		return view('all_employee.Transportation.Bus.inputData');
	}

	public function viewDataBookingTransportation()
	{
		/* validasi waktu 
		$k = strtotime($time_booking);
		$b = date("H:i:s", strtotime("-1 hours", $k));

		date("H:i:s", strtotime("-1 hours", strtotime($time_booking)))
		*/

		$select = Bus_Transportation::select(['id', 'nik', 'name_employee', 'date_booking', 'time_booking', 'destination', 'key_transportation', 'lockey'])	
		->where('id_users', auth::user()->id)	
		->where('date_booking', '>=', date('Y-m-d'))
		->get();
	  
		return Datatables::of($select) 
		->editColumn('time_booking', '{{$time_booking}}')
		->editColumn('lockey', '@if($lockey === 1){{"Confirmed"}} @else{{"Process"}} @endif')
		->add_column('action',				
				'@if (date("H:i:s") <= date("H:i:s", strtotime("-1 hours", strtotime($time_booking))) and $lockey === 0)'				
				.Lang::get('messages.btn_reschedule', ['title' => 'Reschedlue', 'url' => '{{ URL::route(\'ReschedlueDataBooking\', [$id, $key_transportation])}}', 'gaya' => 'color: white;']).' '
				.Lang::get('messages.btn_delete', ['title' => 'Delete Booking', 'url' => '{{ URL::route(\'deleteScheduleBooking\', [$id])}}', 'gaya' => 'color: white;', 'data' => 'Your Booking'])	
				.' '
				.Lang::get('messages.btn_check_in', ['title' => 'Check In', 'url' => '{{ URL::route(\'checkInTransportation\', [$id]) }}', 'name' => 'check in', 'myModal' => '#showModal'])					
				.'@endif'
										
				) 		
			->make();       
	}

	public function checkInTransportation($id)
	{
		$select = Bus_Transportation::find($id);
		if (auth::user()->dept_category_id === 1) {
			
		
		$return = "<div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'>Check IN</h4>
            </div>
            <div class='modal-body'>
            	<p><b>Kode Booking</b> : $select->kode_boking$select->id</p>
            	<p><b>Destination</b> :  $select->destination </p>
            	<p><b>Time</b> : $select->time_booking</p>
            	<p><b>Date</b> : $select->date_booking</p>
            	<p>Hey <b>$select->name_employee</b> Are u wanna <b>check in</b>?</p>              
            </div>
            <div class='modal-footer'>
               	<a class='btn btn-sm btn-primary' href='".URL::route('storeCheckInTransportaion', [$select->id])."'>check in</a>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>";

	    return $return;


	    }
	}

	public function storeCheckInTransportaion($id)
	{
		$select = Bus_Transportation::find($id);
		$data = [
			'lockey' => 1
		];

		Bus_Transportation::where('id', $id)->update($data);
		Session::flash('success', Lang::get('messages.bus_booking', ['name' => $select->name_employee]));
		return Redirect::route('bookingg');

	}

	public function inputToStudio()
	{
		$project = Project_Category::where('id', auth::user()->project_category_id_1)->first();	
		if (auth::user()->project_category_id_1 === null) {
				$project_name = 'General';
			}else{
				$project_name = $project->project_name;
			}
		$departement = Dept_Category::where('id', auth::user()->dept_category_id)->first();
		return view('all_employee.Transportation.Bus.inputToStudio', ['departement' => $departement, 'project' => $project_name]);
	}

	public function storeInputToStudios(Request $request)
	{
		$rule = [
			'nik'  => 'required|numeric',
			'name' => 'required|string',
			'department' => 'required|string',
			'dated' => 'required|date',
			'departure' => 'required',
			'departure_destination' => 'required|string'
		];

		$dataProject = $request->input('project');
		if ($dataProject === 'General') {
					$getProject = 0;
			}elseif ($dataProject != 'General') {
				    $getProject = auth::user()->project_category_id_1;
			}

		$dataOneTrip = [
			'id_users' => auth::user()->id,
			'kode_boking' => auth::user()->dept_category_id.auth::user()->id,
			'time_and_date' =>  $request->input('dated').' '.$request->input('departure'),
			'nik'	=> auth::user()->nik,
			'name_employee' => $request->input('name'),
			'department' => auth::user()->dept_category_id,
			'project_id' => $getProject,
			'date_booking' => $request->input('dated'),
			'time_booking' => $request->input('departure'),
			'destination' => $request->input('departure_destination'),
			'key_transportation' => 1,			
		];
		$dataTwoTrip = [
				'id_users' => auth::user()->id,
				'kode_boking' => auth::user()->dept_category_id.auth::user()->id,
				'time_and_date' =>  $request->input('dated').' '.$request->input('departure'),
				'nik'	=> auth::user()->nik,
				'name_employee' => $request->input('name'),
				'department' => auth::user()->dept_category_id,
				'project_id' => $getProject,
				'date_booking' => $request->input('dated'),
				'time_booking' => $request->input('arrival'),
				'destination' => $request->input('arrival_destination'),
				'key_transportation' => 2,
			];
		$cekdataOneTrip = Bus_Transportation::where('id_users', auth::user()->id)->where('key_transportation', 1)->where('date_booking', $request->input('dated'))->value('date_booking');

		$validator = Validator::make($request->all(), $rule);
		 if ($validator->fails()) {
		 	$errors  = $validator->errors();
			return Redirect::route('inputToStudio')
				->withErrors($validator)
				->withInput();
		} else {
			if ($request->input('dated') < date('Y-m-d')) {
				Session::flash('getError', Lang::get('messages.low_dated', ['name' => $request->input('name')]));									
				return Redirect::route('bookingg');
			}elseif ($request->input('dated') > date('Y-m-d')) {				
				if ($cekdataOneTrip != null) {
					Session::flash('message', Lang::get('messages.bus_sudah_ada', ['name' => $request->input('name')]));
					Session::flash('reminder', Lang::get('messages.bus_reminder'));
				}elseif ($cekdataOneTrip === null) {
					Bus_Transportation::insert($dataOneTrip);
					if ($request->input('arrival') != null) {
						Bus_Transportation::insert($dataTwoTrip);
						}								
					Session::flash('success', Lang::get('messages.bus_booking', ['name' => $request->input('name')]));
					Session::flash('reminder', Lang::get('messages.bus_reminder'));
				}					
				return Redirect::route('bookingg');
			}elseif ($request->input('dated') === date('Y-m-d'))  {
				if ($cekdataOneTrip != null) {
					Session::flash('message', Lang::get('messages.bus_sudah_ada', ['name' => $request->input('name')]));
					Session::flash('reminder', Lang::get('messages.bus_reminder'));
				}elseif ($cekdataOneTrip === null) {

					/*$klke = date('H:i:s', strtotime("-2 hours"));*/					

					if (date('H:i:s', strtotime("-1 hours")) <= $request->input('departure')) {
						Bus_Transportation::insert($dataOneTrip);
						if ($request->input('arrival') != null) {
							Bus_Transportation::insert($dataTwoTrip);
							}								
						Session::flash('success', Lang::get('messages.bus_booking', ['name' => $request->input('name')]));
						Session::flash('reminder', Lang::get('messages.bus_reminder'));
					}elseif (date('H:i:s', strtotime("-1 hours")) >= $request->input('departure')) {														
						Session::flash('getError', Lang::get('messages.low_dated', ['name' => $request->input('name')]));
					}										
				}					
				return Redirect::route('bookingg');
			}			
		}		
	}	

	public function inputFromStudio()
	{
		$project = Project_Category::where('id', auth::user()->project_category_id_1)->first();	
		if (auth::user()->project_category_id_1 === null) {
				$project_name = 'General';
			}else{
				$project_name = $project->project_name;
			}
		$departement = Dept_Category::where('id', auth::user()->dept_category_id)->first();
		return view('all_employee.Transportation.Bus.inputFromStudio', ['departement' => $departement, 'project' => $project_name]);
	}

	public function storeInputFromStudio(Request $request)
	{
		$rule = [
			'nik'  => 'required|numeric',
			'name' => 'required|string',
			'department' => 'required|string',
			'dated' => 'required|date',
			'departure' => 'required',
			'destination' => 'required|string'
		];

		$dataProject = $request->input('project');
		if ($dataProject === 'General') {
					$getProject = 0;
			}elseif ($dataProject != 'General') {
				    $getProject = auth::user()->project_category_id_1;
			}

		$data = [
			'id_users' => auth::user()->id,
			'kode_boking' => auth::user()->dept_category_id.auth::user()->id,
			'time_and_date' =>  $request->input('dated').' '.$request->input('departure'),
			'nik'	=> auth::user()->nik,
			'name_employee' => $request->input('name'),
			'department' => auth::user()->dept_category_id,
			'project_id' => $getProject,
			'date_booking' => $request->input('dated'),
			'time_booking' => $request->input('departure'),
			'destination' => $request->input('destination'),
			'key_transportation' => 2,			
		];

		$cekdata = Bus_Transportation::where('id_users', auth::user()->id)->where('key_transportation', 2)->where('date_booking', $request->input('dated'))->value('date_booking');
		
		$validator = Validator::make($request->all(), $rule);
		 if ($validator->fails()) {
		 	$errors  = $validator->errors();
			return Redirect::route('inputFromStudio')
				->withErrors($validator)
				->withInput();
		} else {
			if ($request->input('dated') < date('Y-m-d')) {
				Session::flash('getError', Lang::get('messages.low_dated', ['name' => $request->input('name')]));									
				return Redirect::route('bookingg');
			}elseif ($request->input('dated') > date('Y-m-d')) {
				if ($cekdata != null) {
					Session::flash('message', Lang::get('messages.bus_sudah_ada', ['name' => $request->input('name')]));
					Session::flash('reminder', Lang::get('messages.bus_reminder'));
				}elseif ($cekdata === null) {
					Bus_Transportation::insert($data);
					Session::flash('success', Lang::get('messages.bus_booking', ['name' => $request->input('name')]));
					Session::flash('reminder', Lang::get('messages.bus_reminder'));
				}
				
				return Redirect::route('bookingg');
			}elseif ($request->input('dated') === date('Y-m-d')) {
				if ($cekdata != null) {
					Session::flash('message', Lang::get('messages.bus_sudah_ada', ['name' => $request->input('name')]));
					Session::flash('reminder', Lang::get('messages.bus_reminder'));
				}elseif ($cekdata === null) {
					if (date('H:i:s', strtotime("-1 hours")) <= $request->input('departure')) {
						Bus_Transportation::insert($data);												
						Session::flash('success', Lang::get('messages.bus_booking', ['name' => $request->input('name')]));
						Session::flash('reminder', Lang::get('messages.bus_reminder'));
					}elseif (date('H:i:s', strtotime("-1 hours")) >= $request->input('departure')) {														
						Session::flash('getError', Lang::get('messages.low_dated', ['name' => $request->input('name')]));
					}	
				}				
				return Redirect::route('bookingg');
			}
		}
	}

	public function ReschedlueDataBooking($id, $key_transportation)
	{
		$project = Project_Category::where('id', auth::user()->project_category_id_1)->first();	
		if (auth::user()->project_category_id_1 === null) {
				$project_name = 'General';
			}else{
				$project_name = $project->project_name;
			}
		$departement = Dept_Category::where('id', auth::user()->dept_category_id)->first();

		$getData = Bus_Transportation::where('id', $id)->first();

		if ($key_transportation === "2") {
			return view('all_employee.Transportation.Bus.editData2', ['departement' => $departement, 'project' => $project_name, 'getData' => $getData]);	
		}elseif ($key_transportation === "1") {
			return view('all_employee.Transportation.Bus.editData1', ['departement' => $departement, 'project' => $project_name, 'getData' => $getData]);	
		}			
	}

	public function editData2RescheduleDataBooking(Request $request, $id, $key_transportation)
	{		
		$rule = [
			'departure' => 'required'
		];

		$data = [
			'time_booking' => $request->input('departure')
		];

		$validator = Validator::make($request->all(), $rule);

		 if ($validator->fails()) {
		 	$errors  = $validator->errors();
			return Redirect::route('ReschedlueDataBooking', [$id, $key_transportation])
				->withErrors($validator)
				->withInput();
		} else {
			Bus_Transportation::where('id', $id)->update($data);
			Session::flash('success', Lang::get('messages.bus_edit', ['name' => $request->input('name')]));
			Session::flash('reminder', Lang::get('messages.bus_reminder'));
			return Redirect::route('bookingg');
		}
	}

	public function editData1RescheduleDataBooking(Request $request, $id, $key_transportation)
	{		
		$rule = [
			'departure' => 'required'
		];

		$data = [
			'time_booking' => $request->input('departure')
		];

		$validator = Validator::make($request->all(), $rule);

		 if ($validator->fails()) {
		 	$errors  = $validator->errors();
			return Redirect::route('ReschedlueDataBooking', [$id, $key_transportation])
				->withErrors($validator)
				->withInput();
		} else {
			Bus_Transportation::where('id', $id)->update($data);
			Session::flash('success', Lang::get('messages.bus_edit', ['name' => $request->input('name')]));
			Session::flash('reminder', Lang::get('messages.bus_reminder'));
			return Redirect::route('bookingg');
		}
	}

	public function deleteScheduleBooking($id)
	{		
		$k = auth::user()->dept_category_id;

		Bus_Transportation::where('id', $id)->delete();
		Session::flash('getError', Lang::get('messages.data_deleted', ['data' => 'Booking']));
		return Redirect::route('bookingg');
	}

	public function wfh_trouble()
	{
		return view::make('all_employee.WFH.index');
	}

	public function downloadGuideRemoteWFH()
	{
        $pathToFile = storage_path('app/pdf/GuideRemote.pdf');

        return response()->download($pathToFile);        
	}

	public function indexHousingAssessment()
	{
		return view::make('all_employee.HousingAssessment.index');
	}

	public function indexForfeited()
	{
		$forfeiteds = Forfeited::where('user_id', auth::user()->id)->get();
		$forfeitedsCount = ForfeitedCounts::where('user_id', auth::user()->id)->where('status', 1)->get();

		$sumfor =  $forfeitedsCount->pluck('amount')->sum();

		$balancefor = $forfeiteds->pluck('countAnnual')->sum() - $forfeitedsCount->pluck('amount')->sum();

		$amount = $forfeiteds->pluck('countAnnual')->sum();

		if ($sumfor >= $amount) {
			$sumfor1 = $amount;
		} else {
			$sumfor1 = $sumfor;
		}

		if ($balancefor <= 0) {
			$balance = 0;
		} else {
			$balance = $balancefor;
		}
		
		$no = 1;

		return view('all_employee.Forfeited.index', compact(['forfeiteds', 'no', 'forfeitedsCount', 'amount', 'sumfor1', 'balance']));
	}

	public function indexSummaryApprovedCoordinator()
	{
		return view('leave.NewAnnual.historiLeaveing');
	}

	public function getDataSummaryApprovedCoordinator()
	{
		$model = Leave::where('email_koor', 'zakaria.anshori@frameworks-studios.com')
					->where('ap_koor', 1)
					->orderBy('id', 'desc')
					->get();

		return Datatables::of($model)
					->addIndexColumn()
					->editColumn('ap_koor', function(Leave $leave){
						$user = NewUser::where('email', $leave->email_koor)->first();

						if ($leave->ap_koor === 1) {
							$return = $user->first_name.' '.$user->last_name.' Approved';
						}
						if ($leave->ap_koor === 2) {
							$return = $user->first_name.' '.$user->last_name.' Disapproved';
						}

						return $return;	
					})
					->editColumn('ap_pm', function(Leave $leave){
						$user = NewUser::where('email', $leave->email_pm)->first();

						if ($leave->ap_pm === 1) {
							$return = $user->first_name.' '.$user->last_name.' Approved';
						}
						if ($leave->ap_pm === 0) {
							$return = $user->first_name.' '.$user->last_name.' Please Approval';
						}
						if ($leave->ap_pm === 2) {
							$return = $user->first_name.' '.$user->last_name.' Disapproved';
						}

						return $return;						
					})
					->editColumn('ap_hd', function(Leave $leave){
						$user = NewUser::where('dept_category_id', 6)->where('hd', 1)->where('active', 1)->first();

						if ($leave->ap_hd === 1) {
							$return = $user->first_name.' '.$user->last_name.' Approved';
						}
						if ($leave->ap_hd === 0) {
							if ($leave->ap_koor === 1 and $leave->ap_pm === 1) {
							$return = 'Pending';
							}
							if ($leave->ap_koor === 1 and $leave->ap_pm === 0) {
							$return = 'Waitting PM';
							}
						}
						if ($leave->ap_hd === 2) {
							$return = $user->first_name.' '.$user->last_name.' Disapproved';
						}

						return $return;
					})
					->editColumn('ver_hr', function(Leave $leave){
					
						if ($leave->ver_hr === 1) {
							$return = 'Verify Success';
						} else {
							$return = 'Waitting Form';					
						}

						return $return;
					})
					->editColumn('ap_hrd', function(leave $leave){

						if ($leave->ap_hrd === 1) {
							$return = 'Verify Success';
						}
						if ($leave->ap_hrd === 0) {
							$return = 'Waitting Verify';
						}
						if ($leave->ap_hrd === 2) {
							$return = 'Canceled';
						}

						return $return;
					})
					->editColumn('leave_category_id', function(Leave $leave){
						$return = Leave_Category::findOrFail($leave->leave_category_id);

						return $return->leave_category_name;
					})
					->make(true);
	}

	public function indexEmployeeExitInterview()
	{
		dd('123');
	}

}
