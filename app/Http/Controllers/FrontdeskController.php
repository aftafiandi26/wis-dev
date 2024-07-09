<?php

namespace App\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use App\stationary_stock;
use App\Stationary_transaction;
use App\stationary_count;
use App\stationary_kategori;
use App\User;
use Carbon\Carbon;
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

class FrontdeskController extends Controller
{

	private function receptionst()
	{
		return "Dhea Karina Putri";
	}
	public function __construct()
	{
		$this->middleware(['auth', 'active', 'hr']);
	}

	public function indexstokstoonery()
	{
		$no = 1;

		$waters = stationary_stock::where('category_item', 1)->orderBy('kode_barang', 'asc')->get();

		return view('HRDLevelAcces.frontedesk.index', compact(['no', 'waters']));
	}


	// public function getstokstoonery()
	// {

	// 	$select = stationary_stock::select(['id', 'kode_barang', 'name_item', 'satuan', 'merk', 'stock_barang', 'total_out_stock', 'in_purchase', 'balance_stock', 'date_stock'])
	// 		->whereMONTH('date_stock', date('m'))

	// 		->get();
	// 	return Datatables::of($select)
	// 		->addColumn('date1', '
	// 			@php
	// 			echo "tes";
	// 			@endphp
	// 			', 6)
	// 		->addColumn('date2', 'date2', 7)
	// 		->addColumn('date3', 'date3', 8)
	// 		->addColumn('date4', 'date4', 9)
	// 		->addColumn('date5', 'date5', 10)
	// 		->addColumn('date6', 'date6', 11)
	// 		->addColumn('date7', 'date7', 12)
	// 		->addColumn('date8', 'date8', 13)
	// 		->addColumn('date9', 'date9', 14)
	// 		->addColumn('date10', 'date10', 15)
	// 		->addColumn('date11', 'date11', 16)
	// 		->addColumn('date12', 'date12', 17)
	// 		->addColumn('date13', 'date13', 18)
	// 		->addColumn('date14', 'date14', 19)
	// 		->addColumn('date15', 'date15', 20)
	// 		->addColumn('date16', 'date16', 21)
	// 		->addColumn('date17', 'date17', 22)
	// 		->addColumn('date18', 'date18', 23)
	// 		->addColumn('date19', '
	// 			@php
	// 			echo "tes";
	// 			@endphp
	// 			', 24)
	// 		->addColumn('date20', 'date20', 25)
	// 		->addColumn('date21', 'date21', 26)
	// 		->addColumn('date22', 'date22', 27)
	// 		->addColumn('date23', 'date23', 28)
	// 		->addColumn('date24', 'date24', 29)
	// 		->addColumn('date25', 'date25', 30)
	// 		->addColumn('date26', 'date26', 31)
	// 		->addColumn('date27', 'date27', 32)
	// 		->addColumn('date28', 'date28', 33)
	// 		->addColumn('date29', 'date29', 34)
	// 		->addColumn('date30', 'date30', 35)
	// 		->addColumn('date31', 'date31', 36)
	// 		->addColumn('action1', '<a href="{{route("Statoonery/indexInStock", [$id])}}"class="btn btn-sm btn-primary">IN</a>')
	// 		->addColumn('action2', '<a href="{{route("Statoonery/indexOutStock", [$id])}}" class="btn btn-sm btn-warning">OUT</a>')
	// 		->make();
	// }

	public function indexOutStock($id)
	{
		$stocks = stationary_stock::where('id', $id)->first();
		$users = User::where('active', 1)->whereNotIn('nik', ["", "123456789"])->orderBy('first_name', 'asc')->get();

		return view('HRDLevelAcces.frontedesk.outStock', compact(['stocks', 'users']));
	}

	public function storeOutStock(Request $request, $id)
	{
		$user = $request->input('user1');

		if ($request->input('user')) {
			$user = User::find($request->input('user'));
			$user = $user->getFullName();
		}

		$rules = [
			'date_stock' => 'required|date',
			'jumlah'    => 'required|numeric',
			'describe' => 'required|min:3',
		];

		$data = [
			'kode_barang' => $request->input('kode'),
			'out_stock'  => $request->input('jumlah'),
			'date_out_stock' => $request->input('date_stock'),
			'key_param'		=> 1,
			'user_id'		=> $request->input('user'),
			'employes'		=> $user,
			'describe'		=> $request->input('describe'),
			'status_transaction' => 2,
		];

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('Statoonery/indexOutStock', [$id])
				->withErrors($validator)
				->withInput();
		} else {

			$stocked = stationary_stock::where('kode_barang', $request->input('kode'))->first();

			if (empty($stocked)) {
				Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry!, Data stock code:' . $request->input('kode') . ' cannot be found.']));
				return Redirect::route('Statoonery/index');
			}

			Stationary_transaction::insert($data);

			Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data Stock']));
			return Redirect::route('Statoonery/index');
		}
	}

	public function indexInStock($id)
	{
		$stock = stationary_stock::where('id', $id)->first();
		return view('HRDLevelAcces.frontedesk.intStock', ['stocks' => $stock]);
	}

	public function storeInStock(Request $request, $id)
	{
		$rules = [
			'date_stock' => 'required|date',
			'jumlah'    => 'required|numeric'
		];

		$data = [
			'kode_barang' => $request->input('kode'),
			'in_stock'  => $request->input('jumlah'),
			'date_in_stock' => $request->input('date_stock'),
			'status_transaction' => 1,
			'key_param' => 1,
		];

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('Statoonery/indexInStock', [$id])
				->withErrors($validator)
				->withInput();
		} else {
			Stationary_transaction::insert($data);
			Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data in stock successfully added. Code: ' . $request->input('kode')]));
			return Redirect::route('Statoonery/index');
		}
	}

	public function addStockStatoonary()
	{
		$categories = stationary_kategori::where('key_param', 1)->orderBy('kategori_stock', 'asc')->get();

		return view('HRDLevelAcces.frontedesk.addStock', compact(['categories']));
	}

	public function storeAddStockStatoonary(Request $request)
	{
		$$variableCategory = $request->input('kategori') . $request->input('kode_barang');

		$findCategory = stationary_stock::where('kode_barang', $variableCategory)->first();

		if ($findCategory) {
			Session::flash('getError',  Lang::get('messages.data_custom', ['data' => 'Sorry!!, code item:' . $request->input('kode_barang') . ' has been created.']));
			return Redirect::route('Stationary/addStockStatoonary');
		}

		$rules = [
			'satuan'		=> 'required|string',
			'date_stock'	=> 'required|date',
			'jumlah'   		=> 'required|numeric',
			'kategori'		=> 'required|numeric',
		];

		$data = [
			'kode_barang'	 => $variableCategory,
			'name_item' 	 => $request->input('nama_item'),
			'category_item'  => $request->input('key_param'),
			'satuan'	     => strtolower($request->input('satuan')),
			'merk'			 => $request->input('merek'),
			'stock_barang'	 => $request->input('jumlah'),
			'total_out_stock' => 0,
			'total_in_stock'  => 0,
			'balance_stock'	 => $request->input('jumlah'),
			'date_stock'	 => $request->input('date_stock'),
			'created_at'	=> date('Y-m-d'),
			'kode_kategory' => $request->input('kategori'),
		];

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('Stationary/addStockStatoonary')
				->withErrors($validator)
				->withInput();
		} else {
			stationary_stock::insert($data);
			Session::flash('message',  Lang::get('messages.data_custom', ['data' => 'Stock water has been created']));
			return Redirect::route('Statoonery/index');
		}
	}

	public function editStationaryName($id)
	{
		$stock = stationary_stock::where('id', $id)->first();

		return view('HRDLevelAcces.frontedesk.EditStock', ['stocks' => $stock]);
	}

	public function saveStationaryName(Request $request, $id)
	{
		$item = stationary_stock::find($id);

		$rules = [
			'nama_item' 	=> 'required',
			'merek'			=> 'required',
			'satuan'		=> 'required',
			'kode'			=> 'required|numeric|min:0',
			'total_stock'		=> 'required|numeric|min:0',
			'total_in_stock'	=> 'required|numeric|min:0',
			'total_out_stock'	=> 'required|numeric|min:0',
			'in_purchase'		=> 'required|numeric|min:0',
			'balance_stock'		=> 'required|numeric|min:0',
		];

		$data = [
			'name_item' 	 => $request->input('nama_item'),
			'satuan'    	 => strtolower($request->input('satuan')),
			'merk'			 => $request->input('merek'),
			'kode_barang'	 => $request->input('kode'),
			'stock_barang'		=> $request->input('total_stock'),
			'total_in_stock'	=> $request->input('total_in_stock'),
			'total_out_stock'	=> $request->input('total_out_stock'),
			'balance_stock'		=> $request->input('balance_stock'),
		];

		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return Redirect::route('editStationaryName', [$id])
				->withErrors($validator)
				->withInput();
		} else {
			stationary_stock::where('id', $id)->update($data);
			Session::flash('success', Lang::get('messages.data_updated', ['data' => 'Data Stock ' . $item->name_item . '']));
			return Redirect::route('Statoonery/index');
		}
	}

	public function GenerateStocked()
	{
		$no = 1;
		$receptionist = $this->receptionst();
		$waters = stationary_stock::where('category_item', 1)->orderBy('kode_barang', 'asc')->get();

		$pdf = App::make('dompdf.wrapper');

		$pdf->loadview('HRDLevelAcces.frontedesk.generatePDF', compact(['no', 'waters', 'receptionist']))
			->setPaper('A4', 'landscape')
			->setOptions(['dpi' => 180, 'defaultFont' => 'sans-serif']);
		return $pdf->stream();
	}

	public function indexKategoryStationary()
	{
		return view('HRDLevelAcces.frontedesk.kategory_stock.index');
	}

	public function dataIndexCategory()
	{
		$modal = stationary_kategori::orderBy('unik_kategori', 'asc')->get();

		return Datatables::of($modal)
			->addIndexColumn()
			->addColumn('action', function (stationary_kategori $stationary) {
				$edit = "<a href=" . route('editKategoryStationary', [$stationary->id]) . " class='btn btn-xs btn-warning' title='Edit " . $stationary->kategori_stock . "'><i class='fa fa-pencil'></i></a>";

				return $edit;
			})
			->rawColumns(['action'])
			->make(true);
	}

	public function addKategoryStationary()
	{
		return view('HRDLevelAcces.frontedesk.kategory_stock.addKategory');
	}

	public function storeKategoryStationary(Request $request)
	{
		$rules = [
			'kode'		=> 'required|numeric',
			'category' 	=> 'required',

		];

		$data = [
			'unik_kategori'	 => $request->input('kode'),
			'kategori_stock' => strtoupper($request->input('category'))
		];

		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return Redirect::route('addKategoryStationary')
				->withErrors($validator)
				->withInput();
		} else {

			$coba = stationary_kategori::where('unik_kategori', 'like', '%' . $request->input('kode') . '%')->value('unik_kategori');
			if ($coba !=  $request->input('kode')) {
				stationary_kategori::insert($data);
				Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data Stock']));
				return Redirect::route('indexKategoryStationary');
			} else {
				Session::flash('message', Lang::get('messages.act_failed', ['act' => 'Inputed Databes', 'data' => 'Category Stationary']));
				return Redirect::route('addKategoryStationary');
			}
		}
	}

	public function editKategoryStationary($id)
	{
		$stationary_kategori = stationary_kategori::find($id);
		return view('HRDLevelAcces.frontedesk.kategory_stock.editKategory', ['stationary_kategori' => $stationary_kategori]);
	}

	public function SaveKategoryStationary(request $request, $id)
	{
		$rules = [
			'code' 	=> 'required|unique:stationary_kategory,unik_kategori',
			'category' 	=> 'required',
		];

		$data = [
			'unik_kategori'			 => $request->input('code'),
			'kategori_stock' => strtoupper($request->input('category'))
		];

		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return Redirect::route('editKategoryStationary', [$id])
				->withErrors($validator)
				->withInput();
		} else {
			stationary_kategori::where('id', $id)->update($data);
			Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data Stock']));
			return Redirect::route('indexKategoryStationary');
		}
	}

	public function GeneratePDFNameKategori($id)
	{
		$getKategori = stationary_kategori::find($id);
		$no = 1;
		$data = stationary_stock::where('kode_kategory', $getKategori->unik_kategori)->orderBy('kode_barang', 'asc')->get();
		$stock_awal = stationary_stock::where('kode_kategory', $getKategori->unik_kategori)->whereMONTH('date_stock', date('m', strtotime('-1 month')))->pluck('stock_barang')->sum();
		$total_items_exited =  stationary_stock::where('kode_kategory', $getKategori->unik_kategori)->pluck('total_out_stock')->sum();
		$total_in_purchase =  stationary_stock::where('kode_kategory', $getKategori->unik_kategori)->pluck('in_purchase')->sum();
		$total_balance_stock = stationary_stock::where('kode_kategory', $getKategori->unik_kategori)->pluck('balance_stock')->sum();

		$pdf = App::make('dompdf.wrapper');
		$pdf->loadview('HRDLevelAcces.frontedesk.kategory_stock.generatePDFKategori', [
			'getKategori'			=> $getKategori,
			'no' 					=> $no,
			'data' 					=> $data,
			'stock_awal' 			=> $stock_awal,
			'total_items_exited' 	=> $total_items_exited,
			'total_in_purchase'		=> $total_in_purchase,
			'total_balance_stock'	=> $total_balance_stock
		])
			->setPaper('A4', 'landscape')
			->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
		return $pdf->stream();
	}

	public function indexStockStationaryWater()
	{
		$no = 1;

		$waters = stationary_stock::where('category_item', 2)->orderBy('kode_barang', 'asc')->get();


		return view('HRDLevelAcces.frontedesk.StationaryWaterMineral.index', compact(['waters', 'no']));
	}

	public function addStockStationaryWater()
	{
		$categories = stationary_kategori::where('key_param', 2)->orderBy('kategori_stock', 'asc')->get();

		return view('HRDLevelAcces.frontedesk.StationaryWaterMineral.addStock', compact(['categories']));
	}

	public function storeAddStockStationaryWater(Request $request)
	{
		$variableCategory = $request->input('kategori') . $request->input('kode_barang');

		$findCategory = stationary_stock::where('kode_barang', $variableCategory)->first();

		if ($findCategory) {
			Session::flash('getError',  Lang::get('messages.data_custom', ['data' => 'Sorry!!, code item:' . $request->input('kode_barang') . ' has been created.']));
			return Redirect::route('addStockStationaryWater');
		}

		$rules = [
			'satuan'		=> 'required|string',
			'date_stock'	=> 'required|date',
			'jumlah'   		=> 'required|numeric',
			'kategori'		=> 'required|numeric',
		];

		$data = [
			'kode_barang'	 => $variableCategory,
			'name_item' 	 => $request->input('nama_item'),
			'category_item'  => $request->input('key_param'),
			'satuan'	     => strtolower($request->input('satuan')),
			'merk'			 => $request->input('merek'),
			'stock_barang'	 => $request->input('jumlah'),
			'total_out_stock' => 0,
			'total_in_stock'  => 0,
			'balance_stock'	 => $request->input('jumlah'),
			'date_stock'	 => $request->input('date_stock'),
			'created_at'	=> date('Y-m-d'),
			'kode_kategory' => $request->input('kategori'),
		];

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('addStockStationaryWater')
				->withErrors($validator)
				->withInput();
		} else {
			stationary_stock::insert($data);
			Session::flash('message',  Lang::get('messages.data_custom', ['data' => 'Stock water has been created']));
			return Redirect::route('indexStockStationaryWater');
		}
	}

	public function indexOutStockStationaryWater($id)
	{
		$stocks = stationary_stock::where('id', $id)->first();
		$users = User::where('active', 1)->whereNotIn('nik', ["", 123456789])->orderBy('first_name', 'asc')->get();
		return view('HRDLevelAcces.frontedesk.StationaryWaterMineral.outStock', compact(['stocks', 'users']));
	}

	public function storeOutStockStationaryWater(Request $request, $id)
	{
		$user = $request->input('user1');

		if ($request->input('user')) {
			$user = User::find($request->input('user'));
			$user = $user->getFullName();
		}

		$rules = [
			'date_stock' => 'required|date',
			'jumlah'    => 'required|numeric',
			'describe' => 'required|min:3',
		];

		$data = [
			'kode_barang' => $request->input('kode'),
			'out_stock'  => $request->input('jumlah'),
			'date_out_stock' => $request->input('date_stock'),
			'key_param'		=> 2,
			'user_id'		=> $request->input('user'),
			'employes'		=> $user,
			'describe'		=> $request->input('describe'),
			'status_transaction' => 2,
		];

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('indexOutStockStationaryWater', [$id])
				->withErrors($validator)
				->withInput();
		} else {

			$stocked = stationary_stock::where('kode_barang', $request->input('kode'))->first();

			if (empty($stocked)) {
				Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry!, Data stock code:' . $request->input('kode') . ' cannot be found.']));
				return Redirect::route('indexOutStockStationaryWater', $id);
			}

			Stationary_transaction::insert($data);

			Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data Stock']));
			return Redirect::route('indexStockStationaryWater');
		}
	}

	public function indexInStockStationaryWater($id)
	{
		$stock = stationary_stock::where('id', $id)->first();

		return view('HRDLevelAcces.frontedesk.StationaryWaterMineral.intStock', ['stocks' => $stock]);
	}

	public function storeInStockStationaryWater(Request $request)
	{
		$rules = [
			'date_stock' => 'required|date',
			'jumlah'    => 'required|numeric'
		];

		$data = [
			'kode_barang' => $request->input('kode'),
			'in_stock'  => $request->input('jumlah'),
			'date_in_stock' => $request->input('date_stock'),
			'status_transaction' => 1,
			'key_param' => 2,
		];

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('indexInStockStationaryWater', [$id])
				->withErrors($validator)
				->withInput();
		} else {
			Stationary_transaction::insert($data);
			Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data in stock successfully added. Code: ' . $request->input('kode')]));
			return Redirect::route('indexStockStationaryWater');
		}
	}

	public function editStockStationaryWater($id)
	{
		$stock = stationary_stock::where('id', $id)->first();

		return view('HRDLevelAcces.frontedesk.StationaryWaterMineral.EditStock', ['stocks' => $stock]);
	}

	public function saveStockStationaryWater(Request $request, $id)
	{
		$rules = [
			'nama_item' 	=> 'required',
			'merek'			=> 'required',
			'satuan'		=> 'required',
		];

		$data = [
			'name_item' 	 => $request->input('nama_item'),
			'satuan'    	 => strtolower($request->input('satuan')),
			'merk'			 => $request->input('merek'),
		];

		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return Redirect::route('editStockStationaryWater', [$id])
				->withErrors($validator)
				->withInput();
		} else {
			stationary_stock::where('id', $id)->update($data);
			Session::flash('message', Lang::get('messages.data_inserted', ['data' => 'Data Stock']));
			return Redirect::route('indexStockStationaryWater');
		}
	}

	public function GenerateStockedWater()
	{
		$no = 1;
		$receptionist = $this->receptionst();
		$waters = stationary_stock::where('category_item', 2)->orderBy('kode_barang', 'asc')->get();

		$pdf = App::make('dompdf.wrapper');

		$pdf->loadview('HRDLevelAcces.frontedesk.StationaryWaterMineral.generatePDF', compact(['no', 'waters', 'receptionist']))
			->setPaper('A4', 'landscape')
			->setOptions(['dpi' => 180, 'defaultFont' => 'sans-serif']);
		return $pdf->stream();
	}

	public function ExcelStationaryStock()
	{
		$no = 1;
		$receptionist = $this->receptionst();
		$waters = stationary_stock::where('category_item', 1)->orderBy('kode_barang', 'asc')->get();

		Excel::create('Stationery', function ($excel) use ($waters, $no, $receptionist) {
			$excel->sheet('New sheet', function ($sheet) use ($waters, $no, $receptionist) {

				$sheet->setOrientation('landscape');
				$sheet->setAutoSize(true);
				$sheet->loadView('HRDLevelAcces.frontedesk.excel.ExcelStationary', compact('waters', 'no', 'receptionist'));
				$sheet->setScale(55);
			});
		})->export('xls');

		return back();
	}

	public function ExcelStationaryStockWater()
	{
		$no = 1;
		$receptionist = $this->receptionst();
		$waters = stationary_stock::where('category_item', 2)->orderBy('kode_barang', 'asc')->get();

		Excel::create('Stationery Mineral Water', function ($excel) use ($waters, $no, $receptionist) {
			$excel->sheet('New sheet', function ($sheet) use ($waters, $no, $receptionist) {

				$sheet->setOrientation('landscape');
				$sheet->setAutoSize(true);
				$sheet->loadView('HRDLevelAcces.frontedesk.excel.ExcelStationaryWater', compact('waters', 'no', 'receptionist'));
				$sheet->setScale(55);
			});
		})->export('xls');

		return back();
	}

	public function indexForfeited()
	{
		dd('k');
		return view('HRDLevelAcces.forfeited.index');
	}

	public function modalMineralViewTable($code, $date)
	{
		$no = 1;
		$transaction = Stationary_transaction::where('kode_barang', $code)->whereYear('date_out_stock', date('Y'))->whereMonth('date_out_stock', date('m'))->whereDay('date_out_stock', $date)->get();
		$water = stationary_stock::where('kode_barang', $code)->first();

		return view('HRDLevelAcces.frontedesk.StationaryWaterMineral.modalViewTable', compact(['transaction', 'no', 'water', 'date']));
	}

	public function editTransaction(Request $request, $id)
	{
		$transaction = Stationary_transaction::find($id);

		$users = User::all();

		return view('HRDLevelAcces.frontedesk.StationaryWaterMineral.editTransaction', compact(['transaction', 'users']));
	}

	public function updateTransaction(Request $request, $id)
	{
		$user = $request->input('user1');
		$ifUser = $request->input('user');

		if ($ifUser == 1) {
			$ifUser = null;
		}

		if ($ifUser) {
			$user = User::find($request->input('user'));
			$user = $user->getFullName();
		}

		$rules = [
			'date_stock' => 'required|date',
			'jumlah'    => 'required|numeric',
			'describe' => 'required|min:3',
		];

		$data = [
			'kode_barang' => $request->input('kode'),
			'out_stock'  => $request->input('jumlah'),
			'date_out_stock' => $request->input('date_stock'),
			'user_id'		=> $ifUser,
			'employes'		=> $user,
			'describe'		=> $request->input('describe'),
		];

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('indexOutStockStationaryWater', [$id])
				->withErrors($validator)
				->withInput();
		} else {

			Stationary_transaction::where('id', $id)->update($data);
			Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Data has been updated']));
			return Redirect::route('indexStockStationaryWater');
		}
	}

	public function deleteTransaction($id)
	{
		Stationary_transaction::find($id)->delete();
		Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Data has been deleted']));
		return Redirect::route('indexStockStationaryWater');
	}

	//end 
}