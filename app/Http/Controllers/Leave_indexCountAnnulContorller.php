<?php

namespace App\Http\Controllers;

use App\Forfeited;
use App\ForfeitedCounts;
use App\Initial_Leave;
use App\Leave;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Leave_indexCountAnnulContorller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function indexNewApply($id)
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

        $test =  Leave::where('leave_category_id', 1)->where('user_id', $id)->where('ap_hrd', 1)->get();


        $user = User::find($id);

        $startDate = date_create($user->join_date);
        $endDate = date_create($user->end_date);

        $startYear = date('Y', strtotime($user->join_date));
        $endYear = date('Y', strtotime($user->end_date));

        if (auth()->user()->emp_status === "Permanent") {
            $yearEnd = date('Y');
        } else {
            $yearEnd = $endYear;
        }

        $now = date_create(date("Y-m-d"));
        $now1 = date_create(date('Y') . '-01-01');
        $now2 = date_create($yearEnd . '-12-31');

        if ($now <= $endDate) {
            $nowed = date_create("2023-03-09");
            $sekarang = $now;
        } else {
            $sekarang = $endDate;
        }

        $cont = date_diff($now, $now1);


        $daff = date_diff($startDate, $sekarang)->format('%m') + (12 * date_diff($startDate, $sekarang)->format('%y'));

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

        $try = [
            $sisaExdo,
            $exdo->sum(),
            $minusExdo->sum(),
            $goingExdo,
            "---",
            $expiredExdo->sum()
        ];

        $test = [
            'exdo' => $exdo->sum(),
            'w'    => $w->sum(),
            'minusExdo'  => $minusExdo->sum(),
            'sisaExdo'    => $sisaExdo,
            'goingExdo'   => $goingExdo
        ];

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
            'totalAnnualPermanent1' => $totalAnnualPermanent1, // ini
            'totalAnnual' => $totalAnnual, // ini
            'renewPermanet'     => $renewPermanet, // ini
            'renewContract'     => $renewContract, // ini 

            'annual'      => $annual->transactionAnnual,
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
        ];

        $return = [
            'totalAnnualPermanent1' => $totalAnnualPermanent1, // ini
            'totalAnnual' => $totalAnnual, // ini
            'renewPermanet'     => $renewPermanet, // ini
            'renewContract'     => $renewContract, // ini 
        ];

        return $return;
    }
}