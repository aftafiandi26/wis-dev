<?php

namespace App\Http\Controllers;

use App\Absences;
use App\User;
use Illuminate\Http\Request;

use Datatables;

class HRAttendanceSearchByDate extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function searchByDate(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');

        $query = Absences::whereDate('date_check_in', '>=', $start)->where('date_check_in', '<=', $end)->get();

        return view('HRDLevelAcces.attendance.Search.byDate.newBydate.index', compact(['start', 'end']));
    }

    public function dataObject($start, $end)
    {
        $query = Absences::whereDate('date_check_in', '>=', $start)->where('date_check_in', '<=', $end)->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (Absences $absences) {
                $return = User::find($absences->id_user);
                return $return->getFullName();
            })
            ->addColumn('nik', function (Absences $absences) {
                $return = User::find($absences->id_user);
                return $return->nik;
            })
            ->addColumn('department', function (Absences $absences) {
                $return = User::find($absences->id_user);
                return $return->getDepartment($return->dept_category_id);
            })
            ->addColumn('position', function (Absences $absences) {
                $return = User::find($absences->id_user);
                return $return->position;
            })
            ->addColumn('time', function (Absences $absences) {
                $awal  = strtotime($absences->timeIN); //waktu awal
                $akhir = strtotime($absences->timeOUT); //waktu akhir

                $diff  = $akhir - $awal;

                $jam   = floor($diff / (60 * 60));
                $menit = $diff - $jam * (60 * 60);
                $detik = $diff - $menit * (60 * 60 * 60);

                $waktu = $jam . ' jam, ' . floor($menit / 60) . ' menit';

                if ($absences->check_out === 1) {
                    return $waktu;
                }
                return "--";
            })
            ->make(true);
    }
}