<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Dept_Category;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class HR_Attendance_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function index()
    {
        $users = User::where('active', 1)->where('dept_category_id', 6)->orderBy('first_name', 'asc')->get();

        return view('HRDLevelAcces.attendances.index', compact(['users']));
    }

    public function  datatables()
    {
        $waktu = Carbon::today();

        if (!isset($_COOKIE['date-time-start'])) {
            $start = $waktu->copy()->subDay(7);
        } else {
            $start = $_COOKIE['date-time-start'];
        }

        if (!isset($_COOKIE['date-time-end'])) {
            $end = $waktu->copy();
        } else {
            $end = $_COOKIE['date-time-end'];
        }

        $query = Attendance::whereDATE('start', '>=', $start)->whereDATE('start', '<=', $end)->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('nik', function (Attendance $att) {
                return $att->user()->nik;
            })
            ->addColumn('employes', function (Attendance $att) {
                return User::find($att->user_id)->getFullName();
            })
            ->addColumn('department', function (Attendance $att) {
                return User::find($att->user_id)->getDepartment();
            })
            ->addColumn('dateStart', function (Attendance $att) {
                $return = null;
                if ($att->start) {
                    $return = date('Y-m-d', strtotime($att->start));
                }
                return $return;
            })
            ->addColumn('timeStart', function (Attendance $att) {
                $return = Null;
                if ($att->start) {
                    $return = date('H:i:s', strtotime($att->start));
                }
                return $return;
            })
            ->addColumn('timeEnded', function (Attendance $att) {
                $return = null;
                if ($att->end) {
                    $return = date('H:i:s', strtotime($att->end));
                }
                return $return;
            })
            ->addColumn('actions', 'HRDLevelAcces.attendances.actions')
            ->rawColumns(['actions'])
            ->editColumn('durations', function (Attendance $att) {
                $minutes = $att->durations; // Misalnya, jumlah menit yang ingin Anda konversi

                // Hitung jumlah jam, sisa menit, dan jumlah hari
                $days = floor($minutes / (60 * 24)); // Hitung jumlah hari
                $hours = floor(($minutes % (60 * 24)) / 60); // Mengonversi sisa menit ke jam
                $remainingMinutes = $minutes % 60; // Menemukan sisa menit setelah konversi
                $second = 00;

                // Format waktu ke dalam string
                $timeString = sprintf("%02d:%02d", $hours, $remainingMinutes); // Format jam, menit, dan hari menjadi string HH:MM:SS   

                return $timeString;
            })
            ->make(true);
    }

    public function edit($id)
    {
        $data = Attendance::with(['relationsUser'])->find($id);

        return view('HRDLevelAcces.attendances.modalEdit', compact(['data']));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'start'     => 'required',
            'end'       => 'required',
            'status'    => 'required',
        ];

        $startTime = new DateTime($request->input('start'));
        $endTime = new DateTime($request->input('end'));

        $interval = $startTime->diff($endTime);

        $convertDay = $interval->format('%d');
        $convertHours = $interval->format('%h');
        $convertMinutes = $interval->format('%i');

        $convertDay = $convertDay * 24;
        $convertHours = $convertDay + $convertHours;
        $convertHours = $convertHours * 60;
        $convertMinutes = $convertHours + $convertMinutes;

        $data = [
            'in'         => true,
            'out'        => true,
            'start'      => $request->input('start'),
            'end'        => $request->input('end'),
            'status_in'  => $request->input('status'),
            'status_out' => $request->input('status'),
            'remarks'    => $request->input('remarks'),
            'durations'  => $convertMinutes
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('hr/summary/attendance/index')
                ->withErrors($validator)
                ->withInput();
        }
        Attendance::find($id)->update($data);
        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'The recorded data has been updated']));
        return redirect()->route('hr/summary/attendance/index');
    }

    public function delete($id)
    {
        $data = Attendance::with(['relationsUser'])->find($id);

        return view('HRDLevelAcces.attendances.modalDelete', compact(['data']));
    }

    public function removed(Request $request, $id)
    {
        Attendance::find($id)->delete();
        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'The recorded data has been removed']));
        return redirect()->route('hr/summary/attendance/index');
    }

    public function insert(Request $request)
    {
        $rules = [
            'employes'      => 'required',
            'start'         => 'required',
            'end'           => 'required',
            'status'        => 'required',
        ];

        $startTime = new DateTime($request->input('start'));
        $endTime = new DateTime($request->input('end'));

        $interval = $startTime->diff($endTime);

        $convertDay = $interval->format('%d');
        $convertHours = $interval->format('%h');
        $convertMinutes = $interval->format('%i');

        $convertDay = $convertDay * 24;
        $convertHours = $convertDay + $convertHours;
        $convertHours = $convertHours * 60;
        $convertMinutes = $convertHours + $convertMinutes;

        $data = [
            'user_id'    => $request->input('employes'),
            'in'         => true,
            'out'        => true,
            'start'      => $request->input('start'),
            'end'        => $request->input('end'),
            'status_in'  => $request->input('status'),
            'status_out' => $request->input('status'),
            'remarks'    => $request->input('remarks'),
            'durations'  => $convertMinutes
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('hr/summary/attendance/index')
                ->withErrors($validator)
                ->withInput();
        }

        Attendance::create($data);
        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'The recorded data has been inserted']));
        return redirect()->route('hr/summary/attendance/index');
    }

    public function convertEmp(Request $request)
    {
        $selectEmp = $request->input('emp');
        $empDateStarted = $request->input('empStarted');
        $empDateEnded = $request->input('empEnded');

        return redirect()->route('hr/summary/attendance/summary/employes', compact(['selectEmp', 'empDateStarted', 'empDateEnded']));
    }

    public function summaryEmp($selectEmp, $empDateStarted, $empDateEnded)
    {

        $users = User::where('active', 1)->where('dept_category_id', 6)->orderBy('first_name', 'asc')->get();
        $emp = User::find($selectEmp);
        $dataArray = [$selectEmp, $empDateStarted, $empDateEnded];

        return view('HRDLevelAcces.attendances.summary.index', compact(['users', 'emp', 'dataArray']));
    }

    public function dataSummaryEmp($selectEmp, $empDateStarted, $empDateEnded)
    {

        $query = Attendance::where('user_id', $selectEmp)->whereDATE('start', '>=', $empDateStarted)->whereDATE('start', '<=', $empDateEnded)->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('nik', function (Attendance $attendance) {
                return $attendance->user()->nik;
            })
            ->addColumn('fullname', function (Attendance $attendance) {
                return $attendance->user()->getFullName();
            })
            ->addColumn('dept', function (Attendance $attendance) {
                return $attendance->user()->getDepartment();
            })
            ->addColumn('dated', function (Attendance $attendance) {
                return date('Y-m-d', strtotime($attendance->start));
            })
            ->addColumn('checkIn', function (Attendance $attendance) {
                return date('H:i:s', strtotime($attendance->start));
            })
            ->addColumn('checkOut', function (Attendance $attendance) {
                if ($attendance->end) {
                    return date('H:i:s', strtotime($attendance->end));
                }
                return null;
            })
            ->addColumn('time', function (Attendance $attendance) {
                $minutes = $attendance->durations; // Misalnya, jumlah menit yang ingin Anda konversi

                // Hitung jumlah jam, sisa menit, dan jumlah hari
                $days = floor($minutes / (60 * 24)); // Hitung jumlah hari
                $hours = floor(($minutes % (60 * 24)) / 60); // Mengonversi sisa menit ke jam
                $remainingMinutes = $minutes % 60; // Menemukan sisa menit setelah konversi
                $second = 00;

                // Format waktu ke dalam string
                $timeString = sprintf("%02d:%02d", $hours, $remainingMinutes); // Format jam, menit, dan hari menjadi string HH:MM:SS   

                return $timeString;
            })
            ->addColumn('actions', function (Attendance $attendance) use ($selectEmp, $empDateStarted, $empDateEnded) {
                $id = $attendance->id;

                return view('HRDLevelAcces.attendances.summary.actions', compact(['id', 'selectEmp', 'empDateStarted', 'empDateEnded']));
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function SummaryEmpEdit($id, $selectEmp, $empDateStarted, $empDateEnded)
    {
        $data = Attendance::with(['relationsUser'])->find($id);
        $dataArray = [$selectEmp, $empDateStarted, $empDateEnded];

        return view('HRDLevelAcces.attendances.summary.modalEdit', compact(['data', 'dataArray']));
    }

    public function SummaryEmpUpdate(Request $request, $id)
    {
        $attendance = Attendance::find($id);

        $rules = [
            'start' => 'required',
            'end' => 'required',
        ];

        $startTime = new DateTime($request->input('start'));
        $endTime = new DateTime($request->input('end'));

        $interval = $startTime->diff($endTime);

        $convertDay = $interval->format('%d');
        $convertHours = $interval->format('%h');
        $convertMinutes = $interval->format('%i');

        $convertDay = $convertDay * 24;
        $convertHours = $convertDay + $convertHours;
        $convertHours = $convertHours * 60;
        $convertMinutes = $convertHours + $convertMinutes;

        $data = [
            'start' => $request->input('start'),
            'end'   => $request->input('end'),
            'status_in' => $request->input('status'),
            'status_out' => $request->input('status'),
            'remarks'   => $request->input('remarks'),
            'durations' => $convertMinutes
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $attendance->update($data);

        Session::flash('success', Lang::get('messages.data_custom', ['data' => $attendance->user()->getFullName() . " attendance updated."]));
        return redirect()->route('hr/summary/attendance/summary/employes', [$request->input('selectEmp'), $request->input('empDateStarted'), $request->input('empDateEnded')]);
    }

    public function DeleteEmp($id, $selectEmp, $empDateStarted, $empDateEnded)
    {
        $data = Attendance::find($id);
        $dataArray = [$selectEmp, $empDateStarted, $empDateEnded];

        return view('HRDLevelAcces.attendances.summary.modalDelete', compact(['data', 'dataArray']));
    }

    public function removeEmp(Request $request, $id)
    {
        $attendance = Attendance::find($id);

        $notif = date('Y-m-d', strtotime($attendance->start)) . " has been removed";
        $attendance->delete();
        Session::flash('message', Lang::get('messages.data_custom', ['data' => $notif]));
        return redirect()->route('hr/summary/attendance/summary/employes', [$request->input('selectEmp'), $request->input('empDateStarted'), $request->input('empDateEnded')]);
    }

    public function reset($id)
    {

        $attendance = Attendance::find($id);

        $data = [
            'out'       => false,
            'end'       => null,
            'durations' => 0,
        ];

        $attendance->update($data);

        Session::flash('message', Lang::get('messages.data_custom', ['data' => $attendance->user()->getFullName() . ' attendance has been reset.']));
        return redirect()->route('hr/summary/attendance/index');
    }
}