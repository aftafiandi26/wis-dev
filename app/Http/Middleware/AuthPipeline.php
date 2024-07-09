<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Lang;

class AuthPipeline
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
        if (Auth::user()->level_hrd !== "Senior Pipeline") {
            return Redirect::route('index')->with('getError', Lang::get('messages.no_access'));

        }
        return $next($request);
    }
}
