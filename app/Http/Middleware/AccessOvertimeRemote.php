<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Lang;

class AccessOvertimeRemote
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
        if (date('H') < 17) {
            return $next($request);
        }

        return redirect()->route('index')->with('getError', Lang::get('messages.remote_access_2300_'));
    }
}