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
use App\User;
use App\Forfeited;
use App\ForfeitedCounts;
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

class LeaveHalfDayController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
        
    }

    public function indexHalfDay()
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

        $getAnnualBalance = null;

        if (auth::user()->emp_status === "Permanent")
        {
            $getAnnualBalance = $totalAnnualPermanent1;
        }else{
            $getAnnualBalance = $totalAnnual;
        }        

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

         $pro_category = User::where('users.koor', '=', 1)->where('active', 1)->where('users.dept_category_id', 6)->orderBy('first_name', 'asc')->get(); 
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
                $ricky[$value->email] =  $value->first_name.' '.$value->last_name;
      
        $ghea =   User::select('email')->where('active', 1)->where('hd', '=', '1')->where('dept_category_id', 6)->pluck('email');
       
        $infiniteApproved = User::where('active', 1)->where('infiniteApprove', 1)->where('dept_ApprovedHOD', auth::user()->dept_category_id)->value('email');      

        $johnReedel = User::select('email')->where('active', 1)->where('hd', 1)->where('dept_category_id', 7)->value('email');

        $lineProducer = User::where('active', 1)->where('producer', 1)->where('dept_category_id', 6)->orderBy('first_name', 'asc')->get();
            foreach ($lineProducer as $value)
               $producer[$value->email] =  $value->first_name.' '.$value->last_name; 

        $supervisor = User::where('active', 1)->where('spv', 1)->whereIn('dept_category_id', [4, 6])->orderBy('first_name', 'asc')->get(); 
            foreach ($supervisor as $value)              
                $spv[$value->email] = $value->first_name.' '.$value->last_name;

        // $provinsi = file_get_contents('http://dev.farizdotid.com/api/daerahindonesia/provinsi');
        $provinsi = file_get_contents('https://ibnux.github.io/data-indonesia/propinsi.json');

        $provinsii = json_decode($provinsi, true);
        // $provinsii = $provinsii['provinsi']; 

        if (auth::user()->hd === 1) {
            if (auth::user()->dept_category_id === 7) {

               $emailHoD = User::where('active', 1)->where('gm', 1)->where('sg', 1)->get();

            } elseif (auth::user()->dept_category_id === 5) {

                $emailHoD = User::where('active', 1)->where('gm', 1)->where('sg', 1)->get();

            } else {
               $emailHoD = User::where('active', 1)->where('gm', 1)->where('sg', 0)->get(); 
            }

            $labelEmailHOD = 'Verify by :';
        } else {
            if (auth::user()->dept_category_id === 4) {
                $emailHoD = User::where('active', 1)->where('dept_category_id', 6)->where('hd', 1)->get(); 
                $labelEmailHOD = 'Produciton Manager :';
            } else {
                // 1175 id Mia sinaga -> apply forward ke John Radel
                if (auth::user()->id === 1175) {
                     $emailHoD = User::where('active', 1)->where('dept_category_id', 7)->where('hd', 1)->get();
                } else {
                     $emailHoD = User::where('active', 1)->where('dept_category_id', auth::user()->dept_category_id)->where('hd', 1)->get(); 
                }                
               
                $labelEmailHOD = 'Head of Department :';
            }
            
        }

        foreach ($emailHoD as $Hod)
                $emailHOD[$Hod->email] = $Hod->first_name.' '.$Hod->last_name;

      

        if ($init_annual->remainannual)
        {
            return View::make('leave.createHalfDay')->with([
            'leave' => $getAnnualBalance, 
            'department' => $department, 
            'labelEmailHOD' => $labelEmailHOD,
            'taken' => $taken->leavetaken, 
            'ent_annual' => $ent_annual->entitle_ann, 
            'proe' => $proe, 
            'pro_category' => $pro_category,
            'pmm'       => $pmm,
            'pm_category' => $pm_category,
            'level' => $level, 
            'ricky' => $ricky,
            'ghea' => $ghea, 
            'provinsii' => $provinsii,
             // 'leave_day' => $leave_day->remainleaveday
            'emailHOD' => $emailHOD,
            'infiniteApproved' => $infiniteApproved,
            'johnReedel' => $johnReedel,
            'producer'  => $producer,
            'spv'       => $spv,
            'supervisor'       => $supervisor
            
            ]);
        } else {
          return Redirect::route('leave/apply');
        }

          return View::make('leave.createHalfDay');

    }

   public function storeLeaveHalfDay(Request $request)
    {
        $init_annual = DB::table('users')
        ->leftJoin('initial_leave', 'initial_leave.user_id', '=', 'users.id')
        ->leftJoin('leave_category', 'leave_category.id', '=', 'initial_leave.leave_category_id')
        ->leftJoin('leave_transaction', 'leave_transaction.user_id', '=', 'users.id')   
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
                    select initial_annual from users where id='.Auth::user()->id.'
                ) 
            ) as entitle_ann')
        ])
        ->first();      
    
         $leave_d = DB::table('leave_transaction')
         ->whereRaw('Datediff(end_leave_date, leave_date)')
            ->first();
                  
                $email_koor = null;
                $email_spv = null;
                $email_pm = null;
                $email_producer = null;
                $ap_gm      = 0;
                $date_ap_gm = null;
                $ap_pipeline = 0;
                $date_ap_pipeline = null;
                $ap_spv = 0;
                $date_ap_spv = null;
                $ap_koor = 0;
                $date_ap_koor = null;
                $ap_pm = 0;
                $date_ap_pm = null;
                $ap_producer = 0;
                $date_producer  = null;
                $ap_hd = 0;
                $date_ap_hd = null;
                // ---------------------
                $ap_infinite = 0;
                $date_ap_infinite = null;

        // dept_category 1 = IT
        if (auth::user()->dept_category_id === 1) {
            if (auth::user()->hd === 1) {
                // HOD -> GM (mike) -> Ver_hr -> HRD -> 
                $ap_pipeline = 1;
                $date_ap_pipeline = date("Y-m-d");
                $ap_spv = 1;
                $date_ap_spv = date("Y-m-d");
                $ap_koor = 1;
                $date_ap_koor = date("Y-m-d");
                $ap_pm = 1;
                $date_ap_pm = date("Y-m-d");
                $ap_producer = 1;
                $date_producer  = date("Y-m-d");
                $ap_hd = 1;
                $date_ap_hd = date("Y-m-d");
                $email_pm = $request->input('sendtoPM');
             } else {
                // Employee -> HOD -> Ver_HR -> HRD
                $ap_pipeline = 1;
                $date_ap_pipeline = date("Y-m-d");
                $ap_spv = 1;
                $date_ap_spv = date("Y-m-d");
                $ap_koor = 1;
                $date_ap_koor = date("Y-m-d");
                $ap_pm = 1;
                $date_ap_pm = date("Y-m-d");
                $ap_producer = 1;
                $date_producer  = date("Y-m-d");
                $ap_gm = 1;
                $date_ap_gm = date("Y-m-d");
                $email_pm = $request->input('sendtoPM');
             }              
        }
        // dept_category 2 = Finance
        elseif (auth::user()->dept_category_id === 2) {
               if (auth::user()->hd === 1) {
                // HOD -> Sow Kim -> Ver_HR -> HRD -> GM (mike)
                $ap_pipeline = 1;
                $date_ap_pipeline = date("Y-m-d");
                $ap_spv = 1;
                $date_ap_spv = date("Y-m-d");
                $ap_koor = 1;
                $date_ap_koor = date("Y-m-d");
                $ap_pm = 1;
                $date_ap_pm = date("Y-m-d");
                $ap_producer = 1;
                $date_producer  = date("Y-m-d");
                $ap_hd = 1;
                $date_ap_hd = date("Y-m-d");
                // ----------------------------------------------              
                $email_pm = $request->input('sendtoPM');

             } else {
                 // Employee -> HOD -> Ver_HR -> HRD
                $ap_pipeline = 1;
                $date_ap_pipeline = date("Y-m-d");
                $ap_spv = 1;
                $date_ap_spv = date("Y-m-d");
                $ap_koor = 1;
                $date_ap_koor = date("Y-m-d");
                $ap_pm = 1;
                $date_ap_pm = date("Y-m-d");
                $ap_producer = 1;
                $date_producer  = date("Y-m-d");
                $ap_gm = 1;
                $date_ap_gm = date("Y-m-d");
                $email_pm = $request->input('sendtoPM');              
             }
        }
        // dept_category 3 = HRD
        elseif (auth::user()->dept_category_id === 3) {
               if (auth::user()->hd === 1) {
                // HOD -> Ver_HR -> HRD -> GM (mike)
                $ap_pipeline = 1;
                $date_ap_pipeline = date("Y-m-d");
                $ap_spv = 1;
                $date_ap_spv = date("Y-m-d");
                $ap_koor = 1;
                $date_ap_koor = date("Y-m-d");
                $ap_pm = 1;
                $date_ap_pm = date("Y-m-d");
                $ap_producer = 1;
                $date_producer  = date("Y-m-d");
                $ap_hd = 1;
                $date_ap_hd = date("Y-m-d");  
                $email_pm = $request->input('sendtoPM');             
             } else {
                // Employee -> HOD -> Ver_HR -> HRD
                $ap_pipeline = 1;
                $date_ap_pipeline = date("Y-m-d");
                $ap_spv = 1;
                $date_ap_spv = date("Y-m-d");
                $ap_koor = 1;
                $date_ap_koor = date("Y-m-d");
                $ap_pm = 1;
                $date_ap_pm = date("Y-m-d");
                $ap_producer = 1;
                $date_producer  = date("Y-m-d");
                $ap_gm = 1;
                $date_ap_gm = date("Y-m-d");
                // $email_pm = 'hr.verification@frameworks-studios.com';
                $email_pm = $request->input('sendtoPM');
                $ap_hd = 1;
                $date_ap_hd = date("Y-m-d");
             }
        }
        //dept Category 4 = Operational ?
        elseif (auth::user()->dept_category_id === 4) {
                $ap_pipeline = 1;
                $date_ap_pipeline = date("Y-m-d");
                $ap_spv = 1;
                $date_ap_spv = date("Y-m-d");
                $ap_koor = 1;
                $date_ap_koor = date("Y-m-d");
                $ap_pm = 1;
                $date_ap_pm = date("Y-m-d");
                $ap_producer = 1;
                $date_producer  = date("Y-m-d");
                $ap_gm = 1;
                $date_ap_gm = date("Y-m-d");                
                $email_pm = $request->input('sendtoPM'); 
        }
        //dept_category 5 = Facility
        elseif (auth::user()->dept_category_id === 5) {
               if (auth::user()->hd === 1) {
                // HOD -> John Reedel -> Ver_HR -> HRD -> GM (Mike)
                $ap_pipeline = 1;
                $date_ap_pipeline = date("Y-m-d");
                $ap_spv = 1;
                $date_ap_spv = date("Y-m-d");
                $ap_koor = 1;
                $date_ap_koor = date("Y-m-d");
                $ap_pm = 1;
                $date_ap_pm = date("Y-m-d");
                // $ap_producer = 0;
                // $date_producer  = date("Y-m-d");
                $ap_hd = 1;
                $date_ap_hd = date("Y-m-d");
                // -------------------
                $ap_infinite = 1;
                $date_ap_infinite = date('Y-m-d');
                $email_pm = $request->input('sendtoPM');

             } else {
                // Employee -> HOD -> Ver_HR -> HRD
                $ap_pipeline = 1;
                $date_ap_pipeline = date("Y-m-d");
                $ap_spv = 1;
                $date_ap_spv = date("Y-m-d");
                $ap_koor = 1;
                $date_ap_koor = date("Y-m-d");
                $ap_pm = 1;
                $date_ap_pm = date("Y-m-d");
                $ap_producer = 1;
                $date_producer  = date("Y-m-d");
                $ap_gm = 1;
                $date_ap_gm = date("Y-m-d");
                $email_pm = $request->input('sendtoPM');
             }
        }
        //dept category 6 = Production
        elseif (auth::user()->dept_category_id === 6) {
            if (auth::user()->hd === 1) {
                // HOD -> Choonmeng -> Ver_HR -> HRD -> GM (Mike)
                $ap_pipeline = 0;
                $date_ap_pipeline = date("Y-m-d");
                $ap_spv = 0;
                $date_ap_spv = date("Y-m-d");
                $ap_koor = 1;
                $date_ap_koor = date("Y-m-d");
                $ap_pm = 1;
                $date_ap_pm = date("Y-m-d");
                $ap_producer = 1;
                $date_producer  = date("Y-m-d");
                $ap_hd = 1;
                $date_ap_hd = date("Y-m-d");
                // -----------------------
                $ap_infinite = 1;
                $date_ap_infinite = date('Y-m-d');
                $email_pm = $request->input('sendtoPM');

             } else {
                if (auth::user()->level_hrd != '0') {
                   if (auth::user()->level_hrd === 'Junior Pipeline') 
                   {        
                    // Employee -> Senior Pipeline -> HOD -> Ver_HR -> HRD
                            $ap_pipeline = 0;
                            $date_ap_pipeline = null;
                            $ap_spv = 0;
                            $date_ap_spv = null;
                            $ap_koor = 1;
                            $date_ap_koor = date("Y-m-d");
                            $ap_pm = 1;
                            $date_ap_pm = date("Y-m-d");
                            $ap_producer = 1;
                            $date_producer  = date("Y-m-d");
                            $ap_gm = 1;
                            $date_ap_gm = date("Y-m-d");
                            $email_koor = $request->input('sendto');
                   } elseif (auth::user()->level_hrd === 'Junior Technical') 
                   {  
                    // Employee -> Senior Pipeline -> HOD -> Ver_HR -> HRD
                            $ap_pipeline = 0;
                            $date_ap_pipeline = null;
                            $ap_spv = 0;
                            $date_ap_spv = null;
                            $ap_koor = 1;
                            $date_ap_koor = date("Y-m-d");
                            $ap_pm = 1;
                            $date_ap_pm = date("Y-m-d");
                            $ap_producer = 1;
                            $date_producer  = date("Y-m-d");
                            $ap_gm = 1;
                            $date_ap_gm = date("Y-m-d");
                            $email_koor = $request->input('sendto');
                   }elseif (auth::user()->level_hrd === 'Senior Pipeline') {
                            $ap_pipeline = 0;
                            $date_ap_pipeline = date("Y-m-d");
                            $ap_spv = 1;
                            $date_ap_spv = date("Y-m-d");
                            $ap_koor = 1;
                            $date_ap_koor = date("Y-m-d");
                            $ap_pm = 1;
                            $date_ap_pm = date("Y-m-d");
                            $ap_producer = 1;
                            $date_producer  = date("Y-m-d");
                            $ap_gm = 1;
                            $date_ap_gm = date("Y-m-d");
                            $email_pm = $request->input('sendtoPM');
                   }elseif (auth::user()->level_hrd === 'Senior Technical') {
                             $ap_pipeline = 0;
                            $date_ap_pipeline = date("Y-m-d");
                            $ap_spv = 1;
                            $date_ap_spv = date("Y-m-d");
                            $ap_koor = 1;
                            $date_ap_koor = date("Y-m-d");
                            $ap_pm = 1;
                            $date_ap_pm = date("Y-m-d");
                            $ap_producer = 1;
                            $date_producer  = date("Y-m-d");
                            $ap_gm = 1;
                            $date_ap_gm = date("Y-m-d");
                            $email_pm = $request->input('sendtoPM');
                   }
                   
                } else {
                        if (auth::user()->producer === 1) {
                            $ap_pipeline = 0;
                            $date_ap_pipeline = date("Y-m-d");
                            $ap_spv = 1;
                            $date_ap_spv = date("Y-m-d");
                            $ap_koor = 1;
                            $date_ap_koor = date("Y-m-d");
                            $ap_pm = 1;
                            $date_ap_pm = date("Y-m-d");
                            $ap_producer = 1;
                            $date_producer  = date("Y-m-d");
                            $ap_gm = 1;
                            $date_ap_gm = date("Y-m-d");
                            $email_pm = $request->input('sendtoPM');
                        } 
                        elseif (auth::user()->pm === 1) {
                            $ap_pipeline = 0;
                            $date_ap_pipeline = date("Y-m-d");
                            $ap_spv = 1;
                            $date_ap_spv = date("Y-m-d");
                            $ap_koor = 1;
                            $date_ap_koor = date("Y-m-d");
                            $ap_pm = 1;
                            $date_ap_pm = date("Y-m-d");
                            $ap_producer = 1;
                            $date_producer  = date("Y-m-d");
                            $ap_gm = 1;
                            $date_ap_gm = date("Y-m-d");
                            $email_pm = $request->input('sendtoPM');
                        }
                        elseif (auth::user()->koor === 1) {
                            $ap_pipeline = 0;
                            $date_ap_pipeline = date("Y-m-d");
                            $ap_spv = 1;
                            $date_ap_spv = date("Y-m-d");
                            $ap_koor = 1;
                            $date_ap_koor = date("Y-m-d"); 
                            $ap_gm = 1;
                            $date_ap_gm = date("Y-m-d"); 
                            $email_pm = $request->input('sendtoPM');           
                        }
                        elseif (auth::user()->spv === 1) {
                            $ap_pipeline = 0;
                            $date_ap_pipeline = date("Y-m-d");
                            $ap_spv = 1;
                            $date_ap_spv = date("Y-m-d"); 
                            $ap_koor = 1;
                            $date_ap_koor = date("Y-m-d");  
                            $ap_gm = 1;
                            $date_ap_gm = date("Y-m-d");  
                            $email_producer = $request->input('sendtoProducer');  
                            $email_pm = $request->input('sendtoPM'); 

                        }
                        else {
                            $ap_pipeline = 0;
                            $date_ap_pipeline = date("Y-m-d");                            
                            $ap_gm = 1;
                            $date_ap_gm = date("Y-m-d");
                            $email_koor = $request->input('sendto');
                            $email_spv = $request->input('sendtoSPV');
                            $email_pm = $request->input('sendtoPM');   
                        }                   
                }
                
                
             }
        }
        // dept category 7 = Production LS
        elseif (auth::user()->dept_category_id === 7) {
            if (auth::user()->hd === 1) {
                // HOD -> Ver_HR -> HRD -> GM (mike)
                $ap_pipeline = 1;
                $date_ap_pipeline = date("Y-m-d");
                $ap_spv = 1;
                $date_ap_spv = date("Y-m-d");
                $ap_koor = 1;
                $date_ap_koor = date("Y-m-d");
                $ap_pm = 1;
                $date_ap_pm = date("Y-m-d");
                $ap_producer = 1;
                $date_producer  = date("Y-m-d");
                $ap_hd = 1;
                $date_ap_hd = date("Y-m-d"); 

            } else {
                // Employee -> HOD-> Ver_HR -> HRD
                $ap_pipeline = 1;
                $date_ap_pipeline = date("Y-m-d");
                $ap_spv = 1;
                $date_ap_spv = date("Y-m-d");
                $ap_koor = 1;
                $date_ap_koor = date("Y-m-d");
                $ap_pm = 1;
                $date_ap_pm = date("Y-m-d");
                $ap_producer = 1;
                $date_producer  = date("Y-m-d");
                $ap_gm = 1;
                $date_ap_gm = date("Y-m-d");
                $email_pm = $request->input('sendtoPM');
            }
            
        }
        // dept category 8 = General
        elseif (auth::user()->dept_category_id === 8) {
               if (auth::user()->hd === 1) {
                    // HOD -> Ver_HR -> HRD 
                    $ap_pipeline = 1;
                    $date_ap_pipeline = date("Y-m-d");
                    $ap_spv = 1;
                    $date_ap_spv = date("Y-m-d");
                    $ap_koor = 1;
                    $date_ap_koor = date("Y-m-d");
                    $ap_pm = 1;
                    $date_ap_pm = date("Y-m-d");
                    $ap_producer = 1;
                    $date_producer  = date("Y-m-d");
                    $ap_hd = 1;
                    $date_ap_hd = date("Y-m-d");                  
               } else {
                    // Employee -> HOD -> Ver_HR -> HRD
                    $ap_pipeline = 1;
                    $date_ap_pipeline = date("Y-m-d");
                    $ap_spv = 1;
                    $date_ap_spv = date("Y-m-d");
                    $ap_koor = 1;
                    $date_ap_koor = date("Y-m-d");
                    $ap_pm = 1;
                    $date_ap_pm = date("Y-m-d");
                    $ap_producer = 1;
                    $date_producer  = date("Y-m-d");
                    $ap_gm = 1;
                    $date_ap_gm = date("Y-m-d");     
                    $email_pm = $request->input('sendtoPM');              
               }
               
        }
        // dept category 9 = Management ?
        elseif (auth::user()->dept_category_id === 9) {
            $ap_pipeline = 1;
            $date_ap_pipeline = date("Y-m-d");
            $ap_spv = 1;
            $date_ap_spv = date("Y-m-d");
            $ap_koor = 1;
            $date_ap_koor = date("Y-m-d");
            $ap_pm = 1;
            $date_ap_pm = date("Y-m-d");
            $ap_producer = 1;
            $date_producer  = date("Y-m-d");
            $ap_hd = 1;
            $date_ap_hd = date("Y-m-d");
            $ap_gm = 1;
            $date_ap_gm = date("Y-m-d");
        }
        ////////////////////////////////////////////
            $tahun_libur = db::table('view_off_year')->whereDate('date','>=', $request->input('leave_date'))->whereDate('date','<=', $request->input('end_leave_date'))->get();
            $tahuan = array();           
            foreach ($tahun_libur as $key => $tahuan_value) {
                $tahuan[] = $tahuan_value->date;
            }

            $awal_cuti = strtotime($request->input('leave_date'));
            $akhir_cuti = strtotime($request->input('end_leave_date'));
            $haricuti = array();         
            for ($i=$awal_cuti; $i <= $akhir_cuti; $i += (60 * 60 * 24)) {
                if (date('w', $i) !== '0' && date('w', $i) !== '6') {
                  
                        $haricuti[] = $i;
                   
                }
            }

            $start_leaved       = $request->input('leave_date');
            $end_leaved         = $request->input('end_leave_date');
            $back_work_leaved   = $request->input('back_work');

            if ($start_leaved <= $end_leaved) {
               $get_end_leaved = $end_leaved;
            } else {
                $get_end_leaved = null;
            }

            if ($back_work_leaved > $end_leaved) {                
                $jumlah_cuti = count($haricuti) - count($tahuan);
            }  elseif ($back_work_leaved = $end_leaved) {               
                $jumlah_cuti = count($haricuti) - count($tahuan) - 0.5;
            } elseif ($back_work_leaved < $end_leaved) {               
                $jumlah_cuti = 0;
            } 

            if ($back_work_leaved >= $end_leaved) {
               $get_bacl_work_leaved = $back_work_leaved;
            } else {
                $get_bacl_work_leaved = null;
            }
            

            $remaining = $request->input('entitlement') - $jumlah_cuti;
            //////////////////////////////////////////////////////
            
            /////////////////////////////////////////////////
     
       
        if ($request->input('nama_provin') === '11') {
            $nama_provins = 'Aceh';
        }elseif ($request->input('nama_provin') === '12') {
            $nama_provins = 'Sumatera Utara';
        }elseif ($request->input('nama_provin') === '13') {
            $nama_provins = 'Sumatera Barat';
        }elseif ($request->input('nama_provin') === '14') {
            $nama_provins = 'Riau';
        }elseif ($request->input('nama_provin') === '15') {
            $nama_provins = 'Jambi';
        }elseif ($request->input('nama_provin') === '16') {
            $nama_provins = 'Sumatera Selatan';
        }elseif ($request->input('nama_provin') === '17') {
            $nama_provins = 'Bengkulu';
        }elseif ($request->input('nama_provin') === '18') {
            $nama_provins = 'Lampung';
        }elseif ($request->input('nama_provin') === '19') {
            $nama_provins = 'Kepulauan Bangka Belitung';
        }elseif ($request->input('nama_provin') === '21') {
            $nama_provins = 'Kepulauan Riau';
        }elseif ($request->input('nama_provin') === '31') {
            $nama_provins = 'Dki Jakarta';
        }elseif ($request->input('nama_provin') === '32') {
            $nama_provins = 'Jawa Barat';
        }elseif ($request->input('nama_provin') === '33') {
            $nama_provins = 'Jawa Tengah';
        }elseif ($request->input('nama_provin') === '34') {
            $nama_provins = 'Di Yogyakarta';
        }elseif ($request->input('nama_provin') === '35') {
            $nama_provins = 'Jawa Timur';
        }elseif ($request->input('nama_provin') === '36') {
            $nama_provins = 'Banten';
        }elseif ($request->input('nama_provin') === '51') {
            $nama_provins = 'Bali';
        }elseif ($request->input('nama_provin') === '52') {
            $nama_provins = 'Nusa Tenggara Barat';
        }elseif ($request->input('nama_provin') === '53') {
            $nama_provins = 'Nusa Tenggara Timur';
        }elseif ($request->input('nama_provin') === '61') {
            $nama_provins = 'Kalimantan Barat';
        }elseif ($request->input('nama_provin') === '62') {
            $nama_provins = 'Kalimantan Tengah';
        }elseif ($request->input('nama_provin') === '63') {
            $nama_provins = 'Kalimantan Selatan';
        }elseif ($request->input('nama_provin') === '64') {
            $nama_provins = 'Kalimantan Timur';
        }elseif ($request->input('nama_provin') === '65') {
            $nama_provins = 'Kalimantan Utara';
        }elseif ($request->input('nama_provin') === '71') {
            $nama_provins = 'Sulawesi Utara';
        }elseif ($request->input('nama_provin') === '72') {
            $nama_provins = 'Sulawesi Tengah';
        }elseif ($request->input('nama_provin') === '73') {
            $nama_provins = 'Sulawesi Selatan';
        }elseif ($request->input('nama_provin') === '74') {
            $nama_provins = 'Sulawesi Tenggara';
        }elseif ($request->input('nama_provin') === '75') {
            $nama_provins = 'Gorontalo';
        }elseif ($request->input('nama_provin') === '76') {
            $nama_provins = 'Sulawesi Barat';
        }elseif ($request->input('nama_provin') === '81') {
            $nama_provins = 'Maluku';
        }elseif ($request->input('nama_provin') === '82') {
            $nama_provins = 'Maluku Utara';
        }elseif ($request->input('nama_provin') === '91') {
            $nama_provins = 'Papua Barat';
        }elseif ($request->input('nama_provin') === '94') {
            $nama_provins = 'Papua';
        }else {
            $nama_provins = $request->input('nama_provin');
        }

         
        $rules = [
            'leave_date'        => 'required|date',
            'end_leave_date'    => 'required|date',
            'back_work'         => 'required|date',
            'reason'            => 'required|max:50'
           /* 'total_day'         => 'required|numeric',*/
           /* 'remain'            => 'required|numeric|min:0'*/
            ];
       
        $data = [
            'user_id'                    => Auth::user()->id,
            'leave_category_id'          => '1',
            'request_by'                 => Auth::user()->first_name.' '.Auth::user()->last_name,
            'request_nik'                => Auth::user()->nik,
            'request_position'           => Auth::user()->position,
            'request_join_date'          => Auth::user()->join_date,
            'request_dept_category_name' => dept_category::where(['id' => Auth::user()->dept_category_id])->value('dept_category_name'),
            'period'                     => date('Y'),
            'leave_date'                 => $request->input('leave_date'),
            'end_leave_date'             => $get_end_leaved,
            'back_work'                  => $get_bacl_work_leaved,
            'total_day'                  => $jumlah_cuti,
            'taken'                      => $taken->leavetaken,
            'entitlement'                => $ent_annual->entitle_ann,
            'pending'                    => $init_annual->remainannual,
            'remain'                     => $remaining,
            'ap_hd'                      => $ap_hd,
            'ap_gm'                      => $ap_gm,
            'date_ap_hd'                 => $date_ap_hd,
            'date_ap_gm'                 => $date_ap_gm,
            'ver_hr'                     => '0',
            'ap_koor'                    => $ap_koor,
            'ap_spv'                     => $ap_spv,
            'ap_pm'                     => $ap_pm,
            'ap_producer'               => $ap_producer,
            'ap_pipeline'               => $ap_pipeline,
            'ap_Infinite'               => $ap_infinite,
            'date_ap_Infinite'          => $date_ap_infinite,
            'date_ap_koor'              => $date_ap_koor,
            'date_ap_spv'               => $date_ap_spv,
            'date_ap_pm'                => $date_ap_pm,
            'date_ap_pipeline'          => $date_ap_pipeline,
            'email_koor'                => $email_koor,
            'email_spv'                 => $email_spv,
            'email_pm'                  => $email_pm,
            'email_producer'            => $email_producer,
            'reason_leave'              => strtolower($request->input('reason')),
            'r_departure'               => $nama_provins,
            'r_after_leaving'           => $request->input('nama_city'),
            'plan_leave'                => $request->input('rencana'),
            'agreement'                 => $request->input('agree'),
            'resendmail'                => 2,
            ];    

            dd($data);
          
            $validator = Validator::make($request->all(), $rules);
          
            if ($validator->fails()) {
                return Redirect::route('leave/create')
                    ->withErrors($validator)
                    ->withInput();
            } else {
               if ($get_bacl_work_leaved != null) {
                   if ($get_end_leaved != null) {
                        if ($remaining < 0) 
                        {
                         Session::flash('getError', Lang::get('messages.annual_balance_error', ['name' => auth::user()->first_name.' '.auth::user()->last_name]));
                         return back();
                        } else {

                       /* Leave::insert($data);

                        $lastLeaved = Leave::where('user_id', auth::user()->id)->where('leave_category_id', 1)->latest()->first();                      

                           $forfeited = [
                                'user_id'   => auth::user()->id,
                                'leave_id'  => $lastLeaved->id,
                                'amount'    => $jumlah_cuti,
                                'status'    => 0,
                            ];

                        ForfeitedCounts::insert($forfeited);*/
                        Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data Leave Transaction']));
                        // $this->sendEmail3();
                        return Redirect::route('leave/transaction');
                        }
                   } else {
                      Session::flash('getError', Lang::get('messages.annual_date_error', ['name' => auth::user()->first_name.' '.auth::user()->last_name]));
                     return back();
                   }                
               } else {
                   Session::flash('getError', Lang::get('messages.annual_date_error', ['name' => auth::user()->first_name.' '.auth::user()->last_name]));
                     return back();
               }               
            }
    } 

    public function sendEmail3()
  {
    $select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()
            ->orderBy('leave_transaction.id','des')
            ->where('leave_transaction.user_id', auth::user()->id)
            ->first();

    $subject = 'Approval Request Leave Application - '.$select->request_by.'';

        if ($select->email_koor != null) {
            Mail::send('email.appMail', ['select' => $select], function($message) use ($select, $subject)
                    {
                
                     $message->to($select->email_koor)->subject($subject);
                     $message->from('wis_system@infinitestudios.id', 'WIS');
                    });
        }else{
            
            if ($select->email_spv != null) {
                Mail::send('email.appMail', ['select' => $select], function($message) use ($select, $subject)
                    {
                
                     $message->to($select->email_spv)->subject($subject);
                     $message->from('wis_system@infinitestudios.id', 'WIS');
                    });
            } else {
                
                if ($select->email_pm != null) {
                // untuk Officer sent to Head Departement
                    Mail::send('email.appMail', ['select' => $select], function($message) use ($select, $subject)
                    {
                
                     $message->to('dede.aftafiandi@frameworks-studios.com')->subject($subject);
                     $message->from('wis_system@infinitestudios.id', 'WIS');
                    });
                } else {
                    // untuk Head Department
                    Mail::send('email.leaveMail', ['select' => $select], function($message) use ($select, $subject)
                        {
                        
                        $message->to('hr.verification@frameworks-studios.com')->subject($subject);
                        $message->from('wis_system@infinitestudios.id', 'WIS');
                        });
                }

            }                
           
        }
   

  }
  //end

}
