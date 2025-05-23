<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;

class AuthProductionTechnology
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
        if (auth()->user()->dept_category_id == 10) {
            # code...
            return $next($request);
        }

        return Redirect::route('index')->with('getError', Lang::get('messages.no_access'));
    }
}