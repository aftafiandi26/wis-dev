<?php

namespace App\Http\Controllers;

use App\FormOvertimes;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Yajra\Datatables\Facades\Datatables;

class ProductionAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    private function nameMonth()
    {
        $array = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];

        return $array;
    }

    public function index()
    {
        $nameMonths = $this->nameMonth();

        return view("production.administration.vpnBeyondDuration.index", compact(['nameMonths']));
    }

    public function dataTablesUser()
    {
        $query = User::select([
            'id', 'first_name', 'last_name', 'dept_category_id', 'nik', 'position', 'emp_status'
        ])->where('active', 1)->where('dept_category_id', 6)->where('hd', 0)->where('hr', 0)->where('level_hrd', "0")->orderBy('first_name', 'asc')->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (User $user) {
                return $user->getFullName();
            })
            ->addColumn('department', function (User $user) {
                return $user->getDepartment();
            })
            ->addColumn('duration', function (User $user) {
                $form = FormOvertimes::where('user_id', $user->id)->whereYear('startovertime', date('Y'))->whereMonth('startovertime', date('m'))->where('verify_it', true)->get();

                $hours = $form->pluck('hours')->sum();

                $minute = $form->pluck('seconds')->sum();

                $minute = $minute / 60;

                $hours = $hours + $minute;

                return round($hours);
                // return $minute;
            })
            ->addColumn('actions', function (User $user) {
                $element = '<a href="' . route('admin-production/vpn-duration/show', [$user->id, intval(date('m')), intval(date('Y'))]) . '" target="_blank" class="btn btn-xs btn-default">Detail</a>';

                return $element;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function show($id, $month, $year)
    {
        $user = User::find($id);
        $month = intval($month);
        $year = intval($year);
        $nameMonths = $this->nameMonth();

        return view('production.administration.vpnBeyondDuration.show', compact(['nameMonths', 'user', 'month', 'year']));
    }

    public function dataTablesShow($id, $month, $year)
    {
        $query = FormOvertimes::where('user_id', $id)->whereYear('startovertime', $year)->whereMonth('startovertime', $month)->where('app_coor', true)->orderBy('startovertime', 'asc')->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('nik', function (FormOvertimes $Over) use ($id) {
                $user = User::find($id);

                return $user->nik;
            })
            ->addColumn('fullname', function (FormOvertimes $Over) use ($id) {
                $user = User::find($id);
                return $user->getFullName();
            })
            ->addColumn('position', function (FormOvertimes $Over) use ($id) {
                $user = User::find($id);
                return $user->position;
            })
            ->addColumn('duration', function (FormOvertimes $Over) {
                $hours = $Over->hours;
                $minute = $Over->seconds / 60;

                $result = $hours + $minute;
                return round($result);
            })
            ->make(true);
    }

    public function filterFormMonth(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        return redirect()->route('admin-production/vpn-duration/filterMonth', compact('month', 'year'));
    }

    public function filterMonth($month, $year)
    {
        $nameMonths = $this->nameMonth();

        return view('production.administration.vpnBeyondDuration.filterMonth', compact(['nameMonths', 'month', 'year']));
    }

    public function dataTablesFilterMonth($month, $year)
    {
        $query = User::select([
            'id', 'first_name', 'last_name', 'dept_category_id', 'nik', 'position', 'emp_status'
        ])->where('active', 1)->where('dept_category_id', 6)->where('hd', 0)->where('hr', 0)->where('level_hrd', "0")->orderBy('first_name', 'asc')->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (User $user) {
                return $user->getFullName();
            })
            ->addColumn('department', function (User $user) {
                return $user->getDepartment();
            })
            ->addColumn('duration', function (User $user) use ($month, $year) {
                $form = FormOvertimes::where('user_id', $user->id)->whereYear('startovertime', $year)->whereMonth('startovertime', $month)->where('verify_it', true)->get();

                $hours = $form->pluck('hours')->sum();

                $minute = $form->pluck('seconds')->sum();

                $minute = $minute / 60;

                $hours = $hours + $minute;

                return round($hours);
            })
            ->addColumn('actions', function (User $user) use ($month, $year) {
                $element = '<a href="' . route('admin-production/vpn-duration/show', [$user->id, $month, $year]) . '" target="_blank" class="btn btn-xs btn-default">Detail</a>';

                return $element;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}