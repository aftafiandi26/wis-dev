<?php

namespace App\Http\Controllers;

use App\FormOvertimes;
use App\Mail\Form\OvertimeFinished;
use App\Mail\Form\OvertimesDisapprovedMails;
use App\Mail\Form\OvertimesMails;
use App\Mail\Form\OvertimesVerified;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Yajra\Datatables\Facades\Datatables;

class FormOvertimesApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function indexCoordinator()
    {
        return view('all_employee.Form.Overtime.Approval.Coordinator.index');
    }

    public function dataIndexCoordinator()
    {
        $data = FormOvertimes::where('coor_id', auth()->user()->id)->where('app_coor', 0)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('type', function (FormOvertimes $form) {
                return Str::title($form->type);
            })
            ->editColumn('app_coor', function (FormOvertimes $form) {
                // $app_coor = app('App\Http\Controllers\AllEmployesFormProgressingController')->appCoordinator($form);
                $app_coor = new AllEmployesFormProgressingController;
                $app_coor = $app_coor->appCoordinator($form);

                return $app_coor;
            })
            ->editColumn('app_gm', function (FormOvertimes $form) {
                // $app_pm = app('App\Http\Controllers\AllEmployesFormProgressingController')->appGeneralManager($form);
                $app_pm = new AllEmployesFormProgressingController;
                $app_pm = $app_pm->appGeneralManager($form);

                return $app_pm;
            })
            ->addColumn('fullname', function (FormOvertimes $form) {
                $return = User::find($form->user_id);

                return $return->getFullName();
            })
            ->addColumn('nik', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->nik;
            })
            ->addColumn('department', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->getDepartment();
            })
            ->addColumn('position', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->position;
            })
            ->addColumn('action', function (FormOvertimes $form) {
                return view('all_employee.Form.Overtime.Approval.Coordinator.actions', compact('form'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function modalCoordinatorApproved($id)
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

        $app_coor = new AllEmployesFormProgressingController;
        $app_coor = $app_coor->appCoordinator($form);

        $app_gm = new AllEmployesFormProgressingController;
        $app_gm = $app_gm->appGeneralManager($form);

        $approvalStatus = [
            'coordinator' => $app_coor,
            'generalManager' => $app_gm
        ];

        return view('all_employee.Form.Overtime.Approval.Coordinator.modalApproved', compact(['form', 'duration', 'approvalStatus']));
    }

    public function approvedCoordinator(Request $request, $id)
    {
        $formOvertime = FormOvertimes::with(['user', 'coordinator', 'generalManager'])->find($id);

        FormOvertimes::where('id', $id)->update([
            'app_coor' => true,
            'app_gm'   => true,
            'gm_id'   => 69,
            'it_id'    => 226,
            'verify_it' => true,
        ]);
        // Mail::to($formOvertime->generalManager->email)->send(new OvertimesMails($formOvertime));
        Mail::send(new OvertimeFinished($id));

        return redirect()->route('form/approval/coordinator/index')->with('success', Lang::get('messages.data_custom', ['data' => 'Form access remote' . $formOvertime->user->getFullName() . ' has been approved.']));
    }

    public function disapprovedCoordinator(Request $request, $id)
    {
        FormOvertimes::where('id', $id)->update(['app_coor' => 2]);
        $formOvertime = FormOvertimes::with(['user', 'coordinator', 'projectManager'])->find($id);
        Mail::to($formOvertime->user->email)->send(new OvertimesDisapprovedMails($id));
        return redirect()->route('form/approval/coordinator/index')->with('getError', Lang::get('messages.data_custom', ['data' => 'Form access remote ' . $formOvertime->user->getFullName() . ' has been disapproved.']));
    }

    public function indexProjectManager()
    {
        return view('all_employee.Form.Overtime.Approval.ProjectManager.index');
    }

    public function dataIndexProjectManager()
    {
        $data = FormOvertimes::where('coor_id', auth()->user()->id)->where('app_coor', false)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('type', function (FormOvertimes $form) {
                return Str::title($form->type);
            })
            ->editColumn('app_coor', function (FormOvertimes $form) {
                $app_coor = new AllEmployesFormProgressingController;
                $app_coor = $app_coor->appCoordinator($form);

                return $app_coor;
            })

            ->addColumn('fullname', function (FormOvertimes $form) {
                $return = User::find($form->user_id);

                return $return->getFullName();
            })
            ->addColumn('nik', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->nik;
            })
            ->addColumn('department', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->getDepartment();
            })
            ->addColumn('position', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->position;
            })
            ->addColumn('action', function (FormOvertimes $form) {
                return view('all_employee.Form.Overtime.Approval.ProjectManager.actions', compact('form'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function modalProjectManagerApproved($id)
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

        $getProgressing = new AllEmployesFormProgressingController();
        $app_coor = $getProgressing->appCoordinator($form);
        $app_gm = $getProgressing->appGeneralManager($form);

        $nameBy = "!@#$%^&*()&";

        if (auth()->user()->pm === 1) {
            $nameBy = "Project Manager";
        }

        if (auth()->user()->producer === 1) {
            $nameBy = "Producer";
        }

        $approvalStatus = [
            'coordinator' => $app_coor,
            'generalManager' => $app_gm
        ];

        return view('all_employee.Form.Overtime.Approval.ProjectManager.modalApproved', compact(['form', 'duration', 'approvalStatus', 'nameBy']));
    }

    public function approvedProjectManager(Request $request, $id)
    {
        FormOvertimes::where('id', $id)->update(['app_coor' => true]);
        $formOvertime = FormOvertimes::with(['user', 'coordinator', 'projectManager', 'generalManager'])->find($id);
        Mail::to($formOvertime->generalManager->email)->send(new OvertimesMails($formOvertime));
        return redirect()->route('form/approval/projectmanager/index')->with('success', Lang::get('messages.data_custom', ['data' => 'Form access remote' . $formOvertime->user->getFullName() . ' has been approved.']));
    }

    public function disapprovedProjectManager(Request $request, $id)
    {
        FormOvertimes::where('id', $id)->update(['app_coor' => 2]);
        $formOvertime = FormOvertimes::with(['user', 'coordinator', 'projectManager'])->find($id);
        Mail::to($formOvertime->user->email)->send(new OvertimesDisapprovedMails($formOvertime));
        return redirect()->route('form/approval/projectmanager/index')->with('getError', Lang::get('messages.data_custom', ['data' => 'Form access remote ' . $formOvertime->user->getFullName() . ' has been disapproved.']));
    }

    public function indexGeneralManager()
    {
        return view('all_employee.Form.Overtime.Approval.GeneralManager.index');
    }

    public function dataIndexGeneralManager()
    {
        $data = FormOvertimes::where('gm_id', auth()->user()->id)->where('app_coor', 1)->where('app_gm', 0)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('type', function (FormOvertimes $form) {
                return Str::title($form->type);
            })
            ->editColumn('app_coor', function (FormOvertimes $form) {
                $app_coor = new AllEmployesFormProgressingController();
                $app_coor = $app_coor->appCoordinator($form);

                return $app_coor;
            })
            ->editColumn('app_gm', function (FormOvertimes $form) {
                $app_pm = new AllEmployesFormProgressingController;
                $app_pm = $app_pm->appGeneralManager($form);

                return $app_pm;
            })
            ->addColumn('fullname', function (FormOvertimes $form) {
                $return = User::find($form->user_id);

                return $return->getFullName();
            })
            ->addColumn('nik', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->nik;
            })
            ->addColumn('department', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->getDepartment();
            })
            ->addColumn('position', function (FormOvertimes $form) {
                $return = User::find($form->user_id);
                return $return->position;
            })
            ->addColumn('action', function (FormOvertimes $form) {
                return view('all_employee.Form.Overtime.Approval.GeneralManager.actions', compact('form'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function modalGeneramlManagerApproved($id)
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

        $getProgressing = new AllEmployesFormProgressingController();
        $app_coor = $getProgressing->appCoordinator($form);
        $app_gm = $getProgressing->appGeneralManager($form);

        $approvalStatus = [
            'coordinator' => $app_coor,
            'generalManager' => $app_gm
        ];

        return view('all_employee.Form.Overtime.Approval.GeneralManager.modalApproved', compact(['form', 'duration', 'approvalStatus']));
    }

    public function approvedGeneralManager(Request $request, $id)
    {
        FormOvertimes::where('id', $id)->update(['app_gm' => true]);
        $formOvertime = FormOvertimes::with(['user', 'coordinator', 'projectManager', 'generalManager'])->find($id);
        Mail::send(new OvertimesVerified($id));
        return redirect()->route('form/approval/generalmanager/index')->with('success', Lang::get('messages.data_custom', ['data' => 'Form access remote' . $formOvertime->user->getFullName() . ' has been approved.']));

        // form di teruskan ke IT
    }

    public function disapprovedGeneralManager(Request $request, $id)
    {
        FormOvertimes::where('id', $id)->update(['app_gm' => 2]);
        $formOvertime = FormOvertimes::with(['user', 'coordinator', 'projectManager'])->find($id);
        Mail::to($formOvertime->user->email)->send(new OvertimesDisapprovedMails($formOvertime));
        return redirect()->route('form/approval/generalmanager/index')->with('getError', Lang::get('messages.data_custom', ['data' => 'Form access remote ' . $formOvertime->user->getFullName() . ' has been disapproved.']));
    }
}