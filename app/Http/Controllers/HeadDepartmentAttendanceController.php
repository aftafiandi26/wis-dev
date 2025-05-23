<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\ProjectGroup;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class HeadDepartmentAttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function index()
    {
        $idDept = auth()->user()->dept_category_id;

        if (auth()->user()->id === 4) {
            $idDept = 1;
        }

        $users = User::where('dept_category_id', $idDept)->whereNotIn('nik', ["", "123456789"])->where('active', 1)->orderBy('first_name', 'asc')->get();

        return view('HeadOfDepartment.Attendance.summary', compact(['users']));
    }

    public function dataTables()
    {
        $idDept = [auth()->user()->dept_category_id];
        $time = date('Y-m-d', strtotime('-1 month'));
        if (auth()->user()->dept_category_id == 10) {
            $idDept = [auth()->user()->dept_category_id, 1];
        }

        if (auth()->user()->hd === 1 and auth()->user()->dept_category_id === 6) {
            $time = date('Y-m-d');
        }

        $users = User::where('active', 1)
            ->whereIn('dept_category_id', $idDept)
            ->whereNotIn('nik', ["", "123456789"])
            ->pluck('id')
            ->map(function ($id) {
                return (int) $id;
            })
            ->toArray();

        $query = Attendance::with('relationsQuest')->whereIn('user_id', $users)->whereDate('start', '>=', $time)->orderBy('start', 'desc');


        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (Attendance $att) {
                $return = User::find($att->user_id);
                return $return->getFullName();
            })
            ->addColumn('position', function (Attendance $att) {
                $return = User::find($att->user_id);
                return $return->position;
            })
            ->addColumn('feel', function (Attendance $att) {
                if ($att->relationsQuest->Q1) {
                    $attendance = new AllEmployes_AttendanceController;
                    $result = $attendance->feels($att->relationsQuest->Q1);
                    return $result;
                }
                return "";
            })
            ->addColumn('health', function (Attendance $att) {
                if ($att->relationsQuest->Q2) {
                    $attendance = new AllEmployes_AttendanceController;
                    $result = $attendance->feels($att->relationsQuest->Q2);
                    return $result;
                }
                return "";
            })
            ->addColumn('project', function (Attendance $att) {
                $data = ProjectGroup::find($att->relationsQuest->group);
                return $data->group_name;
            })
            ->editColumn('durations', function (Attendance $att) {
                $minutes = $att->durations; // Misalnya, jumlah menit yang ingin Anda konversi
                $timeString = null;
                if ($minutes) {
                    // Hitung jumlah jam, sisa menit, dan jumlah hari
                    $days = floor($minutes / (60 * 24)); // Hitung jumlah hari
                    $hours = floor(($minutes % (60 * 24)) / 60); // Mengonversi sisa menit ke jam
                    $remainingMinutes = $minutes % 60; // Menemukan sisa menit setelah konversi
                    $second = 00;

                    // Format waktu ke dalam string
                    $timeString = sprintf("%02d:%02d", $hours, $remainingMinutes);
                }

                return $timeString;
            })
            ->make(true);
    }

    public function form(Request $request)
    {
        $employes = $request->input('emp');
        $start    = $request->input('start');
        $end      = $request->input('end');

        return redirect()->route('hod/attendance/summary/find', compact(['employes', 'start', 'end']));
    }

    public function index1($id, $start, $end)
    {
        $idDept = auth()->user()->dept_category_id;

        if (auth()->user()->id === 4) {
            $idDept = 1;
        }

        $users = User::where('dept_category_id', $idDept)->whereNotIn('nik', ["", "123456789"])->where('active', 1)->orderBy('first_name', 'asc')->get();
        return view('HeadOfDepartment.Attendance.summary2', compact(['users', 'id', 'start', 'end']));
    }

    public function dataTables2($ids, $start, $end)
    {
        $query = Attendance::with('relationsQuest')->where('user_id', $ids)->whereDate('start', '>=', $start)->whereDate('start', '<=', $end)->orderBy('start', 'desc')->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (Attendance $att) {
                $return = User::find($att->user_id);
                return $return->getFullName();
            })
            ->addColumn('position', function (Attendance $att) {
                $return = User::find($att->user_id);
                return $return->position;
            })
            ->addColumn('feel', function (Attendance $att) {
                $attendance = new AllEmployes_AttendanceController;
                $result = $attendance->feels($att->relationsQuest->Q1);
                return $result;
            })
            ->addColumn('health', function (Attendance $att) {
                $attendance = new AllEmployes_AttendanceController;
                $result = $attendance->feels($att->relationsQuest->Q2);
                return $result;
            })
            ->addColumn('project', function (Attendance $att) {
                $data = ProjectGroup::find($att->relationsQuest->group);
                return $data->group_name;
            })
            ->editColumn('durations', function (Attendance $att) {
                $minutes = $att->durations; // Misalnya, jumlah menit yang ingin Anda konversi
                $timeString = null;
                if ($minutes) {
                    // Hitung jumlah jam, sisa menit, dan jumlah hari
                    $days = floor($minutes / (60 * 24)); // Hitung jumlah hari
                    $hours = floor(($minutes % (60 * 24)) / 60); // Mengonversi sisa menit ke jam
                    $remainingMinutes = $minutes % 60; // Menemukan sisa menit setelah konversi
                    $second = 00;

                    // Format waktu ke dalam string
                    $timeString = sprintf("%02d:%02d", $hours, $remainingMinutes);
                }

                return $timeString;
            })
            ->make(true);
    }
}