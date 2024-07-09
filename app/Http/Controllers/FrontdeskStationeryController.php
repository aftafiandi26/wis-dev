<?php

namespace App\Http\Controllers;

use App\stationary_kategori;
use App\stationary_stock;
use App\Stationary_transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Facades\Datatables;

class FrontdeskStationeryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    private function headline()
    {
        return "(hr) Stationery (atk)";
    }

    public function key_param()
    {
        return 1;
    }

    public function receptionist()
    {
        return "Dhea Karina Putri";
    }

    public function indexAtk()
    {
        $headline = $this->headline();
        $key_param = $this->key_param();
        $waters = stationary_stock::where('category_item', $key_param)->orderBy('kode_barang', 'asc')->get();
        $categories = stationary_kategori::where('key_param', $key_param)->orderBy('unik_kategori', 'asc')->get();

        $previous = date('F', strtotime('previous month'));
        $next = date('F', strtotime('next month'));
        $month = date('Y-m');
        $lastDay = date('t');


        return view('HRDLevelAcces.frontedesk.stationary.atk.index', compact(['waters', 'headline', 'key_param', 'categories', 'previous', 'next', 'month', 'lastDay']));
    }

    public function indexAtk1($month)
    {
        $headline = $this->headline();
        $key_param = $this->key_param();
        $year = date('F', strtotime($month));
        $waters = stationary_stock::where('category_item', $key_param)->orderBy('kode_barang', 'asc')->get();

        $categories = stationary_kategori::where('key_param', $key_param)->orderBy('unik_kategori', 'asc')->get();

        $previous = date('F', strtotime('previous month', strtotime($month)));
        $next = date('F', strtotime('next month', strtotime($month)));

        return view('HRDLevelAcces.frontedesk.stationary.atk.index', compact(['waters', 'headline', 'key_param', 'categories', 'previous', 'next', 'month']));
    }

    public function addStock()
    {
        $headline = $this->headline();
        $key_param = $this->key_param();
        $categories = stationary_kategori::where('key_param', $key_param)->orderBy('kategori_stock', 'asc')->get();

        return view('HRDLevelAcces.frontedesk.stationary.atk.addStock', compact(['categories', 'headline']));
    }

    public function storeStock(Request $request)
    {
        $rules = [
            'uom'        => 'required|string',
            'date_stock'    => 'required|date',
            'qty'           => 'required|numeric',
            'category'        => 'required|numeric',
            'code_item'    => 'required|numeric'
        ];

        $variableCategory = $request->input('category') . $request->input('code_item');
        $findCategory = stationary_stock::where('kode_barang', $variableCategory)->first();

        if ($findCategory) {
            Session::flash('getError',  Lang::get('messages.data_custom', ['data' => 'Sorry!!, code item:' . $request->input('code_item') . ' has been created.']));
            return Redirect::route('stationery/atk/stocked/add');
        }

        $data = [
            'kode_barang'     => $variableCategory,
            'name_item'      => Str::title($request->input('item')),
            'category_item'  => $request->input('key_param'),
            'satuan'         => strtolower($request->input('uom')),
            'merk'             => Str::title($request->input('brand')),
            'stock_barang'     => $request->input('qty'),
            'total_out_stock' => 0,
            'total_in_stock'  => 0,
            'balance_stock'     => $request->input('qty'),
            'date_stock'     => $request->input('date_stock'),
            'created_at'    => date('Y-m-d'),
            'kode_kategory' => $request->input('category'),
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('stationery/atk/stocked/add')
                ->withErrors($validator)
                ->withInput();
        } else {
            stationary_stock::insert($data);
            Session::flash('message',  Lang::get('messages.data_custom', ['data' => 'Data stock stationery has been created. name: ' . $request->input('item')]));
            return Redirect::route('stationery/atk/index');
        }
    }

    public function inStocked($id)
    {
        $headline = $this->headline();

        $stocks = stationary_stock::where('id', $id)->first();

        return view('HRDLevelAcces.frontedesk.stationary.atk.intStock', compact(['stocks', 'headline']));
    }

    public function storeInStocked(Request $request, $id)
    {
        $key_param = $this->key_param();
        $category_id = stationary_stock::find($id)->value('kode_kategory');

        $rules = [
            'date_stock' => 'required|date',
            'qty'        => 'required|numeric'
        ];

        $data = [
            'kode_barang' => $request->input('code_item'),
            'category_id' => $category_id,
            'in_stock'  => $request->input('qty'),
            'date_in_stock' => $request->input('date_stock'),
            'status_transaction' => 1,
            'key_param' => $key_param,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('stationery/atk/purchase/add', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {
            Stationary_transaction::insert($data);
            Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Data in stock successfully added. Code: ' . $request->input('code_item')]));
            return Redirect::route('stationery/atk/index');
        }
    }

    public function outStocked($id)
    {
        $headline = $this->headline();
        $stocks = stationary_stock::where('id', $id)->first();
        $users = User::where('active', 1)->whereNotIn('nik', ["", 123456789])->orderBy('first_name', 'asc')->get();
        return view('HRDLevelAcces.frontedesk.stationary.atk.outStock', compact(['stocks', 'users', 'headline']));
    }

    public function storeOutStocked(Request $request, $id)
    {
        $user = $request->input('user1');
        $key_param = $this->key_param();
        $category_id = stationary_stock::find($id)->value('kode_kategory');

        if ($request->input('user')) {
            $user = User::find($request->input('user'));
            $user = $user->getFullName();
        }

        $rules = [
            'date_stock' => 'required|date',
            'qty'    => 'required|numeric|min:0',
            'describe' => 'min:3',
        ];

        $data = [
            'kode_barang' => $request->input('code_item'),
            'category_id' => $category_id,
            'out_stock'  => $request->input('qty'),
            'date_out_stock' => $request->input('date_stock'),
            'key_param'        => $key_param,
            'user_id'        => $request->input('user'),
            'employes'        => $user,
            'describe'        => $request->input('describe'),
            'status_transaction' => 2,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('stationery/atk/out/add', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {

            $stocked = stationary_stock::where('kode_barang', $request->input('code_item'))->first();

            if (empty($stocked)) {
                Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry!, Data stock code:' . $request->input('code_item') . ' cannot be found.']));
                return Redirect::route('stationery/atk/out/add', $id);
            }

            Stationary_transaction::insert($data);
            Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Data out item successfully added. Code: ' . $request->input('code_item')]));
            return Redirect::route('stationery/atk/index');
        }
    }

    public function editATK($id)
    {
        $headline = $this->headline();
        $stock = stationary_stock::where('id', $id)->first();

        return view('HRDLevelAcces.frontedesk.stationary.atk.EditStock', compact(['stock', 'headline']));
    }

    public function updateATK(Request $request, $id)
    {
        $rules = [
            'item'     => 'required',
            'brand'            => 'required',
            'uom'        => 'required',
            'code_item'            => 'required|numeric|min:0',
            'qty'   => 'required|numeric|min:0'
        ];

        $data = [
            'name_item'      => $request->input('item'),
            'satuan'         => strtolower($request->input('uom')),
            'merk'             => $request->input('brand'),
            'kode_barang'     => $request->input('code_item'),
            'stock_barang'  => $request->input('qty')
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::route('stationery/atk/edit', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {
            stationary_stock::where('id', $id)->update($data);
            Session::flash('success', Lang::get('messages.data_custom', ['data' => 'Data item stocked successfully updated. Code: ' . $request->input('code_item')]));
            return Redirect::route('stationery/atk/index');
        }
    }

    public function modalViewData($code, $date)
    {
        $transactions = Stationary_transaction::where('kode_barang', $code)->whereYear('date_out_stock', date('Y'))->whereMonth('date_out_stock', date('m'))->whereDay('date_out_stock', $date)->get();
        $water = stationary_stock::where('kode_barang', $code)->first();

        return view('HRDLevelAcces.frontedesk.stationary.atk.modalVIew', compact(['transactions', 'water', 'date']));
    }

    public function editTransaction(Request $request, $id)
    {
        $transaction = Stationary_transaction::find($id);
        $headline = $this->headline();
        $users = User::where('active', 1)->whereNotIn('nik', ["", 123456789])->get();

        return view('HRDLevelAcces.frontedesk.stationary.atk.editTransaction', compact(['transaction', 'users', 'headline']));
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
            'qty'    => 'required|numeric|min:0',
            'remark' => 'required|min:3',
        ];

        $data = [
            'out_stock'  => $request->input('qty'),
            'date_out_stock' => $request->input('date_stock'),
            'user_id'        => $ifUser,
            'employes'        => $user,
            'describe'        => $request->input('remark'),
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('stationery/atk/transaction/edit', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {

            Stationary_transaction::where('id', $id)->update($data);
            Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Data has been updated']));
            return Redirect::route('stationery/atk/index');
        }
    }

    public function deleteTransaction($id)
    {
        Stationary_transaction::find($id)->delete();
        Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Data has been deleted']));
        return Redirect::route('stationery/atk/index');
    }

    public function PDF($id, $month)
    {
        $key_param = $this->key_param();
        $headline = $this->headline();
        $receptionist = $this->receptionist();
        $category = stationary_kategori::where('key_param', $key_param)->where('unik_kategori', $id)->first();
        $stocked = stationary_stock::where('category_item', $key_param)->where('kode_kategory', $category->unik_kategori)->orderBy('kode_barang', 'asc')->get();
        set_time_limit(150); //this seconds   

        $total_stock_barang = 0;
        $out_items = [];
        $getDataForeach = [];
        $total_out_transaction = [];
        $count_out_transacntion = 0;

        $lastDay = date("t", strtotime($month));

        foreach ($stocked as $key => $stock) {
            $getTotalItemOut = Stationary_transaction::where('kode_barang', $stock->kode_barang)->where('status_transaction', 2)->where('key_param', $key_param)->whereYear('date_out_stock', '<=', date('Y', strtotime($month)))->whereMonth('date_out_stock', '<', date('m', strtotime($month)))->pluck('out_stock')->sum();

            $getStock_Barang = $stock->stock_barang - $getTotalItemOut;

            $totalOutItem = Stationary_transaction::where('kode_barang', $stock->kode_barang)->where('status_transaction', 2)->whereYear('date_out_stock', date('Y', strtotime($month)))->whereMonth('date_out_stock', date('m', strtotime($month)))->pluck('out_stock')->sum();

            $purcahse = Stationary_transaction::where('kode_barang', $stock->kode_barang)->where('status_transaction', 1)->whereYear('date_in_stock', date('Y', strtotime($month)))->whereMonth('date_in_stock', date('m', strtotime($month)))->pluck('in_stock')->sum();

            $balance = $getStock_Barang - $totalOutItem;

            $getDataForeach[] = [
                'id' => $stock->id,
                'stock_barang' => $getStock_Barang,
                'totalOutItem' => $totalOutItem,
                'balance_stock' => $balance,
                'in_purchase' => $purcahse
            ];

            $total_stock_barang += $getStock_Barang;

            for ($i = 1; $i <= $lastDay; $i++) {
                $out_Transaction = Stationary_transaction::where('key_param', $key_param)->where('kode_barang', $stock->kode_barang)->where('status_transaction', 2)->whereDate('date_out_stock', date('Y-m', strtotime($month)) . '-' . $i)->pluck('out_stock')->sum();

                $out_items[] = [
                    'id' => $stock->id,
                    'day' => $i,
                    'value' => $out_Transaction
                ];
            }
        }

        for ($i = 1; $i <= $lastDay; $i++) {
            $total_for_out_transaction = Stationary_transaction::where('key_param', $key_param)->where('status_transaction', 2)->whereDATE('date_out_stock', date('Y-m-d', strtotime($month . '-' . $i)))->pluck('out_stock')->sum();

            $total_out_transaction[] = [
                'day' => $i,
                'value' => $total_for_out_transaction
            ];

            $count_out_transacntion += $total_for_out_transaction;
        }

        $total_in_purhcase = Stationary_transaction::where('status_transaction', 1)->whereYear('date_in_stock', date('Y', strtotime($month)))->whereMonth('date_in_stock', date('m', strtotime($month)))->pluck('in_stock')->sum();

        $pdf = App::make('dompdf.wrapper');

        $pdf->loadview('HRDLevelAcces.frontedesk.stationary.atk.generatePDF', compact(['stocked', 'receptionist', 'key_param', 'category', 'month', 'getDataForeach', 'total_stock_barang', 'out_items', 'total_out_transaction', 'count_out_transacntion', 'total_in_purhcase']))
            ->setPaper('A4', 'landscape')
            ->setOptions(['dpi' => 180, 'defaultFont' => 'sans-serif']);
        $stream = $pdf->stream();
        $download = $pdf->download('stationery_stock.pdf');
        return $download;
    }

    public function Excel($id, $month)
    {
        $receptionist = $this->receptionist();
        $key_param = $this->key_param();
        $category = stationary_kategori::where('key_param', $key_param)->where('unik_kategori', $id)->first();
        $stocked = stationary_stock::where('category_item', $key_param)->where('kode_kategory', $category->unik_kategori)->orderBy('kode_barang', 'asc')->get();

        $total_stock_barang = 0;
        $out_items = [];
        $getDataForeach = [];
        $total_out_transaction = [];
        $count_out_transacntion = 0;

        $lastDay = date("t", strtotime($month));

        foreach ($stocked as $key => $stock) {
            $getTotalItemOut = Stationary_transaction::where('kode_barang', $stock->kode_barang)->where('status_transaction', 2)->where('key_param', $key_param)->whereYear('date_out_stock', date('Y', strtotime($month)))->whereMonth('date_out_stock', '<', date('m', strtotime($month)))->pluck('out_stock')->sum();

            $getStock_Barang = $stock->stock_barang - $getTotalItemOut;

            $totalOutItem = Stationary_transaction::where('kode_barang', $stock->kode_barang)->where('status_transaction', 2)->whereYear('date_out_stock', date('Y', strtotime($month)))->whereMonth('date_out_stock', date('m', strtotime($month)))->pluck('out_stock')->sum();

            $purcahse = Stationary_transaction::where('kode_barang', $stock->kode_barang)->where('status_transaction', 1)->whereYear('date_in_stock', date('Y', strtotime($month)))->whereMonth('date_in_stock', date('m', strtotime($month)))->pluck('in_stock')->sum();

            $balance = $getStock_Barang - $totalOutItem;

            $getDataForeach[] = [
                'id' => $stock->id,
                'stock_barang' => $getStock_Barang,
                'totalOutItem' => $totalOutItem,
                'balance_stock' => $balance,
                'in_purchase' => $purcahse
            ];

            $total_stock_barang += $getStock_Barang;

            for ($i = 1; $i <= $lastDay; $i++) {
                $out_Transaction = Stationary_transaction::where('key_param', $key_param)->where('kode_barang', $stock->kode_barang)->where('status_transaction', 2)->whereDate('date_out_stock', date('Y-m', strtotime($month)) . '-' . $i)->pluck('out_stock')->sum();

                $out_items[] = [
                    'id' => $stock->id,
                    'day' => $i,
                    'value' => $out_Transaction
                ];
            }
        }

        for ($i = 1; $i <= $lastDay; $i++) {
            $total_for_out_transaction = Stationary_transaction::where('key_param', $key_param)->where('status_transaction', 2)->whereDATE('date_out_stock', date('Y-m-d', strtotime($month . '-' . $i)))->pluck('out_stock')->sum();

            $total_out_transaction[] = [
                'day' => $i,
                'value' => $total_for_out_transaction
            ];

            $count_out_transacntion += $total_for_out_transaction;
        }

        $total_in_purhcase = Stationary_transaction::where('status_transaction', 1)->whereYear('date_in_stock', date('Y', strtotime($month)))->whereMonth('date_in_stock', date('m', strtotime($month)))->pluck('in_stock')->sum();

        Excel::create('Stationery', function ($excel) use ($stocked, $receptionist, $key_param, $category, $month, $getDataForeach, $total_stock_barang, $out_items, $total_out_transaction, $count_out_transacntion, $total_in_purhcase) {
            $excel->sheet('Stationery', function ($sheet) use ($stocked, $receptionist, $key_param, $category, $month, $getDataForeach, $total_stock_barang, $out_items, $total_out_transaction, $count_out_transacntion, $total_in_purhcase) {
                $sheet->setOrientation('landscape');
                $sheet->setAutoSize(true);
                $sheet->loadView('HRDLevelAcces.frontedesk.stationary.atk.excel', compact('stocked', 'receptionist', 'key_param', 'category', 'month', 'getDataForeach', 'total_stock_barang', 'out_items', 'total_out_transaction', 'count_out_transacntion', 'total_in_purhcase'));
                $sheet->setScale(55);
            });
        })->download('xlsx');

        return redirect()->back();
    }

    public function modalCategory($id, $month)
    {
        $category = stationary_kategori::find($id);

        return view('HRDLevelAcces.frontedesk.stationary.atk.modalViewCategory', compact(['category', 'month']));
    }

    public function updateCategory(Request $request, $id)
    {
        $rules = [
            'category' => ["required"]
        ];

        $data = [
            'kategori_stock' => $request->input('category')
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('stationery/atk/index')->withErrors($validator)->withInput();
        } else {
            stationary_kategori::where('id', $id)->update($data);
            Session::flash('success', Lang::get('messages.data_custom', ['data' => 'Name category has been updated']));
            return Redirect::route('stationery/atk/index');
        }
    }

    public function indexViewDetailTransaction($code, $month)
    {
        return view('HRDLevelAcces.frontedesk.stationary.atk.viewDateTransaction', compact(['code', 'month']));
    }

    public function dataViewDetailTransaction($code, $month)
    {
        $key_param = $this->key_param();

        $query = Stationary_transaction::where('category_id', $code)->where('key_param', $key_param)->where('status_transaction', 2)->whereMonth('date_out_stock', date('m', strtotime($month)))->whereYear('date_out_stock', date('Y', strtotime($month)))->orderBy('date_out_stock', 'asc')->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('item', function (Stationary_transaction $trans) {
                return $trans->getStock()->name_item;
            })
            ->addColumn('uom', function (Stationary_transaction $trans) {
                return $trans->getStock()->satuan;
            })
            ->addColumn('brand', function (Stationary_transaction $trans) {
                return $trans->getStock()->merk;
            })
            ->make(true);
    }
}