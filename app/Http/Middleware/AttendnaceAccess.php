<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class AttendnaceAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->dept_category_id == 6 || auth()->user()->dept_category_id == 7) {
            return $next($request);
        }

        Session::flash('getError', Lang::get('messages.no_access'));
        return redirect()->route('index');
    }
}