<?php

namespace App\Http\Controllers;

use App\Mail\Form\Weekend_Crew\ApprovedMail;
use App\Mail\Form\Weekend_Crew\DisapprovedMail;
use App\Mail\Form\Weekend_Crew\VerifyMail;
use App\SendingDataWorkingWeekend;
use App\WorkingOnWeekends;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Psy\Util\Json;
use Yajra\Datatables\Facades\Datatables;

class GM_WeekendsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hd']);
    }

    public function index()
    {
        return view('GenaralManager.working_on_weekends.index');
    }

    public function datatablesAllowance()
    {
        $query = SendingDataWorkingWeekend::where('ap_producer', true)->where('allowance', false)->whereIn('approved', [false, 2])->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (SendingDataWorkingWeekend $sent) {
                return $sent->coordinator()->getFullName();
            })
            ->addColumn('position', function (SendingDataWorkingWeekend $sent) {
                return $sent->coordinator()->position;
            })
            ->addColumn('project', function (SendingDataWorkingWeekend $sent) {
                return $sent->coordinator()->getProjectName($sent->coordinator()->project_category_id_1);
            })
            ->addColumn('actions', 'GenaralManager.working_on_weekends.actions')
            ->addColumn('allowance', function (SendingDataWorkingWeekend $sent) {
                $query = WorkingOnWeekends::where('status', $sent->status)->where('extra', 'allowance')->get();

                return $query->count();
            })
            ->rawColumns(['actions'])
            ->editColumn('approved', function (SendingDataWorkingWeekend $sent) {
                if ($sent->approved == true) {
                    $return = "Approved";
                } else {
                    if ($sent->ap_producer == false) {
                        $return = "Waiting " . $sent->producer()->getFullName() . " approval";
                    } else {
                        $return = "Waiting Approval";
                    }
                }

                return $return;
            })
            ->make(true);
    }

    public function datatablesExdo()
    {
        $query = SendingDataWorkingWeekend::where('ap_producer', true)->where('exdo', true)->whereIn('approved', [false, 2])->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (SendingDataWorkingWeekend $sent) {
                return $sent->coordinator()->getFullName();
            })
            ->addColumn('position', function (SendingDataWorkingWeekend $sent) {
                return $sent->coordinator()->position;
            })
            ->addColumn('project', function (SendingDataWorkingWeekend $sent) {
                return $sent->coordinator()->getProjectName($sent->coordinator()->project_category_id_1);
            })
            ->addColumn('actions', 'GenaralManager.working_on_weekends.actionsExdo')
            ->addColumn('exdo', function (SendingDataWorkingWeekend $sent) {
                $query = WorkingOnWeekends::where('status', $sent->status)->where('extra', 'exdo')->get();

                return $query->count();
            })
            ->rawColumns(['actions'])
            ->editColumn('approved', function (SendingDataWorkingWeekend $sent) {
                if ($sent->approved == true) {
                    $return = "Approved";
                } else {
                    if ($sent->ap_producer == false) {
                        $return = "Waiting " . $sent->producer()->getFullName() . " approval";
                    } else {
                        $return = "Waiting Approval";
                    }
                }

                return $return;
            })
            ->make(true);
    }

    public function detail($id)
    {
        $getId = SendingDataWorkingWeekend::find($id);

        $works = WorkingOnWeekends::where('status', $getId->status)->where('coor_id', $getId->coor_id)->where('extra', 'allowance')->get();
        $allApproved = WorkingOnWeekends::whereIn('approved', [0, 1])->where('status', $getId->status)->where('coor_id', $getId->coor_id)->where('extra', 'allowance')->get()->count();
        $allDisapproved = WorkingOnWeekends::whereIn('approved', [0, 2])->where('status', $getId->status)->where('coor_id', $getId->coor_id)->where('extra', 'allowance')->get()->count();

        return view('GenaralManager.working_on_weekends.detail', compact(['works', 'getId', 'allApproved', 'allDisapproved']));
    }

    public function getStat($id)
    {
        $getId = SendingDataWorkingWeekend::find($id);

        $works = WorkingOnWeekends::where('status', $getId->status)->where('coor_id', $getId->coor_id)->where('extra', 'exdo')->get();

        $allApproved = WorkingOnWeekends::whereIn('approved', [false])->where('status', $getId->status)->where('coor_id', $getId->coor_id)->where('extra', 'exdo')->get()->count();
        $allDisapproved = WorkingOnWeekends::whereIn('approved', [true, false])->where('status', $getId->status)->where('coor_id', $getId->coor_id)->where('extra', 'exdo')->get()->count();

        return response()->json(['allApproved' => $allApproved, 'allDisapproved' => $allDisapproved]);
    }

    public function detailExdo($id)
    {
        $getId = SendingDataWorkingWeekend::find($id);

        $works = WorkingOnWeekends::where('status', $getId->status)->where('coor_id', $getId->coor_id)->where('extra', 'exdo')->get();

        $allApproved = WorkingOnWeekends::whereIn('approved', [0, 1])->where('status', $getId->status)->where('coor_id', $getId->coor_id)->where('extra', 'exdo')->get()->count();
        $allDisapproved = WorkingOnWeekends::whereIn('approved', [0, 2])->where('status', $getId->status)->where('coor_id', $getId->coor_id)->where('extra', 'exdo')->get()->count();

        return view('GenaralManager.working_on_weekends.detailExdo', compact(['works', 'getId', 'allApproved', 'allDisapproved']));
    }

    public function ajaxPush(Request $request)
    {
        $id = $request->input('id');
        $approved = $request->input('approved');
        $stat = $request->input('stat');

        $work = WorkingOnWeekends::find($id);
        $date = null;

        if ($approved != false) {
            $date = Carbon::now();
        }

        $work->update([
            'approved' => $approved,
            'date_gm' => $date
        ]);

        if ($approved == false) {
            $res = "pending";
        }

        if ($approved == true) {
            $res = "approved";
        }

        if ($approved == '2') {
            $res = "disapproved";
        }

        $allApproved = WorkingOnWeekends::whereIn('approved', [0, 1])->where('status', $work->status)->where('coor_id', $work->coor_id)->where('extra', 'exdo')->get()->count();
        $allDisapproved = WorkingOnWeekends::whereIn('approved', [0, 2])->where('status', $work->status)->where('coor_id', $work->coor_id)->where('extra', 'exdo')->get()->count();

        return response()->json([
            'message' => $work->user()->getFullName() . ' ' . $res . '.',
            'allApproved' => $allApproved,
            'allDisapproved'    => $allDisapproved,
        ]);
    }

    public function apporved($id)
    {
        $sending = SendingDataWorkingWeekend::find($id);

        $allowance = WorkingOnWeekends::where('status', $sending->status)->where('extra', 'allowance')->where('ap_producer', true)->where('approved', false)->get();
        $exdo = WorkingOnWeekends::where('status', $sending->status)->where('extra', 'exdo')->where('ap_producer', true)->where('approved', false)->get();

        foreach ($allowance as $work) {
            $work->update([
                'approved'   => true,
                'date_gm' => Carbon::now()
            ]);
        }

        foreach ($exdo as $x) {
            $x->update([
                'approved' => 2,
                'date_gm'   => Carbon::now()
            ]);
        }

        $sending->update([
            'approved'   => true,
            'date_gm' => Carbon::now(),
            'allowance' => true,
        ]);

        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Recorded data has been approved']));
        // Mail::to('dede.aftafiandi@infinitestudios.id')->send(new VerifyMail($id));
        Mail::to('wis_system@infinitestudios.id')->send(new VerifyMail($id));
        // Mail::to('dede.aftafiandi@infinitestudios.id')->send(new ApprovedMail($id));
        Mail::to($sending->coordiantor()->email)->send(new ApprovedMail($id));
        return redirect()->route('gm/working-on-weekends/index');
    }

    public function apporvedExdo($id)
    {
        $sending = SendingDataWorkingWeekend::find($id);

        $allowance = WorkingOnWeekends::where('status', $sending->status)->where('extra', 'allowance')->where('ap_producer', true)->where('approved', false)->get();
        $exdo = WorkingOnWeekends::where('status', $sending->status)->where('extra', 'exdo')->where('ap_producer', true)->where('approved', false)->get();

        foreach ($exdo as $x) {
            $x->update([
                'approved' => true,
                'date_gm'   => Carbon::now()
            ]);
        }

        foreach ($allowance as $work) {
            $work->update([
                'approved'   => 2,
                'date_gm' => Carbon::now()
            ]);
        }

        $sending->update([
            'approved'   => true,
            'date_gm' => Carbon::now(),
            'exdo'      => true,
        ]);

        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Recorded data has been approved']));
        Mail::to('dede.aftafiandi@infinitestudios.id')->send(new VerifyMail($id));
        Mail::to('dede.aftafiandi@infinitestudios.id')->send(new ApprovedMail($id));
        return redirect()->route('gm/working-on-weekends/index');
    }

    public function disapproved($id)
    {
        $sending = SendingDataWorkingWeekend::find($id);

        $allowance = WorkingOnWeekends::where('status', $sending->status)->where('extra', 'allowance')->where('ap_producer', true)->where('approved', false)->get();

        foreach ($allowance as $work) {
            $work->update([
                'approved'   => 2,
                'date_gm' => Carbon::now()
            ]);
        }

        $sending->update([
            'approved'   => 2,
            'date_gm' => Carbon::now(),
            'allowance' => 2,
        ]);

        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Recorded data has been disapproved']));
        Mail::to('dede.aftafiandi@infinitestudios.id')->send(new DisapprovedMail($sending->id));
        return redirect()->route('gm/working-on-weekends/index');
    }

    public function disapprovedExdo($id)
    {
        $sending = SendingDataWorkingWeekend::find($id);

        $exdo = WorkingOnWeekends::where('status', $sending->status)->where('extra', 'exdo')->where('ap_producer', true)->where('approved', false)->get();

        foreach ($exdo as $work) {
            $work->update([
                'approved'   => 2,
                'date_gm' => Carbon::now()
            ]);
        }

        $sending->update([
            'approved'   => 2,
            'date_gm' => Carbon::now(),
            'exdo'  => 2
        ]);

        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Recorded data has been disapproved']));
        Mail::to('dede.aftafiandi@infinitestudios.id')->send(new DisapprovedMail($sending->id));
        return redirect()->route('gm/working-on-weekends/index');
    }

    public function summary()
    {
        return view('GenaralManager.working_on_weekends.summary.index');
    }

    public function dataSummary()
    {
        $works = WorkingOnWeekends::where('approved', '!=', false)->get();

        return Datatables::of($works)
            ->addIndexColumn()
            ->addColumn('employes', function (WorkingOnWeekends $work) {
                return $work->user()->getFullName();
            })
            ->addColumn('coordinator', function (WorkingOnWeekends $work) {
                return $work->coordinator()->getFullName();
            })
            ->addColumn('time', function (WorkingOnWeekends $work) {
                return $work->hourly . ' Hours, ' . $work->minutely . ' minutes';
            })
            ->addColumn('position', function (WorkingOnWeekends $work) {
                return $work->user()->position;
            })
            ->addColumn('producer', function (WorkingOnWeekends $work) {
                return $work->producer()->getFullName();
            })
            ->editColumn('approved', function (WorkingOnWeekends $work) {
                if ($work->approved === 1) {
                    $return = "Approved";
                } elseif ($work->approved === 2) {
                    $return = "Disapproved";
                } else {
                    $return = "Pending";
                }

                return $return;
            })
            ->editColumn('workStat', function (WorkingOnWeekends $work) {
                return strtoupper($work->workStat);
            })
            ->make(true);
    }
}