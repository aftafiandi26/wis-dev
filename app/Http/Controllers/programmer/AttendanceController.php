<?php

namespace App\Http\Controllers\programmer;

use App;
use App\Dept_Category;
use App\Http\Controllers\Controller;
use App\Initial_Leave;
use App\Leave;
use App\Meeting;
use App\Leave_backup;
use App\Leave_Category;
use App\NewUser;
use App\Project_Category;
use App\User;
use App\Forfeited;
use App\ForfeitedCounts;
use App\Absences;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
        $modal = Absences::JoinUsers()->select(['absences.*', 'users.nik', 'users.first_name', 'users.last_name', 'users.dept_category_id', 'users.position', 'users.active'])->where('absences.date_check_in', date('Y-m-d'))->where('users.active', 1)->orderBy('timeIN', 'asc')->get();

        return Datatables::of($modal)
            ->addIndexColumn()
            ->addColumn('fullName', '{{ $first_name }} {{ $last_name }}')
            ->editColumn('dept_category_id', function (Absences $absences) {
                $dept = Dept_Category::find($absences->dept_category_id);
                return $dept->dept_category_name;
            })
            ->addColumn('actions', function (Absences $absences) {
                $edit = '<a href=' . route('dev/attendance/reset/edit', $absences->id) . ' class="btn btn-xs btn-warning" title="Edit Attendance"><i class="fa fa-pencil"></i></a>';

                $remove = '<a href="#" class="btn btn-xs btn-danger" title="Delete Attendance"><i class="fa fa-trash"></i></a>';

                return $edit . ' ' . $remove;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function editResetIndex($id)
    {
        $absences = Absences::JoinUsers()->select(['absences.*', 'users.nik', 'users.first_name', 'users.last_name', 'users.dept_category_id', 'users.position', 'users.active'])->where('absences.date_check_in', date('Y-m-d'))->where('users.active', 1)->where('absences.id', $id)->first();

        $dept = Dept_Category::where('id', $absences->dept_category_id)->value('dept_category_name');

        return view('IT.Progress.Attendace.Reset.edit', compact(['absences', 'dept']));
    }

    public function updateResetIndex(Request $request, $id)
    {
        $absences = Absences::JoinUsers()->select(['absences.*', 'users.nik', 'users.first_name', 'users.last_name', 'users.dept_category_id', 'users.position', 'users.active'])->where('absences.date_check_in', date('Y-m-d'))->where('users.active', 1)->where('absences.id', $id)->first();

        $rules = [
            'timeIN'    => 'required',
            'dateIn'    => 'required|date',
            'checkOut'  => 'numeric|min:0',
            'hours'     => 'numeric|min:0'
        ];

        $timeIN = strtotime($request->input('timeIN'));
        $timeOUT = strtotime($request->input('timeOUT'));

        $hours = $timeOUT - $timeIN;

        if ($request->input('timeOUT') === null) {
            $hours = $request->input('hours');
        }

        $data = [
            'timeIN'        => $request->input('timeIN'),
            'timeOUT'       => $request->input('timeOUT'),
            'check_out'     => $request->input('checkOut'),
            'date_check_in'  => $request->input('dateIn'),
            'date_check_out' => $request->input('dateOut'),
            'hours'          => $hours
        ];

        // dd($data);   

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect::route('dev/attendance/reset/edit', $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            Absences::where('id', $id)->update($data);
            Session::flash('success', Lang::get('messages.attendanceSuccess', ['name' => $absences->first_name . ' ' . $absences->last_name]));
            return redirect::route('dev/attendance/reset');
        }
    }
}