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

class HRForfeited extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function index()
    {
        return view('HRDLevelAcces.forfeited.index');
    }

    public function dataIndexUser()
    {
        $query = User::where('active', 1)
            ->select([
                'id',
                'first_name',
                'last_name',
                'nik',
                'dept_category_id',
                'position',
                'emp_status',
                'initial_annual',
                'join_date'
            ])
            ->where('nik', '!=', null)
            ->where('nik', '!=', "123456789")
            ->where('nik', '!=', "D0002")
            // ->whereIn('id', [226, 4])
            ->where('emp_status', '!=', 'Outsource')
            ->orderBy('first_name', 'asc')
            ->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->editColumn('first_name', function (User $user) {
                return $user->first_name . ' ' . $user->last_name;
            })
            ->addColumn('dept', function (User $user) {
                $dept = Dept_Category::find($user->dept_category_id);

                return $dept->dept_category_name;
            })
            ->addColumn('Remains', function (User $user) {
                $annual = Entitled_leave_view::where('nik', $user->nik)->first();

                if ($annual->annual_leave_balance <= 0) {
                    $return = 0;
                } else {
                    $return = $annual->annual_leave_balance;
                }

                $return = "<b>" . $return . "</b>";

                return $return;
            })
            ->addColumn('year2', function (User $user) {
                $return = $this->tahun2021($user->id);

                return $return;
            })
            ->addColumn('forfeited', function (User $user) {
                $return = $this->forfeitedCount($user->id);

                return $return;
            })
            // ->addColumn('available', '{{ $availableForfeited - $forfeited }}')
            ->addColumn('available', function (User $user) {
                return $this->availableLeave($user['id']);
            })
            ->addColumn('exdo', function (User $user) {

                $exdo = Initial_Leave::where('user_id', $user->id)->where('expired', '<=', date('Y-m-d', strtotime('+1 month')))->pluck('initial')->sum();

                $return = $this->exdoMonth($user->id, $exdo);

                return $return;
            })
            ->addColumn('advanceExdo', function (User $user) {
                $exdo = Initial_Leave::where('user_id', $user->id)->pluck('initial')->sum();

                $return = $this->exdoMonth($user->id, $exdo);

                return $return;
            })
            ->addColumn('advancedLeave', function (User $user) {

                $annual = DB::table('users')
                    ->leftJoin('initial_leave', 'initial_leave.user_id', '=', 'users.id')
                    ->leftJoin('leave_category', 'leave_category.id', '=', 'initial_leave.leave_category_id')
                    ->leftJoin('leave_transaction', 'leave_transaction.user_id', '=', 'users.id')

                    ->select([
                        DB::raw('
                            (
                                select (
                                    select COALESCE(sum(total_day), 0) from leave_transaction where user_id=' . $user->id . ' and leave_category_id=1
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

                $now = date_create(date("Y-m-d"));
                $now1 = date_create(date('Y') . '-01-01');
                $now2 = date_create(date('Y') . '-12-31');

                if ($now <= $endDate) {
                    $sekarang = $now;
                } else {
                    $sekarang = $endDate;
                }

                $daff = date_diff($startDate, $sekarang)->format('%m') + (12 * date_diff($startDate, $sekarang->modify('+5 day'))->format('%y'));

                $daffPermanent = date_diff($now1, $now);
                $daffPermanent = $daffPermanent->m;

                $daffPermanent2 = date_diff($now1, $now2)->format('%m') + (12 * date_diff($now1, $now2->modify('+5 day'))->format('%y'));

                $daffPermanent1 = 12 - $daffPermanent;


                if ($daff <= $annual->transactionAnnual) {
                    $newAnnual =  $annual->transactionAnnual;
                } else {
                    $newAnnual = $daff;
                }

                $totalAnnual = $newAnnual - $annual->transactionAnnual;

                $totalAnnualPermanent = $user->initial_annual - $annual->transactionAnnual;

                $totalAnnualPermanent1 = $totalAnnualPermanent - $daffPermanent1;

                $permanent = $user->initial_annual - $annual->transactionAnnual - $totalAnnualPermanent1;

                // contract

                $interval = date_diff(date_create($user->join_date),  date_create($user->end_date));

                $pass = $interval->y * 12;

                $passs = $pass + $interval->m;

                if ($passs <= $annual->transactionAnnual) {
                    $newAnnual =  $annual->transactionAnnual;
                } else {
                    $newAnnual = $passs;
                }

                $totalAnnual = $newAnnual - $annual->transactionAnnual;

                $contract = $user->initial_annual -  $annual->transactionAnnual - $totalAnnual;

                $return = null;

                if ($user->emp_status == "Permanent") {
                    $return = $permanent;
                } else {
                    $return = $contract;
                }

                return $return;
            })
            ->addColumn('totalyALEXDO', function (User $user) {
                $annual = Entitled_leave_view::where('nik', $user->nik)->first();

                if ($annual->annual_leave_balance <= 0) {
                    $remain = 0;
                } else {
                    $remain = $annual->annual_leave_balance;
                }

                $exdo = Initial_Leave::where('user_id', $user->id)->pluck('initial');

                $w = Initial_Leave::where('user_id', $user->id)
                    ->whereDATE('expired', '<=', Carbon::now())
                    ->pluck('initial');

                $minusExdo = Leave::where('user_id', $user->id)->where('leave_category_id', 2)->where('ap_hd', 1)->where('ap_gm', 1)->where('ver_hr', 1)->where('ap_hrd', 1)->pluck('total_day');

                $expiredExdo = $w;
                $goingExdo = 0;

                if ($expiredExdo->sum() >= $minusExdo->sum()) {
                    $goingExdo = $expiredExdo->sum() - $minusExdo->sum();
                }

                $sisaExdo = $exdo->sum() - $minusExdo->sum() - $goingExdo;

                $return = $remain + $sisaExdo;

                $return = "<b style='color: green;'>" . $return . "</b>";

                return $return;
            })
            ->addColumn(
                'actions',
                Lang::get('messages.btn_viewForfeited', ['class' => 'eye', 'title' => 'View forfeited', 'url' => '{{ URL::route(\'forfeited/detail\', [$id]) }}']) .
                    Lang::get('messages.btn_primary', ['title' => 'Add forfeited', 'url' => '{{ URL::route(\'forfeited/add\', [$id]) }}']) .
                    Lang::get('messages.btn_viewExdo', ['class' => 'eye', 'title' => 'View Exdo', 'url' => '{{ URL::route(\'hr/exdo/view/index\', [$id]) }}'])
            )
            ->rawColumns(['totalyALEXDO', 'Remains', 'available'])
            ->make(true);
    }

    public function availableYear()
    {
        $startJoin = date_create(date('Y' . '-01-01'));
        $now = date_create(date('Y-m-d'));

        $day = date_diff($startJoin, $now)->format('%d') + 2;

        $countDay = 0;

        if ($day >= 29) {
            $countDay = 1;
        }

        $month = date_diff($startJoin, $now)->format('%m') + $countDay;

        $year = date_diff($startJoin, $now)->format('%y') * 12;

        $return = ($month + $year);

        $try = [
            'month' => $month,
            'year'  => $year,
            'return' => $return,
        ];

        return $return;
    }

    public function sementaraAvailable($id)
    {
        $forfeiteds = Forfeited::where('user_id', $user->id)->pluck('countAnnual');

        $forfeitedsCount = ForfeitedCounts::where('user_id', $user->id)->where('status', 1)->get();

        $balancefor = $forfeiteds->sum() - $forfeitedsCount->pluck('amount')->sum();

        $totalAnnual = $this->availableLeave($user->id);

        $year = $this->tahun2021($user->id);

        if ($balancefor <= 0) {
            $balance = 0;
        } else {
            $balance = $balancefor;
        }

        if ($totalAnnual <= 0) {
            $return = 0;
        } else {
            $return = $totalAnnual - $balance - $year;
        }

        return $return;
    }

    public function exdoMonth($id, $exdo)
    {

        $w = Initial_Leave::where('user_id', $id)
            ->whereDATE('expired', '<', date('Y-m-d'))
            ->pluck('initial');

        $minusExdo = Leave::where('user_id', $id)->where('leave_category_id', 2)->where('ap_hd', 1)->where('ap_gm', 1)->where('ver_hr', 1)->where('ap_hrd', 1)->pluck('total_day');

        $goingExdo = 0;

        if ($w->sum() >= $minusExdo->sum()) {
            $goingExdo = $w->sum() - $minusExdo->sum();
        }

        $sisaExdo = $exdo - $minusExdo->sum() - $goingExdo;

        if ($sisaExdo < 0) {
            $sisaExdo = $sisaExdo * -1;
            $sisaExdo = $sisaExdo - $sisaExdo;
        }
        return $sisaExdo;
    }

    public function forfeitedExdo($id)
    {
        $totalExdo = Initial_Leave::where('user_id', $id)->whereDATE('expired', '<', date('Y-m-d'))->pluck('initial');
        $takenExdo = Leave::where('user_id', $id)->where('leave_category_id', 2)->where('ap_hd', 1)->where('ver_hr', 1)->where('ap_hrd', 1)->pluck('total_day');

        $return = $totalExdo->sum() - $takenExdo->sum();

        if ($totalExdo->sum() < $takenExdo->sum()) {
            $return = 0;
        }

        return $return;
    }

    public function forfeitedCount($id)
    {
        $startF = '2018';
        $endF = date('Y', strtotime('-2 year'));
        $nowF = date('Y', strtotime('-1 year'));

        $valueYear = Forfeited::where('user_id', $id)->whereBetween('year', [$startF, $endF])->pluck('countAnnual')->sum();
        $valueNowYear = Forfeited::where('user_id', $id)->where('year', $nowF)->pluck('countAnnual')->sum();

        $taken = ForfeitedCounts::where('user_id', $id)->where('status', 1)->pluck('amount')->sum();

        $return = $valueYear - $taken;

        $return = $valueNowYear + $return;

        $try = [
            'valueYear' => $valueYear,
            'valueNowYear'  => $valueNowYear,
            'taken'     => $taken,
            'return'       => $return
        ];

        return $return;
    }

    public function tahun2019($id)
    {
        $starYear = [2018];

        $nowYear = [2018, 2019];

        $valueYear = Forfeited::where('user_id', $id)->whereIn('year', $nowYear)->pluck('countAnnual')->sum();

        $valueYears = Forfeited::where('user_id', $id)->whereIn('year', $starYear)->pluck('countAnnual')->sum();

        $taken = ForfeitedCounts::where('user_id', $id)->where('status', 1)->pluck('amount')->sum();

        $got = $valueYears - $taken;

        $amount = $valueYear - $taken;

        $return = 0;

        if ($amount > 0) {
            $return = $amount - $got;
        }

        $try = [
            'valueYear' => $valueYear,
            'valueYears' => $valueYears,
            'taken'     => $taken,
            'got'   => $got,
            'amount' => $amount,
            'return'    => $return
        ];

        return $valueYear;
    }

    public function tahun2020($id)
    {
        $starYear = [2018, 2019];

        $nowYear = [2018, 2019, 2020];

        $valueYear = Forfeited::where('user_id', $id)->whereIn('year', $nowYear)->pluck('countAnnual')->sum();

        $valueYears = Forfeited::where('user_id', $id)->whereIn('year', $starYear)->pluck('countAnnual')->sum();

        $taken = ForfeitedCounts::where('user_id', $id)->where('status', 1)->pluck('amount')->sum();

        $got = $valueYears - $taken;

        $amount = $valueYear - $taken;

        $return = 0;

        if ($amount > 0) {
            $return = $amount - $got;
        }

        return $return;
    }

    public function tahun2021($id)
    {
        $starYear = [2018, 2019, 2020];

        $nowYear = [2018, 2019, 2020, 2021];

        $valueYear = Forfeited::where('user_id', $id)->whereIn('year', $nowYear)->pluck('countAnnual')->sum();

        $valueYears = Forfeited::where('user_id', $id)->whereIn('year', $starYear)->pluck('countAnnual')->sum();
        $year = Forfeited::where('user_id', $id)->where('year', date('Y', strtotime('-1 year')))->pluck('countAnnual')->sum();

        $taken = ForfeitedCounts::where('user_id', $id)->where('status', 1)->pluck('amount')->sum();

        $got = $valueYears - $taken;

        $amount = $valueYear - $taken;

        $return = 0;

        if ($amount > $got) {
            $return = $amount - $got;
        }
        if ($got > $amount) {
            $return = $got - $amount;
        }

        return $return;
    }

    public function tahun20201($id)

    {
        $th2018 = Forfeited::where('user_id', $id)->where('year', 2018)->value('countAnnual');
        $th2019 = Forfeited::where('user_id', $id)->where('year', 2019)->value('countAnnual');
        $th2020 = Forfeited::where('user_id', $id)->where('year', 2020)->value('countAnnual');

        if ($th2018 === null) {
            $forCount2018 = 0;
        } else {
            $forCount2018 = $th2018;
        }

        if ($th2019 === null) {
            $forCount2019 = 0;
        } else {
            $forCount2019 = $th2019;
        }

        if ($th2020 === null) {
            $forCount2020 = 0;
        } else {
            $forCount2020 = $th2020;
        }

        $valueYear = Forfeited::where('user_id', $id)->pluck('countAnnual')->sum();

        $try = $forCount2018 + $forCount2019 + $forCount2020;

        $taken = ForfeitedCounts::where('user_id', $id)->where('status', 1)->pluck('amount')->sum();

        $cet = ($forCount2018 + $forCount2019) - $taken;

        $amount = ($forCount2018 + $forCount2019 + $forCount2020) - $taken;

        if ($amount <= 0) {
            $return = 0;
        } else {
            if ($amount >= $forCount2020) {
                $return = $amount - $cet;
            } else {
                $return = $amount;
            }
        }

        $try1 = [$try, $valueYear, $taken, $cet, $amount, $return];

        return $try1;
    }

    public function availableLeave($id)
    {
        $user = NewUser::findOrFail($id);

        $annual = Leave::select([
            DB::raw('
                                (
                                    select (
                                        select COALESCE(sum(total_day), 0) from leave_transaction where user_id=' . $user->id . ' and leave_category_id=1
                                        and ap_hd  = 1
                                        and ap_gm  = 1
                                        and ver_hr = 1
                                        and ap_hrd = 1
                                    )
                                ) as transactionAnnual')
        ])->first();

        $startDate = date_create($user->join_date);
        $endDate = date_create($user->end_date);

        $startYear = date('Y', strtotime($user->join_date));
        $endYear = date('Y', strtotime($user->end_date));

        if ($user->emp_status === "Permanent") {
            $yearEnd = date('Y');
        } else {
            $yearEnd = $endYear;
        }

        $now = date_create(date("Y-m-d"));
        $now1 = date_create(date('Y') . '-01-01');
        $now2 = date_create($yearEnd . '-12-31');

        // date_create('2021-05-15') penambahan bulan terjadi
        // dd($now);

        if ($now <= $endDate) {
            $sekarang = $now;
        } else {
            $sekarang = $endDate;
        }

        $cont = date_diff($now, $now1);


        $daff = date_diff($startDate, $sekarang)->format('%m') + (12 * date_diff($startDate, $sekarang->modify('+5 day'))->format('%y'));

        // $daffPermanent = date_diff($now1, $now)->format('%m') + (12 * date_diff($now1, $now->modify('+5 day'))->format('%y'));
        $daffPermanent = date_diff($now1, $now);
        $daffPermanent = $daffPermanent->m;

        $daffPermanent2 = date_diff($now1, $now2)->format('%m') + (12 * date_diff($now1, $now2->modify('+5 day'))->format('%y'));

        $daffPermanent1 = 12 - $daffPermanent;


        if ($daff <= $annual->transactionAnnual) {
            $newAnnual =  $annual->transactionAnnual;
        } else {
            $newAnnual = $daff;
        }

        $totalAnnual = $newAnnual - $annual->transactionAnnual;

        $totalAnnualPermanent = $user->initial_annual - $annual->transactionAnnual;

        $totalAnnualPermanent1 = $totalAnnualPermanent - $daffPermanent1;

        if ($user->emp_status === "Permanent") {
            return $totalAnnualPermanent1;
        } else {
            return $totalAnnual;
        }
    }

    public function detailUserForfeited($id)
    {
        $forfeited = Forfeited::where('user_id', $id)->get();


        $return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'>Detail $forfeited/h4>
            </div>
            <div class='modal-body'>
               <div class='row'>
                    <div class='col-lg-12'>
                           <div class='table-responsive table-sm'>
                                <table class='table table-bordered table-hover text-sm'>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Year</th>
                                            <th>Count</th>
                                        </tr>
                                    </thead>
                            </table>
                           </div>
                    </div>
                </div>

            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
    }

    public function addForfeited($id)
    {
        $user = NewUser::findOrFail($id);

        return view('HRDLevelAcces.forfeited.add', compact(['user']));
    }

    public function storeForfeited(Request $request, $id)
    {
        $user = NewUser::findOrFail($id);

        $rules = [
            'year'     => 'required|numeric',
            'amount'    => 'required|numeric'
        ];

        $data = [
            'user_id'       => $user->id,
            'year'          => $request->input('year'),
            'countAnnual'   => $request->input('amount')
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('forfeited/add', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {
            Forfeited::insert($data);
            Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'forfeited leave ' . $user->first_name . ' ' . $user->last_name]));
            return Redirect::route('forfeited/index');
        }
    }

    public function viewForfeited($id)
    {
        $user = NewUser::findOrFail($id);
        $no = 1;
        $forfeited = Forfeited::where('user_id', $id)->get();

        return view('HRDLevelAcces.forfeited.view', compact(['user', 'forfeited', 'no']));
    }

    public function deleteDataForfeited($id)
    {
        forfeited::where('id', $id)->delete();

        return Redirect::back()->with('danger', 'Data has been deleted');
    }

    public function deleteYearsForfeid()
    {
        $user = NewUser::where('active', 1)->where('id', 226)->first();



        return $user;
    }

    public function cutOffForfeited($id, $forfeited)
    {
        $data = NewUser::JoinDeptCategory()->find($id);
        $forfeited = Forfeited::find($forfeited);

        $countAnnual = Forfeited::where('user_id', $id)->where('year', '<=', $forfeited->year)->pluck('countAnnual')->sum();

        $amount = ForfeitedCounts::where('user_id', $id)->where('status', 1)->pluck('amount')->sum();

        $countAnnual = $countAnnual - $amount;

        $dated = $forfeited->year + 1;

        $dated = date($dated . '-12-31');

        return view('HRDLevelAcces.forfeited.cutoff', compact(['id', 'data', 'forfeited', 'dated', 'countAnnual', 'amount']));
    }

    public function storeCutOffForfeited(Request $request)
    {
        $rule = [
            'startLeaveDate'     => 'required',
            'endLeaveDate'         => 'required',
            'backWork'            => 'required',
            'request_day'        => 'required|numeric|min:0',
            'reason'            => 'required'
        ];

        $id = $request->input('id');
        $idForfeited = $request->input('idForfeited');
        $req_advance = $request->input('req_advance');

        $countAnnual = $request->input('countAnnual');
        $amount = $request->input('amount');

        $count = $countAnnual - $amount;

        if ($request->input('request_day') < $count) {
            $count = $request->input('request_day');
        } else {
            $count = $count;
        }

        $data = [
            'user_id'                => $id,
            'req_advance'            => $req_advance,
            'leave_category_id'      => $request->input('category'),
            'request_by'             => $request->input('request_by') . ' (carry over by ' . auth::user()->first_name . ' ' . auth::user()->last_name . ')',
            'request_nik'            => $request->input('nik'),
            'request_position'       => $request->input('position'),
            'request_join_date'      => $request->input('joindDate'),
            'request_dept_category_name' => $request->input('dept'),
            'period'                => date('Y'),
            'leave_date'            => $request->input('startLeaveDate'),
            'end_leave_date'        => $request->input('endLeaveDate'),
            'back_work'                => $request->input('backWork'),
            'total_day'                => $count,
            'taken'                      => null,
            'entitlement'                => null,
            'pending'                    => null,
            'remain'                     => null,
            'date_ver_hr'                => date("Y-m-d"),
            'date_ap_hd'                 => date("Y-m-d"),
            'date_ap_gm'                 => date("Y-m-d"),
            'date_ap_gm'                 => date("Y-m-d"),
            'ver_hr'                     => '1',
            'ap_hd'                      => '1',
            'ap_gm'                      => '1',
            'ap_hrd'                     => '1',
            'ap_koor'                    => '1',
            'ap_spv'                     => '1',
            'ap_pm'                      => '1',
            'ap_producer'                => '1',
            'reason_leave'               => $request->input('reason'),
            'r_departure'                => null,
            'r_after_leaving'            => null
        ];

        $validator = Validator::make($request->all(), $rule);

        if ($validator->fails()) {
            return Redirect::route('forfeited/cutOff', [$id, $idForfeited])
                ->withErrors($validator)
                ->withInput();
        } else {
            if ($count > 0) {
                Leave::insert($data);
                $this->insertForfeitedCounts($id);
                Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data Forfeited']));
            } else {
                Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Data has been canceled']));
            }

            return Redirect::route('forfeited/detail', $id);
        }
    }

    public function insertForfeitedCounts($id)
    {
        $leave = Leave::where('user_id', $id)->latest()->first();

        $data = [
            'user_id' => $id,
            'leave_id'  => $leave->id,
            'amount'    => $leave->total_day,
            'status'    => 1,
        ];

        ForfeitedCounts::insert($data);
    }
}