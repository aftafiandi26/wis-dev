<?php

namespace App\Http\Middleware;

use Auth;

use Closure;

class authDeptApprovedHOD
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
        if (Auth::user()->dept_ApprovedHOD === 0) {
            return Redirect::route('index')->with('getError', Lang::get('messages.no_access'));
        }

        return $next($request);
    }
}
