<?php

namespace App\Http\Controllers;

use App\FormOvertimes;
use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class GeneralManager_SummaryRemoteAccessVPN_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'gm']);
    }

    public function headline()
    {
        return "Remote Access - Summary";
    }

    public function index()
    {
        $headline = $this->headline();

        $date = date('Y-m-d');

        return view('GenaralManager.Remote-Access.Summary.index', compact(['headline', 'date']));
    }

    private function duration($id, $date)
    {
        $duration = FormOvertimes::select(['hours', 'seconds'])->where('user_id', $id)->where('app_coor', 1)->where('app_gm', 1)->whereYear('startovertime', date('Y', strtotime($date)))->whereMonth('startovertime', date('m', strtotime($date)))->get();

        $hours = $duration->pluck('hours')->sum();
        $minute = $duration->pluck('seconds')->sum();

        $tempMinute = $minute;
        $tempHours = $hours;

        if ($minute >= 60) {
            $countMinute = floor($minute / 60);

            $ka = 60 * $countMinute;

            $tempMinute = $minute - $ka;

            $tempHours = $hours + $countMinute;
        }

        $array = [
            'hours' => $tempHours,
            'minute' => $tempMinute
        ];

        return $array;
    }

    public function dataIndex($date)
    {
        $users = User::select(['id', 'first_name', 'last_name', 'dept_category_id', 'position'])->where('active', 1)->whereNotIn('nik', ["", 123456789])->where('dept_category_id', 6)->where('hd', 0)->orderBy('first_name', 'asc')->get();

        return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('fullname', function (User $user) {
                return $user->getFullName();
            })
            ->addColumn('department', function (User $user) {
                return $user->getDepartment();
            })
            ->addColumn('duration', function (User $user) use ($date) {
                $duration = $this->duration($user->id, $date);

                return $duration['hours'];
            })
            ->make(true);
    }

    public function indexMonthly($month)
    {
        $headline = $this->headline();

        $date = $month;

        return view('GenaralManager.Remote-Access.Summary.index', compact(['headline', 'date']));
    }
}