<?php

namespace App\Http\Controllers;

use App;
use App\Dept_Category;
use App\Entitled_leave_view;
use App\Events\LeaveVerificatedByHr;
use App\Http\Controllers\Controller;
use App\Initial_Leave;
use App\JobFunction_Category;
use App\Leave;
use App\Leave_Category;
use App\Log_User;
use App\Log_Ws_Availability;
use App\NewUser;
use App\Project_Category;
use App\User;
use App\User_project;
use App\Ws_Availability;
use App\Asseting_IT;
use App\Asseting_PS;
use App\Asset_Tracking;
use App\Asset_Cname;
use App\AssetSoftware;
use App\Ws_Map;
use App\MarkInventory;
use App\FinanceTracking;
use App\Asset_PO;

use DB;
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
use Mail;
use Storage;
use Yajra\Datatables\Facades\Datatables;
use Yajra\DataTables\Html\Builder;
use \Milon\Barcode\DNS2D;
use \Milon\Barcode\DNS1D; 


use App\Mail\Notifikasi\NotifikasiInputDataInventory;

class IT_Controller2 extends Controller
{
       public function __construct()
	{
		$this->middleware(['auth', 'active', 'it']);
		
	}

	public function indexUtamaAsset()
	{
		$cname = Asset_Cname::where('status_hardware', 1)->orderBy('category_cname', 'asc')->get();

		return view::make('IT.Asset.asset_utama', ['cname' => $cname]);
	}

	public function indextAsset1($id)
	{		
		$marker_key = Asset_Tracking::where('category_name_id', $id)->get();
		$label = Asset_Cname::where('key_mark', $id)->first();
		
		return view::make('IT.Asset.index', ['marker_key' => $marker_key, 'label' => $label]);
	}

	public function getAsset1($id)
	{	
		return dd($id);
		$select = DB::table('asset_tracking')
		->select([
			'id', 'barcode', 
			'category_type_name', 
			'category_name_name', 
			'brand', 
			'series', 
			'serial_number', 
			'asset_category_name', 
			'ifw_code'
		])	
		->where('category_name_id', $id)	
		->get(); 

		return Datatables::of($select)
		 	->add_column('action',
				Lang::get('messages.btn_asset_detail', ['title' => 'Edit Workstation', 'url' => '{{ URL::route(\'edit-WS\', [$id]) }}'])
				) 
			->make();  
	}

	public function addAsset1()
	{			 
		$list_dept  = Dept_Category::WHERE('id', '!=', 7)->orderBy('id','asc')->get();
		$ps = Dept_Category::where('id', 7)->orderBy('id', 'asc')->get();
		$cname = Asset_Cname::orderBy('category_cname', 'asc')->get();

		return view::make('IT.Asset.add')
		->with([
				'department' => $list_dept,
				'ps'    => $ps, 
				'cname' => $cname,
			]);
	}
	public function contoh()
	{
		Mail::send(new NotifikasiInputDataInventory());
		return back();
	}

	public function storeAddAsset1(Request $request)
	{
		// dd('data ada');
		
		$jenis 	= $request->input('jenis_input');
        $jumlah 	= $request->input('jumlah_input');

		$instansi = $request->input('instansi');
		$department	= $request->input('department');
		$asset_type = $request->input('asset_type');
		$asset_category = $request->input('asset_category');
		$category_type = $request->input('category_type');
		$category_name = $request->input('category_name');
		$Incoming = $request->input('Incoming');
		$rupiah = $request->input('rupiah');
		
		$db_data_asset = Asset_Tracking::orderBy('id','desc')->first();	
		if ($db_data_asset === null) {
			$db_data_asset_count = 1;
		} else {
			$db_data_asset_count = substr($db_data_asset->barcode,9)+1;	
		}	
		


		if ($instansi === "1") {
			$get_intansi = "Kinema Animation";
		}elseif ($instansi === "2") {
			$get_intansi = "Kinema Production Services";
		}elseif ($instansi === "3") {
			$get_intansi = "Infinite Learning";
		}else{
			$get_intansi = Null;
		}

		$data_departement = Dept_Category::where('id', $department)->first();

		if ($asset_type === "1") {
			$get_assset_type = "Purchase";
		}elseif ($asset_type === "2") {
			$get_assset_type = "Transfer";
		}

		if ($asset_category === "1") {
			$get_asset_category = "Asset";
		}elseif ($asset_category === "2") {
			$get_asset_category = "Integrable Asset";
		}elseif ($asset_category === "3") {
			$get_asset_category = "Non Asset";
		}

		if ($category_type === "1") {
			$get_category_type = "Hardware";
		}elseif ($category_type === "2") {
			$get_category_type = "Equipment";
		}elseif ($category_type === "3") {
			$get_category_type = "Tool";
		}elseif ($category_type === "4") {
			$get_category_type = "Software";
		}

		if ($category_name === "11") {
			$get_category_name = "Workstation";
		}elseif ($category_name === "12") {
			$get_category_name = "Switch";
		}elseif ($category_name === "13") {
			$get_category_name = "Server";
		}elseif ($category_name === "14") {
			$get_category_name = "Storage";
		}elseif ($category_name === "15") {
			$get_category_name = "Printer";
		}elseif ($category_name === "16") {
			$get_category_name = "Wacom";
		}elseif ($category_name === "17") {
			$get_category_name = "VGA";
		}elseif ($category_name === "18") {
			$get_category_name = "HDD External";
		}elseif ($category_name === "19") {
			$get_category_name = "HDD Internal";
		}elseif ($category_name === "20") {
			$get_category_name = "HBA Card";
		}elseif ($category_name === "21") {
			$get_category_name = "Render Farm";
		}elseif ($category_name === "22") {
			$get_category_name = "UPS";
		}elseif ($category_name === "23") {
			$get_category_name = "Laptop";
		}elseif ($category_name === "24") {
			$get_category_name = "Monitor";
		}elseif ($category_name === "25") {
			$get_category_name = "KVMX";
		}elseif ($category_name === "26") {
			$get_category_name = "Wireless";
		}elseif ($category_name === "27") {
			$get_category_name = "VOIP";
		}elseif ($category_name === "28") {
			$get_category_name = "Projector";
		}elseif ($category_name === "29") {
			$get_category_name = "Other";
		}else{
			$get_category_name = null;
		}
		
		if ($Incoming != null) {
			$get_incoming_null = $Incoming;
			$get_incoming = substr($get_incoming_null,2,2);
		}else{
			$get_incoming_null = "0000-00-00";
			$get_incoming = substr($get_incoming_null,2,2);
		}

		$rules = [
			
		];

	    $validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {            
					return Redirect::route('addAsset1')
						->withErrors($validator)
						->withInput();
		} else {
			if ($jenis != null) { 
				$no = 1;
			    foreach ($jenis as $value => $j){				    	
					$db_data_asset_count1 = $db_data_asset_count+$no++;	   
			    	$percobaan = [
			    	'barcode'		=> $instansi.$department.$asset_type.$asset_category.$category_type.$category_name.$get_incoming.$db_data_asset_count1,
					'instansi_id'	=> $instansi,
					'dept_id'		=> $department,
					'asset_type_id' => $asset_type,
					'asset_category_id' => $asset_category,
					'category_type_id'  => $category_type,
					'category_name_id' 	=> $category_name,
					'date_incoming'		=> $get_incoming_null,
					'instansi_name'		=> $get_intansi,
					'dept_name'			=> $data_departement->dept_category_name,
					'asset_type_name'	=> $get_assset_type,
					'asset_category_name' => $get_asset_category,
					'category_type_name'  => $get_category_type,
					'category_name_name'  => $get_category_name,
					'ifw_code'			  => strtoupper($jumlah[$value]),
					'brand'				  => strtoupper($request->input('brand')),
					'serial_number'		=> strtoupper($j),
					'part_number'		=> strtoupper($request->input('PN')),
					'series'			=> strtolower($request->input('series')),
					'vendor'			=> strtoupper($request->input('vendor')),
				   	'po_number1'		=> strtoupper($request->input('PO1')),
					'po_number2'		=> strtoupper($request->input('PO2')),
					'po_number3'		=> strtoupper($request->input('PO3')),
					'po_number4'		=> strtoupper($request->input('PO4')),
					'po_number5'		=> strtoupper($request->input('PO5')),
					'invoice'			=> strtoupper($request->input('Invoice')),
					'delivery_order'	=> strtoupper($request->input('DO')),
					'price'				=> $request->input('mata_uang').' '.$request->input('rupiah'),
					'status_item'		=> $request->input('status'),
				
					'item_description'	=> $request->input('note'),
					'created_by'		=> auth::user()->first_name.' '.auth::user()->last_name,
					'nominal'			=> $request->input('rupiah'),	
					'view_po_number'	=> strtoupper($request->input('PO1').'/'.$request->input('PO2').'-'.$request->input('PO3').'/'.$request->input('PO4').'/'.$request->input('PO5')),
					'uom'				=> strtolower($request->input('uom')),							

			    	];
					Asset_Tracking::insert($percobaan);				
					}				
					
		    	}
		    	if ($jenis == null) {		    		
		    		$data = [
					'barcode'		=> $instansi.$department.$asset_type.$asset_category.$category_type.$category_name.$get_incoming.$db_data_asset_count,
					'instansi_id'	=> $instansi,
					'dept_id'		=> $department,
					'asset_type_id' => $asset_type,
					'asset_category_id' => $asset_category,
					'category_type_id'  => $category_type,
					'category_name_id' 	=> $category_name,
					'date_incoming'		=> $get_incoming_null,
					'instansi_name'		=> $get_intansi,
					'dept_name'			=> $data_departement->dept_category_name,
					'asset_type_name'	=> $get_assset_type,
					'asset_category_name' => $get_asset_category,
					'category_type_name'  => $get_category_type,
					'category_name_name'  => $get_category_name,
					'ifw_code'			  => strtoupper($request->input('ifw')),
					'brand'				  => strtoupper($request->input('brand')),
					'serial_number'		=> strtoupper($request->input('SN')),
					'part_number'		=> strtoupper($request->input('PN')),
					'series'			=> strtolower($request->input('series')),
					'vendor'			=> strtoupper($request->input('vendor')),
				   	'po_number1'		=> strtoupper($request->input('PO1')),
					'po_number2'		=> strtoupper($request->input('PO2')),
					'po_number3'		=> strtoupper($request->input('PO3')),
					'po_number4'		=> strtoupper($request->input('PO4')),
					'po_number5'		=> strtoupper($request->input('PO5')),
					'invoice'			=> strtoupper($request->input('Invoice')),
					'delivery_order'	=> strtoupper($request->input('DO')),
					'price'				=> $request->input('mata_uang'),
					'nominal'			=> $request->input('rupiah'),
					'status_item'		=> $request->input('status'),				
					'item_description'	=> $request->input('note'),
					'created_by'		=> auth::user()->first_name.' '.auth::user()->last_name,
					'view_po_number'	=> strtoupper($request->input('PO1').'/'.$request->input('PO2').'-'.$request->input('PO3').'/'.$request->input('PO4').'/'.$request->input('PO5')),
					'uom'				=> strtolower($request->input('uom')),				
					];
					// dd($data);
		    		Asset_Tracking::insert($data);
		    	}

		    	$asset_po = [
				'purchase_order'		=> strtoupper($request->input('PO1').'/'.$request->input('PO2').'-'.$request->input('PO3').'/'.$request->input('PO4').'/'.$request->input('PO5')),
				'po_deprtment'			=> $department,
				'po_invoice'			=> strtoupper($request->input('Invoice')),
				'po_brand'				=> strtoupper($request->input('brand')),
				'po_series'				=> strtolower($request->input('series')),
				'po_delivery_order'		=> strtoupper($request->input('DO')),
				'po_qty'				=> $request->input('qty'),
				'po_uom'				=> $request->input('uom'),
				'po_currency'			=> $request->input('mata_uang'),
				'unit_price'			=> $request->input('rupiah'),
				'amount'				=> $request->input('rupiah')*$request->input('qty'),
				'po_vendor'				=> strtoupper($request->input('vendor')),
				'created_by'			=> auth::user()->first_name.' '.auth::user()->last_name
				];	
				// dd($asset_po);
				Asset_PO::insert($asset_po);
				Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data Asset']));
				return Redirect::route('indexUtamaAsset');
			}	
	}

	public function detailAssetTracking($id)
	{
		$Tracking = Asset_Tracking::find($id);
       	return view::make('IT.Asset.detailHardware', ['tracking' => $Tracking]);
	}

	public function editAssetTracking($id)
	{
		$getData = Asset_Tracking::find($id);

		$list_dept  = Dept_Category::WHERE('id', '!=', 7)->orderBy('id','asc')->get();
		$ps = Dept_Category::where('id', 7)->orderBy('id', 'asc')->get();
		$cname = Asset_Cname::orderBy('category_cname', 'asc')->get();

		return view::make('IT.Asset.edit')->with([
				'department' => $list_dept,
				'ps'    => $ps,
				'getData' => $getData,
				'cname' => $cname,          
			]);
	}

	public function SaveEditAssetTracking(Request $request, $id)
	{
		$instansi = $request->input('instansi');
		$department	= $request->input('department');
		$asset_type = $request->input('asset_type');
		$asset_category = $request->input('asset_category');
		$category_type = $request->input('category_type');
		$category_name = $request->input('category_name');
		$Incoming = $request->input('Incoming');
		$rupiah = $request->input('rupiah');

		$db_data_asset = Asset_Tracking::where('id', $id)->value('barcode');	
		$db_data_asset_count = substr($db_data_asset,9);

		if ($instansi === "1") {
			$get_intansi = "Kinema Animation";
		}elseif ($instansi === "2") {
			$get_intansi = "Kinema Production Services";
		}elseif ($instansi === "3") {
			$get_intansi = "Infinite Learning";
		}else{
			$get_intansi = Null;
		}

		$data_departement = Dept_Category::where('id', $department)->first();

		if ($asset_type === "1") {
			$get_assset_type = "Purchase";
		}elseif ($asset_type === "2") {
			$get_assset_type = "Transfer";
		}

		if ($asset_category === "1") {
			$get_asset_category = "Asset";
		}elseif ($asset_category === "2") {
			$get_asset_category = "Integrable Asset";
		}

		if ($category_type === "1") {
			$get_category_type = "Hardware";
		}elseif ($category_type === "2") {
			$get_category_type = "Equipment";
		}elseif ($category_type === "3") {
			$get_category_type = "Tool";
		}elseif ($category_type === "4") {
			$get_category_type = "Software";
		}

		if ($category_name === "11") {
			$get_category_name = "Workstation";
		}elseif ($category_name === "12") {
			$get_category_name = "Switch";
		}elseif ($category_name === "13") {
			$get_category_name = "Server";
		}elseif ($category_name === "14") {
			$get_category_name = "Storage";
		}elseif ($category_name === "15") {
			$get_category_name = "Printer";
		}elseif ($category_name === "16") {
			$get_category_name = "Wacom";
		}elseif ($category_name === "17") {
			$get_category_name = "VGA";
		}elseif ($category_name === "18") {
			$get_category_name = "HDD External";
		}elseif ($category_name === "19") {
			$get_category_name = "HDD Internal";
		}elseif ($category_name === "20") {
			$get_category_name = "HBA Card";
		}elseif ($category_name === "21") {
			$get_category_name = "Render Farm";
		}elseif ($category_name === "22") {
			$get_category_name = "UPS";
		}elseif ($category_name === "23") {
			$get_category_name = "Laptop";
		}elseif ($category_name === "24") {
			$get_category_name = "Monitor";
		}elseif ($category_name === "25") {
			$get_category_name = "KVMX";
		}elseif ($category_name === "26") {
			$get_category_name = "Wireless";
		}elseif ($category_name === "27") {
			$get_category_name = "VOIP";
		}elseif ($category_name === "28") {
			$get_category_name = "Projector";
		}elseif ($category_name === "29") {
			$get_category_name = "Other";
		}else{
			$get_category_name = null;
		}

		if ($Incoming != null) {
			$get_incoming_null = $Incoming;
			$get_incoming = substr($get_incoming_null,2,2);
		}else{
			$get_incoming_null = "0000-00-00";
			$get_incoming = substr($get_incoming_null,2,2);
		}

		$rules = [
			'brand' 	=> 'required|string',
			'series'	=> 'required',
			'SN'		=> 'required',
			
			'Invoice'	=> 'required',
			'vendor'	=> 'required',
			'rupiah'	=> 'required',
		];		

		$data = [
			'barcode'		=> $instansi.$department.$asset_type.$asset_category.$category_type.$category_name.$get_incoming.$db_data_asset_count,
			'instansi_id'	=> $instansi,
			'dept_id'		=> $department,
			'asset_type_id' => $asset_type,
			'asset_category_id' => $asset_category,
			'category_type_id'  => $category_type,
			'category_name_id' 	=> $category_name,
			'date_incoming'		=> $get_incoming_null,
			'instansi_name'		=> $get_intansi,
			'dept_name'			=> $data_departement->dept_category_name,
			'asset_type_name'	=> $get_assset_type,
			'asset_category_name' => $get_asset_category,
			'category_type_name'  => $get_category_type,
			'category_name_name'  => $get_category_name,
			'ifw_code'			  => strtoupper($request->input('ifw')),
			'brand'				  => strtoupper($request->input('brand')),
			'serial_number'		=> strtoupper($request->input('SN')),
			'part_number'		=> strtoupper($request->input('PN')),
			'series'			=> strtolower($request->input('series')),
			'vendor'			=> strtoupper($request->input('vendor')),			
			'po_number1'		=> strtoupper($request->input('PO1')),
			'po_number2'		=> strtoupper($request->input('PO2')),
			'po_number3'		=> strtoupper($request->input('PO3')),
			'po_number4'		=> strtoupper($request->input('PO4')),
			'po_number5'		=> strtoupper($request->input('PO5')),
			'invoice'			=> strtoupper($request->input('Invoice')),
			'delivery_order'	=> strtoupper($request->input('DO')),
			'price'				=> $request->input('mata_uang'),
			'nominal'			=> $request->input('rupiah'),
			'status_item'		=> $request->input('status'),
			'used'				=> strtolower($request->input('userss')),			
			'item_description'	=> $request->input('note'),
			'created_by'		=> auth::user()->first_name.' '.auth::user()->last_name	
		];
	
		$validator = Validator::make($request->all(), $rules);
	
		 if ($validator->fails()) {            
			return Redirect::route('editAssetTracking', [$id])
				->withErrors($validator)
				->withInput();
		} else {
			Asset_Tracking::where('id', $id)->update($data);
			$getting = Asset_Tracking::where('id', $id)->first();			
			Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Data Asset']));
			return Redirect::route('indextAsset1', [$getting->category_name_id]);
		}
	}

	public function deleteAssetTracking($id)
	{		  
			$getting = Asset_Tracking::where('id', $id)->first();			
			Session::flash('getError', Lang::get('messages.data_deleted', ['data' => 'Data Asset '.$getting->barcode]));
			Asset_Tracking::where('id', $id)->delete();
			return back();
	}

	public function addAssetSoftware()
	{
		return view::make('IT.Asset.software.add');
	}

	public function storeAssetSoftware(Request $request)
	{
		$expiring_date = $request->input('Expiring');
		$starting_date = $request->input('Starting');
		$purc_date = $request->input('Purchase');

		$rules = [
			'Product' 	=> 'required|string|max:255',
			'Software' 	=> 'required|string|max:255',			
			'Version' 	=> 'required',					
			'total_licensed' => 'required|numeric',			
		];

		if ($expiring_date === null) {
			$exp_date = "0000-00-00";
		}else{
			$exp_date = $request->input('Expiring');
		}
		if ($starting_date === null ) {
			$str_date = "0000-00-00";
		}else{
			$str_date = $request->input('Starting');
		}
		if ($purc_date === null) {
			$purchase = "0000-00-00";
		}else{
			$purchase = $request->input('Purchase');
		}

		$total = $request->input('mata_uang').' '.$request->input('Qty')*$request->input('rupiah');
		$data = [
			'product' 		=> $request->input('Product'),
			'name_software' => $request->input('Software'),
			'version' 		=> $request->input('Version'),
			'starting_date' => $str_date,
			'expiring_date' => $exp_date,
			'purchase_date' => $purchase,
			'product_key'  	=> $request->input('key_product'),
			'licensed_id' 	=> $request->input('Licensed'),	
			'total_licensed' => $request->input('total_licensed'),
			'remains_licenses' => $request->input('total_licensed'),
			'email_registrations'	=> $request->input('email'),
			'po_number1'		=> strtoupper($request->input('PO1')),
			'po_number2'		=> strtoupper($request->input('PO2')),
			'po_number3'		=> strtoupper($request->input('PO3')),
			'po_number4'		=> strtoupper($request->input('PO4')),
			'po_number5'		=> strtoupper($request->input('PO5')),
			'vendor'		=> strtoupper($request->input('Vendor')),
			'qty' 			=> $request->input('Qty'),
			'price' 		=> $request->input('mata_uang').' '.$request->input('rupiah'),
			'total_price'   => $total,
			'status_software' 	=> $request->input('status'),
			'type_software' 	=> $request->input('type'),
			'invoice'			=> strtoupper($request->input('Invoice')),
			'delivery_order'	=> strtoupper($request->input('DO')),
			'notee'				=> $request->input('note'),
			'created_by'		=> auth::user()->first_name.' '.auth::user()->last_name,
		];				
		
		$validator = Validator::make($request->all(), $rules);
		
		if ($validator->fails()) {            
			return Redirect::route('addAssetSoftware')
				->withErrors($validator)
				->withInput();
		} else {
			AssetSoftware::insert($data);
			Session::flash('success', Lang::get('messages.data_inserted', ['data' => 'Data Software ']));
			return Redirect::route('indexAssetSoftware');
		}
	}

	public function indexAssetSoftware()
	{		
		return view::make('IT.Asset.software.index');
	}

	public function GetAssetSoftware()
	{
		$select = AssetSoftware::select([
			'id', 'product', 'name_software', 'version', 'purchase_date', 'expiring_date', 'type_software', 'status_software'
		])	
		->orderBy('product', 'asc')	
		->get(); 

		return Datatables::of($select)	
		->edit_column('purchase_date', '@if($purchase_date === "0000-00-00"){{"00-00-000"}} @else {{date("d-m-Y", strtotime($purchase_date))}} @endif')		
		->edit_column('expiring_date', '@if($expiring_date === "0000-00-00"){{"00-00-000"}} @else {{date("d-m-Y", strtotime($expiring_date))}} @endif')			
		->setRowClass('@if (date("Y-m-d") >= date("Y-m-d", strtotime("-1 months", strtotime($expiring_date)))){{ "info" }}@endif @if (date("Y-m-d") >= $expiring_date){{"danger"}} @endif')
		->addColumn('time_limit', '@php
			$date1=date_create($expiring_date);
			$date2=date_create(date("Y-m-d"));
			$diff=date_diff($date2,$date1);
			
			if($expiring_date === "0000-00-00")
			{
				$cat = "Countless";
			}else{
				$cat = $diff->format("%R%a days");
			}

			echo $cat;

		 @endphp')
		->addColumn('condtion', '@if (date("Y-m-d") >= $expiring_date){{"Expired"}} @else {{"Valid"}} @endif')
		->addColumn('action1', 
		  	Lang::get('messages.btn_name', ['title' => 'Add User For Software', 'url' => '{{ URL::route(\'addUserSoftware\', [$id]) }}', 'name' => 'add user'])		  	
		  )
		->addColumn('action2', 		  
		  	Lang::get('messages.btn_name_btn', ['title' => 'Detail For Software', 'url' => '{{ URL::route(\'detailInventorySoftware\', [$id]) }}', 'name' => 'detail', 'bttn' => 'btn-success'])
		  )
		->addColumn('action3', 		  	
		  	Lang::get('messages.btn_name_btn', ['title' => 'Edit For Software', 'url' => '{{ URL::route(\'edtiInvertorySoftware\', [$id]) }}', 'name' => 'edit', 'bttn' => 'btn-warning'])		  
		  )
		->addColumn('action4', 		  	
		  	Lang::get('messages.btn_name_btn', ['title' => 'Delete Software', 'url' => '{{ URL::route(\'deleteListSoftware\', [$id]) }}', 'name' => 'delete', 'bttn' => 'btn-danger'])		  
		  )
		->make();  
	}

	public function deleteListSoftware($id)
	{
		AssetSoftware::where('id', $id)->delete();	
		Session::flash('message', Lang::get('messages.data_deleted', ['data' => 'Software']));
		return back();
	}

	public function SendMailReminderSoftwareMail()
	{		
		return back();
	}

	public function addUserSoftware($id)
	{
		$select = AssetSoftware::find($id);

		$userss = User::where('active', 1)->whereNotIn('nik', ['123456789'])->orderBy('first_name', 'asc')->get();

		$availability = Ws_Availability::orderBy('hostname', 'asc')->get();

		return view::make('IT.Asset.software.addUserSoftware.add', ['select' => $select, 'userss' => $userss, 'availability' => $availability]);
	}

	public function storeAddUserSoftware(Request $request, $id)
	{
		$select = AssetSoftware::find($id);

		$data = [
			'id_userss' => $request->input('nameuser'),
			'id_software' => $select->id,
			'use_license' => 1,
			'id_ws_availability'	=> $request->input('name_workstation'),
			'created_by'			=> auth::user()->first_name.' '.auth::user()->last_name
		];

		MarkInventory::insert($data);
		Session::flash('success', Lang::get('messages.data_inserted', ['data' => 'User Software ']));
		return Redirect::route('indexAssetSoftware');
	}

	public function detailInventorySoftware($id)
	{
		$software = AssetSoftware::find($id);

		$getData = MarkInventory::where('id_software', $software->id)->get();		

		return view::make('IT.Asset.software.addUserSoftware.indexDetail', ['software' => $software, 'getData' => $getData]);

	}

	public function deleteMarkInventory($id)
	{
		MarkInventory::where('id', $id)->delete();
		Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'User software removed']));
		return back();

	}

	public function edtiInvertorySoftware($id)
	{	
		$getData = AssetSoftware::find($id);	

		return view::make('IT.Asset.software.edit')->with([				
				'getData' => $getData,				      
			]);
	}

	public function saveEditInventorySoftware(Request $request, $id)
	{
		$expiring_date = $request->input('Expiring');
		$starting_date = $request->input('Starting');
		$purc_date = $request->input('Purchase');

		$rules = [
			'Product' 	=> 'required|string|max:255',
			'Software' 	=> 'required|string|max:255',			
			'Version' 	=> 'required',					
			'total_licensed' => 'required|numeric',			
		];

		if ($expiring_date === null) {
			$exp_date = "0000-00-00";
		}else{
			$exp_date = $request->input('Expiring');
		}
		if ($starting_date === null ) {
			$str_date = "0000-00-00";
		}else{
			$str_date = $request->input('Starting');
		}
		if ($purc_date === null) {
			$purchase = "0000-00-00";
		}else{
			$purchase = $request->input('Purchase');
		}

		$total = $request->input('mata_uang').' '.$request->input('Qty')*$request->input('rupiah');
		
		$data = [
			'product'					=> $request->input('Product'),
			'name_software'				=> $request->input('Software'),
			'version'					=> $request->input('Version'),
			'starting_date'				=> $request->input('Starting'),
			'expiring_date'				=> $request->input('Expiring'),
			'purchase_date'				=> $request->input('Purchase'),
			'product_key'				=> $request->input('key_product'),
			'licensed_id'				=> $request->input('Licensed'),
			'email_registrations'		=> $request->input('email'),
			'vendor'					=> $request->input('Vendor'),
			'qty'						=> $request->input('Qty'),
			'total_licensed'			=> $request->input('total_licensed'),
			'po_number1'				=> strtoupper($request->input('PO1')),
			'po_number2'				=> strtoupper($request->input('PO2')),
			'po_number3'				=> strtoupper($request->input('PO3')),
			'po_number4'				=> strtoupper($request->input('PO4')),
			'po_number5'				=> strtoupper($request->input('PO5')),
			'invoice'					=> strtoupper($request->input('Invoice')),
			'delivery_order'			=> strtoupper($request->input('DO')),
			'price' 					=> $request->input('mata_uang').' '.$request->input('rupiah'),
			'total_price'  				=> $total,
			'status_software' 			=> $request->input('status'),
			'type_software' 			=> $request->input('type'),
			'notee'						=> $request->input('note'),
			'created_by'				=> auth::user()->first_name.' '.auth::user()->last_name,
			'updated_at'				=> date("Y-m-d H:i:s")		
		
		];
		
		$validator = Validator::make($request->all(), $rules);
		
		if ($validator->fails()) {            
			return Redirect::route('edtiInvertorySoftware', [$id])
				->withErrors($validator)
				->withInput();
		} else {
			AssetSoftware::where('id', $id)->update($data);
			Session::flash('success', Lang::get('messages.data_inserted', ['data' => 'Data Software ']));
			return Redirect::route('indexAssetSoftware');
		}
	}

	public function indexBarcodeAsset($id)
	{
		$Tracking = Asset_Tracking::find($id);
        $return   = "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='showModalLabel'>Asset Detail $Tracking->category_name_name</h4>
            </div>
            <div class='modal-body'>
                <div class='well'>
                    <h4><strong><u>$Tracking->brand $Tracking->series</u></strong></h4> 
                       
                </div>
            </div>
            <div class='modal-footer'>               
                <button type='button' class='btn btn-sm btn-default' data-dismiss='modal'>Close</button>
            </div>
        ";

        return $return;
	}

	public function pdfBarcodeAssetTrackingAll($id)
	{
		$data = Asset_Tracking::where('category_name_id', $id)->orderBy('barcode', 'asc')->get();
		$title = Asset_Cname::where('key_mark', $id)->first();

        $pdf = App::make('dompdf.wrapper');
		$pdf->loadview('IT.Asset.pdfBarcode', ['data' => $data, 'title' => $title])
		->setPaper('A4', 'landscape');
		
		return $pdf->stream();	
	}

	public function pdfIFWCodeAssetTrackingAll($id)
	{
		$data = Asset_Tracking::where('category_name_id', $id)->orderBy('barcode', 'asc')->get();
		$title = Asset_Cname::where('key_mark', $id)->first();
		$no = 1;

        $pdf = App::make('dompdf.wrapper');
		$pdf->loadview('IT.Asset.ifwCode', ['data' => $data, 'title' => $title, 'no' => $no])
		->setPaper('A4', 'potrait');
		
		return $pdf->stream();	
	}

	public function indexResetPasswordIT()
	{
		return view('IT.ResetPassword.index');
	}

	public function dataIndexResetPasswordIT()
	{
		$model = NewUser::where('active', 1)
				->where('nik', '!=', null)
				->orderBy('first_name', 'asc')
				->get();

   		return DataTables::of($model)
   		 		->addIndexColumn()
   		 		->addColumn('fullName', function(NewUser $newuser){
   		 			return $newuser->first_name.' '.$newuser->last_name;
   		 		})
   		 		->addColumn('deptName', function(NewUser $newuser){
   		 			$department = Dept_Category::find($newuser->dept_category_id); 
   		 			return $department->dept_category_name;
   		 		})
   		 		->addColumn('action', function(NewUser $newuser){
   		 			return Lang::get('messages.btn_reset', ['title' => 'Reset Password', 'url' =>  route('passResetUserIT2', [$newuser->id]), 'class' => 'refresh']);
   		 		})
   		 		->edit_column('end_date', function(NewUser $newuser){
   		 			if ($newuser->end_date === null) {
   		 				return '---';
   		 			}
   		 			return $newuser->end_date;
   		 		})
                ->make(true);
	}

	public function passResetUserIT($id)
	{	    	
	    $select = NewUser::find($id);
	    $return   = "
	            <div class='modal-header'>
	                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
	            </div>
	            <div class='modal-body'>
	                <div class='well'>
	                    <h4>Are you sure want to reset <strong>$select->first_name $select->last_name</strong> password?</h4>
	                    <br>
	                    <h4>Password Default : <i><strong>Batam".date('Y')."</strong></i></h4>
	                </div>
	            </div>
	            <div class='modal-footer'>
	            	<a class='btn btn-primary' href='".URL::route('actionPassResetUserIT', [$id])."'>Yes</a>
	                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
	            </div>
	        ";

		return $return;
	}

	public function actionPassResetUser(Request $request, $id)
	{
	   $data = [
			'password' => Hash::make('Batam'.Date('Y')),
			'block_stat' => 0,
		];	

		User::where('id', $id)->update($data);
		Session::flash('message', Lang::get('messages.data_updated', ['data' => 'ta User']));
	    return Redirect::route('indexResetPassswordIT');
	}

}
