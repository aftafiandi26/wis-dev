<?php

namespace App\Http\Controllers;

use App\SendingDataWorkingWeekend;
use App\User;
use App\WorkingOnWeekends;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;

class HR_Weekend_Crew_controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function indexSummary()
    {
        return view('HRDLevelAcces.weekend_crew.summary');
    }

    public function dataTabalesSummary()
    {
        $query = SendingDataWorkingWeekend::where('approved', false)->latest()->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (SendingDataWorkingWeekend $sent) {
                return $sent->coordinator()->getFullName();
            })
            ->addColumn('producer', function (SendingDataWorkingWeekend $sent) {
                return $sent->producer()->getFullName();
            })
            ->addColumn('project', function (SendingDataWorkingWeekend $sent) {
                return $sent->coordinator()->getProjectName($sent->coordinator()->project_category_id_1);
            })
            ->addColumn('crew', 'HRDLevelAcces.weekend_crew.button_crew')
            ->addColumn('actions', 'HRDLevelAcces.weekend_crew.actionsSummary')
            ->addColumn('date', function (SendingDataWorkingWeekend $sent) {
                $first = WorkingOnWeekends::where('status', $sent->status)->orderBy('start', 'asc')->first();
                if ($first) {
                    $first = date('Y-m-d', strtotime($first->start));
                }
                $last = WorkingOnWeekends::where('status', $sent->status)->orderBy('start', 'desc')->first();
                if ($last) {
                    # code...
                    $last = date('Y-m-d', strtotime($last->start));
                }

                return  $first;
            })
            ->editColumn('approved', function (SendingDataWorkingWeekend $sent) {
                $return  = "Err!!";

                if ($sent->ap_producer === 1 and $sent->approved === 1) {
                    $return = "Approved";
                }

                if ($sent->ap_producer === 1 and $sent->approved === 0) {
                    $return = "Pending (GM)";
                }

                if ($sent->ap_producer === 0 and $sent->approved === 0) {
                    $return = "Pending (Producer)";
                }

                if ($sent->ap_producer === 2 or $sent->approved === 2) {
                    $return = "Disapproved";
                }

                return $return;
            })
            ->rawColumns(['crew', 'actions'])
            ->make(true);
    }

    public function showDataSummary($id)
    {
        $send = SendingDataWorkingWeekend::find($id);

        $query = WorkingOnWeekends::where('status', $send->status)->where('extra', 'allowance')->whereIn('approved', [true, false])->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (WorkingOnWeekends $work) {
                return $work->user()->getFullName();
            })
            ->addColumn('position', function (WorkingOnWeekends $work) {
                return $work->user()->position;
            })
            ->editColumn('workStat', function (WorkingOnWeekends $work) {
                return strtoupper($work->workStat);
            })
            ->make(true);
    }

    public function showDataSummary2($id)
    {
        $send = SendingDataWorkingWeekend::find($id);

        $query = WorkingOnWeekends::where('status', $send->status)->where('extra', 'exdo')->whereIn('approved', [true, false])->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (WorkingOnWeekends $work) {
                return $work->user()->getFullName();
            })
            ->addColumn('position', function (WorkingOnWeekends $work) {
                return $work->user()->position;
            })
            ->editColumn('workStat', function (WorkingOnWeekends $work) {
                return strtoupper($work->workStat);
            })
            ->make(true);
    }

    public function delete($id)
    {
        $getId = SendingDataWorkingWeekend::find($id);

        $works = WorkingOnWeekends::where('status', $getId->status)->orderBy('start', 'asc')->get();

        return view('HRDLevelAcces.weekend_crew.modalDanger', compact(['getId', 'works']));
    }

    public function pushDelete($id)
    {
        $getId = SendingDataWorkingWeekend::find($id);

        $works = WorkingOnWeekends::where('status', $getId->status)->orderBy('start', 'asc')->delete();

        $getId->delete();

        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Data weekend crew has been deleted.']));
        return redirect()->route('hrd/weekend-crew/index');
    }

    public function historical()
    {
        $prods = User::where('active', true)->where('dept_category_id', 6)->where('koor', true)->orderBy('first_name', 'asc')->get();

        return view('HRDLevelAcces.weekend_crew.historical', compact(['prods', 'coors']));
    }

    public function dataHistorical()
    {
        $query = WorkingOnWeekends::where('approved', 1)->orderBy('start', 'desc')->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('nik', function (WorkingOnWeekends $work) {
                return $work->user()->nik;
            })
            ->addColumn('employes', function (WorkingOnWeekends $work) {
                return $work->user()->getFullName();
            })
            ->addColumn('coordinator', function (WorkingOnWeekends $work) {
                return $work->coordinator()->getFullName();
            })
            ->addColumn('producer', function (WorkingOnWeekends $work) {
                return $work->producer()->getFullName();
            })
            ->addColumn('position', function (WorkingOnWeekends $work) {
                return $work->user()->position;
            })
            ->addColumn('time', function (WorkingOnWeekends $work) {
                return sprintf("%02d:%02d", $work->hourly, $work->minutely);
            })
            ->editColumn('approved', function (WorkingOnWeekends $work) {
                $return  = "Err!!";

                if ($work->ap_producer === 1 and $work->approved === 1) {
                    $return = "Approved";
                }

                if ($work->ap_producer === 1 and $work->approved === 0) {
                    $return = "Pending (GM)";
                }

                if ($work->ap_producer === 0 and $work->approved === 0) {
                    $return = "Pending (Producer)";
                }

                if ($work->ap_producer === 2 or $work->approved === 2) {
                    $return = "Disapproved";
                }

                return $return;
            })
            ->editColumn('workStat', function (WorkingOnWeekends $work) {
                return strtoupper($work->workStat);
            })
            ->make(true);
    }

    public function findDate(Request $request)
    {
        $prods = User::where('active', true)->where('dept_category_id', 6)->orderBy('first_name', 'asc')->get();

        return view('HRDLevelAcces.weekend_crew.detailDateHistorical', compact(['prods']));
    }

    public function datatablesFindDate(Request $request)
    {
        $query = WorkingOnWeekends::where('approved', '!=', 2)->whereDATE('start', '>=', $request->input('started'))->whereDATE('start', '<=', $request->input('ended'))->orderBy('start', 'desc')->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('nik', function (WorkingOnWeekends $work) {
                return $work->user()->nik;
            })
            ->addColumn('employes', function (WorkingOnWeekends $work) {
                return $work->user()->getFullName();
            })
            ->addColumn('coordinator', function (WorkingOnWeekends $work) {
                return $work->coordinator()->getFullName();
            })
            ->addColumn('producer', function (WorkingOnWeekends $work) {
                return $work->producer()->getFullName();
            })
            ->addColumn('position', function (WorkingOnWeekends $work) {
                return $work->user()->position;
            })
            ->addColumn('time', function (WorkingOnWeekends $work) {
                return sprintf("%02d:%02d", $work->hourly, $work->minutely);
            })
            ->editColumn('approved', function (WorkingOnWeekends $work) {
                $return  = "Err!!";

                if ($work->ap_producer === 1 and $work->approved === 1) {
                    $return = "Approved";
                }

                if ($work->ap_producer === 1 and $work->approved === 0) {
                    $return = "Pending (GM)";
                }

                if ($work->ap_producer === 0 and $work->approved === 0) {
                    $return = "Pending (Producer)";
                }

                if ($work->ap_producer === 2 or $work->approved === 2) {
                    $return = "Disapproved";
                }

                return $return;
            })
            ->editColumn('workStat', function (WorkingOnWeekends $work) {
                return strtoupper($work->workStat);
            })
            ->make(true);
    }

    public function findEmployee(Request $request)
    {
        $prods = User::where('active', true)->where('dept_category_id', 6)->where('koor', true)->orderBy('first_name', 'asc')->get();

        return view('HRDLevelAcces.weekend_crew.detailEmpHistorical', compact(['prods']));
    }

    public function datatablesFindEmployee(Request $request)
    {
        $query = WorkingOnWeekends::where('approved', '!=', 2)->where('coor_id', $request->input('employee'))->whereDATE('start', '>=', $request->input('started'))->whereDATE('start', '<=', $request->input('ended'))->orderBy('start', 'desc')->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('nik', function (WorkingOnWeekends $work) {
                return $work->user()->nik;
            })
            ->addColumn('employes', function (WorkingOnWeekends $work) {
                return $work->user()->getFullName();
            })
            ->addColumn('coordinator', function (WorkingOnWeekends $work) {
                return $work->coordinator()->getFullName();
            })
            ->addColumn('producer', function (WorkingOnWeekends $work) {
                return $work->producer()->getFullName();
            })
            ->addColumn('position', function (WorkingOnWeekends $work) {
                return $work->user()->position;
            })
            ->addColumn('time', function (WorkingOnWeekends $work) {
                return sprintf("%02d:%02d", $work->hourly, $work->minutely);
            })
            ->editColumn('approved', function (WorkingOnWeekends $work) {
                $return  = "Err!!";

                if ($work->ap_producer === 1 and $work->approved === 1) {
                    $return = "Approved (GM)";
                }

                if ($work->ap_producer === 1 and $work->approved === 0) {
                    $return = "Pending (GM)";
                }

                if ($work->ap_producer === 0 and $work->approved === 0) {
                    $return = "Pending (Producer)";
                }

                if ($work->ap_producer === 2 or $work->approved === 2) {
                    $return = "Disapproved";
                }

                return $return;
            })
            ->editColumn('workStat', function (WorkingOnWeekends $work) {
                return strtoupper($work->workStat);
            })
            ->make(true);
    }

    public function dataTabalesSummaryApproved()
    {
        $query = SendingDataWorkingWeekend::where('approved', true)->latest()->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (SendingDataWorkingWeekend $sent) {
                return $sent->coordinator()->getFullName();
            })
            ->addColumn('producer', function (SendingDataWorkingWeekend $sent) {
                return $sent->producer()->getFullName();
            })
            ->addColumn('project', function (SendingDataWorkingWeekend $sent) {
                return $sent->coordinator()->getProjectName($sent->coordinator()->project_category_id_1);
            })
            ->addColumn('crew', 'HRDLevelAcces.weekend_crew.button_crew')
            ->addColumn('actions', 'HRDLevelAcces.weekend_crew.actionsSummary')
            ->addColumn('date', function (SendingDataWorkingWeekend $sent) {
                $first = WorkingOnWeekends::where('status', $sent->status)->orderBy('start', 'asc')->first();
                $first = date('Y-m-d', strtotime($first->start));
                $last = WorkingOnWeekends::where('status', $sent->status)->orderBy('start', 'desc')->first();
                $last = date('Y-m-d', strtotime($last->start));

                return $first . " - " . $last;
            })
            ->editColumn('approved', function (SendingDataWorkingWeekend $sent) {
                $return  = "Err!!";

                if ($sent->ap_producer === 1 and $sent->approved === 1) {
                    $return = "Approved";
                }

                if ($sent->ap_producer === 1 and $sent->approved === 0) {
                    $return = "Pending (GM)";
                }

                if ($sent->ap_producer === 0 and $sent->approved === 0) {
                    $return = "Pending (Producer)";
                }

                if ($sent->ap_producer === 2 or $sent->approved === 2) {
                    $return = "Disapproved";
                }

                return $return;
            })
            ->rawColumns(['crew', 'actions'])
            ->make(true);
    }
}
