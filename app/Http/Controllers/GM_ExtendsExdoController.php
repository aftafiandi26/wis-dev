<?php

namespace App\Http\Controllers;

use App\Initial_Extends;
use App\Initial_Leave;
use App\Mail\GeneralManager\ExtendExdo\ApprovalMail;
use App\Mail\GeneralManager\ExtendExdo\DisapprovalMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;

class GM_ExtendsExdoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'gm']);
    }

    public function index()
    {
        return view('GenaralManager.extend_exdo.index');
    }

    public function datatablesExtended()
    {
        $query = Initial_Extends::where('ap_producer', true)->where('ap_gm', false)->get();

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
            ->addColumn('actions', 'GenaralManager.extend_exdo.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function datatablesSummary()
    {
        $query = Initial_Extends::whereNotIn('ap_producer', [false])->whereIn('ap_gm', [1, 2])->get();

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
            ->addColumn('actions', 'GenaralManager.extend_exdo.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function showModal($id)
    {
        $data = Initial_Extends::find($id);

        $coutless = Initial_Extends::where('initial_leave_id', $data->initial_leave_id)->get();

        return view('GenaralManager.extend_exdo.modal', compact(['data', 'coutless']));
    }

    public function approval($id)
    {
        $data = Initial_Extends::find($id);

        Mail::send(new ApprovalMail($id));

        $data->update([
            'ap_gm'       => true,
            'date_gm'     => Carbon::now()
        ]);

        Session::flash('success', Lang::get('messages.data_custom', ['data' =>  $data->getUser($data->user_id)->getFullName() . '  extended of exdo has been successfully approved.']));
        return redirect()->route('gm/exdo-extended/index');
    }

    public function disapproval($id)
    {
        $data = Initial_Extends::find($id);

        Mail::send(new DisapprovalMail($id));

        $data->update([
            'ap_gm'       => 2,
            'ver_hr'       => 2,
            'date_gm'     => Carbon::now()
        ]);

        Session::flash('success', Lang::get('messages.data_custom', ['data' =>  $data->getUser($data->user_id)->getFullName() . '  extended of exdo has been successfully disapproved.']));
        return redirect()->route('gm/exdo-extended/index');
    }
}