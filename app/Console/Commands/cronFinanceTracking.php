<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\FinanceTracking;
use App\Asset_PO;
use App\Asset_Tracking;
 use App\View_Finance_Tracking; 

class cronFinanceTracking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:financetracking';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert to database finance tracking';

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
        $financetracking = FinanceTracking::all();

        foreach ($financetracking as $f_value) {
        	if ($f_value->usage_period != $f_value->remainning_period) {
	        	$data = [
	        		'v_view_po_number'		=> $f_value->view_po_number,
	        		'v_id_asset_po'			=> $f_value->id_asset_po,
	        		'v_id_finance_tracking'	=> $f_value->id,
	        		'view_date'				=> date('Y-m-d'),
	        		'monthly_cost'			=> $f_value->pc_monthly,
	        		'currency'				=> $f_value->currency,
	        		'view_year'				=> date('Y'),
	        	];
	        	View_Finance_Tracking::insert($data);         	        	

	        	$data2 = [
	        		'acc_ending_balance' 	=> $f_value->acc_ending_balance+$f_value->pc_monthly,
	        		'remainning_period'		=> $f_value->remainning_period+1
	        	];                
	        	FinanceTracking::where('id', $f_value->id)->update($data2);        		
        	}          
        }
    }
}
