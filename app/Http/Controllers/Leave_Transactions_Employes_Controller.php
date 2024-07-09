<?php

namespace App\Http\Controllers;

use App\Leave;
use App\Mail\Leave\EmployesProductionReminderMail;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;

class Leave_Transactions_Employes_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'production']);
    }

    private function header()
    {
        return "leave Transactions";
    }

    private function statusCoordinator($leave)
    {
        $status = "---";

        if ($leave->ap_koor === 1) {
            $status = "Approved";
        }

        if ($leave->ap_koor === 0) {
            $status = "Pending";
        }

        if ($leave->ap_koor === 2) {
            $status = "Disapproved";
        }

        return $status;
    }

    private function statusSupervisor($leave)
    {
        $status = "---";

        if ($leave->ap_spv === 0 && $leave->ap_koor === 0) {
            $status = "Waiting Coordinator";
        }

        if ($leave->ap_spv === 0 && $leave->ap_koor === 1) {
            $status = "Pending";
        }

        if ($leave->ap_spv === 1 && $leave->ap_koor === 1) {
            $status = "Approved";
        }

        if ($leave->ap_spv === 2) {
            $status = 'Disapoved';
        }
        return $status;
    }

    private function statusProjectManager($leave)
    {
        $status = "---";

        if ($leave->ap_spv === 0 && $leave->ap_koor === 0 && $leave->ap_pm === 0) {
            $status = "Waiting Coordinator";
        }

        if ($leave->ap_spv === 0 && $leave->ap_koor === 1 && $leave->ap_pm === 0) {
            $status = "Waiting SPV";
        }

        if ($leave->ap_spv === 1 && $leave->ap_koor === 1 && $leave->ap_pm === 0) {
            $status = "Pending";
        }

        if ($leave->ap_spv === 1 && $leave->ap_koor === 1 && $leave->ap_pm === 1) {
            $status = "Approved";
        }

        if ($leave->ap_pm === 2) {
            $status = 'Disapoved';
        }

        return $status;
    }

    private function statusHeadDepartmentProduction($leave)
    {
        $status = "---";

        if ($leave->ap_spv === 0 && $leave->ap_koor === 0 && $leave->ap_pm === 0 && $leave->ap_hd == 0) {
            $status = "Waiting Coordinator";
        }

        if ($leave->ap_spv === 0 && $leave->ap_koor === 1 && $leave->ap_pm === 0 && $leave->ap_hd == 0) {
            $status = "Waiting SPV";
        }

        if ($leave->ap_spv === 1 && $leave->ap_koor === 1 && $leave->ap_pm === 0 && $leave->ap_hd == 0) {
            $status = "Waiting PM";
        }

        if ($leave->ap_spv === 1 && $leave->ap_koor === 1 && $leave->ap_pm === 1 && $leave->ap_hd == 0) {
            $status = "Pending";
        }

        if ($leave->ap_hd == 1) {
            $status = "Approved";
        }

        if ($leave->ap_hd == 2) {
            $status = "Disapoved";
        }

        return $status;
    }

    private function statusHRProduction($leave)
    {
        $status = "---";

        if ($leave->ap_spv === 0 && $leave->ap_koor === 0 && $leave->ap_pm === 0 && $leave->ap_hd == 0 && $leave->ver_hr === 0 && $leave->ap_hrd === 0) {
            $status = "Waiting Coordinator";
        }

        if ($leave->ap_spv === 0 && $leave->ap_koor === 1 && $leave->ap_pm === 0 && $leave->ap_hd == 0 && $leave->ver_hr === 0 && $leave->ap_hrd === 0) {
            $status = "Waiting Supervior";
        }

        if ($leave->ap_spv === 1 && $leave->ap_koor === 1 && $leave->ap_pm === 0 && $leave->ap_hd == 0 && $leave->ver_hr === 0 && $leave->ap_hrd === 0) {
            $status = "Waiting Project Manager";
        }

        if ($leave->ap_spv === 1 && $leave->ap_koor === 1 && $leave->ap_pm === 1 && $leave->ap_hd == 0 && $leave->ver_hr === 0 && $leave->ap_hrd === 0) {
            $status = "Waiting Head of Department";
        }

        if ($leave->ap_hd == 1 && $leave->ver_hr === 0 && $leave->ap_hrd === 0) {
            $status = "Verifying..";
        }

        if ($leave->ap_hd == 1 && $leave->ver_hr === 1 && $leave->ap_hrd === 0) {
            $status = "Pending";
        }

        if ($leave->ap_hrd === 1) {
            $status = "Confirmed";
        }

        if ($leave->ap_hrd === 2) {
            $status = "Unconfirmed";
        }

        return $status;
    }

    private function foreachStatment($leave)
    {
        $return = new Leave_Transaction_Migrations_Page_Controller;
        $foreachStatment = $return->foreachStatment($leave);

        return $foreachStatment;
    }

    private function statusMail($leave)
    {
        $status = null;

        if ($leave->ap_koor === 0) {
            $status = User::where('email', $leave->email_koor)->first();
        }
        if ($leave->ap_koor === 1 && $leave->ap_spv === 0) {
            $status = User::where('email', $leave->email_spv)->first();
        }
        if ($leave->ap_spv === 1 && $leave->ap_pm === 0) {
            $status = User::where('email', $leave->email_pm)->first();
        }
        if ($leave->ap_pm === 1 && $leave->ap_hd === 0) {
            $status = User::where('dept_category_id', auth()->user()->dept_category_id)->where('hd', 1)->where('active', 1)->first();
        }
        if ($leave->ap_hd === 1 && $leave->ver_hr === 0) {
            $status = User::where('hr', 1)->where('user', 0)->where('active', 1)->first();
        }
        if ($leave->ver_hr === 1 && $leave->ap_hrd === 0) {
            $status = User::where('hrd', 1)->where('active', 1)->first();
        }

        return $status;
    }

    public function indexForEmployes()
    {
        $header = $this->header();

        if (auth()->user()->koor == 1 or auth()->user()->pm == 1 or auth()->user()->spv == 1 or auth()->user()->spv == 1 or auth()->user()->producer == 1) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry you cannot access !!']));
            return redirect()->route('index');
        }

        return view('all_employee.leave.employes.productions.staff.index_productions', compact(['header']));
    }

    public function datatablesForEmployes()
    {
        $data = Leave::where('user_id', auth()->user()->id)->latest()->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('category', function (Leave $leave) {
                return $leave->leaveName()->leave_category_name;
            })
            ->addColumn('status_coor', function (Leave $leave) {
                $status = $this->statusCoordinator($leave);

                return $status;
            })
            ->addColumn('status_spv', function (Leave $leave) {
                $status = $this->statusSupervisor($leave);

                return $status;
            })
            ->addColumn('status_pm', function (Leave $leave) {
                $status = $this->statusProjectManager($leave);

                return $status;
            })
            ->addColumn('status_hd', function (Leave $leave) {
                $status = $this->statusHeadDepartmentProduction($leave);

                return $status;
            })
            ->addColumn('status_hr', function (Leave $leave) {
                $status = $this->statusHRProduction($leave);

                return $status;
            })
            ->addColumn('actions', function (Leave $leave) {
                return view('all_employee.leave.employes.productions.staff.actionsProductions', compact('leave'));
            })
            ->rawColumns(['actions'])
            ->setRowClass(function (Leave $leave) {
                $return = null;

                if ($leave->leave_category_id === 2) {
                    $return = "text-green";
                }

                if ($leave->leave_category_id > 2) {
                    $return = "text-darkblue";
                }

                return $return;
            })
            ->make(true);
    }

    public function detailDatatablesForEmployes($id)
    {
        $leave = Leave::find($id);

        $foreachStatment = $this->foreachStatment($leave);

        return view('all_employee.leave.employes.productions.staff.actions.detail', compact(['leave', 'foreachStatment']));
    }

    public function generePDF($id)
    {
        $leave = Leave::find($id);

        $foreachStatment = $this->foreachStatment($leave);

        $header = $this->header();

        $pdf = PDF::loadview('all_employee.leave.employes.productions.staff.actions.download', compact(['leave', 'header', 'foreachStatment']));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('leave_transaction.pdf');
    }

    public function reminderDatatablesForEmployes($id)
    {
        $leave = Leave::find($id);

        $status = $this->statusMail($leave);

        $send = User::select('first_name', 'last_name', 'email')->where('id', 226)->first();

        return view('all_employee.leave.employes.productions.staff.actions.reminder', compact(['leave', 'status', 'send', 'id']));
    }

    public function sendReminder(Request $request, $id)
    {
        $data = [
            'form' => $request->input('from'),
            'to' => $request->input('send'),
            'message' => $request->input('message')
        ];

        $leave = Leave::find($id);

        if ($leave->resendmail === 0) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, you have exceeded your reminder capacity !!']));
            return redirect()->route('all_employes/leave/transaction/index');
        }

        Mail::send(new EmployesProductionReminderMail($data));

        return redirect()->route('all_employes/leave/transaction/index');
    }

    public function deleteDatatablesForEmployes($id)
    {
        return view('all_employee.leave.employes.productions.staff.actions.delete', compact(['id']));
    }

    public function postDeleteDatatablesForEmployes($id)
    {
        $leave = Leave::find($id);

        $leave->delete();

        Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Form deleted. ']));
        return redirect()->route('all_employes/leave/transaction/index');
    }
}