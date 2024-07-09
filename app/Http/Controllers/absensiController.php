<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Absences;
use App\User;
use App\NewUser;
use App\Dept_Category;

use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;

class absensiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function index()
    {
        $now = Carbon::now()->toFormattedDateString();

        $oldData = Absences::where('id_user', '=', auth::user()->id)->where('date_check_in', '=', date('Y-m-d'))->latest()->first();
        $lastData = Absences::where('id_user', '=', auth::user()->id)->where('date_check_in', '=', date('Y-m-d'))->latest()->value('check_out');

        // dd($lastData);

        if ($oldData === null) {
            $lastData = 1;
        }
        // dd($lastData);ssssssssssss
        return view('all_employee.Absensi.index', [
            'now'       => $now,
            'oldData'   => $oldData,
            'lastData'  => $lastData
        ]);
    }

    public function dataAbsensi()
    {
        $model = Absences::JoinUsers()
            ->where('id_user', auth::user()->id)
            ->where('deleted', 0)
            ->orderBy('date_check_in', 'desc')
            ->get();

        return Datatables::of($model)
            ->addIndexColumn()
            ->addColumn('fullname', function (Absences $absences) {
                return $absences->first_name . ' ' . $absences->last_name;
            })
            ->addColumn('time', function (Absences $absences) {

                $awal  = strtotime($absences->timeIN); //waktu awal
                $akhir = strtotime($absences->timeOUT); //waktu akhir

                $diff  = $akhir - $awal;

                $jam   = floor($diff / (60 * 60));
                $menit = $diff - $jam * (60 * 60);

                $waktu = $jam . ' jam, ' . floor($menit / 60) . ' menit';

                if ($absences->check_out === 1) {
                    return $waktu;
                }
                return "--";
            })
            ->addColumn('primary', function (Absences $absences) {
                $data = Absences::where('date_check_in', $absences->date_check_in)
                    ->where('timeIn', $absences->timeIN)
                    ->value('id');
                return $data;
            })
            ->editColumn('date_check_out', function (Absences $absences) {
                if ($absences->date_check_out === null) {
                    return '---';
                }
                return $absences->date_check_out;
            })
            ->editColumn('dept_category_id', function (Absences $absences) {
                $dept = Dept_Category::find($absences->dept_category_id);

                return $dept->dept_category_name;
            })
            ->addColumn('date', function (Absences $absences) {
                if ($absences->check_out === 1) {
                    return $absences->date_check_out;
                }
                return $absences->date_check_in;
            })
            ->addColumn(
                'action',
                Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'detailAttendance\', [$primary]) }}', 'class' => 'file'])
            )
            ->make(true);
    }

    public function postCheckIn(Request $request)
    {
        if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
            $secret = '6LeYEUUaAAAAAH5DZ-Q6LbggTECgH_FG4IdN8FJS';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if ($responseData->success) {
                $data = [
                    'id_user'       => auth::user()->id,
                    'check_in'      => 1,
                    'date_check_in' => Carbon::now(),
                    'timeIN'        => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                ];

                Absences::insert($data);
                Session::flash('success', Lang::get('messages.data_attendance', ['name' => auth::user()->first_name . ' ' . auth::user()->last_name]));
                return redirect()->route('indexAbsensi');
            } else {
                $errMsg = 'Robot verification failed, please try again.';
            }
        } else {
            Session::flash('getError', Lang::get('messages.attendanceError'));
            return redirect()->route('indexAbsensi');
        }
    }

    public function postCheckOut(Request $request)
    {
        $oldData = Absences::where('id_user', '=', auth::user()->id)->latest()->first();

        $awal  = strtotime($oldData->timeIN); //waktu awal
        $akhir = strtotime(Carbon::now()); //waktu akhir

        $diff  = $akhir - $awal;

        if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
            $secret = '6LeYEUUaAAAAAH5DZ-Q6LbggTECgH_FG4IdN8FJS';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if ($responseData->success) {
                $data = [
                    'check_out'  => 1,
                    'date_check_out' => Carbon::now(),
                    'timeOUT'        => Carbon::now(),
                    'hours'         => $diff,
                    'updated_at'    => Carbon::now(),
                ];

                Absences::where('id', '=', $oldData->id)->update($data);
                Session::flash('success', Lang::get('messages.data_attendance_out', ['name' => auth::user()->first_name . ' ' . auth::user()->last_name]));
                return redirect()->route('indexAbsensi');
            } else {
                $errMsg = 'Robot verification failed, please try again.';
            }
        } else {
            Session::flash('getError', Lang::get('messages.attendanceError'));
            return redirect()->route('indexAbsensi');
        }
    }

    public function postedCheckIn(Request $request)
    {
        $oldData = Absences::where('id_user', '=', auth::user()->id)->latest()->first();

        if ($oldData === null) {
            $data = [
                'id_user'       => auth::user()->id,
                'check_in'      => 1,
                'date_check_in' => Carbon::now(),
                'timeIN'        => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ];

            Absences::insert($data);
            Session::flash('success', Lang::get('messages.data_attendance', ['name' => auth::user()->first_name . ' ' . auth::user()->last_name]));
            return redirect()->route('indexAbsensi');
        } else {
            if ($oldData->date_check_in != date('Y-m-d')) {
                $data = [
                    'id_user'       => auth::user()->id,
                    'check_in'      => 1,
                    'date_check_in' => Carbon::now(),
                    'timeIN'        => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                ];

                Absences::insert($data);
                Session::flash('success', Lang::get('messages.data_attendance', ['name' => auth::user()->first_name . ' ' . auth::user()->last_name]));
                return redirect()->route('indexAbsensi');
            } else {
                Session::flash('getError', Lang::get('messages.attendanceError'));
                return redirect()->route('indexAbsensi');
            }
        }
    }

    public function postedCheckOut(Request $request)
    {
        $oldData = Absences::where('id_user', '=', auth::user()->id)->where('date_check_in', date('Y-m-d'))->first();

        $awal  = strtotime($oldData->timeIN); //waktu awal
        $akhir = strtotime(Carbon::now()); //waktu akhir

        $diff  = $akhir - $awal;
        // dd($oldData);
        if ($oldData->date_check_in === date('Y-m-d')) {
            $data = [
                'check_out'  => 1,
                'date_check_out' => Carbon::now(),
                'timeOUT'        => Carbon::now(),
                'hours'         => $diff,
                'updated_at'    => Carbon::now(),
            ];

            Absences::where('id', '=', $oldData->id)->update($data);
            Session::flash('success', Lang::get('messages.data_attendance_out', ['name' => auth::user()->first_name . ' ' . auth::user()->last_name]));
            return redirect()->route('indexAbsensi');
        } else {
            Session::flash('getError', Lang::get('messages.attendanceError'));
            return redirect()->route('indexAbsensi');
        }
    }

    public function detailAttendance($id)
    {
        $attendance = Absences::JoinUsers()->find($id);

        $absences = Absences::find($id);

        $created_by = NewUser::find($absences->created_by);

        $remarkers  = null;

        if ($absences->created_by != null) {
            $remarkers = "created by " . $created_by->first_name . " " . $created_by->last_name;
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
}