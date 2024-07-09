<?php

namespace App\Http\Controllers;

use App\FormOvertimes;
use App\Mail\Form\OvertimeFinished;
use App\Mail\Form\OvertimeUnverified;
use App\User;
use Illuminate\Http\Request;
use Datatables;
use DateTime;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class ITformOvertimesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'it']);
    }

    public function index()
    {
        return view('IT.Registration_Form.Overtimes.index');
    }

    public function dataObject()
    {
        $data = FormOvertimes::where('app_coor', 1)->where('app_gm', 1)->where('verify_it', 0)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('fullname', function (FormOvertimes $form) {
                $return = User::find($form->user_id);

                return $return->getFullName();
            })
            ->addColumn('username', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->username;
            })
            ->addColumn('position', function (FormOvertimes $form) {
                $return = User::find($form->user_id);

                return $return->position;
            })
            ->editColumn('vpn', '@if ($vpn === 1) {{ "Requested" }} @else {{"-"}} @endif')
            ->editColumn('app_coor', function (FormOvertimes $form) {
                $app_coor = app('App\Http\Controllers\AllEmployesFormProgressingController')->appCoordinator($form);

                return $app_coor;
            })
            ->editColumn('app_gm', function (FormOvertimes $form) {
                $app_gm = app('App\Http\Controllers\AllEmployesFormProgressingController')->appGeneralManager($form);

                return $app_gm;
            })
            ->editColumn('verify_it', '@if ($verify_it === 0) {{"Pending"}} @else {{ "Verify" }} @endif')
            ->addColumn('actions', function (FormOvertimes $form) {
                return view('IT.Registration_Form.Overtimes.actions', compact(['form']));
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function modalVerifyObejct($id)
    {
        $form = FormOvertimes::with(['user', 'coordinator', 'generalManager'])->find($id);

        $startOvertime = new DateTime($form->startovertime);
        $endOvertime = new DateTime($form->endovertime);
        $count_time = $endOvertime->diff($startOvertime);

        $count_day = $count_time->h;

        if ($count_time->d > 0) {
            $count_day = $count_time->d * 24;
        }

        $duration = [
            'hour' => $count_day,
            'minute' => $count_time->i
        ];

        $app_coor = app('App\Http\Controllers\AllEmployesFormProgressingController')->appCoordinator($form);
        $app_gm = app('App\Http\Controllers\AllEmployesFormProgressingController')->appGeneralManager($form);

        $approvalStatus = [
            'coordinator' => $app_coor,
            'generalManager' => $app_gm
        ];

        return view('IT.Registration_Form.Overtimes.modalVerify', compact(['form', 'duration', 'approvalStatus']));
    }

    public function verified(Request $request, $id)
    {
        FormOvertimes::where('id', $id)->update(['verify_it' => true, 'it_id' => auth()->user()->id]);
        $formOvertime = FormOvertimes::with(['user', 'coordinator', 'generalManager'])->find($id);
        Mail::send(new OvertimeFinished($id));
        return redirect()->route('it/registration/form/overtimes/index')->with('success', Lang::get('messages.data_custom', ['data' => 'Form access remote' . $formOvertime->user->getFullName() . ' has been verfied.']));
    }

    public function unverified(Request $request, $id)
    {
        FormOvertimes::where('id', $id)->update(['verify_it' => 2, 'it_id' => auth()->user()->id]);
        $formOvertime = FormOvertimes::with(['user', 'coordinator'])->find($id);
        Mail::send(new OvertimeUnverified($id));
        return redirect()->route('it/registration/form/overtimes/index')->with('getError', Lang::get('messages.data_custom', ['data' => 'Form access remote ' . $formOvertime->user->getFullName() . ' has been unverfied.']));
    }

    public function indexSummary()
    {
        return view('IT.Registration_Form.Overtimes.summary');
    }

    public function dataSummary()
    {
        $data = FormOvertimes::where('verify_it', 1)->orderBy('startovertime', 'desc')->limit(100)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('fullname', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->getFullName();
            })
            ->addColumn('username', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->username;
            })
            ->addColumn('nik', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->nik;
            })
            ->addColumn('position', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->position;
            })
            ->editColumn('app_coor', function (FormOvertimes $form) {
                $app_coor = app('App\Http\Controllers\AllEmployesFormProgressingController')->appCoordinator($form);;
                return $app_coor;
            })
            ->editColumn('app_gm', function (FormOvertimes $form) {
                $app_gm = app('App\Http\Controllers\AllEmployesFormProgressingController')->appGeneralManager($form);
                return $app_gm;
            })
            ->editColumn('verify_it', function (FormOvertimes $form) {
                $it = User::find($form->it_id);

                $ver = "Verify by";

                if ($form->verify_it === 2) {
                    $ver = "Unverify by";
                }

                return $ver . ' ' . $it->getFullName();
            })
            ->make(true);
    }

    public function indexProgress()
    {
        return view('IT.Registration_Form.Overtimes.progressing.index');
    }

    public function dataProgress()
    {
        $data = FormOvertimes::where('verify_it', 0)->orderBy('startovertime', 'dasc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('fullname', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->getFullName();
            })
            ->addColumn('username', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->username;
            })
            ->addColumn('nik', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->nik;
            })
            ->addColumn('position', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->position;
            })
            ->editColumn('app_coor', function (FormOvertimes $form) {
                $app_coor = app('App\Http\Controllers\AllEmployesFormProgressingController')->appCoordinator($form);;
                return $app_coor;
            })
            ->editColumn('app_gm', function (FormOvertimes $form) {
                $app_gm = app('App\Http\Controllers\AllEmployesFormProgressingController')->appGeneralManager($form);
                return $app_gm;
            })
            ->addColumn('actions', function (FormOvertimes $form) {
                $form = $form->id;
                return view('IT.Registration_Form.Overtimes.progressing.actions', compact(['form']));
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function modalProgressing($id)
    {
        $form = FormOvertimes::with(['user', 'coordinator', 'generalManager'])->find($id);

        $startOvertime = new DateTime($form->startovertime);
        $endOvertime = new DateTime($form->endovertime);
        $count_time = $endOvertime->diff($startOvertime);

        $count_day = $count_time->h;

        if ($count_time->d > 0) {
            $count_day = $count_time->d * 24;
        }

        $duration = [
            'hour' => $count_day,
            'minute' => $count_time->i
        ];

        $app_coor = app('App\Http\Controllers\AllEmployesFormProgressingController')->appCoordinator($form);
        $app_gm = app('App\Http\Controllers\AllEmployesFormProgressingController')->appGeneralManager($form);

        $approvalStatus = [
            'coordinator' => $app_coor,
            'generalManager' => $app_gm
        ];

        return view('IT.Registration_Form.Overtimes.progressing.modal', compact(['form', 'duration', 'approvalStatus']));
    }
}