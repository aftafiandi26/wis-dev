<?php

namespace App\Http\Controllers\programmer;

use App\Dept_Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Initial_Leave;
use App\Leave;
use App\User;
use Yajra\Datatables\Facades\Datatables;

class ExdoExpiredCutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function exdoExpired()
    {
        $user = User::find(226);

        $totalExdo = Initial_Leave::where('user_id', $user->id)->pluck('initial')->sum();

        $exdoExpired = Initial_Leave::where('user_id', $user->id)->where('expired', '<', date('Y-m-d'))->pluck('initial')->sum();

        $taken = Leave::where('leave_category_id', 2)->where('user_id', $user->id)->where('ap_hrd', 1)->pluck('total_day')->sum();
        $amount = 't';
        if ($exdoExpired <= $totalExdo) {
            if ($taken < $exdoExpired) {
                $amount = "kk";
            }
        }


        $test = [
            'total_exdo' => $totalExdo,
            'total_exdo_expired' => $exdoExpired,
            'exdo_taken'    => $taken,
            'amount' => $amount
        ];

        dd($test);

        return view('IT.Progress.cutExdoExpired.index');
    }

    public function userExdoExpired()
    {
        $data = User::select(['id', 'nik', 'first_name', 'last_name', 'position', 'dept_category_id'])->where('active', 1)->where('nik', '!=', null)->where('nik', '!=', 123456789)->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('fullname', '{{ $first_name }} {{ $last_name }}')
            ->addColumn('totalInitial', function (User $user) {
                $total = Initial_Leave::where('user_id', $user->id)->pluck('initial')->sum();
                return $total;
            })
            ->addColumn('taken', function (User $user) {
                $taken = Leave::where('user_id', $user->id)->where('leave_category_id', 2)->where('ap_hd', 1)->where('ap_gm', 1)->where('ver_hr', 1)->where('ap_hrd', 1)->pluck('total_day')->sum();
                return $taken;
            })
            ->make(true);
    }
}
