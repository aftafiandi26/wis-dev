<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Lang;

class AuthProductions
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
        if (auth()->user()->dept_category_id === 6) {
            return $next($request);
        }
        return redirect()->route('index')->with('getError', Lang::get('messages.no_access'));
    }
}
