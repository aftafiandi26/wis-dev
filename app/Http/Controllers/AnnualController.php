<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

use Mail;
use App\Leave;
use App\NewUser;

class AnnualController extends Controller {

	public function __construct()
    {
        $this->middleware(['auth', 'active', 'admin']);
    }

    public function indexAnnual()
    {
    	
    	return View::make('annual.indexAnnual');
    }

    public function action()
    {
    	DB::update('update users SET initial_annual = initial_annual + 12 WHERE emp_status = "Permanent"');

        return Redirect::route('annual/index');
    }

}
