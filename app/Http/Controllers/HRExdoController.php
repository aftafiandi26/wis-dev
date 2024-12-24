<?php

namespace App\Http\Controllers;

use App\Initial_Leave;
use App\Leave;
use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class HRExdoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function index()
    {
        return view('HRDLevelAcces.leave.exdo.index.index');
    }

    public function dataTables()
    {
        $users = User::where('active', true)->whereNotIn('nik', ["", "123456789"])->whereNotNull('nik')->orderBy('first_name', 'asc')->get();

        return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('fullname', function (User $user) {
                return $user->getFullName();
            })
            ->addColumn('department', function (User $user) {
                return $user->getDepartment();
            })
            ->addColumn('total', function (User $user) {
                $exdo = Initial_Leave::where('user_id', $user->id)->pluck('initial');

                $user->temp_exdo = $exdo->sum();

                return $exdo->sum();
            })
            ->addColumn('taken', function (User $user) {
                $takenExdo = Leave::where('user_id', $user->id)->where('leave_category_id', 2)->where('formStat', true)->pluck('total_day');
                $user->temp_taken = $takenExdo->sum();

                return $takenExdo->sum();
            })
            ->addColumn('expired', function (User $user) {
                $expired = Initial_Leave::where('user_id', $user->id)->whereDATE('expired', '<', date('Y-m-d'))->pluck('initial')->sum();

                $takenExdo = $user->temp_taken;
                $exdo = $user->temp_exdo;

                $remains = 0;

                if ($expired >= $takenExdo) {
                    $remains = $expired - $takenExdo;
                }

                $remains = $exdo - $takenExdo - $remains;

                $user->temp_remains = $remains;

                $amount = $remains + $takenExdo;
                $return = $exdo - $amount;

                return $return;
            })
            ->addColumn('remains', function (User $user) {
                $remains = $user->temp_remains;

                return $remains;
            })
            ->make(true);
    }
}