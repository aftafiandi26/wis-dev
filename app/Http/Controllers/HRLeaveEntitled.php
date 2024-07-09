<?php

namespace App\Http\Controllers;

use App\Initial_Leave;
use App\Leave;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Session;

class HRLeaveEntitled extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function index()
    {
        return view('leave_report.newDashboard.index');
    }

    public function dataObject()
    {
        $query = User::select([
            'id', 'nik', 'first_name', 'last_name', 'join_date', 'end_date', 'initial_annual',  'dept_category_id', 'emp_status'
        ])->where('active', 1)->whereNotIn('nik', ["", "123456789"])->orderBy('first_name', 'asc')->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', '{{ $first_name }} {{ $last_name }}')
            ->addColumn('entitled_day_off', function (User $user) {
                $return = Initial_Leave::where('user_id', $user->id)->pluck('initial')->sum();

                return $return;
            })
            ->addColumn('total_leave_and_exdo', '{{ $initial_annual + $entitled_day_off }}')
            ->addColumn('taken_leave', function (User $user) {
                $return = Leave::where('leave_category_id', 1)->where('user_id', $user->id)->where('ap_hrd', 1)->where('ap_hd', 1)->where('ap_gm', 1)->pluck('total_day')->sum();

                return $return;
            })
            ->addColumn('taken_exdo', function (User $user) {
                $return = Leave::where('leave_category_id', 2)->where('user_id', $user->id)->where('ap_hrd', 1)->where('ap_hd', 1)->where('ap_gm', 1)->pluck('total_day')->sum();

                return $return;
            })
            ->editColumn('dept_category_id', function (User $user) {
                return $user->getDepartment();
            })
            ->addColumn('day_off_expired', function (User $user) {
                $taken_exdo = Leave::where('leave_category_id', 2)->where('user_id', $user->id)->where('ap_hrd', 1)->where('ap_hd', 1)->where('ap_gm', 1)->pluck('total_day')->sum();

                $entitled_day_off = Initial_Leave::where('user_id', $user->id)->whereDate('expired', '<', date('Y-m-d'))->pluck('initial')->sum();

                $return = $entitled_day_off - $taken_exdo;

                return $return;
            })
            ->addColumn('day_off_available', '{{ $entitled_day_off - $taken_exdo }}')
            ->addColumn('total_taken', '{{ $taken_leave + $taken_exdo }}')
            ->addColumn('annual_leave', '{{ $initial_annual - $taken_leave }}')
            ->addColumn('total_value', '{{ $annual_leave + $day_off_available }}')
            ->make(true);
    }
}