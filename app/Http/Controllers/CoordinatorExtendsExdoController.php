<?php

namespace App\Http\Controllers;

use App\Initial_Extends;
use App\Initial_Leave;
use App\Mail\Production\ExtendsExdo\ExdoExtendedMail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;

class CoordinatorExtendsExdoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'koor']);
    }

    public function index(Request $request)
    {
        $emp = $request->cookie('emp');

        $users = User::where('active', 1)->where('dept_category_id', auth()->user()->dept_category_id)->orderBy('first_name', 'asc')->get();

        $now = Carbon::now();
        $eocNow = $now->addMonth();

        $eoc = [];

        foreach ($users as $key => $value) {
            if ($value->end_date < $eocNow) {
                $eoc[] = $value->getFullName();
            }
        }

        $eoc = json_encode($eoc);

        return view('production.extendsExdo.coordinator.index', compact(['eoc', 'users', 'emp']));
    }

    public function data()
    {
        $query = Initial_Extends::where('create_by', auth()->user()->id)->latest()->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('employee', function (Initial_Extends $init) {
                return  $init->user()->getFullName();
            })
            ->addColumn('producer', function (Initial_Extends $init) {
                return $init->getUser($init->producer_id)->getFullName();
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
            ->make(true);
    }

    public function datatables(Request $request)
    {
        $intial = Initial_Leave::where('user_id', $request->input('id'))->orderBy('id', 'desc')->get();

        return Datatables::of($intial)
            ->addIndexColumn()
            ->addColumn('fullname', function (Initial_Leave $init) {
                $user = User::find($init->user_id);
                return $user->getFullName();
            })
            ->addColumn('actions', function (Initial_Leave $initial) {
                $today = Carbon::now();

                $past = $today->subMonth('2');

                return view('production.extendsExdo.coordinator.actions', compact(['initial', 'past']));
            })
            ->rawColumns(['actions'])
            ->setRowClass(function ($intial) {
                $today = Carbon::now();
                if ($intial->expired < $today) {
                    return 'text-red alert-danger';
                }
            })
            ->make(true);
    }

    public function setCookie(Request $request)
    {
        $id = $request->input('emp');

        return redirect()->route('coordinator/exdo-extends/view', $id);
    }

    public function view($id)
    {
        $selectUser = User::find($id);

        $now = Carbon::now();
        $eocNow = $now->addMonth();

        if ($eocNow > $selectUser->end_date) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => $selectUser->getFullName() . ' will be end of contract']));
            return redirect()->back();
        }

        $users = User::where('emp_status', '!=', 'Permanent')->where('active', 1)->where('dept_category_id', auth()->user()->dept_category_id)->orderBy('first_name', 'asc')->get();

        $eoc = [];
        foreach ($users as $key => $value) {
            if ($value->end_date < $eocNow) {
                $eoc[] = $value->getFullName();
            }
        }

        $eoc = json_encode($eoc);

        return view('production.extendsExdo.coordinator.view', compact(['id', 'selectUser', 'eoc', 'users']));
    }

    public function editExtend($id)
    {
        $init = Initial_Leave::find($id);
        $selectPM = User::where('active', 1)->where('dept_category_id', auth()->user()->dept_category_id)->where('producer', true)->get();

        $record = Initial_Extends::where('initial_leave_id', $id)->where('ver_hr', '!=', 2)->get();

        return view('production.extendsExdo.coordinator.edit', compact(['init', 'selectPM', 'record']));
    }

    public function storeExtends(Request $request, $id)
    {
        $init = Initial_Leave::find($id);

        $extends = Initial_Extends::where('initial_leave_id', $id)->where('ver_hr', false)->first();

        if ($extends) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => $init->user()->getFullName() . ' | extended of exdo application in progress']));
            return redirect()->route('coordinator/exdo-extends/view', $init->user_id);
        }

        $rules = [
            'expired'   => ["required", "date"],
            'approved'  => ["required"]
        ];

        $limitless = date('Y-m-d', strtotime('+1 month', strtotime($init->expired)));

        if ($request->input('expired') > $limitless) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => $init->user()->getFullName() . ' | exdo can only be extended until ' . $limitless . '.']));
            return redirect()->route('coordinator/exdo-extends/view', $init->user_id);
        }

        if ($init->limiter > 4) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => $init->user()->getFullName() . ' | exdo has been extended 3x.']));
            return redirect()->route('coordinator/exdo-extends/view', $init->user_id);
        }

        $data = [
            'initial_leave_id'      => $init->id,
            'user_id'               => $init->user_id,
            'expired'               => $request->input('expired'),
            'producer_id'           => $request->input('approved'),
            'gm_id'                 => 69,
            'create_by'             => auth()->user()->id,
        ];

        Mail::to('dede.aftafiandi@infinitestudios.id')->send(new ExdoExtendedMail($data));

        Initial_Extends::create($data);

        $limiter = [
            'limiter' => $init->limiter + 1
        ];

        Initial_Leave::where('id', $id)->update($limiter);

        Session::flash('message', Lang::get('messages.data_custom', ['data' => $init->user()->getFullName() . " exdo has been extended until " . $request->input('expired') . '.']));
        return redirect()->route('coordinator/exdo-extends/view', $init->user_id);
    }
}