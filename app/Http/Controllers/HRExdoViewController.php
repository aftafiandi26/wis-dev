<?php

namespace App\Http\Controllers;

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
use Maatwebsite\Excel\Facades\Excel;

class HRExdoViewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'hr', 'active']);
    }

    public function index($id)
    {

        $user = User::findOrFail($id);
        $dept = Dept_Category::where('id', $user->dept_category_id)->value('dept_category_name');

        $no = 1;

        $exdoTransaction = Leave::where('leave_category_id', 2)->where('user_id', $id)->where('period', date('Y'))->orderBy('leave_date', 'desc')->paginate(10);

        // Exdo per Month

        $exdo = Initial_Leave::where('user_id', $id)->where('expired', '<=', date('Y-m-d', strtotime('+1 month')))->pluck('initial')->sum();
        $exdoAdnvace = Initial_Leave::where('user_id', $id)->pluck('initial')->sum();

        $sisaExdo = $this->exdoCount($id, $exdo);

        $totalExdo = $this->exdoCount($id, $exdoAdnvace);

        $remains = $totalExdo - $sisaExdo;

        $exdoForfeit = $this->exdoForfeit($id);

        if ($remains <= 0) {
            $remains = 0;
        }

        return view('HRDLevelAcces/leave/exdo/viewExdo/index', compact(['user', 'dept', 'no', 'exdoTransaction', 'sisaExdo', 'remains', 'totalExdo', 'exdoForfeit']));
    }

    private function exdoForfeit($id)
    {
        $wd = Initial_Leave::where('user_id', $id)
            ->whereDATE('expired', '<', date('Y-m-d'))
            ->pluck('initial')->sum();

        $minusExdod = Leave::where('user_id', $id)->where('leave_category_id', 2)->where('ap_hd', 1)->where('ap_gm', 1)->where('ver_hr', 1)->where('ap_hrd', 1)->pluck('total_day')->sum();

        $result = $wd - $minusExdod;

        return $result;
    }

    public function exdoCount($id, $exdo)
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

    public function excelIndexExdo(Request $request)
    {
        $id = $request->input('id');

        $user = User::findOrFail($id);
        $dept = Dept_Category::where('id', $user->dept_category_id)->value('dept_category_name');
        $data = Initial_Leave::where('user_id', $id)->where('expired', '>', date('Y-m-d'))->orderBy('expired', 'asc')->get();

        Excel::create('Index Summary Initial Exdo', function ($excel) use ($user, $dept, $data) {
            $excel->sheet('index Summary Initial Exdo', function ($sheet) use ($user, $dept, $data) {
                $sheet->setAutoSIze(true);
                $sheet->loadView('HRDLevelAcces/leave/exdo/viewExdo/excel/indexExdo', compact(['user', 'dept', 'data']));
            });
        })->export('xls');

        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Download index exdo successed']));

        return redirect()->route('hr/exdo/view/index', $id);
    }

    public function excelExdoTransaction(Request $request)
    {
        $id = $request->input('id');
        $month = $request->input('month');
        $period = $request->input('period');

        $user = User::findOrFail($id);
        $dept = Dept_Category::where('id', $user->dept_category_id)->value('dept_category_name');

        $data = Leave::where('user_id', $id)->where('leave_category_id', 2)->where('period', $period)->whereMonth('leave_date', $month)->orderBy('leave_date', 'desc')->get();

        if ($month == '0') {
            $data = Leave::where('user_id', $id)->where('leave_category_id', 2)->where('period', $period)->orderBy('leave_date', 'desc')->get();
        }

        Excel::create('Summary Exdo Transaction', function ($excel) use ($user, $dept, $data) {
            $excel->sheet('Summary Exdo Transaction', function ($sheet) use ($user, $dept, $data) {
                $sheet->setAutoSIze(true);
                $sheet->loadView('HRDLevelAcces/leave/exdo/viewExdo/excel/exdoLeaveTransaction', compact(['user', 'dept', 'data']));
            });
        })->export('xls');

        return redirect()->route('hr/exdo/view/index', $id);
    }

    public function datatablesCountdown($id)
    {
        $model = Initial_Leave::where('user_id', $id)
            ->where('expired', '>=', date('Y-m-d', strtotime('-2 months')))
            ->orderBy('expired', 'desc')
            ->get();

        return Datatables::of($model)
            ->addIndexColumn()
            ->addColumn('difforHumans', function (Initial_Leave $initial) {
                $carbon =  Carbon::parse($initial->expired)->addDay();
                return $carbon->diffForHumans();
            })
            ->setRowClass('@if ($expired < date("Y-m-d")){{ "danger" }} @endif')
            ->make(true);
    }

    public function datatablesExdoTransaction($id)
    {
        $query = Leave::where('leave_category_id', 2)->where('user_id', $id)->orderBy('leave_date', 'desc')->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (Leave $leave) {
                return $leave->user()->getFullname();
            })
            ->addColumn('statusForm', function (Leave $leave) {
                $return = Null;

                if ($leave->ap_hrd == 1) {
                    $return = "Complate";
                }
                if ($leave->ap_hrd > 1) {
                    $return = "Cancel";
                }
                if ($leave->ap_hrd == 0) {
                    $return = "Progress";
                }

                return $return;
            })
            ->make(true);
    }
}