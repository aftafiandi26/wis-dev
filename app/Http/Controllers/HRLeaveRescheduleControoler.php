<?php

namespace App\Http\Controllers;

use App\Entitled_leave_view;

use App;
use App\Dept_Category;
use App\Http\Controllers\Controller;
use App\Initial_Leave;
use App\Leave;
use App\Meeting;
use App\Leave_backup;
use App\Leave_Category;
use App\NewUser;
use App\Project_Category;
use App\Forfeited;
use App\ForfeitedCounts;
use App\Log_Leave_Transaction;
use App\Mail\HRD\RescheduleLeave\Approved;
use App\Mail\HRD\RescheduleLeave\sendMailReschedule;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class HRLeaveRescheduleControoler extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function index()
    {
        return view('HRDLevelAcces.leave.reschedule.index');
    }

    public function dataIndex()
    {
        $date1 = date('m', strtotime('-1 month'));
        $date2 = date('m', strtotime('+1 month'));

        $modal = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->select([
            'leave_transaction.id', 'leave_transaction.leave_date', 'leave_transaction.end_leave_date', 'leave_transaction.back_work',
            'users.nik', 'users.first_name', 'users.last_name', 'users.position',
            'dept_category.dept_category_name',
            'leave_category.leave_category_name'
        ])
            ->where('users.active', 1)
            // ->whereYear('leave_transaction.leave_date', date('Y'))
            // ->whereMonth('leave_transaction.leave_date', '>=', $date1)
            // ->whereMonth('leave_transaction.leave_date', '<=', $date2)
            ->where('ap_hrd', 0)
            // ->where('users.nik', '12008001')
            ->orderBy('leave_transaction.leave_date', 'asc')
            ->get();

        return Datatables::of($modal)
            ->addIndexColumn()
            ->addColumn('fullname', '{{ $first_name }} {{ $last_name }}')
            ->addColumn('actions', function (Leave $leave) {
                $id = $leave->id;

                $edit = '<a class="btn btn-xs btn-warning" href="' . route('leave/reschedule/edit', $id) . '" title="Edit this form"><i class="fa fa-pencil"></i></a>';

                $view = '<a class="btn btn-xs btn-default" data-role="' . route('leave/reschedule/view', $id) . '" data-toggle="modal" data-target="#showModal" id="view" title="View this form"><i class="fa fa-eye"></i></a>';

                $approved = '<a class="btn btn-xs btn-primary" data-role="' . route('leave/reschedule/approved', $id) . '" data-toggle="modal" data-target="#showModalButton" id="approved" title="Approve this form"><i class="fa fa-check"></i></a>';

                $delete = '<a class="btn btn-xs btn-danger" data-role="' . route('leave/reschedule/disapproved', $id) . '" data-toggle="modal" data-target="#modalDelete" id="delete" title="Delete this form"><i class="fa fa-trash"></i></a>';

                return $edit . " " . $view . " " . $approved . " " . $delete;
            })
            ->addColumn('status', function (Leave $leave) {
                $stat = Leave::find($leave->id);
                $user = User::where('nik', $leave->nik)->first();

                $status = $this->returnStatus($stat);

                if ($user->hd === 1) {
                    if ($stat->ap_gm === 0) {
                        $status = "Pending GM";
                    }
                }

                if ($user->gm === 1) {
                    if ($stat->ver_hr === 0) {
                        $status = "Checking Verify";
                    }
                }

                return $status;
            })
            ->make(true);
    }

    public function editReschedule($id)
    {
        $leave = Leave::find($id);
        $user = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);

        $leaveCategory = Leave_Category::all();

        $annualAvailable = $this->dataAnnual($id);

        $totalAnnual = $this->dataTotalAnnual($id);

        $exdoAvailable = $this->dataExdo($id);

        $coordinator = null;
        $spv = null;
        $pm = null;
        $producer = null;

        $hod = User::where('dept_category_id', $user->dept_category_id)->where('hd', 1)->where('active', 1)->first();
        $general = "Head of Department";
        if ($user->hd === 1) {
            $general = "General Manager";
            $hod = User::where('gm', 1)->where('active', 1)->first();
        }


        $coordinatorList = User::where('active', 1)->where('koor', 1)->where('dept_category_id', $user->dept_category_id)->orderBy('first_name', 'asc')->get();
        $spvList = User::where('active', 1)->where('spv', 1)->where('dept_category_id', $user->dept_category_id)->orderBy('first_name', 'asc')->get();
        $pmList = User::where('active', 1)->where('pm', 1)->where('dept_category_id', $user->dept_category_id)->orderBy('first_name', 'asc')->get();
        $producerList = User::where('active', 1)->where('producer', 1)->where('dept_category_id', $user->dept_category_id)->orderBy('first_name', 'asc')->get();

        if ($leave->email_koor !== Null) {
            $coordinator = User::where('email', $leave->email_koor)->first();
        }

        if ($leave->email_spv !== Null) {
            $spv = User::where('email', $leave->email_spv)->first();
        }

        if ($leave->email_pm !== Null) {
            $pm = User::where('email', $leave->email_pm)->first();

            if ($user->dept_category_id === 6) {
                foreach ($pmList as $findPM) {
                    if ($findPM->id !== $pm->id) {
                        $ppm[] = $findPM;
                    }
                }
                array_push($ppm, $pm);
                $pmList = $ppm;
            }
        }

        if ($leave->email_producer !== Null) {
            $producer = User::where('email', $leave->email_producer)->first();
        }

        if ($user->hd === 1) {
            $hod = User::where('gm', 1)->where('active', 1)->first();
        }

        return view('HRDLevelAcces.leave.reschedule.edit', compact(['leave', 'user', 'annualAvailable', 'exdoAvailable', 'leaveCategory', 'totalAnnual', 'coordinator', 'coordinatorList', 'spv', 'spvList', 'pm', 'pmList', 'producer', 'producerList', 'hod', 'general']));
    }

    public function dataAnnual($id)
    {
        $user = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);

        $annual = DB::table('users')
            ->leftJoin('initial_leave', 'initial_leave.user_id', '=', 'users.id')
            ->leftJoin('leave_category', 'leave_category.id', '=', 'initial_leave.leave_category_id')
            ->leftJoin('leave_transaction', 'leave_transaction.user_id', '=', 'users.id')->select([
                DB::raw('
            (
                select (
                    select COALESCE(sum(total_day), 0) from leave_transaction where user_id=' . $user->user_id . ' and leave_category_id=1
                    and ap_hd  = 1
                    and ap_gm  = 1
                    and ver_hr = 1
                    and ap_hrd = 1
                )
            ) as transactionAnnual')
            ])
            ->first();


        $startDate = date_create($user->join_date);
        $endDate = date_create($user->end_date);

        $startYear = date('Y', strtotime($user->join_date));
        $endYear = date('Y', strtotime($user->end_date));

        if ($user->emp_status === "Permanent") {
            $yearEnd = date('Y');
        } else {
            $yearEnd = $endYear;
        }

        $now = date_create(date('Y-m-d'));
        $now1 = date_create(date('Y') . '-01-01');
        $now2 = date_create(date('Y') . '-12-31');

        // date_create('2021-05-15') penambahan bulan terjadi
        // dd($now);

        if ($now <= $endDate) {
            $sekarang = $now;
        } else {
            $sekarang = $endDate;
        }

        $interval = date_diff(date_create($user->join_date),  date_create(date('Y-m-d')));

        $pass = $interval->y * 12;

        $passs = $pass + $interval->m;

        $daffPermanent = date_diff($now1, $now)->format('%m') + (12 * date_diff($now1, $now->modify('+5 day'))->format('%y'));

        $daffPermanent2 = date_diff($now1, $now2)->format('%m') + (12 * date_diff($now1, $now2->modify('+5 day'))->format('%y'));

        $daffPermanent1 = 12 - $daffPermanent;

        if ($passs <= $annual->transactionAnnual) {
            $newAnnual =  $annual->transactionAnnual;
        } else {
            $newAnnual = $passs;
        }

        $totalAnnual = $newAnnual - $annual->transactionAnnual;

        $totalAnnualPermanent = $user->initial_annual - $annual->transactionAnnual;

        $totalAnnualPermanent1 = $totalAnnualPermanent - $daffPermanent1;

        $return = null;

        if ($user->emp_status === "Permanent") {
            $return = $totalAnnualPermanent1;
        } else {
            $return = $totalAnnual;
        }


        return $return;
    }

    public function dataExdo($id)
    {
        $user = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);

        $exdo = Initial_Leave::where('user_id', $user->user_id)->pluck('initial');

        $w = Initial_Leave::where('user_id', $user->user_id)
            ->whereDATE('expired', '<', date('Y-m-d'))
            ->pluck('initial');

        $expiredExdo = $w;

        $minusExdo = Leave::where('user_id', $user->user_id)->where('leave_category_id', 2)->where('ap_hd', 1)->where('ap_gm', 1)->where('ver_hr', 1)->where('ap_hrd', 1)->pluck('total_day');

        $goingExdo = 0;

        if ($expiredExdo->sum() >= $minusExdo->sum()) {
            $goingExdo = $expiredExdo->sum() - $minusExdo->sum();
        }

        $sisaExdo = $exdo->sum() - $minusExdo->sum() - $goingExdo;


        return $sisaExdo;
    }

    public function dataTotalAnnual($id)
    {
        $user = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()->find($id);

        $annual = DB::table('users')
            ->leftJoin('initial_leave', 'initial_leave.user_id', '=', 'users.id')
            ->leftJoin('leave_category', 'leave_category.id', '=', 'initial_leave.leave_category_id')
            ->leftJoin('leave_transaction', 'leave_transaction.user_id', '=', 'users.id')->select([
                DB::raw('
            (
                select (
                    select COALESCE(sum(total_day), 0) from leave_transaction where user_id=' . $user->user_id . ' and leave_category_id=1
                    and ap_hd  = 1
                    and ap_gm  = 1
                    and ver_hr = 1
                    and ap_hrd = 1
                )
            ) as transactionAnnual')
            ])
            ->first();


        $startDate = date_create($user->join_date);
        $endDate = date_create($user->end_date);

        $startYear = date('Y', strtotime($user->join_date));
        $endYear = date('Y', strtotime($user->end_date));

        if ($user->emp_status === "Permanent") {
            $yearEnd = date('Y');
        } else {
            $yearEnd = $endYear;
        }

        $now = date_create(date('Y-m-d'));
        $now1 = date_create(date('Y') . '-01-01');
        $now2 = date_create(date('Y') . '-12-31');

        // date_create('2021-05-15') penambahan bulan terjadi
        // dd($now);

        if ($now <= $endDate) {
            $sekarang = $now;
        } else {
            $sekarang = $endDate;
        }

        $interval = date_diff(date_create($user->join_date),  date_create(date('Y-m-d')));

        $pass = $interval->y * 12;

        $passs = $pass + $interval->m;

        $daffPermanent = date_diff($now1, $now)->format('%m') + (12 * date_diff($now1, $now->modify('+5 day'))->format('%y'));

        $daffPermanent2 = date_diff($now1, $now2)->format('%m') + (12 * date_diff($now1, $now2->modify('+5 day'))->format('%y'));

        $daffPermanent1 = 12 - $daffPermanent;

        if ($passs <= $annual->transactionAnnual) {
            $newAnnual =  $annual->transactionAnnual;
        } else {
            $newAnnual = $passs;
        }

        $totalAnnual = $newAnnual - $annual->transactionAnnual;

        $totalAnnualPermanent = $user->initial_annual - $annual->transactionAnnual;

        $totalAnnualPermanent1 = $totalAnnualPermanent - $daffPermanent1;

        $forfeited = Forfeited::where('user_id', auth::user()->id)->pluck('countAnnual');
        $forfeitedCounts = ForfeitedCounts::where('user_id', auth::user()->id)->where('status', 1)->pluck('amount');
        $countAmount = $forfeited->sum() - $forfeitedCounts->sum();


        $bla = 0;
        if ($countAmount >= 0) {
            $bla = $countAmount;
        } else {
            $bla = 0;
        }

        $renewPermanet = $totalAnnualPermanent1 - $bla;
        $renewContract = $totalAnnual - $bla;


        return $totalAnnualPermanent;
    }

    public function updateRescheduleAnnual(Request $request, $id)
    {
        $leave = Leave::find($id);

        $startLeave = $request->input('startLeave');
        $endLeave   = $request->input('endLeave');
        $backWork   = $request->input('backWork');
        $requestDay = $request->input('requestDay');

        $coordinator = null;
        if (!empty($request->input('coordinator'))) {
            $coordinator = User::select('email')->find($request->input('coordinator'));
            $coordinator = $coordinator['email'];
        }

        $spv = null;
        if (!empty($request->input('spv'))) {
            $spv = User::select('email')->find($request->input('spv'));
            $spv = $spv['email'];
        }

        $projectManager = null;
        if (!empty($request->input('projectManager'))) {
            $projectManager = User::select('email')->find($request->input('projectManager'));
            $projectManager = $projectManager['email'];
        }

        $producer = Null;
        if (!empty($request->input('producer'))) {
            $producer = User::select('email')->find($request->input('producer'));
            $producer = $producer['email'];
        }

        $interval = date_diff(date_create('2021-01-01'),  date_create('2021-01-31'));
        $pass = $interval->y * 12;
        $passs = $pass + $interval->m + 1;

        $rules = [
            'leaveCategory' => 'required',
            'startLeave'    => 'required|date',
            'endLeave'      => 'required|date',
            'backWork'      => 'required|date',
            'requestDay'    => 'required|numeric'
        ];

        $data = [
            'leave_category_id' => $request->input('leaveCategory'),
            'leave_date'        => $request->input('startLeave'),
            'end_leave_date'    => $request->input('endLeave'),
            'back_work'         => $request->input('backWork'),
            'total_day'         => $request->input('requestDay'),
            'coordinator_id'    => $request->input('coordinator'),
            'email_koor'        => $coordinator,
            'spv_id'            => $request->input('spv'),
            'email_spv'         => $spv,
            'pm_id'             => $request->input('projectManager'),
            'email_pm'          => $projectManager,
            'producer_id'       => $request->input('producer'),
            'email_producer'    => $producer
        ];



        if ($startLeave > $endLeave) {
            $alert = 'Opss!!, date is not valid, please check again!!';
            return redirect()->back()->with('getError', $alert);
        }
        if ($endLeave > $backWork) {
            $alert = 'Opss!!, date is not valid, please check again!!';
            return redirect()->back()->with('getError', $alert);
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('leave/reschedule/edit', $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data leave transaction ' . $leave->user()->first_name . ' ' . $leave->user()->last_name]));
            Leave::where('id', $id)->update($data);
            if ($request->input('send')) {
                $this->sendEmailReschedule($leave->id);
            }
            return redirect()->route('leave/reschedule/index');
        }
    }

    private function returnStatus($stat)
    {
        $status = '--';

        if ($stat->ap_koor === 0) {
            $status = 'Pending Coordinator';
        } else {
            if ($stat->ap_spv === 0) {
                $status = 'Pending SPV';
            } else {
                if ($stat->ap_pm === 0) {
                    $status = 'Pending PM';
                } else {
                    if ($stat->ap_producer === 0) {
                        $status = 'Pending Producer';
                    } else {
                        if ($stat->ap_hd === 0) {
                            $status = 'Pending Head Of Department';
                        } else {
                            if ($stat->ver_hr === 0) {
                                $status = 'Pending HR';
                            } else {
                                if ($stat->ap_hrd === 0) {
                                    $status = 'Pending HR Manager';
                                } else {
                                    $status = 'Complete';
                                }
                            }
                        }
                    }
                }
            }
        }

        return $status;
    }

    private function sendEmailReschedule($id)
    {
        $data = Leave::find($id);

        Mail::to($data->user()->email)->send(new sendMailReschedule($data));
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

    public function viewReschedule($id)
    {
        $leave = Leave::find($id);

        $foreachStatment = $this->foreachStatment($leave);

        return view('HRDLevelAcces.leave.reschedule.view', compact(['leave', 'foreachStatment']));
    }

    public function aprrovedButton($id)
    {
        $leave = Leave::find($id);

        $status = $this->returnStatus($leave);

        $returnName = Null;

        if ($leave->ap_prodcer === 0 and $leave->email_producer !== Null) {
            $returnName = User::where('active', 1)->where('email', $leave->email_producer)->first();
            $returnName = $returnName->getFullName();
        }

        if ($leave->ap_pm === 0 and $leave->email_pm !== Null) {
            $returnName = User::where('active', 1)->where('email', $leave->email_pm)->first();
            $returnName = $returnName->getFullName();
        }

        if ($leave->ap_spv === 0 and $leave->email_spv !== Null) {
            $returnName = User::where('active', 1)->where('email', $leave->email_spv)->first();
            $returnName = $returnName->getFullName();
        }

        if ($leave->ap_koor === 0 and $leave->email_koor !== Null) {
            $returnName = User::where('active', 1)->where('email', $leave->email_koor)->first();
            $returnName = $returnName->getFullName();
        }

        return view('HRDLevelAcces.leave.reschedule.approved', compact(['leave', 'returnName', 'status']));
    }

    public function pushApprovedButton(Request $request, $id)
    {
        $leave = Leave::find($id);

        if (empty($leave)) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, we not found this form. Please call administrator!!']));
            return redirect()->route('leave/reschedule/index');
        }

        $data = $this->getDataApproved($leave->id);

        if (!empty($data)) {
            Session::flash('message', Lang::get('messages.data_custom', ['data' => $leave->request_by . ' ' . $leave->leaveName()->leave_category_name . ' form was successfully approved. ' . $leave->id]));
            Leave::where('id', $leave->id)->update($data['data']);
            if (!empty($data['sun'])) {
                $sun = [
                    'sun' => $data['sun'],
                    'id'  => $leave->id
                ];

                $email = User::find($data['sun']);

                Mail::to($email->email)->send(new Approved($sun));
            }
            return redirect()->route('leave/reschedule/index');
        }
    }

    private function getDataApproved($id)
    {
        $leave = Leave::find($id);

        $data = null;
        $sun = null;

        if ($leave->ver_hr === 1 and $leave->ap_hrd === 0) {
            $data = [
                'ap_hrd' => 1,
                'date_ap_hrd'   => date('Y-m-d'),
                'resendmail'    => 2
            ];
            $sun = null;
        }

        if ($leave->ap_hd === 1 and $leave->ver_hr === 0) {
            $data = [
                'ver_hr' => 1,
                'date_ver_hr' => date('Y-m-d'),
                'resendmail'    => 2
            ];
            $sun = null;
        }

        if ($leave->ap_pm === 1 and $leave->ap_producer === 1 and $leave->ap_hd === 0) {
            $user = User::where('active', 1)->where('hd', 1)->where('dept_category_id', $leave->user()->dept_category_id)->first();

            $data = [
                'ap_hd' => 1,
                'date_ap_hd' => date('Y-m-d'),
                'resendmail'    => 2
            ];
            $sun = $user->id;
        }

        if ($leave->ap_producer === 0 and $leave->ap_pm === 1) {
            $user = User::where('active', 1)->where('email', $leave->email_producer)->first();

            $data = [
                'ap_producer' => 1,
                'date_producer' => date('Y-m-d'),
                'producer_id' => $user->id,
                'resendmail'    => 2
            ];

            $sun = $user->id;
        }

        if ($leave->ap_pm === 0 and $leave->ap_spv === 1) {
            $user = User::where('active', 1)->where('email', $leave->email_pm)->first();

            $data = [
                'ap_pm' => 1,
                'date_ap_pm' => date('Y-m-d'),
                'pm_id' => $user->id,
                'resendmail'    => 2
            ];

            $sun = $user->id;
        }

        if ($leave->ap_spv === 0 and $leave->ap_koor === 1) {
            $user = User::where('active', 1)->where('email', $leave->email_spv)->first();

            $data = [
                'ap_spv' => 1,
                'date_ap_spv' => date('Y-m-d'),
                'spv_id'    => $user->id,
                'resendmail'    => 2
            ];

            $sun = $user->id;
        }

        if ($leave->ap_koor === 0) {
            $user = User::where('active', 1)->where('email', $leave->email_koor)->first();

            $data = [
                'ap_koor' => 1,
                'date_ap_koor' => date('Y-m-d'),
                'coordinator_id' => $user->id,
                'resendmail'    => 2
            ];

            $sun = $user->id;
        }

        $return = [
            'data' => $data,
            'sun'  => $sun
        ];

        return $return;
    }

    public function disapproveButton($id)
    {
        $leave = Leave::find($id);

        $status = $this->returnStatus($leave);

        $returnName = Null;

        if ($leave->ap_prodcer === 0 and $leave->email_producer !== Null) {
            $returnName = User::where('active', 1)->where('email', $leave->email_producer)->first();
            $returnName = $returnName->getFullName();
        }

        if ($leave->ap_pm === 0 and $leave->email_pm !== Null) {
            $returnName = User::where('active', 1)->where('email', $leave->email_pm)->first();
            $returnName = $returnName->getFullName();
        }

        if ($leave->ap_spv === 0 and $leave->email_spv !== Null) {
            $returnName = User::where('active', 1)->where('email', $leave->email_spv)->first();
            $returnName = $returnName->getFullName();
        }

        if ($leave->ap_koor === 0 and $leave->email_koor !== Null) {
            $returnName = User::where('active', 1)->where('email', $leave->email_koor)->first();
            $returnName = $returnName->getFullName();
        }

        return view('HRDLevelAcces.leave.reschedule.disapproved', compact(['leave', 'returnName', 'status']));
    }

    public function pushDisapprovedButton(Request $request, $id)
    {
        $leave = Leave::find($id);

        $data = [
            "user_id" => $leave->user_id,
            "leave_category_id" => $leave->leave_category_id,
            "req_advance" => $leave->req_advance,
            "exdoExpired" => $leave->exdoExpired,
            "request_by" => $leave->request_by,
            "request_nik" => $leave->request_nik,
            "request_position" => $leave->request_position,
            "request_join_date" => $leave->request_join_date,
            "request_dept_category_name" => $leave->request_dept_category_name,
            "period" => $leave->period,
            "leave_date" => $leave->leave_date,
            "end_leave_date" => $leave->end_leave_date,
            "back_work" => $leave->back_work,
            "total_day" => $leave->total_day,
            "leave_day" => $leave->leave_day,
            "off_day" => $leave->off_day,
            "entitlement" => $leave->entitlement,
            "pending" => $leave->pending,
            "taken" => $leave->taken,
            "remain" => $leave->remain,
            "ap_hd" => $leave->ap_hd,
            "ap_koor" => $leave->ap_koor,
            "ap_pm" => $leave->ap_pm,
            "ap_spv" => $leave->ap_Spv,
            "ap_producer" => $leave->ap_producer,
            "ap_hrd" => $leave->ap_hrd,
            "ap_gm" => $leave->ap_gm,
            "ap_Infinite" => $leave->ap_infinite,
            "ver_hr" => $leave->vr_hr,
            "leave_cancel" => $leave->leave_cancel,
            "cancel_date" => date('Y-m-d'),
            "uncancel_date" => $leave->uncancel_date,
            "ver_hr_by" => $leave->ver_hr_by,
            "ap_pipeline" => $leave->ap_pipeline,
            "date_ap_pipeline" => $leave->date_ap_pipeline,
            "date_ap_hd" => $leave->date_ap_hd,
            "date_ap_hrd" => $leave->date_ap_hrd,
            "date_ap_gm" => $leave->date_ap_gm,
            "date_ver_hr" => $leave->date_ver_hr,
            "date_ap_koor" => $leave->date_ap_koor,
            "date_ap_pm" => $leave->date_ap_pm,
            "date_ap_spv" => $leave->date_ap_spv,
            "date_producer" => $leave->date_producer,
            "date_ap_infinite" => $leave->date_ap_infinite,
            "spv_id" => $leave->spv_id,
            "coordinator_Id" => $leave->coordinator_id,
            "pm_id" => $leave->pm_id,
            "producer_id" => $leave->producer_id,
            "email_spv" => $leave->email_spv,
            "email_koor" => $leave->email_koor,
            "email_pm" => $leave->email_pm,
            "email_producer" => $leave->email_producer,
            "reason_leave" => $leave->reason_leave,
            "r_departure" => $leave->r_departure,
            "r_city_name" => $leave->r_city_name,
            "r_after_leaving" => $leave->r_after_leaving,
            "resendmail" => $leave->resendmail,
            "plan_leave" => $leave->plan_leave,
            "agreement" => $leave->agreement
        ];

        Log_Leave_Transaction::insert($data);

        Session::flash('getError', Lang::get('messages.data_custom', ['data' => $leave->request_by . ' ' . $leave->leaveName()->leave_category_name . ' form was deleted.']));

        $leave->Delete();

        return redirect()->route('leave/reschedule/index');
    }
}