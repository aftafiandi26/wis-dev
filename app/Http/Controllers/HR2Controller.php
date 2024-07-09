<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Validator;

use App\Absences;
use App\User;
use App\NewUser;
use App\Leave;
use App\Dept_Category;
use App\Leave_Category;

use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class HR2Controller extends Controller
{
     public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function indexAttendace()
    {
      $users = User::orderBy('first_name', 'asc')->where('nik', '!=', null)->where('nik', '!=', 123456789)->where('active', 1)->get();
      $dept = Dept_Category::orderBy('dept_category_name', 'asc')->get();

    	return view('HRDLevelAcces.attendance.index', [
        'users' => $users ,
        'dept'  => $dept
      ]);
    }

    public function indexListAttendance()
    { 

      return view('HRDLevelAcces.attendance.List.index');
    }

    public function dataAttendace()
    {
      $model = Absences::orderBy('date_check_in', 'desc')
                ->orderBy('timeIN', 'desc')
                ->whereYear('date_check_in', date('Y'))
                // ->whereMonth('date_check_in', '>=', date('m', strtotime('-1 month')))
                ->whereMonth('date_check_in', date('m'))
                ->get();

      return Datatables::of($model)               
                ->addIndexColumn()
                ->addColumn('fullname', function(Absences $absences) {
                  $user = User::find($absences->id_user);

                  return $user['first_name'].' '.$user['last_name'];
                })
                ->addColumn('nik', function(Absences $absences){
                  $user = User::find($absences->id_user);

                  return $user['nik'];
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
              
                ->addColumn('dateAttendance', function(Absences $absences){
                  if($absences->check_out === 1)
                  {
                    return $absences->date_check_out;
                  }
                  return $absences->date_check_in;
                })
                ->addColumn('action', 
                    Lang::get('messages.btn_warning', ['title' => 'Edit', 'url' => '{{ URL::route(\'editAttendance\', [$id]) }}', 'class' => 'pencil']).
                   /* Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'detailIndexAttendance\', [$primary]) }}', 'class' => 'file']).*/
                    '@if($deleted === 0)'.
                     Lang::get('messages.btn_danger', ['title' => '{{ $id }}', 'url' => '{{ URL::route(\'deleteAttendance\', [$id]) }}', 'class' => 'trash']).
                     '@endif'
                  )
                ->editColumn('timeOUT', function(Absences $absences) {
                  if ($absences->timeOUT === null) {
                    return "--";
                  }
                  return $absences->timeOUT;                    
                })                
                ->editColumn('dept_category_id', function(Absences $absences) {
                  $user = User::find($absences->id_user);

                  $department = Dept_Category::find($user['dept_category_id']);

                  return $department['dept_category_name'];
                })
                ->make(true);
    }  

    public function deleteAttendance($id)
    {
      Absences::where('id', $id)->delete();
      Session::flash('message', Lang::get('messages.data_deleted', ['data' => 'Data attendance']));
      return Redirect::route('indexHrAttendace');
    }

    public function indexChart()
    {     
      return view('HRDLevelAcces.attendance.grafk');
    }

    public function editAttendance($id)
    {     
      $absences = Absences::JoinUsers()->find($id);
      $department = Dept_Category::find($absences->dept_category_id);

      return view('HRDLevelAcces.attendance.edit', [
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
        'timeIN'          => $request->input('check_in'),
        'timeOUT'         => $request->input('check_out'),
        'date_check_out'  => $request->input('date'),
        'hours'           => $diff,  
        'remarks'         => $request->input('remark'),     
        'updated_at'      => Carbon::now()
      ];
      // dd($data);
       Absences::where('id', $id)->update($data);           
       Session::flash('success', Lang::get('messages.data_updated', ['data' => 'Attendance '.$request->input('name')]));
            return redirect()->route('indexHrAttendace');
    }

    public function getListtAttendance(Request $request)
    {
      $idUser = $request->input('name');
      $startDate = $request->input('start_date');
      $endDate = $request->input('end_date');

      $no = 1;

      $dataUser = User::find($idUser);

      $dataAttendaces = Absences::where('id_user', $idUser)->where('deleted', 0)->whereBetween('date_check_in', [$startDate, $endDate])->get(); 

      $dataDept = Dept_Category::find($dataUser->dept_category_id);

      // dd($dataAttendaces);

      return view('HRDLevelAcces.attendance.Search.indexEmployeeAttendance', 
        [ 
          'no'              => $no,
          'dataUser'        => $dataUser,
          'dataAttendaces'  => $dataAttendaces,
          'dataDept'        => $dataDept,
          'startDate'       => $startDate,
          'endDate'         => $endDate
        ]);
    }  
    
    public function modalDeletegetListtAttendance($id)
    {
        $data = Absences::find($id);

        $awal  = strtotime($data->timeIN); //waktu awal
        $akhir = strtotime($data->timeOUT); //waktu akhir

        $diff  = $akhir - $awal;

        $jam   = floor($diff / (60 * 60));
        $menit = $diff - $jam * (60 * 60);
        $detik = $diff - $menit * (60 * 60 * 60);

        $waktu = $jam . ' jam, ' . floor($menit / 60) . ' menit';

        if ($data->check_out === 1) {
            $waktu = $waktu;
        } else {
            $waktu = "--";
        }

        return view('HRDLevelAcces.attendance.Search.modalDelete', compact(['data', 'waktu']));
    }

    public function updateDeleteAbove(Request $request, $id)
    {
        Absences::find($id)->delete();
        Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Attendance have deleted']));
        return redirect()->back();
    }

    public function editGetListDataAttendance($id)
    {
      $absences = Absences::JoinUsers()->find($id);
      $department = Dept_Category::find($absences->dept_category_id);
      // dd($id);
      return view('HRDLevelAcces.attendance.Search.edit', [
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
        'timeIN'          => $request->input('check_in'),
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

      $dataAttendaces = Absences::where('id_user', $id)->where('deleted', 0)->whereBetween('date_check_in', [$startDate, $endDate])->get(); 

      $dataHours = db::table('absences')->where('id_user', $id)->whereBetween('date_check_in', [$startDate, $endDate])->pluck('hours');

      $dataHour = $dataHours->sum();

      $dataDept = Dept_Category::find($dataUser->dept_category_id);

      $no = 1; 

      Excel::create('Attendance Report', function($excel) use ($dataAttendaces, $dataUser, $dataDept, $no, $dataHours) {
          $excel->sheet('Attendance Report', function($sheet) use ($dataAttendaces, $dataUser, $dataDept, $no, $dataHours) {

            $sheet->setAutoSize(true);
              $sheet->loadView('HRDLevelAcces.attendance.Search.dataExcel', 
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
         
      return view('HRDLevelAcces.attendance.Search.byDepart.index', [
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
              $sheet->loadView('HRDLevelAcces.attendance.Search.byDepart.dataExcel', 
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

      $absences = Absences::find($id);

      $created_by = NewUser::find($absences->created_by);

      $remarkers  = null;

      if ($absences->created_by != null) {
        $remarkers = "created by ".$created_by->first_name." ".$created_by->last_name;
      }
      
      $return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'>Remarks $remarkers</h4>
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

    public function createAttendanceHR()
    {
      $users = User::where('active', 1)->where('nik', '!=', null)->where('nik', '!=', '123456789')->orderBy('first_name', 'asc')->get();
      // dd($users);
      return view('HRDLevelAcces.attendance.create', [
        'users' => $users
      ]);
    }

    public function postCreatedAttendanceHR(Request $request)
    {
      $data = [
        'id_user'     => $request->input('name'),
        'check_in'    => 1,
        'timeIN'        => $request->input('check_in'),
        'date_check_in' => $request->input('date'),
        'remarks'       => $request->input('remarks'),
        'created_by'     => auth::user()->id,
        'created_at'     => Carbon::now(),
        'updated_at'     => Carbon::now(),
      ];

      $validator = validator::make($request->all(), [
          'name'      => 'required',
          'check_in'  => 'required',
          'date'      => 'required',
          'remarks'   => 'required|max:100'
      ]);

      if ($validator->fails()) {
          return redirect::route('createAttendanceHR')
                        ->withErrors($validator)
                        ->withInput();
      } else {
        Absences::insert($data);
        Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data Attendance']));
        return redirect()->route('indexHrAttendace');
      }
      
    }

    public function indexSummaryVerified()
    {      
      return view('HRDLevelAcces.frontedesk.leave.indexSummaryVerified');
    }

    public function getDataSummaryVerified()
    {
      
     $select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([
        'leave_transaction.id',
        'leave_transaction.ver_hr',
        'leave_transaction.ap_hrd',
        'leave_transaction.request_nik',
        'users.position',
        'leave_transaction.request_by',
        'leave_transaction.leave_date',
        'leave_transaction.end_leave_date',
        'leave_transaction.back_work',
        'leave_category.leave_category_name',
        'dept_category.dept_category_name',
        'leave_transaction.total_day',
        'leave_transaction.req_advance'
      ])
      ->where('leave_transaction.ver_hr', '!=', 0)
      ->where('users.active', 1)
      ->whereNotNull('email_pm')
      ->orderBy('leave_transaction.id', 'desc')
      ->get();

      return Datatables::of($select)
      ->addIndexColumn()
      ->edit_column('ver_hr', function(Leave $leave){
        if ($leave->ver_hr === 1) {
            $ver_hr = "VERIFIED";
        } elseif ($leave->ver_hr === 2) {
            $ver_hr = "DISAPPROVED";
        } else {
            $ver_hr = "--";
        }
        
        return $ver_hr;
      })
      ->edit_column('ap_hrd', function(Leave $leave){
        if ($leave->ap_hrd === 1) {
            $ap_hrd = "CONFIRMED";
        } elseif ($leave->ap_hrd === 0) {
            
           if ($leave->ver_hr === 1) {
                  $ap_hrd = "VERIFIED";
            } elseif ($leave->ver_hr === 2) {
                  $ap_hrd = "DISAPPROVED";
            } else {
                  $ap_hrd = "HR CHECKING";
            }
            
        } else {
          $ap_hrd = "UNCONFIRMED";
        }

        return $ap_hrd;
        
      })
      ->make(true);

    }

    public function getDataHistorical(Request $request)
    {
      $started = $request->input('started');
      $ended   = $request->input('ended');

      $no = 1;
    
      $leave = Leave::joinUsers()->joinLeaveCategory()
                ->where('leave_transaction.leave_date', '>=', $started)->where('leave_date', '<=', $ended)
                ->whereNotNull('leave_transaction.email_pm')
                ->orderBy('leave_transaction.leave_date', 'asc')
                ->get();

      return view('HRDLevelAcces.frontedesk.leave.indexHistoricalSummary', compact(['leave', 'no', 'started', 'ended']));

    }

    public function getDataExcelHistorical($started, $ended)
    {
       $leave = Leave::joinUsers()->joinLeaveCategory()
                ->where('leave_transaction.leave_date', '>=', $started)->where('leave_date', '<=', $ended)
                ->orderBy('leave_transaction.leave_date', 'asc')
                ->get();
      $no = 1;     

      Excel::create('Stationery', function($excel) use($no, $leave, $started, $ended) {

          $excel->sheet('New sheet', function($sheet) use($no, $leave, $started, $ended) {
              $sheet->setOrientation('landscape');
              $sheet->setAutoSize(true);
              $sheet->loadView('HRDLevelAcces.frontedesk.excel.ExcelSummaryLeave', ['leave' => $leave, 'no' => $no, 'started' => $started, 'ended' => $ended]);
          });
      })->export('xls');

      return back();
    }

    public function indexEmployeeExitForm()
    {
      dd('123');
    }

   
   
}
