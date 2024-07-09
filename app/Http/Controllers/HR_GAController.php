<?php

namespace App\Http\Controllers;

use App;
use App\Dept_Category;
use App\Entitled_leave_view;
use App\Events\LeaveVerificatedByHr;
use App\Http\Controllers\Controller;
use App\NewUser;
use App\Project_Category;
use App\User;
use App\PolingKantin;
use App\Absences;
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

use Yajra\Datatables\Facades\Datatables;
use Carbon\Carbon;


class HR_GAController extends Controller
{
    public function __construct()
	{
		$this->middleware(['auth', 'active', 'GA']);
		
	}

	public function dateSeacrhingCanteen()
	{
		return view('HRDLevelAcces.General_Afair.canteen_comitee.dateSearch');
	}

	public function indexVotingCanteen(Request $request)
	{
		$this->validate($request, [
		        'started' => 'required|date',
		        'ended' => 'required|date',
		    	]);

		$started = $request->input('started');
		$ended = $request->input('ended');


		$data =  PolingKantin::whereDate('voting_canteen.created_at', '>=', $started)->whereDate('voting_canteen.created_at', '<=', $ended)->get();

		$prefer1 = $data->where('prefer', 1)->count();
		$prefer2 = $data->where('prefer', 2)->count();
		$vegetarian = $data->where('vegetarian', 1)->count();
		$snyc1 = $prefer1 / $data->count() * 100;
		$snyc2 = $prefer2 / $data->count() * 100;
		$sync3 = $vegetarian / $data->count() * 100;	

		$page = 1;
	
		return view('HRDLevelAcces.General_Afair.canteen_comitee.index', [
			'data' 		=> $data,
			'started'	=> $started,
			'ended'		=> $ended,
			'page'		=> $page,
			'snyc1'		=> $snyc1,
			'snyc2'		=> $snyc2,
			'sync3'		=> $sync3
		]);
	}

	public function getVotingCanteen()
	{	

		$pp = PolingKantin::latest()->first();

		// $started = $request->input('started');
		// $ended = $request->input('ended');

		 // dd($id);

		// PolingKantin::whereDate('created_at', '>=', '2020-09-10')->whereDate('created_at', '<=', '2020-10-17')->get();

		$select = PolingKantin::JoinUsers()->leftJoin('dept_category', 'users.dept_category_id', '=', 'dept_category.id')->select([
			'voting_canteen.id', 'users.nik', 'voting_canteen.name_employee', 'dept_category.dept_category_name', 'voting_canteen.total_point', 'voting_canteen.averange', 'voting_canteen.date_entry', 'voting_canteen.comment'
		])
		// ->where('voting_canteen.date_entry', '=', $pp->date_entry)	
		->where('voting_canteen.created_at', '>=', '2020-09-15')
		->where('voting_canteen.created_at', '<=', '2020-09-23')	
		->get();
	  
		return Datatables::of($select)
			// ->addIndexColumn()
			->edit_column('id', '{{$id}}') 
			->edit_column('date_entry', '{!! date("M, d Y", strtotime($date_entry)) !!} WIB')
		    ->add_column('actions',  Lang::get('messages.btn_voting1', ['title' => 'Detail', 'url' => '{{ URL::route(\'detailVoteAssessmentReport\', [$id]) }}']))
			->make();
	}

	public function detailVoteAssessmentReport($id)
	{
		$select = PolingKantin::find($id);
		
			$return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'>$select->name_employee comment</h4>
            </div>
            <div class='modal-body'>
                $select->comment
            </div>
            <div class='modal-footer'>              
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        	";
		return $return;
	}

	public function DesiredFood()
	{
		return view("HRDLevelAcces.General_Afair.canteen_comitee.desiredfood");
	}

	public function getVotingCanteenDesiredFood()
	{	
		$pp = PolingKantin::latest()->first();

		$select = PolingKantin::JoinUsers()->leftJoin('dept_category', 'users.dept_category_id', '=', 'dept_category.id')->select([
			'voting_canteen.id', 'users.nik', 'voting_canteen.name_employee', 'dept_category.dept_category_name', 
			'voting_canteen.main_dishes_1', 
			'voting_canteen.vegetables_1', 
			'voting_canteen.slide_of_dishes_1',
			'voting_canteen.date_entry'
		])
		->where('voting_canteen.date_entry', '=', $pp->date_entry)		
		->get();
	  
		return Datatables::of($select)
			->edit_column('id', '{{$id}}') 
			->edit_column('date_entry', '{!! date("M, d Y", strtotime($date_entry)) !!} WIB')		    
			->make();
	}

	public function UndesiredFood()
	{
		return view("HRDLevelAcces.General_Afair.canteen_comitee.undesiredfood");
	}

	public function getVotingCanteenUndesiredFood()
	{	
		$pp = PolingKantin::latest()->first();

		$select = PolingKantin::JoinUsers()->leftJoin('dept_category', 'users.dept_category_id', '=', 'dept_category.id')->select([
			'voting_canteen.id', 'users.nik', 'voting_canteen.name_employee', 'dept_category.dept_category_name', 
			'voting_canteen.main_dishes_3',
			'voting_canteen.vegetables_3',
			'voting_canteen.slide_of_dishes_3',
			'voting_canteen.date_entry'
		])
		->where('voting_canteen.date_entry', '=', $pp->date_entry)		
		->get();
	  
		return Datatables::of($select)
			->edit_column('id', '{{$id}}') 
			->edit_column('date_entry', '{!! date("M, d Y", strtotime($date_entry)) !!} WIB')		    
			->make();
	}

	public function getCommentData(Request $request)
	{
		$pp = PolingKantin::latest()->first();

		$data = PolingKantin::select(['name_employee', 'comment', 'date_entry'])->where('date_entry', '=', $pp->date_entry)->orderBy('name_employee', 'asc')->get();
		
		Excel::create('Comment - Canteen', function($excel) use ($data) {

		    $excel->sheet('Comment', function($sheet) use ($data) {
		       $sheet->setAllBorders('thin');
		      $sheet->setAutoSize(array(
			    'C'
			));
		       $sheet->setOrientation('landscape');
		       $sheet->loadView('HRDLevelAcces.General_Afair.canteen_comitee.getcomment', ['data' => $data]);
		    });

		})->export('xls');
		return back();
	}

	public function excelData($started, $ended)
	{
		$data =  PolingKantin::whereDate('voting_canteen.created_at', '>=', $started)->whereDate('voting_canteen.created_at', '<=', $ended)->get();
		$page = 1;
		Excel::create('Data - Canteen', function($excel) use ($data, $page, $started, $ended) {

		    $excel->sheet('Data', function($sheet) use ($data, $page, $started, $ended) {		      
		       $sheet->setOrientation('landscape');
		       $sheet->mergeCells('A1:J1');
		       $sheet->mergeCells('A2:J2');
		       $sheet->loadView('HRDLevelAcces.General_Afair.canteen_comitee.dataExcel', [
		       	'data' 		=> $data, 
		       	'page' 		=> $page,
		       	'started'	=> $started,
		       	'ended'		=> $ended 
		       ]);
		    });

		})->export('xls');
		return back();
	}

	// Attendance
	public function indexAttendace()
    {
      $users = User::orderBy('first_name', 'asc')->where('nik', '!=', null)->where('nik', '!=', 123456789)->where('active', 1)->get();
      $dept = Dept_Category::orderBy('dept_category_name', 'asc')->get();

    	return view('HRDLevelAcces.General_Afair.attendance.index', [
        'users' => $users ,
        'dept'  => $dept
      ]);
    }

    public function indexListAttendance()
    {      
      return view('HRDLevelAcces.General_Afair.attendance.List.index');
    }

    public function dataAttendace()
    {
    	$model = Absences::JoinUsers()
                ->orderBy('date_check_in', 'desc')
                ->orderBy('timeIN', 'desc')
                ->whereYear('date_check_in', date('Y'))
                ->whereMonth('date_check_in', date('m'))
                ->get();

      return Datatables::of($model)               
                ->addIndexColumn()
                ->addColumn('fullname', function(Absences $absences) {
                  return $absences->first_name.' '.$absences->last_name;
                })
                ->addColumn('time', function(Absences $absences){

                  $awal  = strtotime($absences->timeIN); //waktu awal
                  $akhir = strtotime($absences->timeOUT); //waktu akhir

                  $diff  = $akhir - $awal;

                  $jam   = floor($diff / (60 * 60));
                  $menit = $diff - $jam * (60 * 60);
                  $detik = $diff - $menit * (60 * 60 * 60);

                  $waktu = $jam .' jam, ' . floor( $menit / 60 ) . ' menit';

                  if ($absences->check_out === 1) {
                    return $waktu;
                  }
                  return "--";

                })               
                ->addColumn('primary', function(Absences $absences){
                  $get = Absences::where('date_check_in', $absences->date_check_in)
                          ->where('timeIn', $absences->timeIN)
                          ->value('id');
                  return $get;
                })
                ->addColumn('dateAttendance', function(Absences $absences){
                  if($absences->check_out === 1)
                  {
                    return $absences->date_check_out;
                  }
                  return $absences->date_check_in;
                })
                ->addColumn('action', 
                    Lang::get('messages.btn_warning', ['title' => 'Edit', 'url' => '{{ URL::route(\'GaAttendance\', [$primary]) }}', 'class' => 'pencil']).
                    Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'detailIndexGaAttendance\', [$primary]) }}', 'class' => 'file'])
                  )
                ->editColumn('timeOUT', function(Absences $absences) {
                  if ($absences->timeOUT === null) {
                    return "--";
                  }
                  return $absences->timeOUT;                    
                })                
                ->editColumn('dept_category_id', function(Absences $absences) {
                  $department = Dept_Category::find($absences->dept_category_id);

                  return $department->dept_category_name;
                })
                ->make(true);
    }

    public function deleteAttendance($id)
    {
      Absences::where('id', $id)->delete();
  
      Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data attendance']));
      return Redirect::route('indexHrGaAttendace');
    }

    public function indexChart()
    {     
      return view('HRDLevelAcces.General_Afair.attendance.grafk');
    }

    public function editAttendance($id)
    {     
      $absences = Absences::JoinUsers()->find($id);
      $department = Dept_Category::find($absences->dept_category_id);

      return view('HRDLevelAcces.General_Afair.attendance.edit', [
        'absences' => $absences, 
        'department' => $department,
        'id'  => $id
      ]);
    }

    public function updateAttendace(Request $request, $id)
    {
      $absences = Absences::find($id);

      $awal  = strtotime($absences->timeIN); //waktu awal
      $akhir = strtotime($request->input('check_out')); //waktu akhir

      $diff  = $akhir - $awal;
      $data = [
        'check_out'       => 1,
        'timeOUT'         => $request->input('check_out'),
        'date_check_out'  => $request->input('date'),
        'hours'           => $diff,  
        'remarks'         => $request->input('remark'),     
        'updated_at'      => Carbon::now()
      ];

       Absences::where('id', $id)->update($data);           
       Session::flash('success', Lang::get('messages.data_updated', ['data' => 'Attendance '.$request->input('name')]));
            return redirect()->route('indexHrGaAttendace');
    }

    public function getListtAttendance(Request $request)
    {
      $idUser = $request->input('name');
      $startDate = $request->input('start_date');
      $endDate = $request->input('end_date');

      $no = 1;

      $dataUser = User::find($idUser);

      $dataAttendaces = Absences::where('id_user', $idUser)->whereBetween('date_check_in', [$startDate, $endDate])->get(); 

      $dataDept = Dept_Category::find($dataUser->dept_category_id);

      // dd($dataAttendaces);

      return view('HRDLevelAcces.General_Afair.attendance.Search.indexEmployeeAttendance', 
        [ 
          'no'              => $no,
          'dataUser'        => $dataUser,
          'dataAttendaces'  => $dataAttendaces,
          'dataDept'        => $dataDept,
          'startDate'       => $startDate,
          'endDate'         => $endDate
        ]);
    }  

    public function editGetListDataAttendance($id)
    {
      $absences = Absences::JoinUsers()->find($id);
      $department = Dept_Category::find($absences->dept_category_id);
      // dd($id);
      return view('HRDLevelAcces.General_Afair.attendance.Search.edit', [
        'absences' => $absences, 
        'department' => $department,
        'id'  => $id
      ]);
    }

    public function updateGetListDataAttendance(Request $request, $id)
    { 
      $absences = Absences::find($id);

      $awal  = strtotime($absences->timeIN); //waktu awal
      $akhir = strtotime($request->input('check_out')); //waktu akhir

      $diff  = $akhir - $awal;    
      $data = [
        'check_out'       => 1,
        'timeOUT'         => $request->input('check_out'),
        'date_check_out'  => $request->input('date'),
        'hours'           => $diff,
        'remarks'         => $request->input('remark'), 
        'updated_at'      => Carbon::now()
      ];

       Absences::where('id', $id)->update($data);           
       Session::flash('success', Lang::get('messages.data_updated', ['data' => 'Attendance '.$request->input('name')]));
            return redirect()->back();
    }

    public function downloadExcelListAttendance($startDate, $endDate, $id)
    {
      $dataUser = User::find($id);

      $dataAttendaces = Absences::where('id_user', $id)->whereBetween('date_check_in', [$startDate, $endDate])->get(); 

      $dataHours = db::table('absences')->where('id_user', $id)->whereBetween('date_check_in', [$startDate, $endDate])->pluck('hours');

      $dataHour = $dataHours->sum();

      $dataDept = Dept_Category::find($dataUser->dept_category_id);

      $no = 1; 

      Excel::create('Attendance Report', function($excel) use ($dataAttendaces, $dataUser, $dataDept, $no, $dataHours) {
          $excel->sheet('Attendance Report', function($sheet) use ($dataAttendaces, $dataUser, $dataDept, $no, $dataHours) {

            $sheet->setAutoSize(true);
              $sheet->loadView('HRDLevelAcces.General_Afair.attendance.Search.dataExcel', 
                [
                  'no'              => $no,
                  'dataUser'        => $dataUser,
                  'dataAttendaces'  => $dataAttendaces,
                  'dataDept'        => $dataDept,
                  'dataHours'       => $dataHours
                ]);         
         });
      })->export('xls');

      return redirect()->back();
    }

    public function getDataAttendanceDepartment(Request $request)
    {
      $data = [
        'dept'        => $request->input('dept'),
        'start_date'  => $request->input('start_date')
      ];

      $dept       = $request->input('dept');
      $start_date = $request->input('start_date');

      $no = 1;

      $department = Dept_Category::find($dept);
    
      $dataAttendaces = Absences::JoinUsers()->where('dept_category_id', $dept)->where('date_check_in', $start_date)->orderBy('first_name','asc')->get();
      
      return view('HRDLevelAcces.General_Afair.attendance.Search.byDepart.index', [
        'no'              => $no,
        'dataAttendaces'  => $dataAttendaces,
        'department'      => $department,
        'start_date'      => $start_date
      ]);
    }

    public function downloadExcelListAllAttendance($start_date, $department)
    { 
      $no = 1; 

      $dataAttendaces = Absences::JoinUsers()->where('dept_category_id', $department)->where('date_check_in', $start_date)->get();
      $dataDept = Dept_Category::find($department);

      Excel::create('Attendance Report'.$dataDept->dept_category_name, function($excel) use ($dataAttendaces, $dataDept, $no) {
          $excel->sheet('Attendance Report', function($sheet) use ($dataAttendaces, $dataDept, $no) {

            $sheet->setAutoSize(true);
              $sheet->loadView('HRDLevelAcces.General_Afair.attendance.Search.byDepart.dataExcel', 
                [
                  'no'              => $no,
                  'dataAttendaces'  => $dataAttendaces,
                  'dataDept'        => $dataDept
                ]);         
         });
      })->export('xls');

      return redirect()->back();
    }

    public function detailIndexAttendance($id)
    {
      $attendance = Absences::JoinUsers()->find($id);
      
      $return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'>Remark</h4>
            </div>
            <div class='modal-body'>
                <div>
                  <h4><b>$attendance->first_name $attendance->last_name</b></h4>
                </div>
                <div class='well'>
                   <p>$attendance->remarks</p>
                </div>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

}
