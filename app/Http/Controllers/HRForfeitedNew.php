<?php

namespace App\Http\Controllers;

use App\Forfeited;
use App\ForfeitedCounts;
use App\Initial_Leave;
use App\Leave;
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

class HRForfeitedNew extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    private function totalMonth()
    {
        $firstMonth = date_create(date('Y') . '-01-01');
        $lastMonth = date_create(date('Y') . '-12-31');

        $interval = $firstMonth->diff($lastMonth);
        $months = $interval->format('%m');

        return $months + 1;
    }

    private function continueMonth()
    {
        $firstMonth = date_create(date('Y') . '-01-01');
        $lastMonth = date_create(date('Y-m-d'));

        $interval = $firstMonth->diff($lastMonth);
        $months = $interval->format('%m');

        return $months + 1;
    }

    private function indexApply($id)
    {
        $annual = DB::table('users')
            ->leftJoin('initial_leave', 'initial_leave.user_id', '=', 'users.id')
            ->leftJoin('leave_category', 'leave_category.id', '=', 'initial_leave.leave_category_id')
            ->leftJoin('leave_transaction', 'leave_transaction.user_id', '=', 'users.id')

            ->select([
                DB::raw('
            (
                select (
                    select COALESCE(sum(total_day), 0) from leave_transaction where user_id=' . $id . ' and leave_category_id=1
                    and ap_hd  = 1
                    and ap_gm  = 1
                    and ver_hr = 1
                    and ap_hrd = 1
                )
            ) as transactionAnnual')
            ])
            ->first();

        $user = User::find($id);

        $startDate = date_create($user->join_date);
        $endDate = date_create($user->end_date);

        $startYear = date('Y', strtotime($user->join_date));
        $endYear = date('Y', strtotime($user->end_date));

        if (auth::user()->emp_status === "Permanent") {
            $yearEnd = date('Y');
        } else {
            $yearEnd = $endYear;
        }

        $now = date_create(date("Y-m-d"));
        $now1 = date_create(date('Y') . '-01-01');
        $now2 = date_create($yearEnd . '-12-31');

        if ($now <= $endDate) {
            $sekarang = $now;
        } else {
            $sekarang = $endDate;
        }

        $daff = date_diff($startDate, $sekarang)->format('%m') + (12 * date_diff($startDate, $sekarang)->format('%y'));

        $daffPermanent = date_diff($now1, $now);
        $daffPermanent = $daffPermanent->m;

        $daffPermanent1 = 12 - $daffPermanent;

        if ($daff <= $annual->transactionAnnual) {
            $newAnnual =  $annual->transactionAnnual;
        } else {
            $newAnnual = $daff;
        }

        $totalAnnual = $newAnnual - $annual->transactionAnnual;

        $at = array(
            $totalAnnual, $newAnnual, $annual->transactionAnnual, $daff, $sekarang, $now
        );

        $totalAnnualPermanent = $user->initial_annual - $annual->transactionAnnual;

        $totalAnnualPermanent1 = $totalAnnualPermanent - $daffPermanent1;

        //-------------------------------------------------

        $exdo = Initial_Leave::where('user_id', $id)->pluck('initial');

        $w = Initial_Leave::where('user_id', $id)
            ->whereDATE('expired', '<', date('Y-m-d'))
            ->pluck('initial');

        $expiredExdo = $w;

        $minusExdo = Leave::where('user_id', $id)->where('leave_category_id', 2)->where('ap_hd', 1)->where('ap_gm', 1)->where('ver_hr', 1)->where('ap_hrd', 1)->pluck('total_day');

        $goingExdo = 0;

        if ($expiredExdo->sum() >= $minusExdo->sum()) {
            $goingExdo = $expiredExdo->sum() - $minusExdo->sum();
        }

        $sisaExdo = $exdo->sum() - $minusExdo->sum() - $goingExdo;
        $forfeited = Forfeited::where('user_id', $id)->pluck('countAnnual');
        $forfeitedCounts = ForfeitedCounts::where('user_id', $id)->where('status', 1)->pluck('amount');
        $countAmount = $forfeited->sum() - $forfeitedCounts->sum();

        $bla = 0;
        if ($countAmount >= 0) {
            $bla = $countAmount;
        } else {
            $bla = 0;
        }

        $bla = 0;
        if ($countAmount >= 0) {
            $bla = $countAmount;
        } else {
            $bla = 0;
        }

        $renewPermanet = $totalAnnualPermanent1 - $bla;
        $renewContract = $totalAnnual - $bla;


        if (auth()->user()->emp_status === "PKL") {
            $totalAnnual = 0;
            $renewContract = 0;
        }

        $try = [
            'annual'      => $annual->transactionAnnual,
            'totalAnnual' => $totalAnnual,
            'totalAnnualPermanent1' => $totalAnnualPermanent1,
            'remainExdo'     => $sisaExdo,
            'startYear'     => $startYear,
            'yearEnd'       => $yearEnd,
            'user'      => $user->initial_annual,
            'exdo'      => $exdo,
            'minusExdo' => $minusExdo,
            'w' => $w,
            'forfeited'         => $forfeited,
            'forfeitedCounts'   => $forfeitedCounts,
            'countAmount'       => $countAmount,
            'bla'               => $bla,
            'renewPermanet'     => $renewPermanet,
            'renewContract'     => $renewContract
        ];

        return $try;
    }

    public function index()
    {
        return view('HRDLevelAcces.forfeited.logs.index');
    }

    public function dataObjectIndex()
    {
        $data = User::with(['entitled_leave', 'department'])->select([
            'id',
            'first_name',
            'last_name',
            'nik',
            'dept_category_id',
            'position',
            'emp_status',
            'initial_annual',
            'join_date',
            'end_date',
            'forfeitcase'
        ])
            ->where('active', 1)
            ->whereNotIn('nik', ["", "123456789", "D0002"])
            ->whereNotIn('emp_status', ["Outsource"])
            ->whereIn('id', [84])
            ->orderBy('first_name', 'asc')
            ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('fullname', function (User $user) {
                return $user->getFullName();
            })
            ->addColumn('availableAL', function (User $user) {
                $data = $this->indexApply($user->id);

                $return = "Err!!";

                if ($user->emp_status === "Permanent") {
                    if ($user->forfeitcase == 1) {
                        $return = $data['totalAnnualPermanent1'];
                    } else {
                        $return = $data['renewPermanet'];
                    }
                } elseif ($user->emp_status === "PKL") {
                    $return = 0;
                } else {
                    if ($user->forfeitcase == 1) {
                        $return = $data['totalAnnual'];
                    } else {
                        $return = $data['renewContract'];
                    }
                }

                return $return;
            })
            ->addColumn('advanceAL1', function (User $user) {
                $data = $this->indexApply($user->id);

                $return = "Err!!";

                if ($user->emp_status === "Permanent") {
                    if ($user->forfeitcase === 1) {
                        $return = $user->initial_annual - $data['annual'] - $data['totalAnnualPermanent1'];
                    } else {
                        $return = $user->initial_annual - $data['annual'] - $data['renewPermanet'];;
                    }
                } elseif ($user->emp_status === "PKL") {
                    $return = 0;
                } else {
                    if ($user->forfeitcase === 1) {
                        $return = $user->initial_annual - $data['annual'] - $data['totalAnnual'];
                    } else {
                        $return = $user->initial_annual - $data['annual'] - $data['renewContract'];;
                    }
                }


                return $return;
            })
            ->addColumn('advanceAL2', function (User $user) {
                $avail = $this->availableLeave($user);

                $totalAnnual = $avail['newAnnual'] - $avail['annual'];

                $totalAnnualPermanent = $user['initial_annual'] - $avail['annual'];

                $totalAnnualPermanent1 = $totalAnnualPermanent - $avail['daffPermanent1'];

                $permanent = $user['initial_annual'] - $avail['annual'] - $totalAnnualPermanent1;

                $interval = date_diff(date_create($user['join_date']),  date_create($user['end_date']));

                $pass = $interval->y * 12;

                $passs = $pass + $interval->m;

                if ($passs <= $avail['annual']) {
                    $newAnnual =  $avail['annual'];
                } else {
                    $newAnnual = $passs;
                }

                $totalAnnual = $avail['newAnnual'] - $avail['annual'];

                $contract = $user['initial_annual'] -  $avail['annual'] - $totalAnnual;

                if ($user['emp_status'] === "Permanent") {
                    $return = $permanent;
                } else {
                    $return = $contract;
                }

                if ($return >= 12) {
                    $return = $return - 12;
                } else {
                    $return = 0;
                }

                return $return;
            })
            ->addColumn('totalAdvance', '{{ $advanceAL1 }}')
            ->addColumn('remainsAL', '{{ $availableAL + $advanceAL1 }}')

            // ->addColumn('DEDE', function (User $user) {

            //     $totalMonth = $this->totalMonth();

            //     $continueMonth = $this->continueMonth() - 1;

            //     $avail = $this->availableLeave($user);

            //     $totalAnnual = $avail['newAnnual'] - $avail['annual'];

            //     $totalAnnualPermanent = $user['initial_annual'] - $avail['annual'];

            //     $totalAnnualPermanent1 = $totalAnnualPermanent - $avail['daffPermanent1'];

            //     if ($user['emp_status'] === "Permanent") {
            //         $available = $totalAnnualPermanent1;
            //     } else {
            //         $available = $totalAnnual;
            //     }

            //     //end available AL

            //     $forfeited = $available - $continueMonth; // nilai dari forfeited

            //     if ($forfeited < 0) {
            //         $forfeited = 0;
            //     }

            //     return $forfeited;
            // })
            ->addColumn('DEDE', function (User $user) {
                $forfeited = Forfeited::where('user_id', $user->id)->pluck('countAnnual');
                $forfeitedCounts = ForfeitedCounts::where('user_id', $user->id)->where('status', 1)->pluck('amount');
                $countAmount = $forfeited->sum() - $forfeitedCounts->sum();

                if ($countAmount >= 0) {
                    $return = $countAmount;
                } else {
                    $return = 0;
                }

                return $return;
            })
            ->addColumn('exdo', function (User $user) {
                $data = $this->indexApply($user->id);

                return $data['remainExdo'];
            })
            ->addColumn('AL_Exdo', '{{ $remainsAL + $exdo }}')
            ->addColumn(
                'actions',
                Lang::get('messages.btn_viewForfeited', ['class' => 'eye', 'title' => 'View forfeited', 'url' => '{{ URL::route(\'forfeited/detail\', [$id]) }}']) .
                    Lang::get('messages.btn_primary', ['title' => 'Add forfeited', 'url' => '{{ URL::route(\'forfeited/add\', [$id]) }}']) .
                    Lang::get('messages.btn_viewExdo', ['class' => 'eye', 'title' => 'View Exdo', 'url' => '{{ URL::route(\'hr/exdo/view/index\', [$id]) }}', 'target' => '_blank'])
            )
            ->rawColumns(['actions'])
            ->make(true);
    }

    private function availableLeave($user)
    {

        $annual = Leave::select([
            DB::raw('
                                (
                                    select (
                                        select COALESCE(sum(total_day), 0) from leave_transaction where user_id=' . $user['id'] . ' and leave_category_id=1
                                        and ap_hd  = 1
                                        and ap_gm  = 1
                                        and ver_hr = 1
                                        and ap_hrd = 1
                                    )
                                ) as transactionAnnual')
        ])->first();

        $startDate = date_create($user['join_date']);
        $endDate = date_create($user['end_date']);

        $now = Carbon::now();

        $now1 = Carbon::create(date('Y'), 1, 1, 0, 0, 0, 'Asia/Jakarta');

        if ($now <= $endDate) {
            $sekarang = $now;
        } else {
            $sekarang = $endDate;
        }

        $daff = date_diff($startDate, $now);
        $daff = $daff->m + ($daff->y * 12);

        $daffPermanent = date_diff($now1, $now);
        $daffPermanent = $daffPermanent->m;

        $daffPermanent1 = 12 - $daffPermanent;

        if ($daff <= $annual->transactionAnnual) {
            $newAnnual = $annual->transactionAnnual;
        } else {
            $newAnnual = $daff;
        }

        $return = [
            'daffPermanent1' => $daffPermanent1,
            'newAnnual'      => $newAnnual,
            'annual'         => $annual->transactionAnnual,
            'daff'             => $daff,
            'daffPermanent' => $daffPermanent
        ];

        return $return;
    }

    private function exdoMonth($id, $exdo)
    {
        $w = Initial_Leave::where('user_id', $id)
            ->whereDATE('expired', '<', date('Y-m-d'))
            ->pluck('initial')->sum();

        $minusExdo = Leave::where('user_id', $id)->where('leave_category_id', 2)->where('ap_hd', 1)->where('ap_gm', 1)->where('ver_hr', 1)->where('ap_hrd', 1)->pluck('total_day')->sum();

        $goingExdo = 0;

        if ($w >= $minusExdo) {
            $goingExdo = $w - $minusExdo;
        }

        $sisaExdo = $exdo - $minusExdo - $goingExdo;

        if ($sisaExdo < 0) {
            $sisaExdo = $sisaExdo * -1;
            $sisaExdo = $sisaExdo - $sisaExdo;
        }
        return $sisaExdo;
    }
}