<?php

namespace App\Http\Controllers;

use App\Absences;
use App\Dept_Category;
use App\NewUser;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class HeadProductionAttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function summaryIndexAttendance()
    {
        return view('production.summary_attendance.index');
    }

    public function dataObjectSummaryIndexAttendance()
    {
        $data = Absences::JoinUsers()->select(['absences.*', 'users.nik', 'users.first_name', 'users.last_name', 'users.position', 'users.dept_category_id'])->whereBetween('date_check_in', [date('Y-m-d', strtotime('-1 week')), date('Y-m-d', strtotime('now'))])->orderBy('date_check_in', 'desc')->get();
        // dd($data);
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('dept_category_id', function (Absences $absences) {
                $dept = Dept_Category::find($absences->dept_category_id);
                return $dept->dept_category_name;
            })
            ->addColumn('fullName', '{{ $first_name }} {{ $last_name }}')
            ->addColumn('time', function (Absences $absences) {
                if ($absences->check_out === 1) {
                    $awal  = strtotime($absences->timeIN); //waktu awal
                    $akhir = strtotime($absences->timeOUT); //waktu akhir

                    $diff  = $akhir - $awal;

                    $jam   = floor($diff / (60 * 60));
                    $menit = $diff - $jam * (60 * 60);

                    $waktu = $jam . ' jam, ' . floor($menit / 60) . ' menit';

                    return $waktu;
                }
                return "--";
            })
            ->addColumn('action', function (Absences $absences) {
                $a = '<a class="btn btn-xs btn-info" title="Detail" data-toggle="modal" data-target="#showModal" data-role="' . route('headOfProduction/index/modal', $absences->id) . '">view</a>';

                return $a;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function modalObjectSummaryindexAttendance($id)
    {
        $absences = Absences::find($id);
        $user = NewUser::find($absences->id_user);
        $dept = Dept_Category::find($user->dept_category_id);

        $waktu = "'still working'";

        if ($absences->check_out === 1) {
            $awal  = strtotime($absences->timeIN); //waktu awal
            $akhir = strtotime($absences->timeOUT); //waktu akhir

            $diff  = $akhir - $awal;

            $jam   = floor($diff / (60 * 60));
            $menit = $diff - $jam * (60 * 60);

            $waktu = $jam . ' jam, ' . floor($menit / 60) . ' menit';
        }

        return view('production.summary_attendance.modal', compact(['absences', 'user', 'dept', 'waktu']));
    }

    public function findNameAttendanceDepartment(Request $request)
    {
        $findName = $request->input('findName');
        $dept = $request->input('dept');
        $date1 = $request->input('date1');
        $date2 = $request->input('date2');


        $absences = Absences::JoinUsers()->select(['absences.*', 'users.nik', 'users.first_name', 'users.last_name', 'users.position', 'users.dept_category_id'])
            ->where(function ($query) use ($findName) {
                $query->where('users.first_name', 'like', '%' . $findName . '%')
                    ->orWhere('users.last_name', 'like', '%' . $findName . '%');
            })
            ->where('users.dept_category_id', $dept)
            ->orderBy('absences.date_check_in', 'dasc')
            ->whereBetween('date_check_in', [$date1, $date2])->paginate(10);

        return view('production.summary_attendance.searchIndex', compact(['absences', 'dept', 'date1', 'date2']));
    }

    public function attendanceOnline()
    {
        $dept = Dept_Category::all();

        return view('production.summary_attendance.attendanceWFH', compact(['dept']));
    }
}