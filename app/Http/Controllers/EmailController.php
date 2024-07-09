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

class EmailController extends Controller {

	public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function indexEmail()
    {
    	
    	return View::make('email.indexEmail');
    }

    public function sendEmail()
    {
        $select = Leave::joinUsers()->joinDeptCategory()->joinLeaveCategory()
                        ->orderBy('leave_transaction.id','dasc')
                        ->first();
		
		/*if (Auth::user()->hd === 1){
			$subject = '[Head of Department Approval Request] Leave Application - WIS';
			 $email = DB::table('users')
                            ->select(DB::raw('email'))
                            ->where('hd', '=', 1)
                            ->first();
		} if (Auth::user()->gm === 1){
			$subject = '[General Manager Approval Request] Leave Application - WIS';
			$email = DB::table('users')
                            ->select(DB::raw('email'))
                            ->where('gm', '=', 1)
                            ->first();
		}if (Auth::user()->hr === 1){
			$subject = '[Verify Request] Leave Application - WIS';
			$email = DB::table('users')
                            ->select(DB::raw('email'))
                            ->where('hr', '=', 1)
                            ->first();
		}
		*/
        $subject = '[Verify Request] Leave Application - WIS';
       

        // $email;

        // if(Auth::user()->hd === 1) {
        //     $email = DB::table('users')
        //                     ->select(DB::raw('email'))
        //                     ->where('gm', '=', 1)
        //                     ->first();
        //     } else {
        //     $email = DB::table('users')
        //                     ->select(DB::raw('email'))
        //                     ->where('dept_category_id', '=', Auth::user()->dept_category_id)
        //                     ->where('hd', '=', 1)
        //                     ->first();
        //     }

        $email = DB::table('users')
                            ->select(DB::raw('email'))
                            //->where('hr', '=', 1)
                            ->get();
/*
    	   return dd($select);   */	
    	Mail::send('email.verMail', ['select' => $select], function($message) use ($email, $subject)
    	{
            foreach ($email as $e){
            $message->to($e->email)->subject($subject);
            }
            
            $message->from('wis_system@frameworks-studios.com', 'WIS');
    	});
      

    	return Redirect::route('leave/transaction');
    }

    

}
