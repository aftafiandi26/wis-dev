<?php

namespace App\Http\Controllers;

use App\FormOvertimes;
use App\User;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;

use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AllEmployesFormProgressingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function index()
    {
        return view('all_employee.Form.form_progress');
    }

    public function dataObject()
    {
        $data = FormOvertimes::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('type', function (FormOvertimes $form) {
                return Str::title($form->type);
            })
            ->editColumn('app_coor', function (FormOvertimes $form) {
                $app_coor = $this->appCoordinator($form);

                return $app_coor;
            })
            ->editColumn('app_gm', function (FormOvertimes $form) {
                $app_gm = $this->appGeneralManager($form);

                return $app_gm;
            })
            ->editColumn('verify_it', '@if($verify_it == 1){{"Verified"}} @elseif($verify_it == 2){{"Unverified"}} @else {{"--"}} @endif')
            ->addColumn('action', function (FormOvertimes $form) {
                return view('all_employee.Form.actionsForm', compact(['form']));
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function modalObject($id)
    {
        $form = FormOvertimes::with(['user', 'coordinator', 'generalManager'])->find($id);

        $startOvertime = new DateTime($form->startovertime);
        $endOvertime = new DateTime($form->endovertime);
        $count_time = $endOvertime->diff($startOvertime);

        $duration = [
            'hour' => $count_time->h,
            'minute' => $count_time->i
        ];

        $app_coor = $this->appCoordinator($form);
        $app_gm = $this->appGeneralManager($form);

        $approvalStatus = [
            'coordinator' => $app_coor,
            'generalManager' => $app_gm
        ];

        return view('all_employee.Form.modalForm', compact(['form', 'duration', 'approvalStatus']));
    }

    public function appCoordinator($form)
    {
        $app_coor = "Pending";

        if ($form->app_coor == 1) {
            $app_coor = "Approved";
        }

        if ($form->app_coor == 2) {
            $app_coor = "Disapproved";
        }

        return $app_coor;
    }

    public function appProjectManager($form)
    {
        $app_pm = "--";

        if ($form->app_pm == 0 and $form->app_coor == 0) {
            $app_pm = "Waiting (Coordinator)";
        }

        if ($form->app_pm == 0 and $form->app_coor == 1) {
            $app_pm = "Pending";
        }

        if ($form->app_pm == 0 and $form->app_coor == 2) {
            $app_pm = "Disapproved (Coordinator)";
        }

        if ($form->app_pm == 1) {
            $app_pm = "Approved";
        }

        if ($form->app_pm == 2) {
            $app_pm = "Disapproved (PM)";
        }

        return $app_pm;
    }

    public function appGeneralManager($form)
    {
        $app_gm = "--";

        if ($form->app_coor == 0 and $form->app_gm == 0) {
            $app_gm = "Waiting (Coordinator)";
        }
        if ($form->app_coor == 2 and $form->app_gm == 0) {
            $app_gm = "Disapporved (Coordinator)";
        }
        if ($form->app_coor == 1 and $form->app_gm == 0) {
            $app_gm = "Pending";
        }
        if ($form->app_coor == 1 and $form->app_gm == 1) {
            $app_gm = "Approved";
        }
        if ($form->app_coor == 1 and $form->app_gm == 2) {
            $app_gm = "Disapporved";
        }

        return $app_gm;
    }

    private function jejakGM($form)
    {
        if ($form->app_gm == 0 and $form->app_pm == 0 and $form->app_coor == 0) {
            $app_gm = "Waiting (Coordinator)";
        }

        if ($form->app_gm == 0 and $form->app_pm == 0 and $form->app_coor == 1) {
            $app_gm = "Pending";
        }

        if ($form->app_gm == 0 and $form->app_pm == 0 and $form->app_coor == 2) {
            $app_gm = "Disapproved (Coordinator)";
        }

        if ($form->app_gm == 0 and $form->app_pm == 0 and $form->app_coor == 1) {
            $app_gm = "Waiting (PM)";
        }

        if ($form->app_gm == 0 and $form->app_pm == 1 and $form->app_coor == 1) {
            $app_gm = "Pending";
        }

        if ($form->app_gm == 0 and $form->app_pm == 2 and $form->app_coor == 1) {
            $app_gm = "Disapproved (PM)";
        }

        if ($form->app_gm == 1) {
            $app_gm = "Approved";
        }

        if ($form->app_gm == 2) {
            $app_gm = "Disapproved";
        }
    }

    public function modalEditObject($id)
    {
        $form = FormOvertimes::with(['user', 'coordinator', 'generalManager'])->find($id);

        $temp = 6;

        $coordinator = User::where('active', 1)->where('dept_category_id', $temp)->where('koor', 1)->orderBy('first_name', 'asc')->get();

        $projectManager = User::where('active', 1)->where('dept_category_id', $temp)->where('pm', 1)->orderBy('first_name', 'asc')->get();

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

        $app_coor = $this->appCoordinator($form);
        $app_gm = $this->appGeneralManager($form);

        $approvalStatus = [
            'coordinator' => $app_coor,
            'generalManager' => $app_gm
        ];

        return view('all_employee.Form.formEdit', compact(['form', 'coordinator', 'projectManager', 'duration', 'approvalStatus']));
    }

    public function modalUpdateObject(Request $request, $id)
    {
        $vpn = 1;
        if (empty($request->input('vpn'))) {
            $vpn = 0;
        }

        $startOvertime = new DateTime($request->input('startovertime'));
        $endOvertime = new DateTime($request->input('endovertime'));
        $count_time = $endOvertime->diff($startOvertime);

        if ($count_time->invert !== 1) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, Please check your time or date !!']));
            return redirect()->route('form/progressing/index');
        }

        $countHours = 24 * $count_time->d;

        $blockHours = $count_time->h + $countHours;

        if ($blockHours > 12) {
            Session::flash('reminder', Lang::get('messages.data_custom', ['data' => 'Sorry, You exceeded the fetching expiration time limit for remote access.
            Maximum limit of 12 hours a day, for that the system will convert the end limit of your remote access session. !!']));
            $endOvertime = $startOvertime->add(new DateInterval('PT' . 12 . 'H'));
        }

        $data = [
            'startovertime' => $request->input('startovertime'),
            'endovertime'   => $endOvertime,
            'reason'        => $request->input('reason'),
            'coor_id'       => $request->input('coordinator'),
            'pm_id'         => $request->input('projectManager'),
            'vpn'           => $vpn
        ];

        FormOvertimes::where('id', $id)->update($data);

        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Form successfully updated']));
        return redirect()->route('form/progressing/index');
    }

    public function modalDeleteObject($id)
    {
        return view('all_employee.Form.formDelete', compact(['id']));
    }

    public function postDelete($id)
    {
        Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Form successfully deleted']));
        FormOvertimes::where('id', $id)->delete();
        return redirect()->route('form/progressing/index');
    }
}