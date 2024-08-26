<?php

namespace App\Http\Controllers;

use App\FormOvertimes;
use App\User;
use Illuminate\Http\Request;
use DateTime;
use Yajra\Datatables\Facades\Datatables;

class ITDataOvertimeMonth extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'it']);
    }

    public function index()
    {
        return view('IT.Registration_Form.Overtimes.history.index');
    }
    public function dataIndex()
    {
        $query = FormOvertimes::whereMonth('startovertime', date('m', strtotime('-1 month')))->where('verify_it', true)->orderBy('startovertime', 'asc')->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->getFullName();
            })
            ->addColumn('position', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->position;
            })
            ->addColumn('department', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->getDepartment($return->dept_category_id);
            })
            ->addColumn('nik', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->nik;
            })
            ->addColumn('duration', function (FormOvertimes $form) {
                $start = new DateTime($form->startovertime);
                $end = new DateTime($form->endovertime);

                $hitung = date_diff($end, $start);
                $day = $hitung->d * 24;
                $count = $hitung->h + $day;
                return $count;
            })
            ->make(true);
    }

    public function indexUser()
    {
        return view('IT.Registration_Form.Overtimes.history.user');
    }

    public function dataUser()
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
                $form = FormOvertimes::where('user_id', $user->id)->whereYear('startovertime', date('Y'))->whereMonth('startovertime', date('m', strtotime("-1 month")))->where('verify_it', true)->get();

                $hours = $form->pluck('hours')->sum();

                $minute = $form->pluck('seconds')->sum();

                $minute = $minute / 60;

                $hours = $hours + $minute;

                return round($hours);
                // return $minute;
            })
            ->addColumn('actions', 'IT.Registration_Form.Overtimes.history.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function checkDetail($id)
    {
        return view('IT.Registration_Form.Overtimes.history.check', compact(['id']));
    }

    public function chectData($id)
    {
        $form = FormOvertimes::where('user_id', $id)->whereYear('startovertime', date('Y'))->whereMonth('startovertime', date('m'))->where('verify_it', true)->get();

        return Datatables::of($form)
            ->addIndexColumn()
            ->addColumn('nik', function (FormOvertimes $form) {
                $user = User::find($form->user_id);

                return $user->nik;
            })
            ->addColumn('fullname', function (FormOvertimes $form) {
                $user = User::find($form->user_id);

                return $user->getFullName();
            })
            ->addColumn('deprtment', function (FormOvertimes $form) {
                $user = User::find($form->user_id);

                return $user->position;
            })
            ->addColumn('duration', function (FormOvertimes $form) {

                $hours = $form->hours;

                $minute = $form->seconds;

                $minute = $minute / 60;

                $hours = $hours + $minute;

                return round($hours);
                // return $minute;
            })
            ->make(true);
    }
}