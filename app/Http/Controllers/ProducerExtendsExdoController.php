<?php

namespace App\Http\Controllers;

use App\Initial_Extends;
use App\Initial_Leave;
use App\Mail\Production\ExtendsExdo\ApprovalProducerMail;
use App\Mail\Production\ExtendsExdo\DisapprovalProducerMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;

class ProducerExtendsExdoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'producer']);
    }

    public function index()
    {
        return view('production.extendsExdo.producers.index');
    }

    public function datatables()
    {
        $query = Initial_Extends::where('producer_id', auth()->user()->id)->where('ap_producer', false)->get();

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
            ->addColumn('actions', 'production.extendsExdo.producers.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function datatablesSummary()
    {
        $query = Initial_Extends::where('producer_id', auth()->user()->id)->whereNotIn('ap_producer', [false])->get();

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
            ->addColumn('actions', 'production.extendsExdo.producers.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function showModalApproval($id)
    {
        $data = Initial_Extends::find($id);

        return view('production.extendsExdo.producers.approval', compact(['data']));
    }

    public function approval($id)
    {
        $data = Initial_Extends::find($id);

        Mail::send(new ApprovalProducerMail($data));

        $data->update([
            'ap_producer'       => true,
            'date_producer'     => Carbon::now()
        ]);

        Session::flash('success', Lang::get('messages.data_custom', ['data' =>  $data->getUser($data->user_id)->getFullName() . '  extended of exdo has been successfully approved.']));
        return redirect()->route('producer/exdo-exntend/index');
    }

    public function disapproval($id)
    {
        $data = Initial_Extends::find($id);

        Mail::send(new DisapprovalProducerMail($data));

        $data->update([
            'ap_producer'       => 2,
            'ap_gm'             => 2,
            'ver_hr'            => 2,
            'date_producer'     => Carbon::now()
        ]);

        Session::flash('success', Lang::get('messages.data_custom', ['data' =>  $data->getUser($data->user_id)->getFullName() . '  extended of exdo has been disapprved.']));
        return redirect()->route('producer/exdo-exntend/index');
    }
}
