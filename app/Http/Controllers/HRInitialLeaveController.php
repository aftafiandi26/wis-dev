<?php

namespace App\Http\Controllers;

use App\Leave;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class HRInitialLeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function dataTempCreateInitialLeave($id)
    {
        $query = Leave::select(['id', 'user_id', 'leave_category_id', 'leave_date', 'end_leave_date', 'total_day'])->where('user_id', $id)->where('period', date('Y'))->orderBy('leave_date', 'desc')->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('category', function (Leave $leave) {
                $return = $leave->getLeaveCategory();
                return $return;
            })
            ->addColumn('actions', 'leave.tempInitialLeave.actionTable')
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function modalViewTempCreateInitialLeave($id)
    {
        $leave = Leave::find($id);

        if ($leave->ap_hrd === 1) {
            $status = "Approved";
        } else {
            $status = "on progress";
        }

        return view('leave.tempInitialLeave.modalTables', compact(['leave', 'status']));
    }
}