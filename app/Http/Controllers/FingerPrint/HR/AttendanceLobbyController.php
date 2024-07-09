<?php

namespace App\Http\Controllers\FingerPrint\HR;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\FingerPrint\Att_logs;
use App\Model\FingerPrint\Employes;
use App\Model\FingerPrint\Func_Department;
use Yajra\Datatables\Datatables;

class AttendanceLobbyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function index()
    {
        return view('local_load.attendance.index');
    }

    public function dataIindex()
    {
        $emp = Employes::all();

        return Datatables::of($emp)
            ->addIndexColumn()
            ->editColumn('func_id_auto', function (Employes $emp) {
                $return = Func_Department::where('func_id_auto', $emp->func_id_auto)->value('func_name');
                return $return;
            })
            ->make(true);
    }
}