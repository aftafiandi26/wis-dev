<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class Leave_Transaction_Migrations_Page_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function migrationRoute()
    {
        if (auth()->user()->dept_category_id === 6) {
            // Leave_Transactions_Employes_Controller

            // pipeline
            if (auth()->user()->level_hrd !== "0") {
                if (auth()->user()->level_hrd === "Senior Pipeline") {
                    return redirect()->route('all_employes/leave/transaction/senior-pipeline/index');
                }
            } else {
                // coordinator
                if (auth()->user()->koor === 1) {
                    return redirect()->route('all_employes/leave/transaction/coordinator/index');
                }

                //supervisor
                if (auth()->user()->spv === 1) {
                    return redirect()->route('all_employes/leave/transaction/supervisor/index');
                }

                //project manager
                if (auth()->user()->pm === 1) {
                    return redirect()->route('all_employes/leave/transaction/pm/index');
                }

                //manager
                if (auth()->user()->hd === 1) {
                    return redirect()->route('all_employes/leave/transaction/hd/index');
                }

                return redirect()->route('all_employes/leave/transaction/index');
            }
        }

        return redirect()->back();
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

            if ($leave->ap_koor === 1) {
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
            $statFrontdesk = "(Verified - $leave->date_ver_hr)";
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

    public function foreachStatmentHD($leave)
    {
        $gm = User::where('active', 1)->where('user', 1)->where('gm', 1)->first();
        $ver_hr = User::where('active', 1)->where('user', 0)->where('hr', 1)->first();
        $hrd = User::where('active', 1)->where('hrd', 1)->first();
        $hd = User::where('active', 1)->where('hd', 1)->where('dept_category_id', auth()->user()->dept_category_id)->first();

        $statusHD = "(Pending)";

        if ($leave->ap_hd === 1) {
            $statusHD = "(Approved - " . $leave->date_ap_hd . ")";
        }

        $headOfDepartment = $hd->getFullName() . ' ' . $statusHD;

        $statusGM = "(Pending)";

        if ($leave->ap_gm === 1) {
            $statusGM = "(Approved - " . $leave->date_ap_gm . ')';
        }

        $generalManager = $gm->getFullName() . ' ' . $statusGM;

        $statusVerHR = "(Pending)";

        if ($leave->ver_hr === 1) {
            $statusVerHR = "(Verified - " . $leave->date_ver_hr . ')';
        }

        $verify = $ver_hr->getFullName() . ' ' . $statusVerHR;

        $statusHRD = "(Pending)";

        if ($leave->ap_hrd === 1) {
            $statusHRD = "(Confimed - " . $leave->date_ap_hrd . ')';
        }

        $hrd_verify = $hrd->getFullName() . ' ' . $statusHRD;

        $foreachStatment = [
            'hd' => $headOfDepartment,
            'gm' => $generalManager,
            'ver_hr' => $verify,
            'hrd' => $hrd_verify
        ];

        return $foreachStatment;
    }

    public function statusMailHD($leave)
    {
        $status = null;

        if ($leave->ap_gm == 0) {
            $status = User::where('active', 1)->where('gm', 1)->where('user', 1)->first();
        }
        if ($leave->ap_gm == 1 && $leave->ver_hr == 0) {
            $status = User::where('active', 1)->where('hr', 1)->where('user', 0)->first();
        }
        if ($leave->ap_gm == 1 && $leave->ver_hr == 1 && $leave->ap_hrd == 0) {
            $status = User::where('active', 1)->where('hrd', 1)->first();
        }

        if (auth()->user()->level_hrd === "Senior Pipeline" and $leave->ap_hd === 0) {
            $status = User::where('active', 1)->where('ap_hd', 1)->where('dept_category_id', auth()->user()->dept_category_id)->first();
        }

        return $status;
    }
}