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

class ForfeitedController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function indexCounterForfeit()
    {       
        return view('IT.Progress.hrd.forfeit.encounter');
    }

    public function getDataCounterForfeit()
    {
        $select = User::select([
            'id', 'nik', 'first_name', 'last_name', 'initial_annual', 'join_date', 'end_date', 'emp_status'
        ])->where('active', 1)->whereNotIn('nik', [123456789])->whereNotNull('nik')->orderBy('first_name', 'asc')->get();

          return Datatables::of($select)
            ->addIndexColumn()
            ->addColumn('forfeited', function(User $user){
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
            ->addColumn('advancedLeave', function(User $user){
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
            ->addColumn('available', function(User $user){                
              $return =  $this->availableLeave($user->id);

                return $return; 
            })
            ->addColumn('dept', function(User $user){
                $org = User::find($user->id);
                $dept = Dept_Category::find($org->dept_category_id);

                return $dept->dept_category_name;
            })   
            ->addColumn('actions', '@if($forfeited > 0)'
                .Lang::get('messages.btn_warning', ['title' => 'Clear Forfeited | Send Leava Transaction', 'url' => '{{ URL::route(\'forfeited/uploaded\', [$id]) }}', 'class' => 'pencil'])
                .'@endif')         
            ->editColumn('first_name', function(User $user){
                return $user->first_name.' '.$user->last_name;
            })
            ->rawColumns(['actions'])
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

    public function encounterForfei(Request $request)
    {
        $users = User::where('active', 1)->whereNotIn('nik', [123456789])->whereNotNull('nik')->orderBy('first_name', 'asc')->where('id', 226)->get();
       
        foreach ($users as $user) {
            $forfeited = Forfeited::where('user_id', $user->id)->pluck('countAnnual');
            $forfeitedCounts = ForfeitedCounts::where('user_id', $user->id)->where('status', 1)->pluck('amount');    
            $countAmount = $forfeited->sum() - $forfeitedCounts->sum(); 

            $returnForfeit = 0;

            if ($countAmount >= 0) {
                   $returnForfeit = $countAmount;
                } else {
                  $returnForfeit = 0;
                } 
            //------------------------------------------------------------------------------------------      

            // -------------------------------------------------------- annual

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
                   $returnAnnual = $totalAnnualPermanent1;
                } else {
                   $returnAnnual = $totalAnnual;
                }

                $remaining = $returnAnnual - $returnForfeit;

        //------------------------------------------
            if ($countAmount >= 0.5) {

                    $init_annual = DB::table('users')
                    ->leftJoin('initial_leave', 'initial_leave.user_id', '=', 'users.id')
                    ->leftJoin('leave_category', 'leave_category.id', '=', 'initial_leave.leave_category_id')
                    ->leftJoin('leave_transaction', 'leave_transaction.user_id', '=', 'users.id')   
                    ->select([
                        DB::raw('
                        (
                            select (
                                select initial_annual from users where id='.$user->id.' 
                            ) - (
                                select COALESCE(sum(total_day), 0) from leave_transaction where user_id='.$user->id.' and leave_category_id=1
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
                                select COALESCE(sum(total_day), 0) from leave_transaction where user_id='.$user->id.' and leave_category_id=1
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
                                select initial_annual from users where id='.$user->id.'
                            ) 
                        ) as entitle_ann')
                    ])
                    ->first();  
                
                    $data = [
                        'user_id'                    => $user->id,
                        'leave_category_id'          => '1',
                        'req_advance'                => '2',
                        'request_by'                 => $user->first_name.' '.$user->last_name,
                        'request_nik'                => $user->nik,
                        'request_position'           => $user->position,
                        'request_join_date'          => $user->join_date,
                        'request_dept_category_name' => dept_category::where(['id' => $user->dept_category_id])->value('dept_category_name'),
                        'period'                     => date('Y'),
                        'leave_date'                 => date('Y-m-d'),
                        'end_leave_date'             => date('Y-m-d'),
                        'back_work'                  => date('Y-m-d'),
                        'total_day'                  => $returnForfeit,
                        'taken'                      => $taken->leavetaken,
                        'entitlement'                => $ent_annual->entitle_ann,
                        'pending'                    => $init_annual->remainannual,                
                        'remain'                     => $remaining,
                        'ap_hd'                      => '1',
                        'ap_gm'                      => '1',
                        'date_ap_hd'                 => date('Y-m-d'),
                        'date_ap_gm'                 => date('Y-m-d'),
                        'ver_hr'                     => '1',
                        'ap_koor'                    => '1',
                        'ap_spv'                     => '1',
                        'ap_pm'                     => '1',
                        'ap_producer'               => '1',
                        'ap_pipeline'               => '1',
                        'ap_Infinite'               => '0',
                        'ver_hr'                    => '1',
                        'ap_hrd'                    => '1',
                        'date_ap_Infinite'          => date('Y-m-d'),
                        'date_ap_koor'              => date('Y-m-d'),
                        'date_ap_spv'               => date('Y-m-d'),
                        'date_ap_pm'                => date('Y-m-d'),
                        'date_ap_pipeline'          => date('Y-m-d'),
                        'email_koor'                => null,
                        'email_spv'                 => null,
                        'email_pm'                  => null,
                        'email_producer'            => null,
                        'reason_leave'              => 'Forfoited leave 2020',
                        'r_departure'               => 'Kepulauan Riau',
                        'r_after_leaving'           => 'Batam',
                        'plan_leave'                => 1,
                        'agreement'                 => 1,
                        'resendmail'                => 0,
                    ];
                    Leave::insert($data);

                    $lastLeaved = Leave::where('user_id', $user->id)->where('leave_category_id', 1)->latest()->first();                      

                    $forfeited = [
                                'user_id'   => $user->id,
                                'leave_id'  => $lastLeaved->id,
                                'amount'    => $returnForfeit,
                                'status'    => 1,
                            ];

                    ForfeitedCounts::insert($forfeited);
                    
            } 
        }
         return Redirect::route('forfeited/encounter');
    }

    public function detailEncounterForfei(Request $request, $id)
    {
        $user = User::find($id);
       
            $forfeited = Forfeited::where('user_id', $user->id)->pluck('countAnnual');
            $forfeitedCounts = ForfeitedCounts::where('user_id', $user->id)->where('status', 1)->pluck('amount');    
            $countAmount = $forfeited->sum() - $forfeitedCounts->sum(); 

            $returnForfeit = 0;

            if ($countAmount >= 0) {
                   $returnForfeit = $countAmount;
                } else {
                  $returnForfeit = 0;
                } 
            //------------------------------------------------------------------------------------------      

            // -------------------------------------------------------- annual

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
                   $returnAnnual = $totalAnnualPermanent1;
                } else {
                   $returnAnnual = $totalAnnual;
                }

                $remaining = $returnAnnual - $returnForfeit;

        //------------------------------------------
            if ($countAmount > 0) {

                    $init_annual = DB::table('users')
                    ->leftJoin('initial_leave', 'initial_leave.user_id', '=', 'users.id')
                    ->leftJoin('leave_category', 'leave_category.id', '=', 'initial_leave.leave_category_id')
                    ->leftJoin('leave_transaction', 'leave_transaction.user_id', '=', 'users.id')   
                    ->select([
                        DB::raw('
                        (
                            select (
                                select initial_annual from users where id='.$user->id.' 
                            ) - (
                                select COALESCE(sum(total_day), 0) from leave_transaction where user_id='.$user->id.' and leave_category_id=1
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
                                select COALESCE(sum(total_day), 0) from leave_transaction where user_id='.$user->id.' and leave_category_id=1
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
                                select initial_annual from users where id='.$user->id.'
                            ) 
                        ) as entitle_ann')
                    ])
                    ->first();  
                
                    $data = [
                        'user_id'                    => $user->id,
                        'leave_category_id'          => '1',
                        'req_advance'                => '2',
                        'request_by'                 => $user->first_name.' '.$user->last_name,
                        'request_nik'                => $user->nik,
                        'request_position'           => $user->position,
                        'request_join_date'          => $user->join_date,
                        'request_dept_category_name' => dept_category::where(['id' => $user->dept_category_id])->value('dept_category_name'),
                        'period'                     => date('Y'),
                        'leave_date'                 => date('Y-m-d'),
                        'end_leave_date'             => date('Y-m-d'),
                        'back_work'                  => date('Y-m-d'),
                        'total_day'                  => $returnForfeit,
                        'taken'                      => $taken->leavetaken,
                        'entitlement'                => $ent_annual->entitle_ann,
                        'pending'                    => $init_annual->remainannual,                
                        'remain'                     => $remaining,
                        'ap_hd'                      => '1',
                        'ap_gm'                      => '1',
                        'date_ap_hd'                 => date('Y-m-d'),
                        'date_ap_gm'                 => date('Y-m-d'),
                        'ver_hr'                     => '1',
                        'ap_koor'                    => '1',
                        'ap_spv'                     => '1',
                        'ap_pm'                     => '1',
                        'ap_producer'               => '1',
                        'ap_pipeline'               => '1',
                        'ap_Infinite'               => '0',
                        'ver_hr'                    => '1',
                        'ap_hrd'                    => '1',
                        'date_ap_Infinite'          => date('Y-m-d'),
                        'date_ap_koor'              => date('Y-m-d'),
                        'date_ap_spv'               => date('Y-m-d'),
                        'date_ap_pm'                => date('Y-m-d'),
                        'date_ap_pipeline'          => date('Y-m-d'),
                        'email_koor'                => null,
                        'email_spv'                 => null,
                        'email_pm'                  => null,
                        'email_producer'            => null,
                        'reason_leave'              => 'Forfoited leave 2020',
                        'r_departure'               => 'Kepulauan Riau',
                        'r_after_leaving'           => 'Batam',
                        'plan_leave'                => 1,
                        'agreement'                 => 1,
                        'resendmail'                => 0,
                    ];

                    // dd($data);
                    Leave::insert($data);

                    $lastLeaved = Leave::where('user_id', $user->id)->where('leave_category_id', 1)->latest()->first();                      

                    $forfeited = [
                                'user_id'   => $user->id,
                                'leave_id'  => $lastLeaved->id,
                                'amount'    => $returnForfeit,
                                'status'    => 1,
                            ];

                    ForfeitedCounts::insert($forfeited);
                    
            } 
        
         return Redirect::route('forfeited/encounter');
    }
   
}
