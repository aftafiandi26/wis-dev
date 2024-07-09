<?php

namespace App\Http\Controllers;

use App\Absences;
use App\Dept_Category;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class HRAttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function indexTodayAttendance()
    {
        return view('HRDLevelAcces.attendance.today.index');
    }

    public function dataTodayAttendance()
    {
        $modal = Absences::JoinUsers()->select(['absences.*', 'users.first_name', 'users.last_name', 'users.dept_category_id', 'users.position'])->orderBy('date_check_in', 'dasc')->where('date_check_in', date('Y-m-d'))->get();

        return Datatables::of($modal)
            ->addIndexColumn()
            ->editColumn('dept_category_id', function (Absences $absences) {
                $dept = Dept_Category::find($absences->dept_category_id);
                return $dept->dept_category_name;
            })
            ->make(true);
    }
}
