<?php

namespace App\Http\Controllers;

use App\Leave;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;

class HD_PipelineApporvalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'pipeline2']);
    }

    public function index()
    {
        return view('Pipeline2.leavel.indexApproval');
    }

    public function dataTables()
    {
        $users = User::where('active', 1)
            ->where('dept_category_id', auth()->user()->dept_category_id)
            ->pluck('id')
            ->map(function ($id) {
                return (int) $id;
            })
            ->toArray();

        $leave = Leave::whereIn('user_id', $users)->where('ap_hd', false)->orderBy('leave_date', 'asc')->get();

        return Datatables::of($leave)
            ->addIndexColumn()
            ->addColumn('actions', 'Pipeline2.leavel.actions')
            ->editColumn('leave_category_id', function (Leave $leave) {
                return $leave->leaveName()->leave_category_name;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function foreachStatment($leave)
    {
        $producer = null;
        if ($leave->email_producer !== Null) {
            $producer = User::where('active', 1)->where('email', $leave->email_producer)->first();
            $statProducer = "(Pending)";
            if ($leave->ap_producer === 1) {
                $statProducer = "(Approved - $leave->date_producer)";
            }
            $producer = "Producer : " . $producer->getFullName() . " " . $statProducer;
        }

        $projectManager = Null;
        if ($leave->email_pm !== Null) {
            $projectManager = User::where('active', 1)->where('email', $leave->email_pm)->first();
            $statPM = "(Pending)";
            if ($leave->ap_pm === 1) {
                $statPM = "(Approved - $leave->date_ap_pm)";
            }
            $projectManager = "Project Manager : " . $projectManager->getFullName() . " " . $statPM;
        }

        $spv = null;
        if ($leave->email_spv !== Null) {
            $spv = User::where('active', 1)->where('email', $leave->email_spv)->first();

            $statSpv = "(Pending)";

            if ($leave->ap_spv === 1) {
                $statSpv = "(Approved - $leave->date_ap_spv)";
            }

            $spv = "Supervisor : " . $spv->getFullName() . " " . $statSpv;
        }

        $coordinator = null;
        if ($leave->email_koor !== Null) {
            $coordinator = User::where('active', 1)->where('email', $leave->email_koor)->first();

            $statCoor = "(Pending)";

            if ($leave->ap_spv === 1) {
                $statCoor = "(Approved - $leave->date_ap_koor)";
            }

            $coordinator = "Coordinator : " . $coordinator->getFullName() . " " . $statCoor;
        }

        if ($leave->user()->dept_category_id === 6) {
            $hod = User::where('active', 1)->where('hd', 1)->where('dept_category_id', $leave->user()->dept_category_id)->first();
            $statHOD = "(Pending)";
            if ($leave->ap_hd === 1) {
                $statHOD = "Approved - ($leave->date_ap_hd)";
            }
            $hod = "Head of Department : " . $hod->getFullName() . " " . $statHOD;
        } else {
            $hod = User::where('active', 1)->where('email', $leave->email_pm)->first();
            $statHOD = "(Pending)";
            if ($leave->ap_hd === 1) {
                $statHOD = "(Approved - $leave->date_ap_hd)";
            }
            $hod = "Head of Department : " . $hod->getFullName() . " " . $statHOD;
        }

        $frontdesk = User::where('hr', 1)->first();
        $statFrontdesk = "(Waiting)";
        if ($leave->ver_hr === 1) {
            $statFrontdesk = "(Verified - $leave->date_ver_hr";
        }

        $frontdesk = "HRD : Frontdesk " . $statFrontdesk;

        $hrdManager = User::where('hrd', 1)->where('active', 1)->first();
        $statHRD = "(Waiting)";
        if ($leave->ap_hrd === 1) {
            $statHRD = "(Confirm - $leave->date_ap_hrd)";
        }

        $hrdManager = "HR Managaer : " . $hrdManager->getFullName() . " " . $statHRD;

        $foreachStatment = [
            'coordinator' => $coordinator,
            'spv' => $spv,
            'projectManager' => $projectManager,
            'producer' => $producer,
            'hod' => $hod,
            'frontdesk' => $frontdesk,
            'hrdManager' => $hrdManager
        ];

        return $foreachStatment;
    }

    public function modalApproval($id)
    {

        $leave = Leave::find($id);

        $foreachStatment = $this->foreachStatment($leave);

        return view('Pipeline2.leavel.modalApproval', compact(['leave', 'foreachStatment']));
    }

    public function approval($id)
    {
        $email  = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);
        // $leave = Leave::find($id);

        $hr = User::find(279);
        $data = [
            'ap_hd'         => true,
            'date_ap_hd'    => date('Y-m-d'),
            'resendmail'    => 2,
        ];

        // Mail::send('email.verMail', ['email' => $email], function ($message) use ($email, $hr) {
        //     $message->to($hr->email)->subject('[Approved] Leave Application - ' . $email->request_by . '');
        //     $message->from('wis_system@infinitestudios.id', 'WIS');
        // });

        Leave::where('id', $id)->update($data);

        Session::flash('message', Lang::get('messages.data_custom', ['data' =>  $email->request_by . ' leave application form was approved']));
        return redirect()->route('leave/hd/pipeline');
    }

    public function disapproval($id)
    {
        $email  = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);
        $leave = Leave::find($id);

        $data = [
            'ap_hd'         => 2,
            'ver_hr'        => 2,
            'ap_hrd'        => 5,
            'date_ap_hd'    => date('Y-m-d'),
            'resendmail'    => 2,
            'formStat'      => false
        ];

        // Mail::send('email.disapproveMail', ['email' => $email], function ($message) use ($email) {
        //     $message->to($email->email)->subject('[Disapproved] Leave Application - WIS');
        //     $message->from('wis_system@infinitestudios.id', 'WIS');
        // });

        Leave::where('id', $id)->update($data);

        Session::flash('message', Lang::get('messages.data_custom', ['data' =>  $leave->request_by . ' leave application form was disapproved']));
        return redirect()->route('leave/hd/pipeline');
    }
}