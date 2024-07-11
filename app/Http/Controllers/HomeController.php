<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Log_Attempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

use App\User;

class HomeController extends Controller
{

    public function showIndex()
    {
        if (Auth::user()) {
            if (Auth::user()->active === 1) {
                return View::make('index');
            } else {
                Auth::logout();
                return Redirect::route('index')->with('getError', Lang::get('messages.acc_banned'));
            }
        } else {
            return View::make('login');
        }
    }

    public function doLogin(Request $request)
    {

        function getClientIP()
        {

            if (isset($_SERVER)) {

                if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
                    return $_SERVER["HTTP_X_FORWARDED_FOR"];

                if (isset($_SERVER["HTTP_CLIENT_IP"]))
                    return $_SERVER["HTTP_CLIENT_IP"];

                return $_SERVER["REMOTE_ADDR"];
            }

            if (getenv('HTTP_X_FORWARDED_FOR'))
                return getenv('HTTP_X_FORWARDED_FOR');

            if (getenv('HTTP_CLIENT_IP'))
                return getenv('HTTP_CLIENT_IP');

            return getenv('REMOTE_ADDR');
        }
        /////////////////////////////////////////////////////////////////////////
        if (Auth::user()) {

            return Redirect::route('index')->with('getError', Lang::get('messages.yes_login'));
        } else {
            $rules = [
                'username' => 'required',
                'password' => 'required|min:5'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect::route('index')
                    ->withErrors($validator)
                    ->withInput($request->except(['password']));
            } else {
                $userdata = [
                    'username' => $request->input('username'),
                    'password' => $request->input('password'),
                ];

                if (Auth::attempt($userdata)) {

                    if (Auth::user()->active === 1 && Auth::user()->block_stat < 5) {
                        $block =  0;
                        $online = 1;
                        $b = [
                            'request_ip' => getClientIP() . '',
                            'block_stat' => $block,
                            'online' => $online
                        ];

                        $attemptLogin = [
                            'user_id'       => auth()->user()->id,
                            'ip_address'    => $request->ip(),
                            'hostname'      => gethostbyaddr($request->ip())
                        ];

                        Log_Attempt::create($attemptLogin);

                        User::where('username', $request->input('username'))->update($b);

                        return Redirect::route('index')->with('message', Lang::get('messages.welcome', ['name' => Auth::user()->first_name . ' ' . Auth::user()->last_name]))->with('messagee', Lang::get('messages.security_first'));
                    } elseif (Auth::user()->active === 1 && Auth::user()->block_stat >= 5) {
                        Auth::logout();
                        return Redirect::route('index')->with('getError', Lang::get('messages.blocked'));
                    } else {
                        Auth::logout();
                        return Redirect::route('index')->with('getError', Lang::get('messages.acc_banned'));
                    }
                } elseif (User::where('username', $request->input('username'))->increment('block_stat')) {
                    return Redirect::route('index')->with('getError', Lang::get('messages.dede'))->withInput($request->except(['password']));
                } else {
                    return Redirect::route('index')->with('getError', Lang::get('messages.login_fail'))->withInput($request->except(['password']));
                }
            }
        }
    }

    public function logout(Request $request)
    {
        $online = 0;
        $b = ['online' => $online];

        /*User::where('id', '=', $id)->update($b);*/
        $a = User::where('id', '=', $request)->update($b);
        //dd(User::where('id', '=', $request));
        Auth::logout();

        return Redirect::route('index')->with('message', Lang::get('messages.thankyou'));
    }

    public function changePassword()
    {
        return View::make('change-password');
    }

    public function updatePassword(Request $request)
    {
        $rules = [
            'oldpassword'      => 'required|min:5',
            'newpassword'      => 'required|min:5',
            'confnewpassword' => 'required|min:5|same:newpassword'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('get_change-password')
                ->withErrors($validator);
        } else {
            if (Hash::check($request->input('oldpassword'), User::where('id', Auth::user()->id)->value('password'))) {
                User::where('id', Auth::user()->id)->update([
                    'password' => Hash::make($request->input('newpassword'))
                ]);

                Session::flash('message', Lang::get('messages.passwd_changed'));
                return Redirect::route('index');
            } else {
                return Redirect::route('get_change-password')->withErrors(['oldpassword' => Lang::get('messages.oldpasswd_wrong')]);
            }
        }
    }
}
