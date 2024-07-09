<?php

namespace App\Http\Controllers\testing;

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

class NewAnnualController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function indexNewApply()
    {
    	$annual = DB::table('users')
        ->leftJoin('initial_leave', 'initial_leave.user_id', '=', 'users.id')
        ->leftJoin('leave_category', 'leave_category.id', '=', 'initial_leave.leave_category_id')
        ->leftJoin('leave_transaction', 'leave_transaction.user_id', '=', 'users.id')
      
        ->select([
            DB::raw('
            (
                select (
                    select COALESCE(sum(total_day), 0) from leave_transaction where user_id='.Auth::user()->id.' and leave_category_id=1
                    and ap_hd  = 1
                    and ap_gm  = 1                    
                    and ver_hr = 1
                    and ap_hrd = 1
                )
            ) as transactionAnnual')
        ])
        ->first();

        $user = User::find(auth::user()->id);

        $startDate = date_create($user->join_date);
        $endDate = date_create($user->end_date);

        $startYear = date('Y', strtotime($user->join_date));
        $endYear = date('Y', strtotime($user->end_date));

        if (auth::user()->emp_status === "Permanent") {
           $yearEnd = date('Y');
        } else {
            $yearEnd = $endYear;
        }

        $now = date_create();
        $now1 = date_create(date('Y').'-01-01');
        $now2 = date_create(date('Y').'-12-31');
            
       // date_create('2021-05-15') penambahan bulan terjadi
        // dd($endDate);
       
        if ($now <= $endDate) {
        	$sekarang = $now;
        } else {
        	$sekarang = $endDate;
        } 



        $daff = date_diff($startDate, $sekarang->modify('+5 day'))->format('%m')+(12*date_diff($startDate, $sekarang->modify('+5 day'))->format('%y'));

        $daffPermanent = date_diff($now1, $now->modify('+5 day'))->format('%m')+(12*date_diff($now1, $now->modify('+5 day'))->format('%y'));

        $daffPermanent2 = date_diff($now1, $now2->modify('+5 day'))->format('%m')+(12*date_diff($now1, $now2->modify('+5 day'))->format('%y'));

        $daffPermanent1 = 12 - $daffPermanent;        


        if ($daff <= $annual->transactionAnnual) {
        	$newAnnual =  $annual->transactionAnnual;
        }else{
        	$newAnnual = $daff;
        }       

        $totalAnnual = $newAnnual - $annual->transactionAnnual;

        $totalAnnualPermanent = $user->initial_annual - $annual->transactionAnnual;

        $totalAnnualPermanent1 = $totalAnnualPermanent - $daffPermanent1;

        // dd($sekarang);

        //-------------------------------------------------      

        $exdo = Initial_Leave::where('user_id', auth::user()->id)->pluck('initial');      

        $w = Initial_Leave::where('user_id', auth::user()->id)
                ->whereDATE('expired', '<=', Carbon::now())
                ->pluck('initial');

        $minusExdo = Leave::where('user_id', auth::user()->id)->where('leave_category_id', 2)->where('ap_hd', 1)->where('ap_gm', 1)->where('ver_hr', 1)->where('ap_hrd', 1)->pluck('total_day');

        $exdoHangus = $w->sum() - $minusExdo->sum();
        $exdoHangus1 = $minusExdo->sum() + $exdoHangus; 

        if ($w->sum() <= 0) {
            $sisaExdo = $exdo->sum() - $minusExdo->sum();
        } else {
           $sisaExdo = $exdo->sum() - $exdoHangus1;
        }           
    	
        // dd($w);
        return view('leave.NewAnnual.indexNewAnnual',[
            'annual'      => $annual,
            'totalAnnual' => $totalAnnual,
            'totalAnnualPermanent1' => $totalAnnualPermanent1,
            'remainExdo'     => $sisaExdo,
            'startYear'     => $startYear,
            'yearEnd'       => $yearEnd,
            'user'      => $user,
            'exdo'      =>$exdo,
            'minusExdo' => $minusExdo,
            'w' => $w,
        ]);
    }

    public function indexDataExdo()
    {
         $model = Initial_Leave::where('user_id', auth::user()->id) 
                ->where('expired', '>=', date('Y-m-d', strtotime('-2 months'))) 
                ->orderBy('expired', 'asc')
                ->get();

      return Datatables::of($model)  
                ->addIndexColumn()               
                ->addColumn('difforHumans', function(Initial_Leave $initial){
                    $carbon =  Carbon::parse($initial->expired);
                   

                    return $carbon->diffForHumans();
                })
                ->setRowClass('@if ($expired <= date("Y-m-d")){{ "danger" }}@endif')
                ->make(true);        
    }

    public function createAdvance()
    {
        $department = dept_category::where(['id' => Auth::user()->dept_category_id])->value('dept_category_name');

        
        $init_annual = DB::table('users')
        ->leftJoin('initial_leave', 'initial_leave.user_id', '=', 'users.id')
        ->leftJoin('leave_category', 'leave_category.id', '=', 'initial_leave.leave_category_id')
   
        ->select([
            DB::raw('
            (
                select (
                    select initial_annual from users where id='.Auth::user()->id.' 
                ) - (
                    select COALESCE(sum(total_day), 0) from leave_transaction where user_id='.Auth::user()->id.' and leave_category_id=1
                    and ap_hd  = 1
                    and ap_gm  = 1
                    and ver_hr = 1
                    and ap_hrd = 1
                )
            ) as remainannual')
        ])
        ->first();

        $annual = DB::table('users')
        ->leftJoin('initial_leave', 'initial_leave.user_id', '=', 'users.id')
        ->leftJoin('leave_category', 'leave_category.id', '=', 'initial_leave.leave_category_id')
        ->leftJoin('leave_transaction', 'leave_transaction.user_id', '=', 'users.id')
      
        ->select([
            DB::raw('
            (
                select (
                    select COALESCE(sum(total_day), 0) from leave_transaction where user_id='.Auth::user()->id.' and leave_category_id=1
                    and ap_hd  = 1
                    and ap_gm  = 1                    
                    and ver_hr = 1
                    and ap_hrd = 1
                )
            ) as transactionAnnual')
        ])
        ->first();

        // new rule
        $user = User::find(auth::user()->id);

        $startDate = date_create($user->join_date);
        $endDate = date_create($user->end_date);

        $startYear = date('Y', strtotime($user->join_date));
        $endYear = date('Y', strtotime($user->end_date));

        if (auth::user()->emp_status === "Permanent") {
           $yearEnd = date('Y');
        } else {
            $yearEnd = $endYear;
        }

        $now = date_create();
        $now1 = date_create(date('Y').'-01-01');
        $now2 = date_create(date('Y').'-12-31');

   

         if ($now <= $endDate) {
            $sekarang = $now;
        } else {
            $sekarang = $endDate;
        } 



        $daff = date_diff($startDate, $sekarang->modify('+5 day'))->format('%m')+(12*date_diff($startDate, $sekarang->modify('+5 day'))->format('%y'));

        $daffPermanent = date_diff($now1, $now->modify('+5 day'))->format('%m')+(12*date_diff($now1, $now->modify('+5 day'))->format('%y'));

        $daffPermanent2 = date_diff($now1, $now2->modify('+5 day'))->format('%m')+(12*date_diff($now1, $now2->modify('+5 day'))->format('%y'));

        $daffPermanent1 = 12 - $daffPermanent;        


        if ($daff <= $annual->transactionAnnual) {
            $newAnnual =  $annual->transactionAnnual;
        }else{
            $newAnnual = $daff;
        }       

        $totalAnnual = $newAnnual - $annual->transactionAnnual;

        $totalAnnualPermanent = $user->initial_annual - $annual->transactionAnnual;

        $totalAnnualPermanent1 = $totalAnnualPermanent - $daffPermanent1;

        $getAnnualBalance = null;

        if (auth::user()->emp_status === "Permanent")
        {
            $getAnnualBalance = $totalAnnualPermanent1;
        }else{
            $getAnnualBalance = $totalAnnual;
        }

        // dd($init_annual);

        //

        $taken = DB::table('users')
        ->leftJoin('initial_leave', 'initial_leave.user_id', '=', 'users.id')
        ->leftJoin('leave_category', 'leave_category.id', '=', 'initial_leave.leave_category_id')
        ->leftJoin('leave_transaction', 'leave_transaction.user_id', '=', 'users.id')
        ->select([
            DB::raw('
            (
                (
                    select COALESCE(sum(total_day), 0) from leave_transaction where user_id='.Auth::user()->id.' and leave_category_id=1
                    and ap_hd  = 1
                    and ap_gm  = 1
                    and ver_hr = 1
                    and ap_hrd = 1
                )
            ) as leavetaken')
        ])
        ->first();

        $ent_annual = DB::table('users')
        ->leftJoin('initial_leave', 'initial_leave.user_id', '=', 'users.id')
        ->leftJoin('leave_category', 'leave_category.id', '=', 'initial_leave.leave_category_id')
        ->leftJoin('leave_transaction', 'leave_transaction.user_id', '=', 'users.id')
        ->select([
            DB::raw('
            (
                (
                    select COALESCE(sum(initial), 0) from initial_leave where user_id='.Auth::user()->id.' and leave_category_id=1
                ) 
            ) as entitle_ann')
        ])
        ->first();

      $leave_day = DB::table('users')
        ->leftJoin('initial_leave', 'initial_leave.user_id', '=', 'users.id')
        ->leftJoin('leave_category', 'leave_category.id', '=', 'initial_leave.leave_category_id')
        ->leftJoin('leave_transaction', 'leave_transaction.user_id', '=', 'users.id')
        ->select([
            DB::raw('
            (
                select (
                    SELECT datediff(end_leave_date, leave_date) FROM leave_transaction
                    
                ) 
            ) as remainleaveday')
        ])
        ->first();

      

        $pro_category = User::where('users.koor', '=', 1)->where('active', 1)->orderBy('first_name', 'asc')->get(); 
            foreach ($pro_category as $value)
                 $proe[$value->email] = $value->first_name.' '.$value->last_name;

         $pm_category = User::where('users.pm', '=', 1)->where('active', 1)->orderBy('first_name', 'asc')->get();    
            foreach ($pm_category as $value)
                $pmm[$value->email] = $value->first_name.' '.$value->last_name;

        $level_hrd =  User::where('level_hrd', '=', 'Senior Pipeline')->where('dept_category_id', 6)->where('active', 1)->get();
             foreach ($level_hrd as $value)
                $level[$value->email] =  $value->first_name.' '.$value->last_name;

        $rickys = User::where('level_hrd', '=', 'Senior Technical')->where('dept_category_id', 6)->where('active', 1)->get();
             foreach ($rickys as $value)
                $ricky['dede.aftafiandi@frameworks-studios.com'] =  $value->first_name.' '.$value->last_name;
        // dd($rickys);
        $ghea =   User::select('email')->where('hd', '=', '1')->where('dept_category_id', 6)->pluck('email');

        $provinsi = file_get_contents('http://dev.farizdotid.com/api/daerahindonesia/provinsi');
        $provinsii = json_decode($provinsi, true);
        $provinsii = $provinsii['provinsi']; 
        $emailHOD = [
            'dede.aftafiandi@frameworks-studios.com' => 'HR Department'
        ];
        $emailHoD = User::where('active', 1)->where('dept_category_id', auth::user()->dept_category_id)->where('hd', 1)->get();
         foreach ($emailHoD as $Hod)
                $emailHOD[$Hod->email] = $Hod->first_name.' '.$Hod->last_name;

        // dd($emailHOD);

        if ($init_annual->remainannual)
        {
            return View::make('leave.createAdvance')->with([
            'leave' => $init_annual->remainannual, 
            'department' => $department, 
            'taken' => $taken->leavetaken, 
            'ent_annual' => $ent_annual->entitle_ann, 
            'proe' => $proe, 
            'pmm' => $pmm, 
            'level' => $level, 
            'ricky' => $ricky,
            'ghea' => $ghea, 
            'provinsii' => $provinsii,
            'emailHOD' => $emailHOD
            ]);
        } else {
            return Redirect::route('createAdvanceLeave');
        }
    }
}
