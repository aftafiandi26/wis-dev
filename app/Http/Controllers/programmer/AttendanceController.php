<?php

namespace App\Http\Controllers\programmer;

use App;
use App\Dept_Category;
use App\Http\Controllers\Controller;
use App\Absences;
use App\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;
use DateTime;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function resetIndex()
    {
        return view('IT.Progress.Attendace.Reset.index');
    }

    public function dataResetIndex()
    {
        $data = Attendance::with('relationsUser')->whereDATE('start', date('Y-m-d'))->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('fullName', function (Attendance $attendance) {
                return $attendance->relationsUser->getFullName();
            })
            ->editColumn('dept_category_id', function (Attendance $attendance) {
                $dept = Dept_Category::find($attendance->relationsUser->dept_category_id);
                return $dept->dept_category_name;
            })
            ->addColumn('nik', function (Attendance $attendance) {
                return $attendance->relationsUser->nik;
            })
            ->addColumn('position', function (Attendance $attendance) {
                return $attendance->relationsUser->position;
            })
            ->addColumn('durations', function (Attendance $att) {
                $minutes = $att->durations; // Misalnya, jumlah menit yang ingin Anda konversi

                // Hitung jumlah jam, sisa menit, dan jumlah hari
                $days = floor($minutes / (60 * 24)); // Hitung jumlah hari
                $hours = floor(($minutes % (60 * 24)) / 60); // Mengonversi sisa menit ke jam
                $remainingMinutes = $minutes % 60; // Menemukan sisa menit setelah konversi
                $second = 00;

                // Format waktu ke dalam string
                $timeString = sprintf("%02d:%02d:%02d:%02d", $days, $hours, $remainingMinutes, $second); // Format jam, menit, dan hari menjadi string HH:MM:SS               


                return $timeString;
            })

            ->addColumn('actions', 'IT.Progress.Attendace.Reset.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function editResetIndex($id)
    {
        $att = Attendance::with('relationsUser')->find($id);

        return view('IT.Progress.Attendace.Reset.modalEdit', compact(['att']));
    }

    public function updateResetIndex(Request $request, $id)
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
        return redirect()->route('dev/attendance/reset');
    }

    public function reseted($id)
    {
        $att = Attendance::find($id);

        $data = [
            'end'       => null,
            'out'       => false,
            'durations' => 0,
        ];

        $att->update($data);
        Attendance::find($id)->update($data);
        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'The recorded data has been reseted']));
        return redirect()->route('dev/attendance/reset');
    }
}