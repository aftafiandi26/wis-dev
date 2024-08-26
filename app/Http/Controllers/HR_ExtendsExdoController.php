<?php

namespace App\Http\Controllers;

use App\Initial_Extends;
use App\Initial_Leave;
use App\Mail\HRD\ExtendExdo\Reminders;
use App\Mail\HRD\ExtendExdo\UnverifiedMails;
use App\Mail\HRD\ExtendExdo\VerifiedMails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class HR_ExtendsExdoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function index()
    {
        return view('HRDLevelAcces.hr_admin.extend_exdo.index');
    }

    public function datatablesExtended()
    {
        $query = Initial_Extends::where('ap_gm', true)->where('ver_hr', false)->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('employee', function (Initial_Extends $init) {
                return  $init->user()->getFullName();
            })
            ->addColumn('coor', function (Initial_Extends $init) {
                return $init->getUser($init->create_by)->getFullName();
            })
            ->addColumn('amount', function (Initial_Extends $init) {
                return $init->initial_leave()->initial;
            })
            ->addColumn('init_expired', function (Initial_Extends $init) {
                return $init->initial_leave()->expired;
            })
            ->addColumn('status', function (Initial_Extends $init) {
                $status = "Disapproved";

                if ($init->ap_producer == 0 and $init->ap_gm == 0 and $init->ver_hr == 0) {
                    $status =   $init->getUser($init->producer_id)->getFullName() . " | Pending";
                }
                if ($init->ap_producer == 1 and $init->ap_gm == 0 and $init->ver_hr == 0) {
                    $status =   "GM Pending";
                }
                if ($init->ap_producer == 1 and $init->ap_gm == 1 and $init->ver_hr == 0) {
                    $status =   "HR Verifying";
                }
                if ($init->ap_producer == 1 and $init->ap_gm == 1 and $init->ver_hr == 1) {
                    $status =   "Successed";
                }

                return $status;
            })
            ->addColumn('actions', 'HRDLevelAcces.hr_admin.extend_exdo.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function showModal($id)
    {
        $data = Initial_Extends::find($id);

        $coutless = Initial_Extends::where('initial_leave_id', $data->initial_leave_id)->get();

        return view('HRDLevelAcces.hr_admin.extend_exdo.modal', compact(['data', 'coutless']));
    }

    public function disapproved(Request $request)
    {
        $rules = [
            'message' => ['required']
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Your message-note is empty!.']));
            return redirect()->route('hrd/exdo-extended/index');
        }
        $extends = Initial_Extends::find($request->input('id'));

        Mail::send(new UnverifiedMails($request->all()));

        $extends->update([
            'ver_hr'    => 2,
            'date_hr'   => Carbon::now()
        ]);

        Session::flash('success', Lang::get('messages.data_custom', ['data' => $extends->getUser($extends->user_id)->getFullName() . ' extended of exdo has been successfully disapproved.']));
        return redirect()->route('hrd/exdo-extended/index');
    }

    public function verified($id)
    {
        $extend = Initial_Extends::find($id);

        Mail::send(new VerifiedMails($id));

        $extend->update([
            'ver_hr'        => true,
            'date_hr'       => Carbon::now()
        ]);

        $exdo = Initial_Leave::find($extend->initial_leave_id);

        $exdo->update([
            'expired'   => $extend->change_to
        ]);

        Session::flash('success', Lang::get('messages.data_custom', ['data' => $extend->getUser($extend->user_id)->getFullName() . ' extended of exdo has been successfully verified.']));
        return redirect()->route('hrd/exdo-extended/index');
    }

    public function datatablesProgress()
    {
        $query = Initial_Extends::where('ver_hr', false)->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('employee', function (Initial_Extends $init) {
                return  $init->user()->getFullName();
            })
            ->addColumn('coor', function (Initial_Extends $init) {
                return $init->getUser($init->create_by)->getFullName();
            })
            ->addColumn('amount', function (Initial_Extends $init) {
                return $init->initial_leave()->initial;
            })
            ->addColumn('init_expired', function (Initial_Extends $init) {
                return $init->initial_leave()->expired;
            })
            ->addColumn('status', function (Initial_Extends $init) {
                $status = "Disapproved";

                if ($init->ap_producer == 0 and $init->ap_gm == 0 and $init->ver_hr == 0) {
                    $status =   $init->getUser($init->producer_id)->getFullName() . " | Pending";
                }
                if ($init->ap_producer == 1 and $init->ap_gm == 0 and $init->ver_hr == 0) {
                    $status =   "GM Pending";
                }
                if ($init->ap_producer == 1 and $init->ap_gm == 1 and $init->ver_hr == 0) {
                    $status =   "HR Verifying";
                }
                if ($init->ap_producer == 1 and $init->ap_gm == 1 and $init->ver_hr == 1) {
                    $status =   "Successed";
                }

                return $status;
            })
            ->addColumn('actions', 'HRDLevelAcces.hr_admin.extend_exdo.actionsProgress')
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function showModalProgress($id)
    {
        $data = Initial_Extends::find($id);

        $coutless = Initial_Extends::where('initial_leave_id', $data->initial_leave_id)->get();

        $ketProducer = "Disapproved";
        $styleProducer = "color-red";
        $ketGM = "Disapproved";
        $styleGM = "color-red";

        if ($data->ap_producer == 0) {
            $ketProducer = "Pending";
            $styleProducer = null;
        }
        if ($data->ap_producer == 1) {
            $ketProducer = "Approved";
            $styleProducer = "color-green";
        }

        if ($data->ap_producer == 0 && $data->ap_gm == 0) {
            $ketGM = "Waiting";
            $styleGM = null;
        }
        if ($data->ap_producer == 1 && $data->ap_gm == 0) {
            $ketGM = "Pending";
            $styleGM = null;
        }
        if ($data->ap_producer == 1 && $data->ap_gm == 1) {
            $ketGM = "Approved";
            $styleGM = "color-green";
        }



        return view('HRDLevelAcces.hr_admin.extend_exdo.modalProgress', compact(['data', 'coutless', 'ketProducer', 'ketGM', 'styleProducer', 'styleGM']));
    }

    public function datatablesSummary()
    {
        $query = Initial_Extends::whereIn('ver_hr', [1, 2])->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('employee', function (Initial_Extends $init) {
                return  $init->user()->getFullName();
            })
            ->addColumn('coor', function (Initial_Extends $init) {
                return $init->getUser($init->create_by)->getFullName();
            })
            ->addColumn('amount', function (Initial_Extends $init) {
                return $init->initial_leave()->initial;
            })
            ->addColumn('init_expired', function (Initial_Extends $init) {
                return $init->initial_leave()->expired;
            })
            ->addColumn('status', function (Initial_Extends $init) {
                $status = "Disapproved";

                if ($init->ap_producer == 0 and $init->ap_gm == 0 and $init->ver_hr == 0) {
                    $status =   $init->getUser($init->producer_id)->getFullName() . " | Pending";
                }
                if ($init->ap_producer == 1 and $init->ap_gm == 0 and $init->ver_hr == 0) {
                    $status =   "GM Pending";
                }
                if ($init->ap_producer == 1 and $init->ap_gm == 1 and $init->ver_hr == 0) {
                    $status =   "HR Verifying";
                }
                if ($init->ap_producer == 1 and $init->ap_gm == 1 and $init->ver_hr == 1) {
                    $status =   "Successed";
                }

                return $status;
            })
            ->addColumn('actions', 'HRDLevelAcces.hr_admin.extend_exdo.actionsSummary')
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function showModalSummary($id)
    {
        $data = Initial_Extends::find($id);

        $coutless = Initial_Extends::where('initial_leave_id', $data->initial_leave_id)->get();


        return view('HRDLevelAcces.hr_admin.extend_exdo.modalSummary', compact(['data', 'coutless']));
    }

    public function reminders(Request $request)
    {
        $rules = [
            'message' => ['required']
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Your message-note is empty!.']));
            return redirect()->route('hrd/exdo-extended/index');
        }
        $extends = Initial_Extends::find($request->input('id'));

        Mail::send(new Reminders($request->all()));

        Session::flash('message', Lang::get('messages.data_custom', ['data' => $extends->getUser($extends->user_id)->getFullName() . ' extended of exdo form was successfully reminded']));
        return redirect()->route('hrd/exdo-extended/index');
    }
}