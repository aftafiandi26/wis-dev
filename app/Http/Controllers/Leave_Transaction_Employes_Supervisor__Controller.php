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

class Leave_Transaction_Employes_Supervisor__Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'production', 'spv']);
    }

    private function header()
    {
        return "leave Transactions";
    }

    private function statusProducer($leave)
    {
        $status = "---";

        if ($leave->ap_pm === 0 && $leave->ap_producer === 0 && $leave->ap_spv === 1) {
            $status = "Waiting PM";
        }

        if ($leave->ap_pm === 1 && $leave->ap_producer === 0) {
            $status = "Pending";
        }


        if ($leave->ap_producer === 1) {
            $status = "Approved";
        }

        if ($leave->ap_producer === 2) {
            $status = "Disapoved";
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

        if ($leave->ap_pm === 0 && $leave->ap_producer == 0) {
            $status = "Waiting PM";
        }

        if ($leave->ap_pm === 1 && $leave->ap_producer == 0) {
            $status = "Waiting Producer";
        }

        if ($leave->ap_pm === 1 && $leave->ap_producer == 1 && $leave->ap_hd === 0) {
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

        if ($leave->ap_pm == 0) {
            $status = "Waiting PM";
        }
        if ($leave->ap_pm == 1 &&  $leave->ap_producer == 0) {
            $status = "Waiting Producer";
        }
        if ($leave->ap_producer == 1 && $leave->ap_hd == 0) {
            $status = "Waiting Head Of Department";
        }
        if ($leave->ap_hd == 1 && $leave->ver_hr == 0) {
            $status = "Verifying...";
        }
        if ($leave->ver_hr == 1 && $leave->ap_hrd == 0) {
            $status = "Pending HR Manager";
        }
        if ($leave->ap_hrd == 1) {
            $status = "Confirmed";
        }

        if ($leave->ver_hr == 2) {
            $status = "Unverified";
        }
        if ($leave->ap_hrd == 2) {
            $status = "Rejected";
        }

        return $status;
    }

    private function foreachStatment($leave)
    {
        $return = new Leave_Transaction_Migrations_Page_Controller;
        $foreachStatment = $return->foreachStatment($leave);

        return $foreachStatment;
    }

    public function indexEmployes()
    {
        $header = $this->header();

        return view('all_employee.leave.employes.productions.supervisor.index', compact(['header']));
    }

    public function datatatable()
    {
        $data = Leave::where('user_id', auth()->user()->id)->latest()->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('category', function (Leave $leave) {
                return $leave->leaveName()->leave_category_name;
            })
            ->addColumn('status_pm', function (Leave $leave) {
                $status = $this->statusProjectManager($leave);

                return $status;
            })
            ->addColumn('status_producer', function (Leave $leave) {
                $status = $this->statusProducer($leave);

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
                return view('all_employee.leave.employes.productions.supervisor.actions', compact('leave'));
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

    public function detail($id)
    {
        $leave = Leave::find($id);

        $foreachStatment = $this->foreachStatment($leave);

        return view('all_employee.leave.employes.productions.supervisor.actions.detail', compact(['leave', 'foreachStatment']));
    }

    public function generePDF($id)
    {
        $leave = Leave::find($id);

        $foreachStatment = $this->foreachStatment($leave);

        $header = $this->header();

        $pdf = PDF::loadview('all_employee.leave.employes.productions.supervisor.actions.download', compact(['leave', 'header', 'foreachStatment']));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('leave_transaction.pdf');
    }

    public function reminderMail($id)
    {
        $leave = Leave::find($id);

        $foreachStatment = $this->foreachStatment($leave);

        $status = $this->statusHRProduction($leave);

        $send = User::select('first_name', 'last_name', 'email')->where('id', 226)->first();

        return view('all_employee.leave.employes.productions.supervisor.actions.reminder', compact(['leave', 'foreachStatment', 'send', 'id']));
    }

    public function sendReminder(Request $request, $id)
    {
        $data = [
            'form' => $request->input('from'),
            'to' => $request->input('send'),
            'message' => $request->input('message')
        ];

        $leave = Leave::find($id);

        $resendmail = $leave->resendmail - 1;

        if ($leave->resendmail === 0) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, you have exceeded your reminder capacity !!']));
            return redirect()->route('all_employes/leave/transaction/supervisor/index');
        }

        Mail::send(new EmployesProductionReminderMail($data));

        $leave->update(['resendmail' => $resendmail]);
        Session::flash('reminder', Lang::get('messages.data_custom', ['data' => "Reminder sent successfully. You have reminder " . $resendmail . "X."]));
        return redirect()->route('all_employes/leave/transaction/supervisor/index');
    }

    public function delete($id)
    {
        return view('all_employee.leave.employes.productions.supervisor.actions.delete', compact(['id']));
    }

    public function postDelete($id)
    {
        $leave = Leave::find($id);

        $leave->delete();

        Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Form deleted. ']));
        return redirect()->route('all_employes/leave/transaction/supervisor/index');
    }
}