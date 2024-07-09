<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\PDF;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Facades\Datatables;
use Yajra\DataTables\Html\Builder;


use App\AssetSoftware;
use App\Dept_Category;
use App\FinanceTracking;
use App\Asset_PO;
use App\Asset_Tracking;

class FinanceController extends Controller
{
    public function __construct()
	{
		$this->middleware(['auth', 'active', 'Finance']);
		
	}

	public function indexListSoftware()
	{
		return view::make('Finance.software.index');
	}

	public function getListSoftware()
	{
		$select = AssetSoftware::select(['id', 'product',  'name_software', 'version', 'type_software', 'expiring_date', 'price', 'status_software'])
		->get();

		return DataTables::of($select)
		->edit_column('expiring_date', '{{date("M, d Y", strtotime($expiring_date))}}')		
		->setRowClass('@if (date("Y-m-d") >= date("Y-m-d", strtotime("-1 months", strtotime($expiring_date)))){{ "info" }}@endif @if (date("Y-m-d") >= $expiring_date){{"danger"}} @endif')
		->addColumn('time_limit', '@php
			$date1=date_create($expiring_date);
			$date2=date_create(date("Y-m-d"));
			$diff=date_diff($date2,$date1);
			echo $diff->format("%R%a days");
		 @endphp')
		->addColumn('condtion', '@if (date("Y-m-d") >= $expiring_date){{"Expired"}} @else {{"Valid"}} @endif')
		->addColumn('action2', 
				Lang::get('messages.btn_success', ['title' => 'Detail', 'url' => '{{ URL::route(\'detailListSoftware\', [$id]) }}', 'class' => 'check-square'])	
		)
		->make();
	}

	public function detailListSoftware($id)
	{
		$ListSoftware = AssetSoftware::find($id);
		$date1=date_create($ListSoftware->expiring_date);
		$date2=date_create(date("Y-m-d"));
		$diff=date_diff($date2,$date1);

		if (date("Y-m-d") >= $ListSoftware->expiring_date) {
			$conditon = "Expired";
		}else{
			$conditon = "Valid";
		}

		$time_limit = $diff->format("%R%a days");

        $return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'><b>$ListSoftware->product Detail</b></h4>
            </div>
            <div class='modal-body'>
                <div class='well'>
                   <table>
                   		<tr>
							<th>ID Software</th>
							<td>: </td>
							<td>$ListSoftware->id</td>
						</tr>
						<tr>
							<th>Software Name</th>
							<td>: </td>
							<td>$ListSoftware->name_software</td>
						</tr>
						<tr>
							<th>Version</th>
							<td>: </td>
							<td>$ListSoftware->name_software</td>
						</tr>
						<tr>
							<th>Purchase Date</th>
							<td>: </td>
							<td>$ListSoftware->purchase_date</td>
						</tr>
						<tr>
							<th>Expiring Date</th>
							<td>: </td>
							<td>$ListSoftware->expiring_date</td>
						</tr>
						<tr>
							<th>Type Software</th>
							<td>: </td>
							<td>$ListSoftware->type_software</td>
						</tr>
						<tr>
							<th>Qty</th>
							<td>: </td>
							<td>$ListSoftware->qty</td>
						</tr>
						<tr>
							<th>Unit Price</th>
							<td>: </td>
							<td>$ListSoftware->price</td>
						</tr>
						<tr>
							<th>Total Price</th>
							<td>: </td>
							<td>$ListSoftware->total_price</td>
						</tr>
						<tr>
							<th>Vendor</th>
							<td>: </td>
							<td>$ListSoftware->vendor</td>
						</tr>
						<tr>
							<th>PO</th>
							<td>: </td>
							<td>$ListSoftware->po_number1/$ListSoftware->po_number2-$ListSoftware->po_number3/$ListSoftware->po_number4/$ListSoftware->po_number5</td>
						</tr>
						<tr>
							<th>Invoice</th>
							<td>: </td>
							<td>$ListSoftware->Invoice</td>
						</tr>
						<tr>
							<th>Status</th>
							<td>: </td>
							<td>$ListSoftware->status_software</td>
						</tr>
						<tr>
							<th>Time Limit</th>
							<td>: </td>
							<td>$time_limit</td>
						</tr>
						<tr>
							<th>Conditon</th>
							<td>: </td>
							<td>$conditon</td>
						</tr>
					</table>                       
                </div>
            </div>
            <div class='modal-footer'>
            <a href='".URL::route('PrintItemListSoftware', [$id])."' class='btn btn-sm btn-primary' target='_blank'>print</a> 
            <button type='button' class='btn btn-sm btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
	}

	public function PrintItemListSoftware($id)
	{
		$getData = AssetSoftware::find($id);

		$date1=date_create($getData->expiring_date);
		$date2=date_create(date("Y-m-d"));
		$diff=date_diff($date2,$date1);
		$time_limit = $diff->format("%R%a days");

		if (date("Y-m-d") >= $getData->expiring_date) {
			$conditon = "Expired";
		}else{
			$conditon = "Valid";
		}

		$time_limit = $diff->format("%R%a days");

		return view::make('Finance.software.printItemSoftware', ['getData' => $getData, 'time_limit' => $time_limit, 'conditon' => $conditon]);
	}

	public function indexListAssetTracking()
	{
		$select = Dept_Category::all();
		return view::make('Finance.inventory_tracking.halaman_utama', ['select' => $select]);
	}

	public function indexListAssetTrackingDP($id)
	{

		$select = Dept_Category::find($id);

		if ($select->id === 1) {		
			return view::make('Finance.inventory_tracking.index', ['select' => $select]);
		}else{
			return back();
		}
		
	}

	public function getListAssetTracking()
	{
		$select = FinanceTracking::JoinAsset_PO()->select([
			'finance_tracking.id',			
			'finance_tracking.view_po_number',
			'finance_tracking.f_brand',
			'finance_tracking.f_series',
			'asset_po_invoice.po_qty',
			'asset_po_invoice.po_currency',
			'asset_po_invoice.unit_price',
			'asset_po_invoice.amount',
			'finance_tracking.currency',
			'finance_tracking.usage_period',
			'finance_tracking.beginning_balance',
			'finance_tracking.pc_addition',
			'finance_tracking.pc_calculation',
			'finance_tracking.pc_monthly',
			'finance_tracking.pc_write',
			'finance_tracking.pc_ending_balance'
		])
		->where('finance_tracking.f_department', 1)
		->get();

		 return Datatables::of($select)
		 ->edit_column('unit_price', '{{$po_currency." ".number_format($unit_price,0,",",".")}}')
		 ->edit_column('amount', '{{$po_currency." ".number_format($amount,0,",",".")}}')
		 ->edit_column('beginning_balance', '{{$currency." ".number_format($beginning_balance,0,",",".")}}')
		 ->edit_column('pc_addition', '{{$currency." ".number_format($pc_addition,0,",",".")}}')
		 ->edit_column('pc_calculation', '{{$currency." ".number_format($pc_calculation,0,",",".")}}')
		 ->edit_column('pc_monthly', '{{$currency." ".number_format($pc_monthly,0,",",".")}}')
		 ->edit_column('pc_write', '{{$currency." ".number_format($pc_write,0,",",".")}}')
		 ->edit_column('pc_ending_balance', '{{$currency." ".number_format($pc_ending_balance,0,",",".")}}')
		 ->addColumn('intro', 
		    	Lang::get('messages.btn_warning', ['title' => 'Purchase Cost', 'url' => '{{ URL::route(\'addPurchaseCost\', [$id]) }}', 'class' => 'pencil']).
		    	Lang::get('messages.btn_warning', ['title' => 'Accumulation', 'url' => '{{ URL::route(\'indexListAccumulution\', [$id]) }}', 'class' => 'file'])
			)
		 ->make();
	}

	public function addPurchaseCost($id)
	{
		$select = FinanceTracking::find($id);
		$asset_tracking = Asset_Tracking::where('view_po_number', $select->view_po_number)->paginate(5);
		$asset_po_invoice = Asset_PO::where('id', $select->id_asset_po)->first();

		return view::make('Finance.inventory_tracking.purchaseCost', [
			'select' => $select, 
			'asset_tracking' => $asset_tracking, 
			'asset_po_invoice' => $asset_po_invoice
		]);
	}

	public function editPurchase($id)
	{
		$select = FinanceTracking::find($id);
		$asset_po_invoice = Asset_PO::find($select->id_asset_po);
		$asset_tracking = Asset_Tracking::where('view_po_number', $select->view_po_number)->first();
		return view::make('Finance.inventory_tracking.editPurchaseCost', [
			'select' => $select, 
			'asset_po_invoice' => $asset_po_invoice,
			'asset_tracking'	=> $asset_tracking
		]);
	}

	public function storePurchaseCost(Request $request, $id)
	{
		$finance_tracking = FinanceTracking::find($id);
		$asset_po_invoice = Asset_PO::find($finance_tracking->id_asset_po);
		$asset_tracking = Asset_Tracking::where('view_po_number', $finance_tracking->view_po_number)->first();

		$rules = [
			'date_purchase' 	=> 'required',
			'usage_period'		=> 'required|numeric',
			'currency'			=> 'required|string',
			'beginning_balance'	=> 'required|numeric'
		];

		$data_asset_tracking = [
			'date_purchase' => $request->input('date_purchase')
		];

		$pc_calculation = $request->input('beginning_balance')+$request->input('pc_addition');

		$data_purchase_cost = [
			'usage_period'			=> $request->input('usage_period'),
			'currency'				=> $request->input('currency'),
			'beginning_balance'		=> $request->input('beginning_balance'),
			'pc_addition'			=> $request->input('pc_addition'),
			'pc_calculation'		=> $pc_calculation,
			'pc_monthly'			=> $pc_calculation/$request->input('usage_period'),
			'pc_write'				=> $request->input('pc_write'),
			'pc_ending_balance'		=> $request->input('beginning_balance')+$request->input('pc_addition')-$request->input('pc_write'),
			'updated_by'			=> auth::user()->first_name.' '.auth::user()->last_name
		];
		
		$validator = Validator::make($request->all(), $rules);
	
		 if ($validator->fails()) {            
			return Redirect::route('editPurchase', [$id])
				->withErrors($validator)
				->withInput();
		} else {
			Asset_Tracking::where('view_po_number', $finance_tracking->view_po_number)	->update($data_asset_tracking);
			FinanceTracking::where('id', $id)->update($data_purchase_cost);	
			Session::flash('message', Lang::get('messages.thankyou', ['data' => 'Data User']));
			return Redirect::route('addPurchaseCost', [$finance_tracking->f_department]);
		}
	}

	public function indexListAccumulution($id)
	{
		$job = Dept_Category::find($id);
		$finance_tracking = FinanceTracking::paginate(25);
		$no = 1;

		return view::make('Finance.inventory_tracking.accumuluation', [
			'no'					=> $no,
			'finance_tracking'		=> $finance_tracking,
			'job'					=> $job
		
		]);
	}

	public function excelListAccumulution($id)
	{
		$data = FinanceTracking::where('f_department', $id)->get();

		Excel::create('List Accumulation '.date('Y'), function($excel) use ($data)
		{
			 $excel->sheet('List Accumulation '.date('Y'), function($sheet) use($data) {

			    $sheet->setOrientation('landscape');
			  	$sheet->setAutoSize(true);
		        $sheet->loadView('Finance.inventory_tracking.excel', 
		        	['data' => $data]);		      
		   		});   

		})->download('xls');

		return back();
	}


//end	
}
