<?php

namespace App\Http\Controllers\programmer;

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
use App\User;
use App\Forfeited;
use App\ForfeitedCounts;
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
use Carbon\Carbon;

class DevController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'active']);
    }

    public function indexProgressLeave()
    {        
       return view('IT.Progress.hrd.annual_leave.progress');
    }

    public function dataProggressLeave()
    {
        $select = Leave::select([
            'id',
            'leave_category_id',
            'request_by', 'request_nik',
            'request_dept_category_name',
            'period',
            'leave_date',
            'total_day',
            'ap_koor',
            'ap_spv',
            'ap_pm',
            'ap_hd',
            'ver_hr',
            'ap_hrd',
            'leave_date',
            'end_leave_date',
            'back_work'
        ])->where('ap_hrd', 0)->where('ap_hd', '!=', 2)->where('ver_hr', '!=', 2)->where('ap_producer', '!=', 2)->where('ap_pm', '!=', 2)->where('ap_spv', '!=', 2)
        ->where('ap_koor', '!=', 2)->where('period', '2021')
        ->orderBy('id', 'desc')->get();

        return Datatables::of($select)
        ->addIndexColumn()
        ->addColumn('actions', function(Leave $leave){
            $button = '<a href="'.route('dev/delete/leave', $leave->id).'" class="btn btn-danger btn-xs">&#xf1f8;</a>';

            return $button;
        })
        ->rawColumns(['actions'])
        ->editColumn('leave_category_id', function(Leave $leave){
            $name = Leave_Category::find($leave->leave_category_id);

            if ($leave->req_advance === 2) {
               $return = 'Forfoited';
            } else {
               $return = $name->leave_category_name;
            }

            return $return;
            
        })
        ->editColumn('ap_koor', function(Leave $statment){
          
            if ($statment->ap_koor === 0) {
                $return = 'Pending Coordinator';
            } else {

                if ($statment->ap_spv === 0) {
                    $return = 'Pending SPV';
                } else {

                    if ($statment->ap_pm === 0) {
                        $return = 'Pending PM';
                    } else {

                        if ($statment->ap_producer === 0) {
                            $return = 'Pending Producer';
                        } else {

                            if ($statment->ap_hd === 0) {
                                $return = 'Pending Head of Department';
                            } else {

                                if ($statment->ver_hr === 0) {
                                    $return = 'Pending HR Checking';
                                } else {

                                    if ($statment->ap_hrd === 0) {
                                        $return = 'Pending HR Manager';
                                    } else {
                                        $return = 'Approved';
                                    }
                                    
                                }
                                
                            }
                            
                        }
                        
                    }
                    
                }
                
            }

            return $return;            

        })
        ->make(true);
    }

    public function indexStatmentLeaveProgress()
    {
        return view('IT.Progress.hrd.annual_leave.progressCount');
    }

    public function dataStatmentLeavePrograess()
    {
        $model = User::select([
            'id', 
            'first_name', 
            'last_name',
            'dept_category_id',
            'position',
            'emp_status',
            'initial_annual'
        ])->where('active', 1)->orderBy('first_name', 'asc')->whereNotNull('nik')->whereNotIn('nik', [1234566789])
        ->get();

        return Datatables::of($model)
        ->addIndexColumn()
        ->edit_column('first_name', function(User $user){
            return $user->first_name.' '.$user->last_name;
        })
        ->edit_column('initial_leave', function(User $user){
            $annual = DB::table('users')
                ->leftJoin('initial_leave', 'initial_leave.user_id', '=', 'users.id')
                ->leftJoin('leave_category', 'leave_category.id', '=', 'initial_leave.leave_category_id')
                ->leftJoin('leave_transaction', 'leave_transaction.user_id', '=', 'users.id')
              
                ->select([
                    DB::raw('
                    (
                        select (
                            select COALESCE(sum(total_day), 0) from leave_transaction where user_id='.$user->id.' and leave_category_id=1
                            and ap_hd  = 1
                            and ap_gm  = 1                    
                            and ver_hr = 1
                            and ap_hrd = 1
                        )
                    ) as transactionAnnual')
                ])
                ->first(); 

               $return = $user->initial_annual - $annual->transactionAnnual;

                return $return;
        })
        ->edit_column('dept_category_id', function(User $user){
            $dept = Dept_Category::find($user->dept_category_id);
            return $dept->dept_category_name;
        })
        ->addColumn('available', function(User $user){
                $return = $this->availableLeave($user->id);

                return $return; 
        })
        ->addColumn('remainForfeit', function(User $user){    
            $selectF = Forfeited::where('user_id', $user->id)->get();

            $select = ForfeitedCounts::where('user_id', $user->id)->where('status', 1)->get();

            $return = $selectF->pluck('countAnnual')->sum() - $select->pluck('amount')->sum();

            return $return;
        })
        ->addColumn('leaveonProgress', function(User $user){
            $leave = Leave::where('ap_hrd', 0)->where('period', 2021)->where('user_id', $user->id)->get();

            return $leave->pluck('total_day')->sum();
        })
        ->make(true);
    }

    public function availableLeave($id)
    {
        $user = User::find($id);

        $annual = DB::table('users')
                ->leftJoin('initial_leave', 'initial_leave.user_id', '=', 'users.id')
                ->leftJoin('leave_category', 'leave_category.id', '=', 'initial_leave.leave_category_id')
                ->leftJoin('leave_transaction', 'leave_transaction.user_id', '=', 'users.id')
              
                ->select([
                    DB::raw('
                    (
                        select (
                            select COALESCE(sum(total_day), 0) from leave_transaction where user_id='.$user->id.' and leave_category_id=1
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

                $now = date_create();
                $now1 = date_create(date('Y').'-01-01');
                $now2 = date_create(date('Y').'-12-31');
                    
               // date_create('2021-05-15') penambahan bulan terjadi
                // dd($now);
               
                if ($now <= $endDate) {
                    $sekarang = $now;
                } else {
                    $sekarang = $endDate;
                } 

                $daff = date_diff($startDate, $sekarang)->format('%m')+(12*date_diff($startDate, $sekarang->modify('+5 day'))->format('%y'));

                $daffPermanent = date_diff($now1, $now)->format('%m')+(12*date_diff($now1, $now->modify('+5 day'))->format('%y'));

                $daffPermanent2 = date_diff($now1, $now2)->format('%m')+(12*date_diff($now1, $now2->modify('+5 day'))->format('%y'));

                $daffPermanent1 = 12 - $daffPermanent;        

               

                if ($daff <= $annual->transactionAnnual) {
                    $newAnnual =  $annual->transactionAnnual;
                }else{
                    $newAnnual = $daff;
                }       

                $totalAnnual = $newAnnual - $annual->transactionAnnual;

                $totalAnnualPermanent = $user->initial_annual - $annual->transactionAnnual;

                $totalAnnualPermanent1 = $totalAnnualPermanent - $daffPermanent1;

                 if ($user->emp_status === "Permanent") {
                   $return = $totalAnnualPermanent1;
                } else {
                    $return = $totalAnnual;
                }

        return $return;
    }

    public function deleteFormLeave($id)
    {
        $leave = Leave::findOrFail($id);
        Session::flash('getError', Lang::get('messages.data_deleted', ['data' => 'Data Leave Transaction '.$leave->request_by.' Deleted' ]));
        $leave->delete();

        return redirect()->route('dev/indexProgressLeave');        
    }

    public function indexHistoriLeave()
    {
        return view('IT.Progress.hrd.annual_leave.histori');
    }

    public function dataHistoriLeave()
    {
        $model = Leave::select([
            'id', 'user_id', 'leave_category_id', 'request_by', 'request_nik', 'request_position', 'request_dept_category_name', 'leave_date', 'end_leave_date', 'total_day', 'period'
        ])
        ->where('ap_hrd', 1)->where('period', '2022')->orderBy('leave_date', 'desc')->get();

        return Datatables::of($model)
        ->addIndexColumn()
        ->addColumn('status', function(Leave $leave){
            $usr = User::find($leave->user_id);

            $status = '<span style="color:red;">Deactive</span>';

            if ($usr->active === 1) {
                $status = '<span style="color:green;">Active</span>';
            }

            return $status;
        })
        ->addColumn('actions', function(Leave $leave){
             $button = '<a href="'.route('dev/histori/leave/delete', $leave->id).'" class="btn btn-danger btn-xs">&#xf1f8;</a>';
             return $button;
        })
        ->rawColumns(['actions'])
        ->editColumn('user_id', function(Leave $leave){
            $user = User::find($leave->user_id);

            return $user->first_name.' '.$user->last_name;
        })
        ->editColumn('leave_category_id', function(Leave $leave){
            $return = Leave_Category::find($leave->leave_category_id);

            return $return->leave_category_name;
        }) 

        ->make(true);
    }

    public function deleteHistoriLeave($id)
    {
        $leave = Leave::findOrFail($id);
        Session::flash('getError', Lang::get('messages.data_deleted', ['data' => 'Data Leave Transaction '.$leave->request_by.' Deleted' ]));
        $leave->delete();

        return redirect()->route('dev/histori/leave');
    }
    
    public function signatureLayoutV2(Request $request)
    {
        return view('IT.support.signature.layout_v2', compact(['request']));
    }

    public function signatureEmail()
    {
        return view('IT.support.signature.index');
    }

    public function downloadSignature(Request $request)
    {
        $url = file_get_contents(route('dev/signature/layout_v2'));
        dd($url);
    }

}
