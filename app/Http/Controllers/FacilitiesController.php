<?php

namespace App\Http\Controllers;


use App;
use App\Dept_Category;
use App\Http\Controllers\Controller;
use App\Bus_Transportation;
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
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\TransportaionMail;

class FacilitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'FacilitesCoordinator']);
    }

    public function indexTransportationBUS()
    {
        $tgl_besar = Bus_Transportation::orderBY('date_booking', 'desc')->first();
        $tgl_kecil = Bus_Transportation::orderBY('date_booking', 'asc')->first(); 
      
        $getDormitory = Bus_Transportation::orderBY('date_booking', 'desc')->whereBetween('date_booking', [$tgl_kecil->date_booking, $tgl_besar->date_booking])->get();

    	return view('Facilites.Transportation.Bus.index', ['getDormitory' => $getDormitory, 'tgl_besar' => $tgl_besar, 'tgl_kecil' => $tgl_kecil]);
    }

    public function getINdexTransaction()
    {
    	$select = Bus_Transportation::JoinDeptCategory()->select(['bus_transportation.id', 'bus_transportation.nik', 'bus_transportation.name_employee', 'dept_category.dept_category_name','bus_transportation.date_booking', 'bus_transportation.time_booking', 'bus_transportation.destination', 'bus_transportation.created_at','bus_transportation.lockey'])
        ->where('bus_transportation.key_transportation', 1)
        ->orderBY('bus_transportation.date_booking', 'desc')
		->get();
	  
		return Datatables::of($select)
        ->edit_column('lockey', '@if($lockey === 1){{"Locked"}} @else {{"Unlocked"}} @endif')
      ->add_column('actions',
            '@if ($lockey === 1)'.
            Lang::get('messages.btn_unlocked', ['title' => 'Unlocked {{$name_employee}}', 'url' => '{{ URL::route(\'UnlockedBus\', [$id]) }}', 'class' => 'check-square'])
            .'@elseif ($lockey === 0)'.
              Lang::get('messages.btn_locked', ['title' => 'Locked {{$name_employee}}', 'url' => '{{ URL::route(\'lockedBus\', [$id]) }}', 'class' => 'check-square'])
            .'@endif'
            )
		->make();    
    }

    public function getINdexTransaction1()
    {
        $select = Bus_Transportation::JoinDeptCategory()->select(['bus_transportation.id', 'bus_transportation.nik', 'bus_transportation.name_employee', 'dept_category.dept_category_name','bus_transportation.date_booking', 'bus_transportation.time_booking', 'bus_transportation.destination', 'bus_transportation.created_at', 'bus_transportation.lockey'])
        ->where('key_transportation', 2)
        ->orderBY('bus_transportation.date_booking', 'desc')
        ->get();
      
        return Datatables::of($select)
        ->edit_column('lockey', '@if($lockey === 1){{"Locked"}} @else {{"Unlocked"}} @endif')
      ->add_column('actions',
            '@if ($lockey === 1)'.
            Lang::get('messages.btn_unlocked', ['title' => 'Unlocked {{$name_employee}}', 'url' => '{{ URL::route(\'UnlockedBus\', [$id]) }}', 'class' => 'check-square'])
            .'@elseif ($lockey === 0)'.
              Lang::get('messages.btn_locked', ['title' => 'Locked {{$name_employee}}', 'url' => '{{ URL::route(\'lockedBus\', [$id]) }}', 'class' => 'check-square'])
            .'@endif'
            )
        ->make();   
    }

    public function UnlockedBus($id)
    {
        Bus_Transportation::where('id', $id)->update([
            'lockey' => 0,
        ]);
        return Redirect::back();

    }

    public function lockedBus($id)
    {
        Bus_Transportation::where('id', $id)->update([
            'lockey' => 1,
        ]);
        return Redirect::back();

    }  

    public function locked_Transportations(Request $request)
    {
        $coba = $request->input('selectdeparture');
        $tanggal = $request->input('dated');

        $data = [
            'lockey' => 1,
        ];   
        Bus_Transportation::where('lockey', 0)->where('key_transportation', $coba)->whereDate('date_booking', $tanggal)->update($data);
        Session::flash('message', Lang::get('messages.process_success', ['act' => 'Lock Data']));
        return Redirect::route('indexTransportationBUS');
    }

    public function sendEmailTransportation(Request $request)
    {   
        Mail::send(new TransportaionMail());

        return Redirect::route('indexTransportationBUS');
    }

    public function ExcelTransportation(Request $request)
    {  
         $dated = $request->input('date');
         $datedd = $request->input('dateet');
         $key   = $request->input('destination');
       
       Excel::create('Booking Transportation', function($excel) use($dated, $key, $datedd) {

            $excel->sheet('Sheetname', function($sheet) use($dated, $key, $datedd) {
                $sheet->loadView('Facilites.Transportation.Bus.ExcelTransportation', [
                    'dated' => $dated,
                    'key'   => $key,
                    'datedd' => $datedd,
                ]);
            });

        })->export('xls');
    }

    public function GenerateExcelTransportasi(Request $request)
    {
        $start = $request->input('start');
         $end = $request->input('end');
         $key   = $request->input('destination');

         $getData = Bus_Transportation::whereBetween('date_booking', [$start, $end])->where('lockey', 1)->where('key_transportation', 1)->orderBY('date_booking', 'asc')->get();

         $getData1 = Bus_Transportation::whereBetween('date_booking', [$start, $end])->where('lockey', 1)->where('key_transportation', 2)->orderBY('date_booking', 'asc')->get();
       
       Excel::create('List Name Transportation', function($excel) use($getData, $getData1) {

            $excel->sheet('First sheet', function($sheet) use($getData) {

                $sheet->loadView('Facilites.Transportation.Bus.GenereteExcel', [
                    'getData' => $getData, 
                ]);
            });

            $excel->sheet('Second sheet', function($sheet) use($getData1) {

                $sheet->loadView('Facilites.Transportation.Bus.GenereteExcel1', [
                    'getData' => $getData1, 
                ]);
            });

        })->export('xls');
    }

    public function searchListTransportation(Request $request)
    {
        $start_date = $request->input('start');
        $end_date   = $request->input('end');
        $destination = $request->input('destination');
        $no = 1;

        $getData = Bus_Transportation::whereBetween('date_booking', [$start_date, $end_date])->where('lockey', 1)->where('key_transportation', $destination)->get();

        return view::make('Facilites.Transportation.Bus.searchlist', [
            'getData'       => $getData,
            'destination'   => $destination,
            'start_date'    => $start_date,
            'end_date'      => $end_date,
            'no'            => $no
        ]);
    }
}
