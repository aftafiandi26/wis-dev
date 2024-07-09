<?php

namespace App\Http\Middleware;

use Auth;

use Closure;

class AuthFacilitiesAdmin
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
        if (Auth::user()->position != 'Admin Facility') {
            return Redirect::route('index')->with('getError', Lang::get('messages.no_access'));
        }
        return $next($request);
    }
}
