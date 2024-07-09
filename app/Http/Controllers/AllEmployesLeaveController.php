<?php

namespace App\Http\Controllers;

use App\Dept_Category;
use Datatables;
use App\Leave;
use App\Leave_Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AllEmployesLeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function indexSummary()
    {
        $department = Dept_Category::all();

        return view('leave.summary.indexAllEmployes', compact(['department']));
    }

    public function objectSummary()
    {
        $data = Leave::whereYear('leave_date', date('Y'))->where('ap_hrd', 1)->orderBy('leave_date', 'dasc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('ap_hrd', '@if($ap_hrd === 1){{ "Accepted" }} @elseif($ap_hrd === 0){{ "Progressing" }} @else {{ "Rejected" }} @endif')
            ->editColumn('leave_category_id', function (Leave $leave) {
                return $leave->getLeaveCategory();
            })
            ->editCOlumn('reason_leave', function (leave $leave) {
                $return = Str::lower($leave->reason_leave);
                return $return;
            })
            ->editColumn('leave_date', function (Leave $leave) {
                return date('d F', strtotime($leave->leave_date));
            })
            ->editColumn('end_leave_date', function (Leave $leave) {
                return date('d F', strtotime($leave->end_leave_date));
            })
            ->editColumn('back_work', function (Leave $leave) {
                return date('d F', strtotime($leave->back_work));
            })
            ->addColumn('actions', 'leave.summary.indexActions')
            ->make(true);
    }

    public function modalSummary($id)
    {
        $leave = Leave::find($id);
        $hd = User::where('dept_category_id', $leave->user()->dept_category_id)->where('hd', 1)->first();

        return view('leave.summary.modalAllEmployes', compact(['leave', 'hd']));
    }

    public function getRequest(Request $request)
    {
        $start = $request->input('startDate');
        $end   = $request->input('endDate');
        $dept  = $request->input('select');

        return redirect()->route('leave/summary/employes/find', [$start, $end, $dept]);
    }

    public function findLeave($start, $end, $dept)
    {
        $department = Dept_Category::all();

        return view('leave.summary.find.index', compact(['start', 'end', 'dept', 'department']));
    }

    public function findData($start, $end, $dept)
    {
        if ($dept != "all") {
            $query = Leave::whereBetween('leave_date', [$start, $end])->where('request_dept_category_name', $dept)->where('ap_hrd', 1)->orderBy('leave_date', 'asc')->get();
        } else {
            $query = Leave::whereBetween('leave_date', [$start, $end])->where('ap_hrd', 1)->orderBy('leave_date', 'asc')->get();
        }

        return Datatables::of($query)
            ->addIndexColumn()
            ->editColumn('ap_hrd', '@if($ap_hrd === 1){{ "Accepted" }} @elseif($ap_hrd === 0){{ "Progressing" }} @else {{ "Rejected" }} @endif')
            ->editColumn('leave_category_id', function (Leave $leave) {
                return $leave->getLeaveCategory();
            })
            ->editCOlumn('reason_leave', function (leave $leave) {
                $return = Str::lower($leave->reason_leave);
                return $return;
            })
            ->editColumn('leave_date', function (Leave $leave) {
                return date('d F', strtotime($leave->leave_date));
            })
            ->editColumn('end_leave_date', function (Leave $leave) {
                return date('d F', strtotime($leave->end_leave_date));
            })
            ->editColumn('back_work', function (Leave $leave) {
                return date('d F', strtotime($leave->back_work));
            })
            ->addColumn('actions', 'leave.summary.indexActions')
            ->make(true);
    }

    public function indexCalender()
    {
        return view('leave.calender.index');
    }

    public function objectCalender()
    {
        $query = Leave::where('ap_hrd', 1)->whereYear('leave_date', date('Y'))->orderBy('id', 'desc')->get();

        foreach ($query as $value) {

            $user = User::find($value['user_id']);
            $leaveName = Leave_Category::find($value['leave_category_id']);

            if ($value['leave_category_id'] === 1) {
                $color = 'lightblue';
            } elseif ($value['leave_category_id'] === 2) {
                $color = 'lightgreen';
            } else {
                $color = 'grey';
            }

            $textColor = 'black';

            if ($color === "grey") {
                $textColor = 'white';
            }

            $arrayQuqery[] = [
                'id' => $value['id'],
                'title' => $user->getFullName() . ' ' . "($leaveName->leave_category_name)",
                'start' => $value['leave_date'],
                'end' => $value['back_work'],
                'color' => $color,
                'textColor' => $textColor,
            ];
        }

        return $arrayQuqery;
    }
}