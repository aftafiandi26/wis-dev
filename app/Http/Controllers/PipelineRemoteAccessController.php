<?php

namespace App\Http\Controllers;

use App\FormOvertimes;
use App\User;
use Illuminate\Http\Request;
use Datatables;
use DateTime;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;

class PipelineRemoteAccessController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'pipelineTechnology']);
    }

    public function indexProgress()
    {
        $data = User::where('level_hrd', 'like', '%Pipeline%')->where('position', 'like', '%Technology%')->where('active', 1)->where('id', auth()->user()->id)->first();

        return view('Pipeline.Form.Overtimes.progressing.index');
    }

    public function dataProgress()
    {
       $data = FormOvertimes::where('startovertime', '>=', date('Y-m-d') . " 00:00")->where('startovertime', '<=', date("Y-m-d", strtotime("+ 24 hours")))->orderBy('startovertime', 'dasc')->get();

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
                return view('Pipeline.Form.Overtimes.progressing.actions', compact(['form']));
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

        return view('Pipeline.Form.Overtimes.progressing.modal', compact(['form', 'duration', 'approvalStatus']));
    }
}