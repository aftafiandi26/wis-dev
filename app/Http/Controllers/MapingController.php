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
use App\Ws_Map;
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
use SimpleSoftwareIO\QrCode; 


class MapingController extends Controller
{    
       public function __construct()
    {
        $this->middleware(['auth', 'active' ]);
        
    }  
    
    public function indexMAPOfficer2()
	{
		$animasii = WS_MAP::where('area', 'Officer')->get();

		$Officer_380 = Ws_Map::select('*')->where('no_seat', 380)->where('area', '=', 'Officer')->first();
		$Officer_381 = Ws_Map::select('*')->where('no_seat', 381)->where('area', '=', 'Officer')->first();
		$Officer_382 = Ws_Map::select('*')->where('no_seat', 382)->where('area', '=', 'Officer')->first();
		$Officer_383 = Ws_Map::select('*')->where('no_seat', 383)->where('area', '=', 'Officer')->first();
		$Officer_384 = Ws_Map::select('*')->where('no_seat', 384)->where('area', '=', 'Officer')->first();
		$Officer_385 = Ws_Map::select('*')->where('no_seat', 385)->where('area', '=', 'Officer')->first();
		$Officer_386 = Ws_Map::select('*')->where('no_seat', 386)->where('area', '=', 'Officer')->first();
		$Officer_387 = Ws_Map::select('*')->where('no_seat', 387)->where('area', '=', 'Officer')->first();
		$Officer_388 = Ws_Map::select('*')->where('no_seat', 388)->where('area', '=', 'Officer')->first();
		$Officer_389 = Ws_Map::select('*')->where('no_seat', 389)->where('area', '=', 'Officer')->first();
		$Officer_390 = Ws_Map::select('*')->where('no_seat', 390)->where('area', '=', 'Officer')->first();
		$Officer_391 = Ws_Map::select('*')->where('no_seat', 391)->where('area', '=', 'Officer')->first();
		$Officer_392 = Ws_Map::select('*')->where('no_seat', 392)->where('area', '=', 'Officer')->first();
		$Officer_393 = Ws_Map::select('*')->where('no_seat', 393)->where('area', '=', 'Officer')->first();
		$Officer_394 = Ws_Map::select('*')->where('no_seat', 394)->where('area', '=', 'Officer')->first();
		$Officer_395 = Ws_Map::select('*')->where('no_seat', 395)->where('area', '=', 'Officer')->first();

		$mobile_24 = Asseting_IT::select('*')->where('ifw_code', 'like', '%'.$Officer_380->workstation.'%')->first();

		return View::make('IT.WS_MAP.Officer.index_officer', [
			'animasii' 			=> $animasii,
			'Officer_380' => $Officer_380,
			'Officer_381' => $Officer_381,
			'Officer_382' => $Officer_382,
			'Officer_383' => $Officer_383,
			'Officer_384' => $Officer_384,
			'Officer_385' => $Officer_385,
			'Officer_386' => $Officer_386,
			'Officer_387' => $Officer_387,
			'Officer_388' => $Officer_388,
			'Officer_389' => $Officer_389,
			'Officer_390' => $Officer_390,
			'Officer_391' => $Officer_391,
			'Officer_392' => $Officer_392,
			'Officer_393' => $Officer_393,
			'Officer_394' => $Officer_394,
			'Officer_395' => $Officer_395,
			'mobile_24'			=> $mobile_24,
		]);
	}

	public function loadHTMLOfficer2()
	{
		$Officer_380 = Ws_Map::select('*')->where('no_seat', 380)->where('area', '=', 'Officer')->first();
		$Officer_381 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 381)->where('area', '=', 'Officer')->first();
		$Officer_382 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 382)->where('area', '=', 'Officer')->first();
		$Officer_383 = Ws_Map::select('*')->where('no_seat', 383)->where('area', '=', 'Officer')->first();
		$Officer_384 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 384)->where('area', '=', 'Officer')->first();
		$Officer_385 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 385)->where('area', '=', 'Officer')->first();
		$Officer_386 = Ws_Map::select('*')->where('no_seat', 386)->where('area', '=', 'Officer')->first();
		$Officer_387 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 387)->where('area', '=', 'Officer')->first();
		$Officer_388 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 388)->where('area', '=', 'Officer')->first();
		$Officer_389 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 389)->where('area', '=', 'Officer')->first();
		$Officer_390 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 390)->where('area', '=', 'Officer')->first();
		$Officer_391 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 391)->where('area', '=', 'Officer')->first();
		$Officer_392 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 392)->where('area', '=', 'Officer')->first();
		$Officer_393 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 393)->where('area', '=', 'Officer')->first();
		$Officer_394 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 394)->where('area', '=', 'Officer')->first();
		$Officer_395 = Ws_Map::JoinWs_Availability()->select('*')->where('no_seat', 395)->where('area', '=', 'Officer')->first();

		$pdf = App::make('dompdf.wrapper'); ini_set("memory_limit", '512M');		
		$pdf->loadview('IT.WS_MAP.Officer.print', [		
				'Officer_380' => $Officer_380,
				'Officer_381' => $Officer_381,				
				'Officer_382' => $Officer_382,
				'Officer_383' => $Officer_383,
				'Officer_384' => $Officer_384,
				'Officer_385' => $Officer_385,
				'Officer_386' => $Officer_386,
				'Officer_387' => $Officer_387,
				'Officer_388' => $Officer_388,
				'Officer_389' => $Officer_389,
				'Officer_390' => $Officer_390,
				'Officer_391' => $Officer_391,
				'Officer_392' => $Officer_392,
				'Officer_393' => $Officer_393,
				'Officer_394' => $Officer_394,
				'Officer_395' => $Officer_395,
		])        
		->setPaper('A3', 'landscape')
		->setOptions(['dpi' => 140, 'defaultFont' => 'sans-serif']);    
		return $pdf->stream(); 
	}

	public function indexITMap()
	{		
		//lakukan parsing data ke html
			$IT_396 = Ws_Map::select('*')->where('no_seat', 396)->where('area', '=', 'IT Room')->first();
			$IT_397 = Ws_Map::select('*')->where('no_seat', 397)->where('area', '=', 'IT Room')->first();
			$IT_398 = Ws_Map::select('*')->where('no_seat', 398)->where('area', '=', 'IT Room')->first();
			$IT_399 = Ws_Map::select('*')->where('no_seat', 399)->where('area', '=', 'IT Room')->first();
			$IT_400 = Ws_Map::select('*')->where('no_seat', 400)->where('area', '=', 'IT Room')->first();
			$IT_401 = Ws_Map::select('*')->where('no_seat', 401)->where('area', '=', 'IT Room')->first();
			$IT_402 = Ws_Map::select('*')->where('no_seat', 402)->where('area', '=', 'IT Room')->first();
			$IT_403 = Ws_Map::select('*')->where('no_seat', 403)->where('area', '=', 'IT Room')->first();
			$IT_404 = Ws_Map::select('*')->where('no_seat', 404)->where('area', '=', 'IT Room')->first();
			$IT_405 = Ws_Map::select('*')->where('no_seat', 405)->where('area', '=', 'IT Room')->first();
			$IT_406 = Ws_Map::select('*')->where('no_seat', 406)->where('area', '=', 'IT Room')->first();
			$IT_407 = Ws_Map::select('*')->where('no_seat', 407)->where('area', '=', 'IT Room')->first();
			$IT_408 = Ws_Map::select('*')->where('no_seat', 408)->where('area', '=', 'IT Room')->first();
			$IT_409 = Ws_Map::select('*')->where('no_seat', 409)->where('area', '=', 'IT Room')->first();
			$IT_410 = Ws_Map::select('*')->where('no_seat', 410)->where('area', '=', 'IT Room')->first();
			$IT_411 = Ws_Map::select('*')->where('no_seat', 411)->where('area', '=', 'IT Room')->first();
			$IT_412 = Ws_Map::select('*')->where('no_seat', 412)->where('area', '=', 'IT Room')->first();
			$IT_413 = Ws_Map::select('*')->where('no_seat', 413)->where('area', '=', 'IT Room')->first();
			$IT_414 = Ws_Map::select('*')->where('no_seat', 414)->where('area', '=', 'IT Room')->first();
			$IT_415 = Ws_Map::select('*')->where('no_seat', 415)->where('area', '=', 'IT Room')->first();
			$IT_416 = Ws_Map::select('*')->where('no_seat', 416)->where('area', '=', 'IT Room')->first();
			$IT_417 = Ws_Map::select('*')->where('no_seat', 417)->where('area', '=', 'IT Room')->first();
			$IT_418 = Ws_Map::select('*')->where('no_seat', 418)->where('area', '=', 'IT Room')->first();
			$IT_419 = Ws_Map::select('*')->where('no_seat', 419)->where('area', '=', 'IT Room')->first();
			$IT_420 = Ws_Map::select('*')->where('no_seat', 420)->where('area', '=', 'IT Room')->first();
			$IT_421 = Ws_Map::select('*')->where('no_seat', 421)->where('area', '=', 'IT Room')->first();
			$IT_422 = Ws_Map::select('*')->where('no_seat', 422)->where('area', '=', 'IT Room')->first();
			$IT_423 = Ws_Map::select('*')->where('no_seat', 423)->where('area', '=', 'IT Room')->first();
			$IT_424 = Ws_Map::select('*')->where('no_seat', 424)->where('area', '=', 'IT Room')->first();
			$IT_425 = Ws_Map::select('*')->where('no_seat', 425)->where('area', '=', 'IT Room')->first();
			$IT_426 = Ws_Map::select('*')->where('no_seat', 426)->where('area', '=', 'IT Room')->first();
			$IT_427 = Ws_Map::select('*')->where('no_seat', 427)->where('area', '=', 'IT Room')->first();
			$IT_428 = Ws_Map::select('*')->where('no_seat', 428)->where('area', '=', 'IT Room')->first();
			$IT_429 = Ws_Map::select('*')->where('no_seat', 429)->where('area', '=', 'IT Room')->first();
			$IT_430 = Ws_Map::select('*')->where('no_seat', 430)->where('area', '=', 'IT Room')->first();
			$IT_431 = Ws_Map::select('*')->where('no_seat', 431)->where('area', '=', 'IT Room')->first();
			$IT_432 = Ws_Map::select('*')->where('no_seat', 432)->where('area', '=', 'IT Room')->first();
			$IT_433 = Ws_Map::select('*')->where('no_seat', 433)->where('area', '=', 'IT Room')->first();
			$IT_434 = Ws_Map::select('*')->where('no_seat', 434)->where('area', '=', 'IT Room')->first();
			$IT_435 = Ws_Map::select('*')->where('no_seat', 435)->where('area', '=', 'IT Room')->first();
			$IT_436 = Ws_Map::select('*')->where('no_seat', 436)->where('area', '=', 'IT Room')->first();
			
		    return view::make('IT.WS_MAP.IT_room.index_it_map', [
		 	"IT_396" => $IT_396,
		 	"IT_397" => $IT_397,
		 	"IT_398" => $IT_398,
		 	"IT_399" => $IT_399,
		 	"IT_400" => $IT_400,
		 	"IT_401" => $IT_401,
		 	"IT_402" => $IT_402,
		 	"IT_403" => $IT_403,
		 	"IT_404" => $IT_404,
		 	"IT_405" => $IT_405,
		 	"IT_406" => $IT_406,
		 	"IT_407" => $IT_407,
		 	"IT_408" => $IT_408,
		 	"IT_409" => $IT_409,
		 	"IT_410" => $IT_410,
		 	"IT_411" => $IT_411,
		 	"IT_412" => $IT_412,
		 	"IT_413" => $IT_413,
		 	"IT_414" => $IT_414,
		 	"IT_415" => $IT_415,
		 	"IT_416" => $IT_416,
		 	"IT_417" => $IT_417,
		 	"IT_418" => $IT_418,
		 	"IT_419" => $IT_419,
		 	"IT_420" => $IT_420,
		 	"IT_421" => $IT_421,
		 	"IT_422" => $IT_422,
		 	"IT_423" => $IT_423,
		 	"IT_424" => $IT_424,
		 	"IT_425" => $IT_425,
		 	"IT_426" => $IT_426,
		 	"IT_427" => $IT_427,
		 	"IT_428" => $IT_428,
		 	"IT_429" => $IT_429,
		 	"IT_430" => $IT_430,
		 	"IT_431" => $IT_431,
		 	"IT_432" => $IT_432,
		 	"IT_433" => $IT_433,
		 	"IT_434" => $IT_434,
		 	"IT_435" => $IT_435,
		 	"IT_436" => $IT_436,
		 ]);
	}
}