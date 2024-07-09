<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\NewUser;
use DB;
use Mail;

class cronEntitlementAnnualContract extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entitlement_annual:contract';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'set initial_annual for contract employee';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        // $join_date = NewUser::select('join_date')->value('join_date');
        // $end_date = NewUser::select('end_date')->value('end_date');

        // $join_date = NewUser::value('join_date');
        // $end_date = NewUser::value('end_date');


        // $join_date = DB::table('users')->select('join_date')->where('nik', '=', '21803001')->first();
        // $end_date = DB::table('users')->select('end_date')->where('nik', '=', '21803001')->first();

        // return dd($join_date);

        // $join_date = NewUser::select('join_date')->where('emp_status', '=', 'Contract')->value('join_date');
        // $end_date = NewUser::select('end_date')->where('emp_status', '=', 'Contract')->value('end_date');


        // $join_date = NewUser::where(['emp_status' => 'Contract'])->get();

        // $initial_annual = date_diff(date_create($join_date), date_create($end_date))->format('%m') + (12*date_diff(date_create($join_date), date_create($end_date))->format('%y'));


        // DB::update('update users SET initial_annual = '.$initial_annual.'');
        $data = NewUser::where(['emp_status' => 'Contract'])->get();

        foreach ($data as $key => $value){
            $initial_annual = date_diff(date_create($value->join_date), date_create($value->end_date))->format('%m') + (12*date_diff(date_create($value->join_date), date_create($value->end_date))->format('%y'));
            echo $initial_annual;
            DB::update('update users SET initial_annual = '.$initial_annual.'');
            }

        // return dd($join_date);

        // $join_date = date_create($join_date);
        // $end_date = date_create($end_date);


        // $initial_annual = date_diff($join_date, $end_date)->format('%m') + (12*date_diff($join_date, $end_date)->format('%m'));

        // return dd($join_date);

        // $join_date = DB::table('users')->select(DB::raw('join_date'))->get();
        // $end_date = DB::table('users')->select(DB::raw('end_date'))->get();


        // $data = [
        //         'initial_annual' => date_diff($join_date, $end_date)->format('%m')
        //         'initial_annual' => date_diff(date_create($join_date), date_create($end_date))->format('%m')
        //         ];        
        // NewUser::where('emp_status', '=', 'Contract')->update($data);

        


        

        // $initial_annual = $join_date->diff($end_date)->format('%m');

        // $datetime1 = new DateTime('2009-10-11');
        // $datetime2 = new DateTime('2009-10-13');
        // $interval = $datetime1->diff($datetime2);
        // echo $interval->format('%R%a days');

        // DB::update('update users SET initial_annual = '.$initial_annual.' WHERE emp_status = "Contract"');
        // DB::update('update users SET initial_annual = '.$initial_annual.' WHERE nik = "21803001"');
    }
}
