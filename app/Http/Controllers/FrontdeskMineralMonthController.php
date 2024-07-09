<?php

namespace App\Http\Controllers;

use App\stationary_kategori;
use App\stationary_stock;
use App\Stationary_transaction;
use App\Stationery_Mineral_Purchase;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FrontdeskMineralMonthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    private function headline()
    {
        $return = new FrontdeskMineralController;
        $return = $return->headline();

        return $return;
    }

    private function key_param()
    {
        $return = new FrontdeskMineralController;
        $return = $return->key_param();

        return $return;
    }

    private function receptionist()
    {
        $return = new FrontdeskMineralController;
        $return = $return->receptionist();

        return $return;
    }

    private function price_format($id)
    {
        $return = new FrontdeskMineralController;
        $return = $return->price_format($id);

        return $return;
    }

    public function index($month)
    {
        $headline = $this->headline();

        $key_param = $this->key_param();

        $waters = stationary_stock::where('category_item', 2)->orderBy('kode_barang', 'asc')->get();

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

        return view('HRDLevelAcces.frontedesk.stationary.find.mineral.index', compact(['waters', 'headline', 'key_param', 'previous', 'next', 'month', 'lastDay', 'array_out_waters', 'array_waters', 'totalStocked', 'array_tfoot_out', 'total_tfoot']));
    }

    public function addStock($month)
    {
        $headline = $this->headline();
        $categories = stationary_kategori::where('key_param', 2)->orderBy('kategori_stock', 'asc')->get();

        return view('HRDLevelAcces.frontedesk.stationary.find.mineral.addStock', compact(['categories', 'headline', 'month']));
    }

    public function storeStock(Request $request, $month)
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
            'name_item'      => title_case($request->input('item')),
            'category_item'  => $request->input('key_param'),
            'satuan'         => strtolower($request->input('uom')),
            'merk'             => title_case($request->input('brand')),
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
            return Redirect::route('stationery/mineral/find/add', $month)
                ->withErrors($validator)
                ->withInput();
        } else {
            stationary_stock::insert($data);
            Session::flash('message',  Lang::get('messages.data_custom', ['data' => 'Data stock stationery has been created. item: ' . $request->input('item')]));
            return Redirect::route('stationery/mineral/find/index', $month);
        }
    }

    public function inStocked($id, $month)
    {
        $headline = $this->headline();

        $stocks = stationary_stock::where('id', $id)->first();

        return view('HRDLevelAcces.frontedesk.stationary.find.mineral.intStock', compact(['stocks', 'headline', 'month']));
    }

    public function storeInStocked(Request $request, $id, $month)
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
            return Redirect::route('stationery/mineral/find/in', [$id, $month])
                ->withErrors($validator)
                ->withInput();
        } else {
            Stationary_transaction::insert($data);
            Stationery_Mineral_Purchase::create($purchase);
            stationary_stock::where('kode_barang', $data['kode_barang'])->update($stock);
            Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Data in stock successfully added. Code: ' . $request->input('code_item')]));
            return Redirect::route('stationery/mineral/find/index', $month);
        }
    }

    public function outStocked($id, $month)
    {
        $headline = $this->headline();
        $stocks = stationary_stock::where('id', $id)->first();
        $users = User::where('active', 1)->whereNotIn('nik', ["", 123456789])->orderBy('first_name', 'asc')->get();

        $price = $this->price_format($stocks->price);

        return view('HRDLevelAcces.frontedesk.stationary.find.mineral.outStock', compact(['stocks', 'users', 'headline', 'price', 'month']));
    }

    public function storeOutStocked(Request $request, $id, $month)
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
            return Redirect::route('stationery/mineral/find/out', [$id, $month])
                ->withErrors($validator)
                ->withInput();
        } else {

            $stocked = stationary_stock::where('kode_barang', $request->input('code_item'))->first();

            if (empty($stocked)) {
                Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry!!, Data stock code:' . $request->input('code_item') . ' cannot be found.']));
                return Redirect::route('stationery/mineral/find/out', [$id, $month]);
            }

            Stationary_transaction::insert($data);
            Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Data out item successfully added. Code: ' . $request->input('code_item')]));
            return Redirect::route('stationery/mineral/find/index', $month);
        }
    }
}