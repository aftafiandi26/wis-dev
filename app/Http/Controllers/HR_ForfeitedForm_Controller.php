<?php

namespace App\Http\Controllers;

use App\ForfeitedCounts;
use App\Leave;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\CssSelector\Node\FunctionNode;
use Yajra\Datatables\Facades\Datatables;

class HR_ForfeitedForm_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    private function foreachStatment($leave)
    {
        $producer = null;
        if ($leave->email_producer !== Null) {
            $producer = User::where('email', $leave->email_producer)->first();
            $statProducer = "(Pending)";
            if ($leave->ap_producer === 1) {
                $statProducer = "(Approved - $leave->date_producer)";
            }
            $producer = "Producer : " . $producer->getFullName() . " " . $statProducer;
        }

        $projectManager = Null;
        if ($leave->email_pm !== Null) {
            $projectManager = User::where('email', $leave->email_pm)->first();
            $statPM = "(Pending)";
            if ($leave->ap_pm === 1) {
                $statPM = "(Approved - $leave->date_ap_pm)";
            }
            $projectManager = "Project Manager : " . $projectManager->getFullName() . " " . $statPM;
        }

        $spv = null;
        if ($leave->email_spv !== Null) {
            $spv = User::where('email', $leave->email_spv)->first();

            $statSpv = "(Pending)";

            if ($leave->ap_spv === 1) {
                $statSpv = "(Approved - $leave->date_ap_spv)";
            }

            $spv = "Supervisor : " . $spv->getFullName() . " " . $statSpv;
        }

        $coordinator = null;
        if ($leave->email_koor !== Null) {
            $coordinator = User::where('email', $leave->email_koor)->first();

            $statCoor = "(Pending)";

            if ($leave->ap_koor === 1) {
                $statCoor = "(Approved - $leave->date_ap_koor)";
            }

            $coordinator = "Coordinator : " . $coordinator->getFullName() . " " . $statCoor;
        }

        if ($leave->user()->dept_category_id === 6) {
            $hod = User::where('hd', 1)->where('dept_category_id', $leave->user()->dept_category_id)->first();
            $statHOD = "(Pending)";
            if ($leave->ap_hd === 1) {
                $statHOD = "Approved - ($leave->date_ap_hd)";
            }
            $hod = "Head of Department : " . $hod->getFullName() . " " . $statHOD;
        } else {
            $hod = User::where('email', $leave->email_pm)->first();
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

        $hrdManager = User::where('hrd', 1)->first();
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

    private function userAll()
    {
        $users = User::where('active', 1)->whereNotIn('nik', ['', '123456789'])->orderBy('first_name', 'asc')->get();
        return $users;
    }

    public function index()
    {
        $users = $this->userAll();

        return view('HRDLevelAcces.forfeited.form.index', compact(['users']));
    }

    public function datatables()
    {
        $query = ForfeitedCounts::orderBy('id', 'desc')->where('amount', '>', 0)->where('status', true)->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (ForfeitedCounts $x) {
                $x = User::find($x->user_id);
                return $x->getFullName();
            })
            ->addColumn('nik', function (ForfeitedCounts $x) {
                $x = User::find($x->user_id);
                return $x['nik'];
            })
            ->addColumn('position', function (ForfeitedCounts $x) {
                $x = User::find($x->user_id);
                return $x->position;
            })
            ->addColumn('department', function (ForfeitedCounts $x) {
                $x = User::find($x->user_id);

                return $x->getDepartment();
            })
            ->addColumn('startLeave', function (ForfeitedCounts $x) {
                $x = Leave::find($x->leave_id);
                $y = new Carbon($x['leave_date']);

                return $y->toFormattedDateString();
            })
            ->addColumn('form', 'HRDLevelAcces.forfeited.form.buttonFormLeave')
            ->rawColumns(['form'])
            ->make(true);
    }

    public function modalformleave($id)
    {
        $x = ForfeitedCounts::Find($id);

        $leave = Leave::find($x['leave_id']);
        $foreachStatment = $this->foreachStatment($leave);

        return view('HRDLevelAcces.forfeited.form.modalFormLeave', compact('leave', 'foreachStatment'));
    }

    public function reloadPage(Request $request)
    {
        $id = $request->input('emp');

        return redirect()->route('forfeited/indexPerson', $id);
    }

    public function indexPerson($id)
    {
        $users = $this->userAll();

        return view('HRDLevelAcces.forfeited.form.indexPerson', compact(['users', 'id']));
    }

    public function datatablesPerson($id)
    {

        $query = ForfeitedCounts::orderBy('id', 'desc')->where('amount', '>', 0)->where('status', true)->where('user_id', $id)->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (ForfeitedCounts $x) {
                $x = User::find($x->user_id);
                return $x->getFullName();
            })
            ->addColumn('nik', function (ForfeitedCounts $x) {
                $x = User::find($x->user_id);
                return $x['nik'];
            })
            ->addColumn('position', function (ForfeitedCounts $x) {
                $x = User::find($x->user_id);
                return $x->position;
            })
            ->addColumn('department', function (ForfeitedCounts $x) {
                $x = User::find($x->user_id);

                return $x->getDepartment();
            })
            ->addColumn('startLeave', function (ForfeitedCounts $x) {
                $x = Leave::find($x->leave_id);
                $y = new Carbon($x['leave_date']);

                return $y->toFormattedDateString();
            })
            ->addColumn('form', 'HRDLevelAcces.forfeited.form.buttonFormLeave')
            ->rawColumns(['form'])
            ->make(true);
    }
}