<?php

namespace App\Http\Controllers\FingerPrint;

use App\AttLog;
use App\Dept_Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FingerPrint\Att_logs;
use App\User;
use Yajra\Datatables\Facades\Datatables;

class FingerPrintSpotController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function getObjectFingerPrint()
    {
        $data = Att_logs::with(['employes'])->whereMonth('scan_date', date('m'))->orderBy('scan_date', 'dasc')->limit(250)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('time', function (Att_logs $att_logs) {
                $time = date('H:i:s', strtotime($att_logs->scan_date));

                return $time;
            })
            ->addColumn('entry', function (Att_logs $att_logs) {
                $entry = null;

                if ($att_logs->verify_mode == "1") {
                    $entry = "In";
                }

                if ($att_logs->verify_mode == "2") {
                    $entry = "Out";
                }

                return $entry;
            })
            ->addColumn('fullName', function (Att_logs $att_logs) {
                $fullname = $att_logs->employes->first_name . " " . $att_logs->employes->last_name;

                return $fullname;
            })
            ->addColumn('date', function (Att_logs $att_logs) {
                $date = date('Y-m-d', strtotime($att_logs->scan_date));

                return $date;
            })
            ->addColumn('department', function (Att_logs $att_logs) {
                $user = User::where(function ($query) use ($att_logs) {
                    $query->where('first_name', $att_logs->employes->first_name)
                        ->orWhere('last_name', $att_logs->employes->last_name);
                })->first();

                $dept = Dept_Category::find($user['dept_category_id']);

                return $dept['dept_category_name'];
            })
            ->addColumn('position', function (Att_logs $att_logs) {
                $user = User::where(function ($query) use ($att_logs) {
                    $query->where('first_name', $att_logs->employes->first_name)
                        ->orWhere('last_name', $att_logs->employes->last_name);
                })->first();

                return $user['position'];
            })
            ->addColumn('phone', function (Att_logs $att_logs) {
                $user = User::where(function ($query) use ($att_logs) {
                    $query->where('first_name', $att_logs->employes->first_name)
                        ->orWhere('last_name', $att_logs->employes->last_name);
                })->first();

                $phone = null;

                if ($user['dept_category_id'] === 6) {
                    $phone = $user['phone'];
                }

                return $phone;
            })
            ->addColumn('actions', function (Att_logs $att_logs) {
                $a = '<a class="btn btn-xs btn-info" title="Detail" data-toggle="modal" data-target="#showModal" data-role="' . route('attendance/finger/modal', $att_logs->att_id) . '">view</a>';

                return $a;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function attendanceOnsite()
    {
        return view('production.summary_attendance.attendanceOnsite');
    }

    public function modalObjectFingerPrint($id)
    {
        $att_logs = Att_logs::with('employes')->where('att_id', $id)->first();

        $user = User::where(function ($query) use ($att_logs) {
            $query->where('first_name', $att_logs->employes->first_name)
                ->orWhere('last_name', $att_logs->employes->last_name);
        })->first();

        $dept = Dept_Category::find($user['dept_category_id']);

        return view('production.summary_attendance.modalFingerPrint', compact(['att_logs', 'user', 'dept']));
    }

    public function searchIndexFingerPrint(Request $request)
    {
        $name = $request->input('findName');

        $fingerPrint = Att_logs::Join('emp', 'att_log.pin', '=', 'emp.pin')->whereDate('scan_date', '>=', $request->input('date1'))->whereDate('scan_date', '<=', $request->input('date2'))
            ->orderBy('scan_date', 'dasc')->where(function ($query) use ($name) {
                $query->where('first_name', 'like', '%' . $name . '%')->orWhere('last_name', 'like', '%' . $name . '%');
            })->paginate(10);

        return view('production.summary_attendance.searchIndexFingerPrint', compact(['fingerPrint']));
    }
}