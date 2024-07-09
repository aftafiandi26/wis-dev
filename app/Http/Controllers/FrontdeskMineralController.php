<?php

namespace App\Http\Controllers;

use App\stationary_kategori;
use App\stationary_stock;
use App\Stationary_transaction;
use App\Stationery_Mineral_Purchase;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class FrontdeskMineralController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function headline()
    {
        return "(hr) Mineral Water";
    }

    public function key_param()
    {
        return 2;
    }

    public function receptionist()
    {
        return "Dhea Karina Putri";
    }

    public function price_format($id)
    {
        return  number_format($id, 0, ',', '.');
    }

    public function index()
    {
        $headline = $this->headline();

        $key_param = $this->key_param();

        $waters = stationary_stock::where('category_item', 2)->orderBy('kode_barang', 'asc')->get();

        $previous = date('F', strtotime('previous month'));
        $next = date('F', strtotime('next month'));
        $month = date('Y-m');
        $lastDay = date('t');

        $array_out_waters = [];
        $array_waters = [];
        $array_tfoot_waters = [];

        $array_tfoot_out = [];

        foreach ($waters as $value) {
            for ($i = 1; $i <= $lastDay; $i++) {
                $out_water_count = Stationary_transaction::where('key_param', $key_param)->where('kode_barang', $value->kode_barang)->where('status_transaction', 2)->whereDATE('date_out_stock', $month . '-' . $i)->pluck('out_stock')->sum();

                $array_out_waters[] = [
                    'id' => $value->id,
                    'day' => $i,
                    'value' => $out_water_count,
                ];
            }

            $in_water_count = Stationary_transaction::where('kode_barang', $value->kode_barang)->where('status_transaction', 1)->whereYear('date_in_stock', date('Y', strtotime($month)))->whereMonth('date_in_stock', date('m', strtotime($month)))->pluck('in_stock')->sum();

            $total_out = Stationary_transaction::where('key_param', $key_param)->where('kode_barang', $value->kode_barang)->where('status_transaction', 2)->whereYear('date_out_stock', date('Y', strtotime($month)))->whereMonth('date_out_stock', date('m', strtotime($month)))->pluck('out_stock')->sum();

            $getStoacked = Stationary_transaction::where('key_param', $key_param)->where('kode_barang', $value->kode_barang)->where('status_transaction', 2)->whereYear('date_out_stock', '<=', date('Y', strtotime($month)))->whereMonth('date_out_stock', '<', date('m', strtotime($month)))->pluck('out_stock')->sum();

            $stocked = $value->stock_barang - $getStoacked;
            $balance_stock = $stocked - $total_out;

            if ($stocked < 0) {
                $stocked = "Err!!";
                $balance_stock = "Err!!";
            }

            $array_waters[] = [
                'id' => $value->id,
                'in_count' => $in_water_count,
                'out_count' => $total_out,
                'stocked'   => $stocked,
                'balance' => $balance_stock,
            ];
        }

        $totalStocked = array_reduce($array_waters, function ($carry, $item) {
            return $carry + $item["stocked"];
        }, 0);

        $total_tfoot_out = array_reduce($array_waters, function ($carry, $item) {
            return $carry + $item["out_count"];
        }, 0);

        $total_tfoot_in = array_reduce($array_waters, function ($carry, $item) {
            return $carry + $item["in_count"];
        }, 0);

        $total_tfoot_balance = array_reduce($array_waters, function ($carry, $item) {
            return $carry + $item["balance"];
        }, 0);

        $total_tfoot = [
            'totalStocked' => $totalStocked,
            'total_tfoot_out' => $total_tfoot_out,
            'total_tfoot_in' => $total_tfoot_in,
            'total_tfoot_balance' => $total_tfoot_balance
        ];

        for ($i = 1; $i <= $lastDay; $i++) {
            $total_out_water_count = Stationary_transaction::where('key_param', $key_param)->where('status_transaction', 2)->whereDATE('date_out_stock', $month . '-' . $i)->pluck('out_stock')->sum();

            $array_tfoot_out[] = [
                'day' => $i,
                'value' => $total_out_water_count
            ];
        }

        return view('HRDLevelAcces.frontedesk.stationary.mineral.index', compact(['waters', 'headline', 'key_param', 'previous', 'next', 'month', 'lastDay', 'array_out_waters', 'array_waters', 'totalStocked', 'array_tfoot_out', 'total_tfoot']));
    }

    public function addStock()
    {
        $headline = $this->headline();
        $categories = stationary_kategori::where('key_param', 2)->orderBy('kategori_stock', 'asc')->get();

        return view('HRDLevelAcces.frontedesk.stationary.mineral.addStock', compact(['categories', 'headline']));
    }

    public function storeStock(Request $request)
    {
        $rules = [
            'uom'        => 'required|string',
            'date_stock'    => 'required|date',
            'qty'           => 'required|numeric',
            'category'        => 'required|numeric',
            'code_item'    => 'required|numeric',
            'price'    => 'required|numeric'
        ];

        $variableCategory = $request->input('category') . $request->input('code_item');
        $findCategory = stationary_stock::where('kode_barang', $variableCategory)->first();

        if ($findCategory) {
            Session::flash('getError',  Lang::get('messages.data_custom', ['data' => 'Sorry!!, code item:' . $request->input('code_item') . ' has been created.']));
            return Redirect::route('stationery/mineral/add');
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
            'price'     => $request->input('price')
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('stationery/mineral/add')
                ->withErrors($validator)
                ->withInput();
        } else {
            stationary_stock::insert($data);
            Session::flash('message',  Lang::get('messages.data_custom', ['data' => 'Data stock stationery has been created. item: ' . $request->input('item')]));
            return Redirect::route('stationery/mineral/index');
        }
    }

    public function inStocked($id)
    {
        $headline = $this->headline();

        $stocks = stationary_stock::where('id', $id)->first();

        return view('HRDLevelAcces.frontedesk.stationary.mineral.intStock', compact(['stocks', 'headline']));
    }

    public function storeInStocked(Request $request, $id)
    {
        $rules = [
            'date_stock'   => 'required|date',
            'qty'          => 'required|numeric',
            'box'          => 'required|numeric',
            'pcs'          => 'required|numeric',
            'priceBox'     => 'required|numeric',
            'pricePcs'     => 'required|numeric',
            'priceTotal'   => 'required|numeric',
            'pr-1'         => 'required|numeric',
            'pr-4'         => 'required|string',
            'pr-5'         => 'required|numeric'
        ];

        $pr = $request->input('pr-1') . "/PR/HR-KSM/" . Str::upper($request->input('pr-4')) . "/" . $request->input('pr-5');

        $data = [
            'kode_barang' => $request->input('code_item'),
            'in_stock'  => $request->input('qty'),
            'date_in_stock' => $request->input('date_stock'),
            'status_transaction' => 1,
            'key_param' => $this->key_param(),
            'describe' => $pr,
        ];

        $purchase = [
            'kode_barang'   => $data['kode_barang'],
            'key_param'     => $data['key_param'],
            'pr'            => $pr,
            'qty_box'       => $request->input('box'),
            'qty_pcs'       => $request->input('pcs'),
            'qty_total'     => $data['in_stock'],
            'price_box'      => $request->input('priceBox'),
            'price_pcs'      => $request->input('pricePcs'),
            'price_total'    => $request->input('priceTotal'),
            'date'          => $data['date_in_stock'],
            'remarks'       => $request->input('remark'),
        ];

        $stock = [
            'price' => $purchase['price_pcs']
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('stationery/mineral/purcahse/add', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {
            Stationary_transaction::insert($data);
            Stationery_Mineral_Purchase::create($purchase);
            stationary_stock::where('kode_barang', $data['kode_barang'])->update($stock);
            Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Data in stock successfully added. Code: ' . $request->input('code_item')]));
            return Redirect::route('stationery/mineral/index');
        }
    }

    public function outStocked($id)
    {
        $headline = $this->headline();
        $stocks = stationary_stock::where('id', $id)->first();
        $users = User::where('active', 1)->whereNotIn('nik', ["", 123456789])->orderBy('first_name', 'asc')->get();

        $price = $this->price_format($stocks->price);

        return view('HRDLevelAcces.frontedesk.stationary.mineral.outStock', compact(['stocks', 'users', 'headline', 'price']));
    }

    public function storeOutStocked(Request $request, $id)
    {
        $user = $request->input('user1');
        $code = $request->input('code_item');

        $stock = stationary_stock::where('kode_barang', $code)->first();

        if ($request->input('qty') > $stock->balance_stock) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry!!, not enough stock!!!']));
            return Redirect::route('stationery/mineral/out/add', $id);
        }

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
            'out_stock'  => $request->input('qty'),
            'date_out_stock' => $request->input('date_stock'),
            'key_param'        => $this->key_param(),
            'user_id'        => $request->input('user'),
            'employes'        => $user,
            'describe'        => $request->input('describe'),
            'status_transaction' => 2,
            'price'     => $stock->price,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('stationery/mineral/out/add', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {

            $stocked = stationary_stock::where('kode_barang', $request->input('code_item'))->first();

            if (empty($stocked)) {
                Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry!!, Data stock code:' . $request->input('code_item') . ' cannot be found.']));
                return Redirect::route('stationery/mineral/out/add', $id);
            }

            Stationary_transaction::insert($data);
            Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Data out item successfully added. Code: ' . $request->input('code_item')]));
            return Redirect::route('stationery/mineral/index');
        }
    }

    public function editMineral($id)
    {
        $headline = $this->headline();
        $stock = stationary_stock::where('id', $id)->first();

        return view('HRDLevelAcces.frontedesk.stationary.mineral.EditStock', compact(['stock', 'headline']));
    }

    public function updateMineral(Request $request, $id)
    {
        $rules = [
            'item'     => 'required',
            'brand'            => 'required',
            'uom'        => 'required',
            'code_item'            => 'required|numeric|min:0',
        ];

        $data = [
            'name_item'      => $request->input('item'),
            'satuan'         => strtolower($request->input('uom')),
            'merk'             => $request->input('brand'),
            'kode_barang'     => $request->input('code_item'),
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::route('stationery/mineral/edit', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {
            stationary_stock::where('id', $id)->update($data);
            Session::flash('success', Lang::get('messages.data_custom', ['data' => 'Data item stocked successfully updated. Code: ' . $request->input('code_item')]));
            return Redirect::route('stationery/mineral/index');
        }
    }

    public function modalViewData($code, $date)
    {
        $transactions = Stationary_transaction::where('kode_barang', $code)->whereDATE('date_out_stock', date('Y-m-d', strtotime($date)))->get();
        $water = stationary_stock::where('kode_barang', $code)->first();

        return view('HRDLevelAcces.frontedesk.stationary.mineral.modalVIew', compact(['transactions', 'water', 'date']));
    }

    public function editTransaction(Request $request, $id)
    {
        $transaction = Stationary_transaction::find($id);
        $headline = $this->headline();
        $users = User::where('active', 1)->whereNotIn('nik', ["", 123456789])->get();

        return view('HRDLevelAcces.frontedesk.stationary.mineral.editTransaction', compact(['transaction', 'users', 'headline']));
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
            return Redirect::route('stationery/mineral/transaction/edit', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {

            Stationary_transaction::where('id', $id)->update($data);
            Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Data has been updated']));
            return Redirect::route('stationery/mineral/index');
        }
    }

    public function deleteTransaction($id)
    {
        Stationary_transaction::find($id)->delete();
        Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Data has been deleted']));
        return Redirect::route('stationery/mineral/index');
    }

    public function PDF($month)
    {
        $key_param = $this->key_param();
        $headline = $this->headline();
        $receptionist = $this->receptionist();
        $waters = stationary_stock::where('category_item', $key_param)->orderBy('kode_barang', 'asc')->get();

        $previous = date('F', strtotime('previous month', strtotime($month)));
        $next = date('F', strtotime('next month', strtotime($month)));
        $lastDay = date('t', strtotime($month));

        $array_out_waters = [];
        $array_waters = [];
        $array_tfoot_waters = [];

        $array_tfoot_out = [];

        foreach ($waters as $value) {
            for ($i = 1; $i <= $lastDay; $i++) {
                $out_water_count = Stationary_transaction::where('key_param', $key_param)->where('kode_barang', $value->kode_barang)->where('status_transaction', 2)->whereDATE('date_out_stock', $month . '-' . $i)->pluck('out_stock')->sum();

                $array_out_waters[] = [
                    'id' => $value->id,
                    'day' => $i,
                    'value' => $out_water_count,
                ];
            }

            $in_water_count = Stationary_transaction::where('kode_barang', $value->kode_barang)->where('status_transaction', 1)->whereYear('date_in_stock', date('Y', strtotime($month)))->whereMonth('date_in_stock', date('m', strtotime($month)))->pluck('in_stock')->sum();

            $total_out = Stationary_transaction::where('key_param', $key_param)->where('kode_barang', $value->kode_barang)->where('status_transaction', 2)->whereYear('date_out_stock', date('Y', strtotime($month)))->whereMonth('date_out_stock', date('m', strtotime($month)))->pluck('out_stock')->sum();

            $getStoacked = Stationary_transaction::where('key_param', $key_param)->where('kode_barang', $value->kode_barang)->where('status_transaction', 2)->whereYear('date_out_stock', '<=', date('Y', strtotime($month)))->whereMonth('date_out_stock', '<', date('m', strtotime($month)))->pluck('out_stock')->sum();

            $stocked = $value->stock_barang - $getStoacked;
            $balance_stock = $stocked - $total_out;

            if ($stocked < 0) {
                $stocked = "Err!!";
                $balance_stock = "Err!!";
            }

            $array_waters[] = [
                'id' => $value->id,
                'in_count' => $in_water_count,
                'out_count' => $total_out,
                'stocked'   => $stocked,
                'balance' => $balance_stock,
            ];
        }

        $totalStocked = array_reduce($array_waters, function ($carry, $item) {
            return $carry + $item["stocked"];
        }, 0);

        $total_tfoot_out = array_reduce($array_waters, function ($carry, $item) {
            return $carry + $item["out_count"];
        }, 0);

        $total_tfoot_in = array_reduce($array_waters, function ($carry, $item) {
            return $carry + $item["in_count"];
        }, 0);

        $total_tfoot_balance = array_reduce($array_waters, function ($carry, $item) {
            return $carry + $item["balance"];
        }, 0);

        $total_tfoot = [
            'totalStocked' => $totalStocked,
            'total_tfoot_out' => $total_tfoot_out,
            'total_tfoot_in' => $total_tfoot_in,
            'total_tfoot_balance' => $total_tfoot_balance
        ];

        for ($i = 1; $i <= $lastDay; $i++) {
            $total_out_water_count = Stationary_transaction::where('key_param', $key_param)->where('status_transaction', 2)->whereDATE('date_out_stock', $month . '-' . $i)->pluck('out_stock')->sum();

            $array_tfoot_out[] = [
                'day' => $i,
                'value' => $total_out_water_count
            ];
        }

        $pdf = App::make('dompdf.wrapper');

        $pdf->loadview('HRDLevelAcces.frontedesk.stationary.mineral.generatePDF', compact([
            'waters', 'receptionist', 'headline', 'key_param', 'previous', 'next', 'lastDay', 'month', 'array_out_waters', 'array_waters', 'totalStocked', 'array_tfoot_out', 'total_tfoot'
        ]))
            ->setPaper('A4', 'landscape')
            ->setOptions(['dpi' => 180, 'defaultFont' => 'sans-serif']);

        $download = $pdf->download('stationery_stock.pdf');
        return $download;
    }

    public function Excel($month)
    {
        $receptionist = $this->receptionist();
        $key_param = $this->key_param();
        $waters = stationary_stock::where('category_item', $key_param)->orderBy('kode_barang', 'asc')->get();

        $previous = date('F', strtotime('previous month', strtotime($month)));
        $next = date('F', strtotime('next month', strtotime($month)));
        $lastDay = date('t', strtotime($month));

        $array_out_waters = [];
        $array_waters = [];
        $array_tfoot_waters = [];

        $array_tfoot_out = [];

        foreach ($waters as $value) {
            for ($i = 1; $i <= $lastDay; $i++) {
                $out_water_count = Stationary_transaction::where('key_param', $key_param)->where('kode_barang', $value->kode_barang)->where('status_transaction', 2)->whereDATE('date_out_stock', $month . '-' . $i)->pluck('out_stock')->sum();

                $array_out_waters[] = [
                    'id' => $value->id,
                    'day' => $i,
                    'value' => $out_water_count,
                ];
            }

            $in_water_count = Stationary_transaction::where('kode_barang', $value->kode_barang)->where('status_transaction', 1)->whereYear('date_in_stock', date('Y', strtotime($month)))->whereMonth('date_in_stock', date('m', strtotime($month)))->pluck('in_stock')->sum();

            $total_out = Stationary_transaction::where('key_param', $key_param)->where('kode_barang', $value->kode_barang)->where('status_transaction', 2)->whereYear('date_out_stock', date('Y', strtotime($month)))->whereMonth('date_out_stock', date('m', strtotime($month)))->pluck('out_stock')->sum();

            $getStoacked = Stationary_transaction::where('key_param', $key_param)->where('kode_barang', $value->kode_barang)->where('status_transaction', 2)->whereYear('date_out_stock', '<=', date('Y', strtotime($month)))->whereMonth('date_out_stock', '<', date('m', strtotime($month)))->pluck('out_stock')->sum();

            $stocked = $value->stock_barang - $getStoacked;
            $balance_stock = $stocked - $total_out;

            if ($stocked < 0) {
                $stocked = "Err!!";
                $balance_stock = "Err!!";
            }

            $array_waters[] = [
                'id' => $value->id,
                'in_count' => $in_water_count,
                'out_count' => $total_out,
                'stocked'   => $stocked,
                'balance' => $balance_stock,
            ];
        }

        $totalStocked = array_reduce($array_waters, function ($carry, $item) {
            return $carry + $item["stocked"];
        }, 0);

        $total_tfoot_out = array_reduce($array_waters, function ($carry, $item) {
            return $carry + $item["out_count"];
        }, 0);

        $total_tfoot_in = array_reduce($array_waters, function ($carry, $item) {
            return $carry + $item["in_count"];
        }, 0);

        $total_tfoot_balance = array_reduce($array_waters, function ($carry, $item) {
            return $carry + $item["balance"];
        }, 0);

        $total_tfoot = [
            'totalStocked' => $totalStocked,
            'total_tfoot_out' => $total_tfoot_out,
            'total_tfoot_in' => $total_tfoot_in,
            'total_tfoot_balance' => $total_tfoot_balance
        ];

        for ($i = 1; $i <= $lastDay; $i++) {
            $total_out_water_count = Stationary_transaction::where('key_param', $key_param)->where('status_transaction', 2)->whereDATE('date_out_stock', $month . '-' . $i)->pluck('out_stock')->sum();

            $array_tfoot_out[] = [
                'day' => $i,
                'value' => $total_out_water_count
            ];
        }

        Excel::create('MIneral Stock', function ($excel) use ($waters, $receptionist, $key_param, $month, $previous, $next, $lastDay, $array_out_waters, $array_waters, $totalStocked, $array_tfoot_out, $total_tfoot) {
            $excel->sheet('mineral', function ($sheet) use ($waters, $receptionist, $key_param, $month, $previous, $next, $lastDay, $array_out_waters, $array_waters, $totalStocked, $array_tfoot_out, $total_tfoot) {

                $sheet->setOrientation('landscape');
                $sheet->setAutoSize(true);
                $sheet->loadView('HRDLevelAcces.frontedesk.stationary.mineral.excel', compact([
                    'waters', 'receptionist', 'key_param', 'month', 'previous', 'next', 'lastDay', 'array_out_waters', 'array_waters', 'totalStocked', 'array_tfoot_out', 'total_tfoot'
                ]));
                $sheet->setScale(55);
            });
        })->download('xlsx');

        return redirect()->back();
    }
}